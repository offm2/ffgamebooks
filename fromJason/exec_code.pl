require "evalexpr.pl";

############# DOES NOT YET RECURSIVELY CHECK FOR LIBRARY FILES REQUIRED BY INCLUDED LIBRARY FLES

### EXEC_CODE
### parameters	(1)the code to execute in one string 
###		(2)pathname -inc. filename- of the permanent variables file 
###		(3)path & filename of the output file
###		(4)path & filename of the debug output file
###		(5)path and filename of an associated SEL library file 
sub exec_code
{
	my $code_chunk=shift;
	my $perm_vars_filepath=shift; 
	$print_file=shift;
	$debug_file_path=shift; ## currently needs to be global for &printdebug only
	$sel_file=shift;
	my @cla=@_;
	
	local $debug_line_evaluating_string, $debug_function_evaluating_string;
	
	######## GLOBALS DECLARATION #########

	## permvars_x and temps_x are flag hashes as a variable may exist but be undefined in value
	
	$debug_file_path=0; ## comment out this line to switch debugging output on
	
	%permvars;
	%permvars_x;
	
	%temps;
	%temps_x;
	
	%killvar;

	$sel_output_line_counter=0; ## make static in &printdebug? - static not possible in perl
	$debug_line_counter=0; ## make static in &printdebug?
	$kill_runaway_counter=0; ## make static in &printdebug?
	
	local %function_code;
	
	######## END GLOBALS DECLARATION #########

	## flush the output file
	if (defined($print_file))
	{
		open (PRINTFILE, ">$print_file") or die "failed to open print outputfile $print_file";
		close PRINTFILE;
	}
	
	## load environment:
	## 1) Open the DEBUG filehandle
	## 2) Reads in the list of libraries associated with the 1 SEL file passed to exec_code
	## 3) Calls 'parse_code_files' on passed code, SEL file and associated libraries
	## 4) Reads in the Permanent variables from the designated file to the global hash
	## if exec_code is called from another perl script it may well be called more than
	## once from that script.  If this is the case then the actions that take place here
	## need only occur once, *assumes* the same environment will be wanted for all calls
	## BAD PRACTICE and must be corrected
	
	if (!(defined(fileno(DEBUG))))
	{
		if($debug_file_path)
		{
			open (DEBUG, ">$debug_file_path") or die "failed to open DEBUG stream: $!";
		}
	}

	if (!(defined($environment_loaded)))
	{
		my @function_lib;
		my %included_libs;
		
		&get_libraries($sel_file,\%included_libs,\@function_lib);
		
		&parse_code_files($code_chunk, @function_lib);

		&loadpermvars($perm_vars_filepath);
		
		### store 'command line arguments' to permvar argv array (overrides any permvars called $argv)
		$permvars{'argv'}=\@cla;
		$permvars_x{'argv'}=1;

		### stays global so is remembered between calls to exec_code - replace with 'static' declaration?
		### no - considering ditching environment loaded due to previous assumption
		$environment_loaded=1;
		
		&printdebug ("<BR>Loaded Environment<BR>");
	}
	else
	{
		&parse_file("main",$code_chunk);
	}
	
	### go to code execution
	@main_result=&interpolate(&handle_function_call("main"));

	&savepermvars($perm_vars_filepath);

	if (defined(fileno(DEBUG)))
	{
		close DEBUG;
	}
	
	## not sure why differentiation is needed...
	if (@main_result>1)
	{
		return @main_result;
	}
	else
	{
		return $main_result[0];
	}

}

sub get_libraries{
	my $sel_file=shift;
	my $checklist_hashref=shift;
	my $lib_list_ref=shift;
	
	${$checklist_hashref}{$sel_file}=1;
	push @{$lib_list_ref}, $sel_file;

	$sel_file=~/(.*)sel$/i;
	my $libpathsfile=($1."inc");
	
	my $functionlibscount=@{$lib_list_ref};

	if($libpathsfile){
		if (open (my $fh, "<", "$libpathsfile"))
		{
			local $_;
			while(<$fh>)
			## while (defined(${$lib_list_ref}[$functionlibscount]=<$fh>))
			{
				chomp;
				if(${$checklist_hashref}{$_}!=1){
					&get_libraries($_,$checklist_hashref,$lib_list_ref);
				}
				## $functionlibscount=@{$lib_list_ref};
			}
			close $fh;
		}
		else
		{
			die "failed to open library: $libpathsfile, $!\n";
		}
	}
}

#### parameters: none
### assumes PERMVARS filehandle is open for reading
#### note: returns a REFERENCE to the sublist
sub read_sublist
{
	my @anon_list;
	my $varline;
	my $index_count=0;
	
	my $return_list=\@anon_list;
	
	my ($name, $value, $assign);
	
	$varline=<PERMVARS>;
	while( (defined($varline)) and ($assign ne "]"))
	{
		chomp $varline;	

		($name,$assign,$value)=(split (/(=|\[|\]|\*)/,$varline,2));
		
		if ($assign ne "*")
		{
			if ($assign eq "[")
			{
				${$return_list}[$index_count]=&read_sublist;
				$varline=<PERMVARS>;
			}
			elsif($assign eq "=")
			{
				${$return_list}[$index_count]=$value;
				$varline=<PERMVARS>;
			}
			elsif($assign eq "]")
			{ ## do nothing, do NOT read <PERMVARS> especially
			}
			else
			{
				die "unknown type symbol in permvar record";
			}
		}
		else
		{  
			$varline=<PERMVARS>;
		}
		$index_count++;
	}
	
	return $return_list;	
}

###### parameters 1) List reference
## assumes PERMVAR filehandle is open for writing
sub write_sublist
{
	my $listref=shift;
	
	my $nullcount=0;
	
	if (ref($listref) eq "ARRAY")
	{
		foreach $value (@{$listref})
		{
			if (defined ($value))
			{
				if ($nullcount)
				{
					for (1..$nullcount)
					{
						print PERMVARS "sublist*\n";
					}
					
					$nullcount=0;
				}

				if (ref($value))
				{
					print PERMVARS "sublist[\n";
					&write_sublist($value);
				}
				else
				{
					print PERMVARS "sublist=".$value."\n";
				}
			}
			else
			{
				$nullcount++;
			}

		}
		print PERMVARS "sublist]\n";
	}
	else
	{
		die "Invalid reference value passed to write_list";
	}
}


###########################################
## parameters (1) function name (2...) parameter list
sub handle_function_call
{
	my @parameters;
	my $function_name=shift;
	
	&printdebug ("Handle Function handling:$function_name\n");
	
	## strip the function denoting ampersand from function name if its still there
	$function_name =~ s/^\&//;
	
	my $parameter_count=0;
	# while($_=shift)
	while (defined($_=shift)) ## trips up on 0 parameters
	{
		$parameters[$parameter_count]=$_;
		&printdebug ("Handle_Function has received a parameter: $parameters[$parameter_count]\n");
		$parameter_count++;
	}
	
	## allowing recursion 27/4/08 if all goes well will have to remove @funcs_called and associated operations as it will be redundant
	## check for recursion - @func_stack MUST stay global (I suppose could be called local in &exec_code)
	#foreach $funcs_called (@func_stack)
	#{
	#	if ($funcs_called eq $function_name)
	#	{
	#		die "Recursive function call to function: $function_name";
	#	}
	#}
	
	push @func_stack, $function_name;
	&printdebug("Function_stack is adding:@func_stack");
	
	## completed function names are not popped off the stack in this sub as that is the responsibilty of process_function
	
	if ($function_name eq "return")
	{
		foreach $parameter (@parameters)
		{
			&printdebug ("return statement passed: $parameter\n");
		}
		## note that evalexpr will have calculated any expressions in parameters to 'return' already
		
		## if a list has been passed to return, return the list (probably just evaluating it as perl does)
		if(defined($parameters[1]))
		{		
			## interpolate any variables that have been passed as parameters
			
			for (my $paramindex=0;$paramindex<@parameters;$paramindex++)
			{
				splice @parameters,$paramindex,1,&interpolate($parameters[$paramindex]);
			}
			
			####### return reference to list??? Im not sure about this
			return \\@parameters;
		}
######## doh! the parameter might be a listname!!!! 
		else ## only 1 parameter given to &return, so return the value
		{						
			my @result=();
			push @result,(&interpolate($parameters[0]));
			if(@result > 1)
			{
				return \\@result;
			}
			else
			{
				return $result[0];
			}
		}
	}
	## we dont interpolate variables passed to inbuilt functions as they may operate on actual variable names
	else 
	{
		$return_val=&inbuilt($function_name, @parameters);
		
		&printdebug ("Return=$return_val");
		
		if (defined ($return_val))
		{
			&printdebug ("got here");
			return $return_val;
		}
		else
		{
			if (defined(@{$func_codelines{$function_name}}))
			{

				## interpolate any variables that have been passed as parameters

				for (my $paramindex=0;$paramindex<@parameters;$paramindex++)
				{
					splice @parameters,$paramindex,1,&interpolate($parameters[$paramindex]);
				}			

				#return &process_function($function_name,@parameters);
				
				my @func_result=&process_function($function_name,@parameters);		
				
				if (@func_result>1)
				{
					return \\@func_result;
				}
				else
				{
					return $func_result[0];
				}
			}
			else
			{
				$failed_func = pop @func_stack;
				$current_func = pop @func_stack;
				if ($function_name eq "main")
				{
					die "SEL command invoked without any code!";
				}
				else
				{
					die "Unknown function: $failed_func, called in function: $current_func";
				}
			}
		}
	}
}


########################################################
## parameters (1) function_name (2...) list of paramaters
sub process_function
{
	my $function_name=shift;
	my @return_val=0;
	
	$debug_function_evaluating_string=$function_name;
	
	my @parameters;
	
	## initialise local variables hash for this function block
	local %local_vars;
	local %local_vars_x;
	
	my $parameter_count=0;
	my $arg_name;
	my $is_list=0;
	
	## get parameters into local argument list
	while (defined($parameters[$parameter_count]=shift)) 
	# while ($parameters[$parameter_count]=shift) ## trips up on 0 paramters (?)
	{
		if (!($is_list))
		{
			$arg_name = ${$func_args{$function_name}}[$parameter_count];

			if ($arg_name)
			{
				$arg_name =~ s/([\$\@])//;

				if ($1 eq "\@")
				{
					$is_list=1;
					## put reference to anonymous list into $local_vars{$arg_name}, with parameter as element 0
					$local_vars{$arg_name}=[$parameters[$parameter_count]];
					$local_vars_x{$arg_name}=1;
				}
				else
				{
					$is_list=0;
					$local_vars{$arg_name}=$parameters[$parameter_count];
					$local_vars_x{$arg_name}=1;
				}
			}
		}
		else
		{
			push @{$local_vars{$arg_name}}, $parameters[$parameter_count];
		}
		$parameter_count++;
	}

	my @codelines=@{$func_codelines{$function_name}};
	
	@return_val=&process_block(\@codelines,1);

	my $stacktop=pop @func_stack;
	if ($stacktop eq "return")
	{
		if (($stacktop=pop @func_stack) eq "main")
		{
			die "statement -return- not allowed in -main-";
		}
		push @func_stack, $stacktop;
	}
	
	&printdebug ("returning value(s): \"@return_val\", from function: $function_name\n");

	return @return_val;
}

##############################################
## slightly inefficient - could rejig to make better use of $evaluating
sub process_block
{
	my $codelines_ref=shift;
	my $evaluating=shift; ## 1 for true, 0 for false
	my @return_val;
	my $stacktop;
	my $code_line=shift @{$codelines_ref};
	
	$debug_line_evaluating_string=$code_line;

	#### BAD BAD CODING this condition has caused serious problems, the pop part means that func_stack is popped every time a block finishes
	## the defined must be removed at sometime to enable block nesting error catching - note arrangement will have to be made for 'main' to do this
	## important that the pop statement is first in test
	while( (($stacktop=pop @func_stack) ne "return") and ($code_line ne "}") and (defined($code_line)) )
	{
		push @func_stack, $stacktop;
		
		if (!(defined($code_line)))
		{
			die "Block nesting error\n";
		}

		if ($code_line eq ";")
		{
			## end of line marker - do nothing (?)
		}
		elsif($code_line eq "{")
		{
			@return_val=&process_block(\@{$codelines_ref},$evaluating);
		}
		elsif($code_line =~ /^\s*IF\s*\((.*)\)\s*$/i)
		{
			my $if_condition=$1;
			
			my $next_item=shift @{$codelines_ref};
			
			if ($next_item eq "{")
			{
				if ($evaluating)
				{
					my @condition_result=&evaluate_string($if_condition);
					
					# if a list of values was returned its a true result
					if (@condition_result>1)
					{						
						@return_val=&process_block(\@{$codelines_ref},1);
						
						my $next_line=shift @{$codelines_ref};
						
						if ($next_line=~/^\s*ELSE\s*$/i)
						{
							if ((shift @{$codelines_ref}) eq '{')
							{
								@return_val=&process_block(\@{$codelines_ref},0);
							}
							else
							{
								die "sel ELSE statement requires a block to be opened with { immiediately afterwards\n";
							}
						}
						else
						{
							unshift @{$codelines_ref},$next_line;
						}
					}
					# if the single value returned is a non-zero val, therefore true
					elsif($condition_result[0])
					{
						@return_val=&process_block(\@{$codelines_ref},1);
						
						my $next_line=shift @{$codelines_ref};
						
						if ($next_line=~/^\s*ELSE\s*$/i)
						{
							if ((shift @{$codelines_ref}) eq '{')
							{
								&process_block(\@{$codelines_ref},0);
								#### this was a major fuckup - pushing return value from an unevaluated block into @return_val, doh!!!!
								## @return_val=&process_block(\@{$codelines_ref},0);
							}
							else
							{
								die "sel ELSE statement requires a block to be opened with { immiediately afterwards\n";
							}
						}
						else
						{
							unshift @{$codelines_ref},$next_line;
						}
					}
					# the single value returned is zero (false)
					else
					{
						&process_block(\@{$codelines_ref},0);
						
						my $next_line=shift @{$codelines_ref};
						
						if ($next_line=~/^\s*ELSE\s*$/i)
						{
							if ((shift @{$codelines_ref}) eq '{')
							{
								@return_val=&process_block(\@{$codelines_ref},1);
							}
							else
							{
								die "sel ELSE statement requires a block to be opened with { immiediately afterwards\n";
							}
						}
						else
						{
							unshift @{$codelines_ref},$next_line;
						}
					}
				}
				else
				{
					&process_block(\@{$codelines_ref},0);
				}
			}
			else
			{
				die "sel IF statement requires a block to be opened with { immiediately afterwards\n";
			}
		}
		elsif($code_line =~ /^\s*WHILE\s*\((.*)\)\s*$/i)
		{
			my $while_condition=$1;
			
			my $next_item=shift @{$codelines_ref};
			
			if ($next_item eq "{")
			{
				if ($evaluating)	
				{
					my @condition_result=&evaluate_string($while_condition);

					# if a list of values was returned its a true result
					if (@condition_result>1)
					{	
						my @block_copy=@{$codelines_ref};
						
						unshift @{$codelines_ref},$code_line,'{';
												
						@return_val=&process_block(\@block_copy,1);
						
					}
					# if the single value returned is a non-zero val, therefore true
					elsif($condition_result[0])
					{
						my @block_copy=@{$codelines_ref};
						
						unshift @{$codelines_ref},$code_line,'{';
						
						@return_val=&process_block(\@block_copy,1);

					}
					# the single value returned is zero (false)
					else
					{
						&process_block(\@{$codelines_ref},0);
					}
				}
				else
				{
					&process_block(\@{$codelines_ref},0);
				}
			}
			else
			{
				die "sel WHILE statement requires a block to be opened with { immiediately afterwards\n";
			}

		}
		else
		{
			if ($evaluating)
			{
				&printdebug ("evaluating code:\"$code_line\"\n");
				@return_val=&evaluate_string($code_line);
				&printdebug ("evaluate_string evaluated $code_line to: @return_val\n");
			}
		}
		
		$code_line=shift @{$codelines_ref};
	}
	
	
######### fixes not returning error (i hope) without this line &return is acting simply as a Perl exit command
	if(($stacktop eq 'return') or($code_line eq '}') or(!(defined($code_line)))){push @func_stack, $stacktop;$stacktop="";}
	&printdebug("Function_stack is:@func_stack");
	return @return_val;
	
}



##############################################
## parameters (1) 'main' function code chunk (2...) list of library files inc. pathnames
sub parse_code_files
{
	### basically seperates the filenames from the FQN, sticks the filename in a
	### checklist of filenames to ensure that libraries of the same filename aren't 
	### processed twice, and passes info for each file to parse_file procedure
	### the recursive library loading should be done here
	
	local %library_list;
	my @libs_compiled;
	$main=shift;
	
	while (defined($library_pathfile=shift) )
	{
		my @parts = split /\\|\//,$library_pathfile;
		
		my $part= pop @parts;
		
		$library_list{$part}=$library_pathfile;
	}
	
	&parse_file("main",$main);
	push @libs_compiled, "main";
	
	foreach $next_file (keys (%library_list))
	{
		my $count=0;
		my $done=0;
		## check to see if this filename ($next_file) already compiled
		while ( (defined($compiled = $libs_compiled[$count])) and !($done) )
		{
			if ($next_file eq $compiled)
			{
				$done=1;
			}
			$count++
		}
		if (!($done))
		{
			&parse_file($next_file,$library_list{$next_file});
			push @libs_compiled, $next_file;
		}
	}
	
	## test functions loaded, output to debug - very verbose debug output, should remove as works atm
	foreach $testfunc (keys(%func_codelines))
	{
		my $x=0;
		foreach $testline (@{$func_codelines{$testfunc}})
		{
			&printdebug ("$testfunc line $x = \"$testline\"\n");
			$x++;
		}
	}
}

## parameters (1) name of library file (2) fully qualified name (i.e. inc. paths) - or code to execute if 'main'
sub parse_file
{
	my $rawcode="";
	$libname=shift;
	
	&printdebug ("parsing file: $libname\n");
	
	if ($libname eq "main")
	{
		$rawcode=shift;
		@{$func_codelines{$libname}}=();
	}
	else
	{
		$lib_file=shift;
		
		&printdebug ("reading lib file at location: $lib_file\n");

		if (open (LIBFILE, "<$lib_file"))
		{
			while (<LIBFILE>)
			{
				## remove comments - anything after and including a # sign unless preceeded by an escape \
				s/([^\\\#])?\#.*/$1/;
				## comment removal not working - why? - seems to work now
				chomp;
				$rawcode.=$_;
			}
			close LIBFILE;
		}
		else
		{
			&printdebug("failed to open library file $lib_file: $!");
		}
	}
	
	&printdebug ("rawcode is:\"$rawcode\"\n");
	
	# split all code up on { } ; and unescaped "
	@split_code = split /(\;|\{|\}|\\.|\'|\")/,$rawcode;
	
	&printdebug ("Split code=@split_code");
	
	### go through the split code cleaning whitespace, assigning statements to functions, and pushing 'include/use' files onto list of files to be included (@library_list)
	### also check for validity of open/close {} etc. and prevent subs declaration inside subs
	
	if ($libname eq "main")
	{
		$current_function="main";
	}
	else
	{
		$current_function="none";
	}
	
	my $block_depth=0;
	
	my $is_literal=0;
	my $was_literal=0;
	my $lit_delim="";
	
	foreach $raw_statement (@split_code)
	{
		&printdebug ("checking raw statement:\"$raw_statement\"\n");
		
		## strip trailing and leading whitespace from statement, as long as its not a literal part
		
		if (!($is_literal))
		{
			$raw_statement =~ s/^\s+//;
			$raw_statement =~ s/\s+$//;
		}
		
		## skip statement if whitespace strip has left nothing in it
		if ( ((defined($raw_statement)) and ($raw_statement ne "")) or $is_literal)
		{
			if ( $raw_statement=~ /^\s*sub\s+([A-Za-z_]\w*)\((.*)\)/ ) ## matches a sub declaration, paranthesis compulsory, $1=func name, $2=argument declarations (if any)
			{
				## ensure sub declaration not nested
				if ($current_function eq "none")
				{
					$func_name=$1;
					$arg_list_string=$2;
					$argument_declaration_string=$2;
					
					if ($func_name eq "main")
					{
						die "Functions may not be named \"main\" - found in library file $libname";
					}
					else
					{
						$current_function=$func_name;
						$func_arg_declaration{$current_function}=$argument_declaration_string;
						$func_codeline_count=0;
						
						## initialise codelines list for this function - clears existing lines if this is a duplicate function declaration (e.g. someone overriding a library function)
						@{$func_codelines{$current_function}}=();
						
						## set up argument list required
						my @arg_list = (split (/\,/,$arg_list_string));
						foreach (@arg_list)
						{
							## if the arg matches a valid variable pattern, with the addition of a possible list type argumaent variable (the @)
							if (/\s*([\$\@][A-Za-z_]\w*)\s*/)
							{
								## then put it into the argument definition list for this function
								push @{$func_args{$current_function}}, $1;
							}
						}
					}
				}
				else
				{
					die "cannot nest Sub declaration inside function $current_function, declared in library file $libname";
				}
			}
			else ## must be some code statements (not a sub declaration)
			{
				## no code is allowed outside function definitions except in 'main' (which is treated as a function anyway)
				if ($current_function eq "none")
				{
					die "Code is not allowed in library files outside of a function definition - error in library file: $libname, near $raw_statement";
				}
				else
				{					
					
					if($is_literal)  ## dealing with being inside a string literal - allows strings to contain { } and ; chars
					{
						if ($raw_statement eq $lit_delim)
						{
							$is_literal=0;
							$was_literal=1;
							
							&printdebug ("\nexiting literal\n");
						}
						
						my $prior_codeline = pop @{$func_codelines{$current_function}};
						$prior_codeline.=$raw_statement;
						push @{$func_codelines{$current_function}}, $prior_codeline;
						&printdebug ("building string with: $prior_codeline\n");
					}
					elsif ($raw_statement eq "{") ## checking block nesting to determine whether function has started or finished
					{
						$block_depth++;
						
						if ($block_depth>1) ## must be a brace used for a purpose other than function definition so leave it in codelines
						{
							push @{$func_codelines{$current_function}}, $raw_statement;
						}
						else ## leave braces marking start of function out of code list so do nothing
						{
							## forgot about braces in main - duh
							if ($current_function eq "main")
							{
								push @{$func_codelines{$current_function}}, $raw_statement;
							}
						}
					}
					elsif ($raw_statement eq "}")
					{
						$block_depth--;
						if ($block_depth < 1)
						{
							if ($block_depth==0)
							{
								if ($current_function eq "main")
								{
									push @{$func_codelines{$current_function}}, $raw_statement;
								}
								else
								{
									$current_function="none";
								}
							}
							else ## block depth gone negative therefore error in code - this should never be reached as check for code outside of main should trap before this
							{
								die "Unexpected close block bracket - } - in library $libname";
							}
						}
						else ## must be a brace used for a purpose other than function definition so leave it in codelines
						{
							push @{$func_codelines{$current_function}}, $raw_statement;
						}
					}
					elsif (($raw_statement eq "\"") or ($raw_statement eq "\'"))
					{
						$lit_delim=$raw_statement;
						
						
						$is_literal=1;
						
						my $prior_codeline = pop @{$func_codelines{$current_function}};

						if (($prior_codeline ne ";") and ($prior_codeline ne "}") and ($prior_codeline ne "{"))
						{
							$prior_codeline.=$raw_statement;
							push @{$func_codelines{$current_function}}, $prior_codeline;
						}
						else
						{
							push @{$func_codelines{$current_function}}, $prior_codeline, $raw_statement;
						}
						
						&printdebug ("\nbeginning literal\n");
					}
					else
					{
						## must be some kind of code so stick the code item into the functions list
						
						if ($was_literal)  ##concatenate raw statement if the previous item is an incomplete codeline from literal construction
						{
							$was_literal=0;
							
							my $prior_codeline = pop @{$func_codelines{$current_function}};
							
							if ($raw_statement ne ";") ## unless the remaining raw statement is an end of line indicator of course, we dont want to concatenate that onto the codeline
							{
								$raw_statement= $prior_codeline.$raw_statement;
							}
							else
							{
								push @{$func_codelines{$current_function}}, $prior_codeline;
							}
						}
						push @{$func_codelines{$current_function}}, $raw_statement;
					}
				}
			}
		}
	}	
}

sub inbuilt
{
	my $function_name = shift;
	my $returnvalue=0;
	
################### permvar function - parameters: list of variable names
	if ($function_name eq "permvar")
	{
		my @parameters;

		my $parameter_count=0;
		while (defined($parameters[$parameter_count]=shift))
		{
			if ($parameters[$parameter_count] =~ /\$([A-Za-z_]+\w*)/)
			{
				$varname=$1;
				
				if ($permvars_x{$varname})
				{
					# already a permvar so ignore
				}

				elsif ($local_vars_x{$varname})
				{
					&printdebug ("\nWarning - Cannot make local variable Permanent\n");
				}
				elsif ($temps_x{$varname})
				{
					$permvars{$varname}=$temps{$varname};
					$permvars_x{$varname}=1;
					
					&printdebug ("made $varname permanent with a value of $temps{$varname} \n");
					
					$temps{$varname}=undef;
					$temps_x{$varname}=0;
					
					$returnvalue++;
				}
				
				else
				{
					$permvars{$varname}=undef;
					$permvars_x{$varname}=1;
					
					$returnvalue++;
				}
			}
			else
			{
				pop @func_stack;
				$calling_func=pop @func_stack;
				die "SEL function 'permvar' requires valid variables to operate on.  Invalid parameter \"$parameters[$parameter_count]\" passed to permvar in function: $calling_func";
			}
			
			$parameter_count++;
		}
	}
	
################### killvar function - parameters: list of variable names	
	### destroy variables by noting in the %killvar hash which vars should not be written out to file
	elsif ($function_name eq "killvar")
	{
		my @parameters;

		my $parameter_count=0;
		while (defined($parameters[$parameter_count]=shift))
		{
			if ($parameters[$parameter_count] =~ /\$([A-Za-z_]+\w*)/)
			{
				$varname=$1;
				$killvar{$varname}=1;
				
				$permvars{$varname}=undef;
				$permvars_x{$varname}=0;
				
				$returnvalue++;
			}
			else
			{
				pop @func_stack;
				$calling_func=pop @func_stack;
				die "SEL function 'killvar' requires valid variables to operate on.  Invalid parameter \"$parameters[$parameter_count]\" passed to killvar in function: $calling_func";
			}
			
			$parameter_count++;
		}
	}
################### add to list function - parameters 1) Listname to add to 2) list of values to add
## NOTE cannot have a quantity function as the removefrom function does as this can be used to abuse
### think i may have to replace permvarlist, tempslist and localvarslist with anon arrays, seems a bit dodgy as they only need to be anon and the existing names are used elsewhere
	elsif($function_name eq "addtolist")
	{
		## get the list to push onto
		my $list_name=shift;
				
		my $parameter;
		
		my @parameters;
		
		
		## get the parameters to push onto the list
		while (defined($parameter=shift))
		{
			push @parameters, $parameter;
		}
		
		## interpolate any variables that have been passed as parameters
		for (my $paramindex=0;$paramindex<@parameters;$paramindex++)
		{
			splice @parameters,$paramindex,1,&interpolate($parameters[$paramindex]);
		}
		
		

		if ($list_name =~ /\$([A-Za-z_]+\w*)/)
		{
			my $list=$1;

			if ($local_vars_x{$list})
			{
				## turn the variable into a list reference if necessary
				if (ref($local_vars{$list}) eq "")
				{
					my %localvarlist;
					if(defined($local_vars{$list})){
						my $oldval=$local_vars{$list};
						$localvarlist{$list}[0]=$oldval;
						$localvarlist{$list}[1]=shift @parameters;
					}
					else{
						$localvarlist{$list}[0]=shift @parameters;
					}
					$local_vars{$list}=\@{$localvarlist{$list}};
					$local_vars_x{$list}=1;
					$returnvalue++;
				}
				else
				{
					&printdebug ("variable $list is a reference\n");
				}
				
				#if (@{$local_vars{$list}}==1)  ## seems a little pointless?
				#{
				#	if(!(defined(${$local_vars{$list}}[0])))
				#	{
				#		${$local_vars{$list}}[0]=shift @parameters;
				#	}
				#}
				
				while (defined($parameter=shift @parameters))
				{
					push @{$local_vars{$list}}, $parameter;
					$returnvalue++;
				}
			}
			elsif ($permvars_x{$list})
			{
				## turn the variable into a list reference if necessary
				if (ref($permvars{$list}) eq "")
				{
					my %permvarlist;
					if(defined($permvars{$list})){
						my $oldval=$permvars{$list};
						&printdebug ("\n moving up existing value of - $oldval - into new list\n");
						$permvarlist{$list}[0]=$oldval;
						$permvarlist{$list}[1]=shift @parameters;
					}
					else{
						$permvarlist{$list}[0]=shift @parameters;
					}
					$permvars{$list}=\@{$permvarlist{$list}};
					$permvars_x{$list}=1;
					$returnvalue++;
				}
				else
				{
					&printdebug ("variable $list is a reference\n");
				}
				
				#if (@{$permvars{$list}}==1) ## pointless?
				#{
				#	if(!(defined(${$permvars{$list}}[0])))
				#	{
				#		${$permvars{$list}}[0]=shift @parameters;
				#	}
				#}


				while (defined($parameter=shift @parameters))
				{
					push @{$permvars{$list}}, $parameter;
					$returnvalue++;
				}
			}
			else ## do exactly the same but to a tempvar list
			{			
				## turn the variable into a list reference if necessary
				if (ref($temps{$list}) eq "")
				{
					my %tempslist;
					if(defined($temps{$list})){
						my $oldval=$temps{$list};
						$tempslist{$list}[0]=$oldval;
						$tempslist{$list}[1]=shift @parameters;
					}
					else{
						$tempslist{$list}[0]=shift @parameters;
					}
					$temps{$list}=\@{$tempslist{$list}};
					$temps_x{$list}=1;
					$returnvalue++;
				}
				
				#if (@{$temps{$list}}==1) ## pointless?
				#{
				#	if(!(defined(${$temps{$list}}[0]))) 
				#	{
				#		${$temps{$list}}[0]=shift @parameters;
				#	}
				#}
				
				
				while (defined($parameter=shift @parameters))
				{
					push @{$temps{$list}}, $parameter;
					$returnvalue++;
				}			
			}
		}
		elsif(ref($list_name)) ##array index
		{
			## array index holds scalar value
			if (ref (${$list_name}) eq "SCALAR")
			{
				&printdebug ("its a scalar ref\n");
				my @templist;
				if(defined(${${$list_name}})){
					my $oldval=${${$list_name}};
					$templist[0]=$oldval;
					$templist[1]=shift @parameters;
				}
				else{
					$templist[0]=shift @parameters;
				}
				${${$list_name}}=\@templist;
				$returnvalue++;
			}
			## array index holds reference to list
			elsif (ref (${$list_name}) eq "ARRAY")
			{
				&printdebug ("variable is Array reference\n");
			}
			elsif(ref (${$list_name}) eq "REF"){ ## array index not yet defined i think!  This does mean addtolist will bump out any deliberately null array indexes and also empty string indexes (:-s not good) and replace it with the first element of the new array, this may need reconsidering
				my @templist=();
				${${$list_name}}=\@templist;
			}
			else
			{
				$ref=ref(${$list_name});
				die "unknown reference passed to &addtolist ref type:($ref)";
			}
			
			while (defined($parameter=shift @parameters))
			{
				push @{${${$list_name}}}, $parameter;
				$returnvalue++;
			}
		}
		else
		{
			pop @func_stack;
			$calling_func=pop @func_stack;
			die "SEL function 'addtolist' requires a valid variable name as its first parameter - invalid name \"$list\" passed in function $calling_func";
		}
		
	}
################### splice function - parameters 1) Listname to splice 2) Offset 3)Length 4+) Replacement values
	elsif($function_name eq "splice")
	{
		my $listname=shift;

		my $parameter;
		
		my @parameters;
		
		
		## get the parameters
		while (defined($parameter=shift))
		{
			push @parameters, $parameter;
		}
		
		## interpolate any variables that have been passed as parameters
		for (my $paramindex=0;$paramindex<@parameters;$paramindex++)
		{
			splice @parameters,$paramindex,1,&interpolate($parameters[$paramindex]);
		}

		my $offset=shift @parameters;
		my $length=shift @parameters;
		
		if ($listname =~ /\$([A-Za-z_]+\w*)/)
		{
			my $list=$1;
			if($local_vars_x{$list})
			{
				if(ref($local_vars{$list}))
				{
					$returnvalue = splice @{$local_vars{$list}},$offset,$length,@parameters;
				}
				else
				{
					die "&splice passed scalar variable instead of list";
				}
			}
			elsif($temps_x{$list})
			{
				if(ref($temps{$list}))
				{
					$returnvalue = splice @{$temps{$list}},$offset,$length,@parameters;
				}
				else
				{
					die "&splice passed scalar variable instead of list";
				}			
			}
			elsif($permvars_x{$list})
			{
				if(ref($permvars{$list}))
				{
					$returnvalue = splice @{$permvars{$list}},$offset,$length,@parameters;
				}
				else
				{
					die "&splice passed scalar variable instead of list";
				}			
			}
			else ## create new array? no
			{
				die "&splice called on non-existant variable";
			}
		}
		elsif(ref($listname)) ## splice called on array element
		{
			## array element holds scalar value
			if (ref (${$list_name}) eq "SCALAR")
			{
				die "&splice called with Scalar value as list";
			}
			## array element holds reference to list
			elsif (ref (${${$list_name}}) eq "ARRAY")
			{
				&printdebug ("listname passed to &splice is array reference\n");
				
				$returnvalue = splice @{${${$list_name}}},$offset,$length,@parameters;
			}
			else
			{
				die "unknown reference passed to &splice";
			}
		}
		else
		{
			pop @func_stack;
			$calling_func=pop @func_stack;
			die "SEL function 'splice' requires a valid variable name as its first parameter - invalid name \"$list\" passed in function $calling_func";
		}
	#### doh! splice returns undef if no elements are removed!		
		if (!(defined($returnvalue))) { $returnvalue=0;} 
	}
################### remove from list function - parameters: 1) List name to remove values from 2)Number of times values should be removed (positive integer or ALL) 3) List of values to remove
	elsif($function_name eq "removefromlist")
	{
		## note - routine doesnt explicitly check for ALL as alternative to a quantity requirement - any non-numeric value is treated as ALL
		
		my $list_name=shift;
		
		my $quantity=shift;
		
		my @parameters;
		my $parameter;
		
		my $totalremoved=0;
		my $subremoved=0;
		
		while(defined($parameter=shift))
		{
			push @parameters, $parameter;
		}
		
		## interpolate any variables that have been passed as parameters (parameters 3 onwards, 1 and 2 have been dealt with)
		for (my $paramindex=0;$paramindex<@parameters;$paramindex++)
		{
			splice @parameters,$paramindex,1,&interpolate($parameters[$paramindex]);
		}
		
		if ($list_name =~ /\$([A-Za-z_]+\w*)/)
		{
			my $list=$1;
			
			if ($local_vars_x{$list})
			{
				if (ref($local_vars{$list})) ## the variable is a list
				{
					foreach $param (@parameters) ## loop through all the values we want removing
					{
						my $removed=0;
						## loop through all the elements in the list, or until quantity removed requirement is met
						for (my $listindex=0;($listindex<@{$permvars{$list}}) and ($removed ne $quantity);$listindex++)
						{
							## if the current element matches the current value to remove
							if ($param eq ${$local_vars{$list}}[$listindex])
							{
								splice(@{$local_vars{$list}},$listindex,1);
								$listindex--; ## splice has caused index denoted by listindex to be ahead one
								# ${$local_vars{$list}}[$listindex] = undef; ## replaced with splice above
								$removed++;
								$totalremoved++;

							}
							elsif(ref(${$local_vars{$list}}[$listindex])) # element is an array ref, recurse into this removal routine
							{
								$subremoved=&inbuilt("removefromlist",\\${$local_vars{$list}}[$listindex],($quantity-$removed),$param);
								$totalremoved+=$subremoved;
								$removed+=$subremoved;
							}
							else{## not value we are looking for, do nothing
							}
						}
					}
				}
				else ## the variable is a single scalar
				{
					my $removed=0;
					for (my $paramindex=0;($paramindex<@parameters) and (!($removed));$paramindex++)
					{
						if ($local_vars{$list} eq $parameters[$paramindex])
						{
							$local_vars{$list}=undef;
							$removed=1;
							$totalremoved++;
						}
						else{## not value we are looking for, do nothing
						}
					}
				}
			}
			if ($permvars_x{$list})
			{
				if (ref($permvars{$list}))
				{
					foreach $param (@parameters)
					{
						my $removed=0;
						for (my $listindex=0;($listindex<@{$permvars{$list}}) and ($removed ne $quantity);$listindex++)
						{
							if ($param eq ${$permvars{$list}}[$listindex])
							{
								splice(@{$permvars{$list}},$listindex,1);
								$listindex--; ## splice has caused index denoted by listindex to be ahead one
								## ${$permvars{$list}}[$listindex] = undef; ## replaced with splice above
								$removed++;
								$totalremoved++;
							}
							elsif(ref(${$permvars{$list}}[$listindex])) # element is an array ref
							{
								$subremoved=&inbuilt("removefromlist",\\${$permvars{$list}}[$listindex],($quantity-$removed),$param);
								$totalremoved+=$subremoved;
								$removed+=$subremoved;
							}
							else{## not value we are looking for, do nothing
							}
						}
					}
				}
				else
				{
					my $removed=0;
					for (my $paramindex=0;($paramindex<@parameters) and (!($removed));$paramindex++)
					{
						if ($permvars{$list} eq $parameters[$paramindex])
						{
							$permvars{$list}=undef;
							$removed=1;
							$totalremoved++;
						}
						else{## not value we are looking for, do nothing
						}
					}
				}
			}
			elsif($temps_x{$list})
			{
				if (ref($temps{$list}))
				{
					foreach $param (@parameters)
					{
						my $removed=0;
						for (my $listindex=0;($listindex<@{$temps{$list}}) and ($removed ne $quantity);$listindex++)
						{
							if ($param eq ${$temps{$list}}[$listindex])
							{
								splice(@{$temps{$list}},$listindex,1);
								$listindex--; ## splice has caused index denoted by listindex to be ahead one
								## ${$temps{$list}}[$listindex] = undef; ## replaced with splice above
								$removed++;
								$totalremoved++;
							}
							elsif(ref(${$temps{$list}}[$listindex])) # element is an array ref
							{
								$subremoved=&inbuilt("removefromlist",\\${$temps{$list}}[$listindex],($quantity-$removed),$param);
								$totalremoved+=$subremoved;
								$removed+=$subremoved;
							}
							else{## not value we are looking for, do nothing
							}
						}
					}
				}
				else
				{
					my $removed=0;
					for (my $paramindex=0;($paramindex<@parameters) and (!($removed));$paramindex++)
					{
						if ($temps{$list} eq $parameters[$paramindex])
						{
							$temps{$list}=undef;
							$removed=1;
							$totalremoved++;
						}
						else{## not value we are looking for, do nothing
						}
					}
				}
			}
			else
			{
				print "SEL Error: Cannot remove items from listname: $list, as listname does not exist<BR>";
			}
		}
		elsif (ref($list_name)) ## array index
		{
			my $list=$list_name;
			
			## must rediscover when (or if) a reference to a scalar is created
			if (ref(${$list}) eq "SCALAR")
			{
				my $removed=0;
				for (my $paramindex=0;($paramindex<@parameters) and (!($removed));$paramindex++)
				{
					if(${${$list}} eq $parameters[$paramindex])
					{
						${${$list}}=undef;
						$removed=1;
						$totalremoved++;
					}
					else{## not value we are looking for, do nothing
					}
				}
			}
			elsif(ref(${${$list}}) eq "ARRAY")
			{
				foreach $param (@parameters)
				{
					my $removed=0;
					for (my $listindex=0;($listindex<@{${${$list}}}) and ($removed ne $quantity);$listindex++)
					{
						if ($param eq ${${${$list}}}[$listindex])
						{
							splice(@{${${$list}}},$listindex,1);
							$listindex--; ## splice has caused index denoted by listindex to be ahead one
							## ${${${$list}}}[$listindex] = undef; ## replaced with splice above
							$removed++;
							$totalremoved++;
						}
						elsif(ref(${${${$list}}}[$listindex])) # element is an array ref
						{
							$subremoved=&inbuilt("removefromlist",\\${${${$list}}}[$listindex],($quantity-$removed),$param);
							$totalremoved+=$subremoved;
							$removed+=$subremoved;
						}
						else{## not value we are looking for, do nothing
						}

					}
				}				
			}
			else
			{
				die "unknown reference passed to &removefromlist";
			}
		}
		else
		{
			pop @func_stack;
			$calling_func=pop @func_stack;
			die "SEL function 'removefromlist' requires a valid variable name as its first parameter - invalid name \"$list\" passed in function $calling_func";
		}
		
		$returnvalue= $totalremoved;
	}
################### count values in list function - parameters: 1) Listname 2) Value that requires a count
### note if SEL is developed to allow a foreach capability then this function can be made redundant
	elsif($function_name eq "countinlist")
	{
		my $list=shift;
		
		my $valuetocount=shift;
		
		my $listelement;
		
		my $hitcount=0;
		
		if ($list =~ /\$([A-Za-z_]+\w*)/)
		{
			my $listname=$1;
			
			if ($local_vars_x{$listname})
			{
				if (ref ($local_vars{$listname}) )
				{
					if (defined($valuetocount))
					{
						foreach $listelement (&interpolate($list))
						{
							if ($listelement eq $valuetocount)
							{
								$hitcount++;
							}
						}

						$returnvalue= $hitcount;
					}
					else
					{
						$returnvalue=@{$local_vars{$listname}};
					}
				}
				else
				{
					if (defined($valuetocount))
					{
						if ($local_vars{$listname} eq $valuetocount)
						{
							$returnvalue= 1;
						}
						else
						{
							$returnvalue= 0;
						}
					}
					else
					{
						if (defined($local_vars{$listname}))
						{
							$returnvalue=1;
						}
						else
						{
							$returnvalue=0;
						}
					}
				}
			}			
			elsif ($permvars_x{$listname})
			{
				if (ref ($permvars{$listname}) )
				{
					if (defined($valuetocount))
					{
						foreach $listelement (&interpolate($list))
						{
							if ($listelement eq $valuetocount)
							{
								$hitcount++;
							}
						}

						$returnvalue= $hitcount;
					}
					else
					{
						$returnvalue=@{$permvars{$listname}};
					}
				}
				else
				{
					if (defined($valuetocount))
					{
						if ($permvars{$listname} eq $valuetocount)
						{
							$returnvalue= 1;
						}
						else
						{
							$returnvalue= 0;
						}
					}
					else
					{
						if (defined($permvars{$listname}))
						{
							$returnvalue=1;
						}
						else
						{
							$returnvalue=0;
						}
					}
				}
			}
			elsif($temps_x{$listname})
			{
				if (ref ($temps{$listname}) )
				{
					if (defined($valuetocount))
					{
						foreach $listelement (&interpolate($list))
						{
							if ($listelement eq $valuetocount)
							{
								$hitcount++;
							}
						}

						$returnvalue= $hitcount;
					}
					else
					{
						$returnvalue=@{$temps{$listname}};
					}
				}
				else
				{
					if (defined($valuetocount))
					{
						if ($temps{$listname} eq $valuetocount)
						{
							$returnvalue= 1;
						}
						else
						{
							$returnvalue= 0;
						}
					}
					else
					{
						if (defined($temps{$listname}))
						{
							$returnvalue=1;
						}
						else
						{
							$returnvalue=0;
						}
					}
				}
			}
			else
			{
				## print "SEL warning: countinlist function requires an existing variable to operate on as parameter 1.  Returning nothing.<BR>";
			}
		}
		elsif(ref($list)) ## array index
		{
			if (ref(${$list}) eq "SCALAR")
			{
				if (defined($valuetocount))
				{
					if(${${$list}} eq $valuetocount)
					{
						$returnvalue=1;
					}
					else
					{
						$returnvalue=0;
					}
				}
				else
				{
					if (defined(${${$list}}))
					{
						$returnvalue=1;
					}
					else
					{
						$returnvalue=0;
					}
				}
			}
			elsif (ref(${${$list}}) eq "ARRAY")
			{
				
				if (defined($valuetocount))
				{
					foreach $listelement (&interpolate($list))
					{
						if ($listelement eq $valuetocount)
						{
							$hitcount++;
						}	
					}
					
					$returnvalue=$hitcount;
				}
				else
				{
					$returnvalue=@{${${$list}}};
				}
			}
			else
			{
				die "Unknown reference passed to \&countinlist";
			}
		}
		else
		{
			pop @func_stack;
			$calling_func=pop @func_stack;
			die "SEL function 'countinlist' requires a valid variable name as its first parameter - invalid name \"$list\" passed in function $calling_func";
		}
	}
############### Random number function
	elsif($function_name eq "random")
	{
		my $lower=&interpolate(shift);
		my $higher=&interpolate(shift);
		
		my $ceiling=$higher-$lower;
		
		$returnvalue=$lower+int(rand($ceiling+1));
		
		
	}
############## local variable declaration parameters: list of varnames to be localised
	elsif($function_name eq "my")
	{
		my @parameters;

		my $parameter_count=0;
		while (defined($parameters[$parameter_count]=shift))
		{
			if ($parameters[$parameter_count] =~ /\$([A-Za-z_]+\w*)/)
			{
				$varname=$1;
				
				if ($local_vars_x{$varname})
				{
					# already a local var so ignore
				}
				elsif ($temps_x{$varname})
				{
					$local_vars{$varname}=$temps{$varname};
					$local_vars_x{$varname}=1;
					&printdebug ("created local var $varname with a value of $temps{$varname} \n");
					$returnvalue++;
				}
				else
				{
					### this might be bad - see permvar func for reason
					$local_vars{$varname}=undef;
					$local_vars_x{$varname}=1;
					$returnvalue++;
				}
			}
			else
			{
				pop @func_stack;
				$calling_func=pop @func_stack;
				die "SEL function 'my' requires valid variables to operate on.  Invalid parameter \"$parameters[$parameter_count]\" passed to my in function: $calling_func";
			}
			
			$parameter_count++;
		}	
	}
######################### print function, parameters: list of items to print
	elsif($function_name eq "print")
	{
		my @parameters;
		my $print_string;
		
		if (($sel_output_line_counter < 1000) && ($sel_output_line_counter > -1))
		{
			$sel_output_line_counter++;
			
			if (defined($print_file))
			{
				open (PRINTFILE, ">>$print_file") or die "failed to open print outputfile $print_file";
				while (defined($parameters[$parameter_count]=shift))
				{
					&printdebug ("\nPrint func gets here\n");
					print PRINTFILE &interpolate($parameters[$parameter_count]);
				}
				close PRINTFILE;
			}
			else
			{
				while (defined($parameters[$parameter_count]=shift))
				{
					print &interpolate($parameters[$parameter_count]);
				}		
			}
		}
		else
		{
			open (PRINTFILE, ">>$print_file") or die "failed to open print outputfile $print_file";
			&printdebug ("\nPrint func gets here\n");
			print PRINTFILE "\nSEL Output exceeds 1000 lines, probable runaway script detected, no more output for this invokation will be displayed or logged\n" ;
			close PRINTFILE;
			$sel_output_line_counter = -1;
		}
	}
####################### is_numeric function: parameter: item to check for being a number
	elsif($function_name eq "is_numeric")
	{
		my $parameter=&interpolate(shift);
		## $parameter="$parameter";
		if($parameter=~/[^\d\.]+/) {  ## if there's anything that isn't a digit or a period (decimal point)
			$returnvalue=0;
		}
		elsif($parameter=~/\..*\./){ ## if there's more than one period/decimal point
			$returnvalue=0;
		}
		elsif(($parameter eq '') or !(defined($parameter))){ ## catch empty variables
			$returnvalue=0;
		}
		else{
			$returnvalue=1;  ## then it's a number - note this does allow the decimal point to be the first or last character in the string, not sure about this
		}
	}
###################### defined function: parameter item to check for definition
	elsif($function_name eq "defined")
	{
		my $parameter=&interpolate(shift);
		$returnvalue=defined($parameter);
	}
###################### floor function, return rounding down of parameter
	elsif($function_name eq "floor"){
		my $parameter=&interpolate(shift);
		if($parameter=~/^\d+\.\d+$/){
			use POSIX;
			$returnvalue=floor($parameter);
		}
		else{
			$returnvalue=$parameter;
		}
	}
###################### ceiling function, return rounding up of parameter
	elsif($function_name eq "ceil"){
		my $parameter=&interpolate(shift);
		if($parameter=~/^\d+\.\d+$/){
			use POSIX;
			$returnvalue=ceil($parameter);
		}
		else{
			$returnvalue=$parameter;
		}
		
	}
###################### round function, return rounding to nearest of parameter
	elsif($function_name eq "round"){
		my $parameter=&interpolate(shift);
		if($parameter=~/^\d+\.\d+$/){
			use Math::Round;
			$returnvalue=round($parameter);
		}
		else{
			$returnvalue=$parameter;
		}
	}
	else
	{
		return undef;
	}
############### END of inbuilt function	list
	
	pop @func_stack;
	
	&printdebug ("<BR>Inbuilt function: $function_name returning value:$returnvalue<BR>");
	
	return $returnvalue;
}

sub printdebug
{
	if($kill_runaway_counter++ > 1000000)
	{
		die "Runaway Script detected - exceeds 1,000,000 debug comments, handling function: $debug_function_evaluating_string";
	}
	
	
	if (($debug_line_counter > -1) && ($debug_line_counter < 10000))
	{
		$debug_line_counter++;
		my $debug_line=shift;
		if($debug_file_path){
			print DEBUG $debug_line;
		}
	}
	elsif($debug_line_counter > -1)
	{
		# open (PRINTFILE, ">>$print_file") or die "failed to open print outputfile $print_file";
		if($debug_file_path){
			print DEBUG "\nDEBUG Output exceeds 10000 lines, possible runaway script detected, no more debug output for this invokation will be displayed or logged\n" ;
		}
		# close PRINTFILE;
		$debug_line_counter= -1;
	}
}

sub savepermvars
{
	my $perm_vars_filepath=shift;

	## save permanent variables from hash - note perm vars are not allowed to have '=' in their name
	### cant see any way to stop this bit happening each time a code segment is executed in a page, as only alternative I can see is enforcing the calling code be required to call a 'close up' routine at the end of page parsing
	open(PERMVARS, ">$perm_vars_filepath") or print "Failed to open permanent variables file $perm_vars_filepath: $!";
	foreach $varname (keys(%permvars_x))
	{
		if (!(defined($killvar{$varname})))
		{
			if (ref($permvars{$varname})) ## is a list
			{
				my $nullcount=0; ## the nullcount prevents trailing null values in a list from being recorded
				my $record_made; ## error note: cannot record a list with only 1 null value as a list with current list recording method
				foreach $value (@{$permvars{$varname}})
				{
						if (defined ($value))
						{
							$record_made=1;
							if ($nullcount)
							{
								for (1..$nullcount)
								{
									print PERMVARS $varname."*\n";
								}
								
								$nullcount=0;
							}
							
							if (ref($value))
							{
								print PERMVARS $varname."[\n";
								&write_sublist($value);
							}
							else
							{
								print PERMVARS $varname."=".$value."\n";
							}
						}
						else
						{
							$nullcount++;
						}
				}
				if(!($record_made)) ## catches lists with only null values, truncates to a regular var with 1 null value (bad bad bad)
				{
					print PERMVARS $varname."=\n";
				}
			}
			else
			{
				if(defined($permvars{$varname}))
				{
					print PERMVARS $varname."=".$permvars{$varname}."\n";
				}
				else
				{
					print PERMVARS $varname."*\n";
				}
			}
		}
	}
	close PERMVARS;
}

sub loadpermvars
{
	my $perm_vars_filepath=shift;

	## permanent variable loading into hash - note perm vars are not allowed to have '=' in their name
	open(PERMVARS, "<$perm_vars_filepath") or print "Failed to open permanent variables file: $!";

	my %permvarlistindexcount;

	while(defined($varline=<PERMVARS>))
	{
		chomp $varline;
		my ($name, $value, $assign);

		($name,$assign,$value)=(split (/(=|\[|\]|\*)/,$varline,2));

		if ($permvars_x{$name})
		{
			if ($assign eq "[")
			{
				$value=&read_sublist;
			}

			if($assign eq "*")
			{
				$permvarlistindexcount{$name}++;
			}
			else
			{
				if (ref ($permvars{$name}))
				#if ( (ref ($permvars{$name})) and $permvarlistindexcount{$name} > 1)
				{
					${$permvars{$name}}[$permvarlistindexcount{$name}]=$value;
					$permvarlistindexcount{$name}++;
				}
				else
				{
					my @anonlist;

					@anonlist=($permvars{$name},$value);

					$permvars{$name}=\@anonlist;
					$permvarlistindexcount{$name}=2;
				}
			}
		}
		else
		{
			$permvars_x{$name}=1;
			if ($assign eq "[")
			{
				 my @anon_list;
				 @anon_list=(&read_sublist);
				 $permvars{$name}=\@anon_list;
				# $permvars{$name}=&read_sublist;
			}
			else
			{
				if($assign ne "*")
				{
					$permvars{$name}=$value;
				}
			}
			$permvarlistindexcount{$name}=1;				
		}
	}
	close PERMVARS;
}

1;