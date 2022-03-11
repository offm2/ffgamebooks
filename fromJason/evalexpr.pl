require "exec_code.pl";

# $inputstring = "";

# print "split=@listexp\n";

# print "result is:".&evaluate;

################ note literal strings are broken when they start with an '&' symbol or '[]' symbol, must rememdy with typing of elements at initial breakdown phase (function, list, scalar)

sub evaluate
{

	my @stack;
	my @postfix;
	my $expected_type = 0; # 0 for constant, 1 for operator
	my $element = shift @listexp;

	$element = &strip_white($element);
	
	$depth++;

	## loop through expression and convert to postfix expression
	while (defined($element) and ($element ne ")") and ($element ne "]"))
	{			
		local $element_is_literal=0;
		local $element_is_function=0;
		
		### variable in string interpolation must occur here sometime... :s
		### deal with quoted strings - probably will cause a problem if empty strings are used
		### just makes one element out of a string - doesnt actually DEAL with literals :-(
		if (($element eq "\"") or ($element eq "\'"))
		{
			my $literal_part = shift @listexp;
			my $delimiter=$element;
			$element="";

			while ($literal_part ne $delimiter)
			{
				## deal with (some) escape codes
				if ($literal_part =~/\\(.)/)
				{
					$escaped_char= $1;
					
					&printdebug("escape char detected\n");
					
					if($escaped_char eq "n")
					{
						$escape_replace="\n";
					}
					elsif($escaped_char eq "t")
					{
						$escape_replace="\t";
					}
					elsif($escaped_char =~ /\"/)
					{
						$escape_replace="\"";
					}
					else
					{
						$escape_replace=$escaped_char;
					}
					$literal_part=$escape_replace;
				}
				
				$element.=$literal_part;
				$literal_part = shift @listexp;	
			}
			$element_is_literal = 1;
		}
		
		## check for floating point number
		if($element=~/\d+/){
			my $next=shift @listexp;
			if($next eq "."){
				$next= shift @listexp;
				if($next=~/\d+/){
					$element.=(".".$next);
				}
				else{
					unshift @listexp,$next;
					unshift @listexp,".";
				}
			}
			else{
				unshift @listexp,$next;
			}
		}
		
		#### deal with Open Bracket
		if ($element eq "(")
		{
			&printdebug ("Going into bracket... <BR>\n");
			$element= &evaluate;
			&printdebug ("Bracket replaced element=\"$element\"<BR>\n");
		}
		
		#### array indexes
		if ($element eq "[")
		{
			if ($expected_type==1)
			{
				my $replace;
				&printdebug ("Going into Array index... <BR>\n");
				$replace=&evaluate;
				unshift @listexp, $replace;
				&printdebug ("Array Index=\"$replace\"<BR>\n");			
				$element= "~";
			}
			else
			{
				die "mislocated [";
			}
		}
		
		####### Determine precedence value of element
		if ( (($element eq "+") or ($element eq "-")) and !$element_is_literal )
		{
			if ($expected_type == 0)
			{
				$element="$element"."U"; #U for Unary
			}
		}
		
		### if element is a function
		if (&isfunction($element)) ### determine if function parameters are open-ended or bracket closed
		{
			#### peek forward to see if parameters are parenthesised
			my $next_item = shift @listexp;
			&printdebug ("\"$next_item\"");
			$next_item = &strip_white($next_item);
			
			#### if paremeters are parenthesised, effectively stuff function name into brackets and &evaluate it now (poor precedence wise - im sure this screws up proper precedence rules)
			if ($next_item eq "(")
			{
				unshift @listexp, $element;
				$element = &evaluate;
				$element_is_literal=1;  ## bodge to ensure returned strings are treated as string in determine_precedence #### note made redundant by $element_is_fucntion=1 at end of block
			}

			#### push onto @listexpr an empty list item and ',' concatenator? or just a ',' concatenator? - yes just concatenator but onto @stack
			else
			{
				if (defined($next_item))			
				{
					### put the next item back in the listexpr
					&printdebug ("\n Unshifting \"$next_item\" to list \"@listexp\""); 
					unshift @listexp, $next_item;
					
					## put the 'apply to'operator in between func and next $element
					push @operator_list, ",";
					$op_count=@operator_list;
					push @stack, \$operator_list[$operator_count-1];
					
					#push @stack, ",";
					
					&printdebug ("\n wtf??? Stack = \"@stack\"\n");
				}
				else ## catch functions at end of line with no parameters
				{
					##execute function immiediately
					$element = &execute_function($element);
				}
			}
			$element_is_function=1;
		}
		
		&printdebug ("just to see... Stack = \"@stack\"\n");
		
		### now that functions and bracket have been dealt with complete precedence evaluation
		$element_precedence = &determine_precedence($element,0);
		$element_assoc=$assoc;
	
		#### Test output
		&printdebug ("element precedence for $element = $element_precedence\n");
		
		### ensure well-formed expression (simple method of trapping)
		if (($expected_type==0) and ($element_precedence!=0)) ## Constant expected, non-constant found
		{
			## exclude unary operators and open functions from error trap
			if (($element_precedence!=77) and ($element ne "+U") and ($element ne "-U") and ($element ne "!") and ($element ne "not"))
			{
				die "Error in SEL expression: Operator found where Constant expected\n Code: $debug_line_evaluating_string\n Function: $debug_function_evaluating_string";
			}
		}
		elsif (($expected_type==1) and ($element_precedence==0)) ## Operator expected, Constant found
		{
				die "Error in SEL expression:Constant found where Operator expected\n Code: $debug_line_evaluating_string\n Function: $debug_function_evaluating_string";
		}
		
		## set expected type for element next time through the loop
		if ($element_precedence != 0)
		{
			$expected_type = 0;
		} 
		else
		{
			$expected_type = 1;
		}
		
		if (($element_precedence != 0) and (!($element_is_function)) )
		{
			push @operator_list, $element;
			$op_count=@operator_list;
			$element=\$operator_list[($operator_count-1)];
			
		}
		
		$element_is_literal=0;
		$element_is_function=0;
		
		######### Determine precedence value of top of stack
		$top=pop @stack;
		
		$top_precedence = &determine_precedence($top,1);
		$top_assoc=$assoc;
		
		&printdebug ("Top=\"$top\"\n");
		&printdebug ("Top Precedence=$top_precedence\n");		

		
		if ($element_precedence != $open_function_precedence) ###open functions just get lobbed on to the stack
		{
			####### Pop Stack to Postfix expr. until precedence of new element is 'higher' (reversed here) than top of stack
			while ( defined($top) and ($top_precedence <= $element_precedence) and not(($top_precedence==$element_precedence) and ($top_assoc and $element_assoc)) )
			{
					
				push @postfix,$top;
	
				$top=pop @stack;
	
				$top_precedence = &determine_precedence($top,1);				
				
				$top_assoc=$assoc;
			}

				
			###### stick the top of stack back on (as it is 'lower' than new element) providing we havent actually emptied the stack
			if (defined($top))
			{
				push @stack,$top;
			}
		}
		else 
		{
			push @stack, $top; ## replace top if we bypassed the sort due to open function detection
		}
		
		##### stick new element on to stack (should be correct location now)
		push @stack,$element;
		&printdebug ("\n stack = @stack \n");
		&printdebug ("\n postfix = @postfix \n");
		
		##### get next new element
		$element = shift @listexp;
		
		$element = &strip_white($element);
	}
	## end loop through expression
	
	#### ??probably make more efficient by having one wrapper loop for 0 depth and an internal for in-bracket??
	if ($element eq ")" or $element eq "]")
	{
		&printdebug ("Coming out of bracket...<BR>");
		if (--$depth < 1)
		{
			die "Unexpected close-bracket ) or ]";
		}
	}
	else #### must be end of line/expression so check for bracket correctness
	{
		if ($depth > 1)
			{
				die "Unterminated open brackets ( or [ in expression";
			}
	}
	
	#### pop rest of stack to postfix vector
	$top=pop @stack;
	while (defined ($top))
	{
		push @postfix, $top;
		$top=pop @stack;
	}
	
	
	#### test outputs
	&printdebug ("\nListExp=@listexp<BR>\n");
	&printdebug ("Stack=@stack<BR>\n");
	&printdebug ("Postfix=@postfix<BR>\n");
	&printdebug ("Depth=$depth<BR>\n");
	
	## end &evaluate
	return &process_postfix(@postfix);
	
	
}

sub process_postfix
{
	#######  Assumes that there actually *IS* an operator.  Special case not catered for yet is a single Variable (needs to be interpolated and returned)
	
	my @postfix = @_;
	&printdebug ("Passed list received is: @postfix\n");
	my @stack;
	my $element;
	my $lists_index = 0;
	my @lists;
	
	while (defined($element=shift @postfix))
	{
		&printdebug ("Postfix element being evaluated is:$element\n");
		
		### nasty jig job to figure if the ref is an operator or not
		if ((ref($element) eq "SCALAR") and (&determine_precedence(${$element},0)) )
		{
			$element = $$element;
			
			if ( ($element eq "-U") or ($element eq "+U") )
			{
				# $element =~ s/U/1\*/;
				$element =~ s/U//;
				$operand = &interpolate(pop @stack);
				$operation_string = "$element"."$operand";

				if($element =~ /\-/)
				{$result=-1*$operand;}
				elsif($element =~ /\+/)
				{$result=+1*$operand;}
				### $result = eval $operation_string;  ## need to test substitution
				push @stack,$result;
			}
			
			######## WARNING - maze of references, unused if's, and some incorrect commenting coming up
			#### could it be any worse? :-)
			elsif($element eq "~")
			{
				my $index=&interpolate(pop @stack);
				my $listref=pop @stack;
				
				if ($listref =~ /^\$([A-Za-z_]+\w*)/)
				{
					my $var_ID=$1;
					
					if ($local_vars_x{$var_ID})
					{
						if(ref($local_vars{$var_ID}) eq "ARRAY")
						{
							if (ref( ${$local_vars{$var_ID}}[$index]) eq "ARRAY" )
							{
								$result=\\@{$local_vars{$var_ID}}[$index];
							}
							else
							{
								$result=\\${$local_vars{$var_ID}}[$index];
							}
						}
						else ## is scalar - create new array? yes
						{
							my @anon_list;
							if (defined($local_vars{$var_ID})){$anon_list[0]=$local_vars{$var_ID};}
							$local_vars{$var_ID}=\@anon_list;
							$result=\\${$local_vars{$var_ID}}[$index];
						}
					}					
					elsif ($temps_x{$var_ID})
					{
						if (ref($temps{$var_ID}) eq "ARRAY")
						{
							if (ref(${$temps{$var_ID}}[$index]) eq "ARRAY")
							{ 
								$result=\\@{$temps{$var_ID}}[$index];
							}
							else
							{
								$result=\\${$temps{$var_ID}}[$index];
							}
						}
						else ## is scalar - create new array? yes
						{
							my @anon_list;
							if(defined($temps{$var_ID})){$anon_list[0]=$temps{$var_ID};}
							$temps{$var_ID}=\@anon_list;
							$result=\\${$temps{$var_ID}}[$index];
						}
						
					}
					elsif ($permvars_x{$var_ID})
					{
						if(ref($permvars{$var_ID}) eq "ARRAY")
						{
							if (ref( ${$permvars{$var_ID}}[$index]) eq "ARRAY" )
							{
								$result=\\@{$permvars{$var_ID}}[$index];
							}
							else
							{
								$result=\\${$permvars{$var_ID}}[$index];
							}
						}
						else ## is scalar - create new array? yes
						{
							my @anon_list;
							if (defined($permvars{$var_ID})){$anon_list[0]=$permvars{$var_ID};}
							$permvars{$var_ID}=\@anon_list;
							$result=\\${$permvars{$var_ID}}[$index];
						}
					}
					else #its a new list in a new var
					{
						my @anon_list;
						$temps{$var_ID}=\@anon_list;
						$temps_x{$var_ID}=1;
						$result=\\${$temps{$var_ID}}[$index];	
					}
					
				}
				## from here on a lot of the IF's don't seem to be used only 2 ive seen
				
				## this never seems to be true
				elsif (ref($listref) eq "ARRAY")
				{
					&printdebug ("Array indices does get referred to as Array ref\n");
					if (ref( ${$listref}[$index] eq "ARRAY" ))
					{
						
						$result=\@{$listref}[$index];
					}
					else
					{
						$result=\${$listref}[$index];
					}
					
				}
				## used for sure
				elsif (ref($listref) eq "SCALAR")
				{
					if (ref( ${$listref}) eq "ARRAY" )
					{
						&printdebug ("We get in here\n");
						$result=\${$listref}[$index];
					}
					elsif(ref(${$listref}) eq "REF")
					{
						&printdebug ("hm\n");
					}
					## this SHOULD get used - if the previous indice was a SCALAR, now being turned into array - but doesnt (???)
					elsif (ref(${$listref}) eq "SCALAR")
					{
						&printdebug ("we get in here though\n");
						my @anon_list;
						${$listref}=\@anon_list;
						$result=\${$listref}[$index]
						#$result=\${$listref}[$index];
					}
					## this IS used - when the listref (previous index) hasn't been previously defined as an array
					else
					{
						
						&printdebug ("Odd\n");
						my @anon_list;
						if(defined($listref)){$anon_list[0]=$listref;}
						${$listref}=\@anon_list;
						$result=\${${$listref}}[$index];
					}
					
				}
				elsif(ref($listref) eq "REF")
				{
					if (ref(${$listref}) eq "ARRAY")
					{
						&printdebug ("Array indices does get referred to as Array ref\n");
						if (ref( ${${$listref}}[$index] eq "ARRAY" ))
						{

							$result=\\@{${$listref}}[$index];
						}
						else
						{
							$result=\\${${$listref}}[$index];
						}

					}
					## used for sure
					elsif (ref(${$listref}) eq "SCALAR")
					{
						if (ref( ${${$listref}}) eq "ARRAY" )
						{
							&printdebug ("We get in here3\n");
							$result=\\${${$listref}}[$index];
						}
						elsif(ref(${${$listref}}) eq "REF")
						{
							&printdebug ("hm\n");
						}
						## this SHOULD get used - if the previous indice was a SCALAR, now being turned into array - but doesnt (???)
						## duh no it shouldnt - in fact none of these sub-ref tests should be true, and the else should always be executed
						elsif (ref(${${$listref}}) eq "SCALAR")
						{
							&printdebug ("we get in here though3\n");
							my @anon_list;
							if(defined(${${${$listref}}})){$anon_list[0]=${${${$listref}}};} ## this might be one deref too many? no, double ref is a ref to anon list so triple deref required
							${${$listref}}=\@anon_list;
							$result=\\${${$listref}}[$index]
							#$result=\${$listref}[$index];
						}
						## this IS used - when the listref (previous index) hasn't been previously defined as an array
						else
						{

							&printdebug ("Odd3\n");
							my @anon_list;
							if(defined(${${$listref}})){$anon_list[0]=${${$listref}};}
							${${$listref}}=\@anon_list;
							$result=\\${${${$listref}}}[$index];
						}

					}
					## pretty sure its used
					elsif(ref(${$listref}) eq "REF")
					{
						### this IS used
						if (ref( ${${$listref}}) eq "ARRAY" )
						{
							&printdebug ("We get in here2\n");
							$result=\\${${${$listref}}}[$index];
						}
						elsif(ref(${${$listref}}) eq "REF")
						{
							&printdebug ("hm\n");
						}
						elsif (ref(${${$listref}}) eq "SCALAR")
						{
							&printdebug ("we get in here though2\n");
							my @anon_list;
							if(defined(${${${$listref}}})){$anon_list[0]=${${${$listref}}};}
							${${$listref}}=\@anon_list;
							$result=\\${${$listref}}[$index]; ## should be a triple deref surely?
							#$result=\${$listref}[$index];
						}
						else
						{
							&printdebug ("Odd2\n");
							my @anon_list;
							if(defined(${${$listref}})){$anon_list[0]=${${$listref}};}
							${${$listref}}=\@anon_list;
							$result=\\${${$listref}}[$index];
						}
					}

					else
					{
						die "Cannot Index element: $listref";
					}

				}

				else
				{
					die "Cannot Index element: $listref";
				}
				
				push @stack, $result;
			}
			############### END of reference maze.  THIS REALLY needs looking at.
			
			elsif ($element eq "=")
			{
				## returns the actual variable name assigned to - needed in case of statements like "&permvar $items='sword'", and for chained assignments e.g. x=y=z
				
				## have to deal with possibility of interpolate returning a list for operand2
				my @operand2 = &interpolate(pop @stack);
				&printdebug ("op2=@operand2\n");
				$operand2_element_count = @operand2;
				if ($operand2_element_count > 1)
				{
					## as a list has been returned for operand2 make scalar assignment get number of items
					## jan 2006: seems that this has been ignored and assigning list to scalar assigns ref of list
					$operand2 = $operand2_element_count;
				}
				else ## assume @operand REF has 1 element, not 0 or less
				{
					&printdebug ("blah is @operand2\n");
					$operand2 = $operand2[0];
				}

				$operand1 = pop @stack;
				$operator = "=";

				if (($operand1 =~ /^\$([A-Za-z_]+\w*)/) or ref($operand1))
				{
					my $element_index = $1;
					## bit of a nasty botchfix here
					if (ref($operand1)){$element_index="000arrayreference";}

					
					## if its a function local variable
					if ($local_vars_x{$element_index})
					{
						if (ref($local_vars{$element_index})) ## list being assigned TO, so if operand2 is list assign the list, else assign the scalar (destroys existing list either way)
						{
							if ($operand2_element_count > 1)
							{
								@{$local_vars{$element_index}} = @operand2;
								$result=$operand1;
							}
							else
							{
								$local_vars{$element_index}=$operand2;
								$result=$operand1;
							}
						}
						else ## scalar variable being assigned TO, so assign ref of operand2 if op2 is a list, otherwise straight assignment
						{
							if ($operand2_element_count > 1)
							{
								$local_vars{$element_index}=\@operand2;
								$result=$operand1;
							}
							else
							{
								&printdebug ("Assigning $operand2 to \$$element_index\n");
								$local_vars{$element_index}=$operand2;
								$result=$operand1;
							}

						}
					}					
					
					# if its a temporary variable
					elsif ($temps_x{$element_index})
					{
						if (ref($temps{$element_index})) ## list being assigned TO, so if operand2 is list assign the list, else assign the scalar (destroys existing list either way)
						{
							if ($operand2_element_count > 1)
							{
								@{$temps{$element_index}} = @operand2;
								$result=$operand1;
							}
							else
							{
								$temps{$element_index}=$operand2;
								$result=$operand1;
							}
						}
						else ## scalar variable being assigned TO, so assign ref of operand2 if op2 is a list, otherwise straight assignment
						{
							if ($operand2_element_count > 1)
							{
								$temps{$element_index}=\@operand2;
								$result=$operand1;
							}
							else
							{
								&printdebug ("Assigning $operand2 to \$$element_index\n");
								$temps{$element_index}=$operand2;
								$result=$operand1;
							}

						}
					}
					

					# if its a book global variable
					#### permvars is global hash defined in exec_code NOTE must deal with contents being an REF reference (list)
					elsif ($permvars_x{$element_index})
					{
						if (ref($permvars{$element_index})) ## list being assigned TO, so if operand2 is list assign the list, else assign the scalar (destroys existing list either way)
						{
							if ($operand2_element_count > 1)
							{
								@{$permvars{$element_index}} = @operand2;
								$result=$operand1;
							}
							else
							{
								$permvars{$element_index}=$operand2;
								$result=$operand1;
							}
						}
						else ## scalar variable being assigned TO, so assign ref of operand2 if op2 is a list, otherwise straight assignment
						{
							if ($operand2_element_count > 1)
							{
								$permvars{$element_index}=\@operand2;
								$result=$operand1;
							}
							else
							{
								&printdebug ("Assigning $operand2 to \$$element_index\n");
								$permvars{$element_index}=$operand2;
								$result=$operand1;
							}

						}
					}


					# otherwise its a new/undefined variable
					## OR its an array index reference
					else
					{
							## array index
							if (ref($operand1) eq "REF")
							{

								if ($operand2_element_count > 1)
								{
									${${$operand1}}=\@operand2;
									&printdebug ("Assigning reference of \@operand2 to \$$element_index\n");
								}
								else
								{
									${${$operand1}}=$operand2;
									&printdebug ("Assigning value of $operand2 to \$$element_index\n");
								}
								
								$result=$operand1;
							}
							## assume its a new variable from here on
							elsif ($operand2_element_count > 1)
							{
								&printdebug ("Assigning reference of \@operand2 to \$$element_index\n");
								
								$temps{$element_index}=\@operand2;
								$temps_x{$element_index}=1;
								
								$result=$operand1;
							}
							else
							{
								&printdebug ("Assigning $operand2 to \$$element_index\n");
								
								$temps{$element_index}=$operand2;
								$temps_x{$element_index}=1;
								
								$result=$operand1;
							}
					}
				}
				push @stack, $result;
			}

			######## need to evaluate functions here also as operand 2 may be a function - using the ',' operator as an 'apply-to' operator'.
			######## possibility of list reference value in operandx needs to be considered elsewhere too
			elsif ($element =~ /,/)
			{
				&printdebug ("comma<BR><BR><BR>");
				$operator =",";
				&printdebug ("operandR=",$operandR = pop @stack);
				&printdebug ("\n");
				&printdebug ("operandL=",$operandL = pop @stack);
				&printdebug ("\n");
				
				#### not sure about interpolating as this means functions will only receive values to user variables
				## addendum - do NOT interpolate as inbuilt functions need actual variable names passed as parameters


				if (ref(${$operandL}) eq "ARRAY") ## list, (scalar, list or function)
				{
					if (ref(${$operandR} eq "ARRAY")) ## list,list
					{
						push @{${$operandL}}, @{${$operandR}};
						$result = $operandL;
					}

					else ## list, (scalar or function)
					{
						if (&isfunction($operandR)) ## list, function
						{
							$result = &execute_function($operandR, @{${$operandL}});

						}
						else ## list, scalar
						{
							push @{${$operandL}}, $operandR;
							$result = $operandL;
						}
					}

				}
				#### not sure this bit is right - or even if it gets used
				elsif (&isfunction($operandL)) ## parenthesised function,-> function, (scalar or list)
				{
					&printdebug ("BOOOOOOOOOOOOOOOOOOOO");
					if (ref(${$operandR}) eq "ARRAY") ## function, list
					{
						$result=&execute_function($operandL, @{${$operandR}});
					}
					else ## function, scalar
					{
						$result=&execute_function($operandL, $operandR);
					}
				}
				else ## scalar, (scalar, list or function)
				{
					if (ref(${$operandR} eq "ARRAY")) ## scalar, list
					{
							$lists[$lists_index][0] = $operandL;
							my $new_list = \@lists[$lists_index];
							push @{${$new_list}}, (@{${$operandR}});
							$result = $new_list;
							$lists_index++;
					}
					else ### scalar, (scalar or function)
					{
						if (&isfunction($operandR)) ## scalar, function
						{
							$result = &execute_function($operandR, $operandL);
						}
						else ## scalar, scalar
						{
							$lists[$lists_index][0] = $operandL;
							$lists[$lists_index][1] = $operandR;
							$result = \@lists[$lists_index];
							$lists_index++;
						}
					}
				}

				push @stack, $result;
			}

			elsif ($element eq "/")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 / $operand2\n");
				$result = $operand1 / $operand2;
				push @stack, $result;
			}
			elsif ($element eq "*")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 * $operand2\n");
				$result = $operand1 * $operand2;
				push @stack, $result;
			}
			elsif ($element eq "-")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 - $operand2\n");
				$result = $operand1 - $operand2;
				push @stack, $result;
			}
			elsif ($element eq "+")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 + $operand2\n");
				$result = $operand1 + $operand2;
				push @stack, $result;
			}
			elsif ($element eq "%")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 % $operand2\n");
				$result = $operand1 % $operand2;
				push @stack, $result;
			}
			elsif ($element eq ">")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 > $operand2\n");
				$result = $operand1 > $operand2;
				push @stack, $result;
			}
			elsif ($element eq "<")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 < $operand2\n");
				$result = $operand1 < $operand2;
				push @stack, $result;
			}
			elsif ($element eq ">=")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 >= $operand2\n");
				$result = $operand1 >= $operand2;
				push @stack, $result;
			}
			elsif ($element eq "<=")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 <= $operand2\n");
				$result = $operand1 <= $operand2;
				push @stack, $result;
			}
			elsif ($element eq "!=")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 != $operand2\n");
				$result = $operand1 != $operand2;
				push @stack, $result;
			}
			elsif ($element eq "==")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 == $operand2\n");
				$result = $operand1 == $operand2;
				push @stack, $result;
			}
			elsif ($element =~ /^ne$/i)
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 NE $operand2\n");
				$result = $operand1 ne $operand2;
				push @stack, $result;
			}
			elsif ($element =~ /^ine$/i)
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 EQ $operand2\n");
				$result = ($operand1 !~/^$operand2$/i);
				push @stack, $result;
			}
			elsif ($element =~ /^eq$/i)
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 EQ $operand2\n");
				$result = $operand1 eq $operand2;
				push @stack, $result;
			}
			elsif ($element =~ /^ieq$/i)
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 EQ $operand2\n");
				$result = ($operand1 =~/^$operand2$/i);
				push @stack, $result;
			}
			elsif (($element =~ /^or$/i) or ($element eq "\|\|"))
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 OR $operand2\n");
				$result = ($operand1 or $operand2);
				push @stack, $result;
			}
			elsif (($element =~ /^and$/i) or ($element eq "\&\&"))
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 AND $operand2\n");
				$result = ($operand1 and $operand2);
				push @stack, $result;
			}
			elsif ($element =~ /^xor$/i)
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 XOR $operand2\n");
				$result = ($operand1 xor $operand2);
				push @stack, $result;
			}
			elsif ($element eq ".")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 . $operand2\n");
				$result = $operand1.$operand2;
				push @stack, $result;
			}
			elsif (($element eq "!") or  ($element eq "not"))
			{
				$operand=&interpolate(pop @stack);
				&printdebug ("Evaluating: NOT $operand\n");
				$result=not($operand);
				push @stack, $result;
			}
			elsif ($element eq "&")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 bitwise AND $operand2\n");
				$result = $operand1 & $operand2;
				push @stack, $result;
			}
			elsif ($element eq "^")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 bitwise XOR $operand2\n");
				$result = $operand1 ^ $operand2;
				push @stack, $result;
			}
			elsif ($element eq "|")
			{
				&printdebug ($operand2 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ($operand1 = &interpolate(pop @stack)); &printdebug ("\n");
				&printdebug ("Evaluating: $operand1 bitwise OR $operand2\n");
				$result = $operand1 | $operand2;
				push @stack, $result;
			}
			else
			{
				die "unknown operator";
				#push @stack,$element;
			}
		}
		else
		{
			push @stack,$element;
		}
	}
	$postfix_result=pop @stack;
	&printdebug ("postfix returning:$postfix_result<BR><BR>");

	## result isnt interpolated... is this right?
	return $postfix_result;
}


sub determine_precedence
{
	my $element=shift;
	my $is_stack=shift;
	my $element_precedence;
	
	## left global for poor programming reasons :-p
	## set to 1 for right associativity, left at 0 for left associativity
	$assoc=0;

	$open_function_precedence = 77;
	
	
	if ($is_stack)
	{
		if (ref($element) eq "SCALAR")
		{
			$element=${$element};
		}
		elsif ($element =~ /^\&[A-Za-z_]+\w*/)
		{
			return 77;
		}
		else
		{
			return 0;
		}
	}
	
	
	if($element_is_literal)
	{
		$element_precedence=0;
	}
	elsif($element=~/\".*\"/)
	{
		$element_precedence=0;
	}
	elsif ( ($element eq "or") or ($element eq "xor") )
	{
		$element_precedence=100;
	}
	elsif ($element eq "and")
	{
		$element_precedence=90;
	}
	elsif ($element eq "not")
	{
		$element_precedence=80;
	}
	elsif ($element =~ /^\&[A-Za-z_]+\w*/)
	{
		$element_precedence = 77;
	}
	elsif ($element eq ",")
	{
		$element_precedence=75;
	}
	elsif ($element eq "=")
	{
		$element_precedence=73;
		$assoc=1;
	}
	elsif ($element eq "||")
	{
		$element_precedence=70;
	}
	elsif ($element eq "&&")
	{
		$element_precedence=60;
	}
	elsif ( ($element eq "==") or ($element eq "!=") or ($element eq "eq") or ($element eq "ne") or ($element eq "ieq") or ($element eq "ine"))
	{
		$element_precedence=50;
	}
	elsif($element eq "|" or $element eq "^"){
		$element_precedence=45;
	}
	elsif($element eq "&"){
		$element_precedence=43;
	}
	elsif ( ($element eq ">=") or ($element eq "<=") or ($element eq "<") or ($element eq ">") )
	{
		$element_precedence=40;
	}
	elsif ( ($element eq "+") or ($element eq "-") or ($element eq "."))
	{
		$element_precedence=30;
	}
	elsif ( ($element eq "*") or ($element eq "/") or ($element eq "%") )
	{
		$element_precedence=20;
	}
	elsif ( ($element eq "+U") or ($element eq "-U") or ($element eq "!") )
	{
		$element_precedence=10;
	}
	elsif($element eq "**")
	{
		$element_precedence=5;
		$assoc=1;
	}
	elsif ($element eq "~")
	{
		$element_precedence=3;
	}
	else
	{
		if($is_stack)
		{
			$element_precedence=0;
		}
		elsif($element=~/^\$[A-Za-z_]+\w*/) ## is a user variable
		{
			$element_precedence=0;
		}
		elsif (($element=~/^[\d]+$/) or ($element=~/^[\d]+\.[\d]+$/)) ## is a number of some description
		{
			$element_precedence=0;
		}
		elsif(ref($element))
		{
			$element_precedence=0;
		}
		elsif ($element eq "")  ## bodge to handle nulls returned by logical operations
		{
			$element_precedence=0;
		}
		else
		{
			die "invalid Statement in SEL code - unknown:\"$element\"";
		}
	}
	
	return $element_precedence;
}

sub interpolate
{
	my $element = shift;
	
	if ($element =~ /^\$([A-Za-z_]+\w*)$/)
	{
		my $element_index=$1;
		
		### remember - if its an undef variable - it doesnt matter whether its a temp, perm or local!
		
		# if its a function local variable
		if ($local_vars_x{$element_index})
		{
			if (ref($local_vars{$element_index}))
			{
				##interpolate variables in list
				for(my $index=0;$index<@{$local_vars{$element_index}};$index++)
				{
					if( ${$local_vars{$element_index}}[$index]=~/(\$[A-Za-z_]+\w*)/ )
					{
						splice @{$local_vars{$element_index}},$index,1,&interpolate($1);
					}
				}
				
				@int_list=@{$local_vars{$element_index}};
				
				## flatten array indices
				
				for(my $index=0;$index<@int_list;$index++)
				{
					if( ref($int_list[$index]) eq "ARRAY" )
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
					elsif(ref($int_list[$index]) eq "REF")
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}					
				}

				&printdebug ("interpolate returning interpolated list:@int_list<BR><BR><BR>");

				return @int_list;
			}
			else
			{
				&printdebug ("interpolate returning interpolated variable\n");
				return $local_vars{$element_index};
			}
		}
		
		# if its a temporary variable
		elsif ($temps_x{$element_index})
		{
			if (ref($temps{$element_index}))
			{
				##interpolate variables in list
				for(my $index=0;$index<@{$temps{$element_index}};$index++)
				{
					if( ${$temps{$element_index}}[$index]=~/(\$[A-Za-z_]+\w*)/ )
					{
						splice @{$temps{$element_index}},$index,1,&interpolate($1);
					}
				}
				
				@int_list=@{$temps{$element_index}};
				
				## flatten array indices
				
				for(my $index=0;$index<@int_list;$index++)
				{
					if( ref($int_list[$index]) eq "ARRAY" )
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
					elsif(ref($int_list[$index]) eq "REF")
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}					
				}

				&printdebug ("interpolate returning interpolated list:@int_list<BR><BR><BR>");

				return @int_list;
			}
			else
			{
				&printdebug ("interpolate returning interpolated variable\n");
				return $temps{$element_index};
			}

		}
		
		# if its a book global variable
		#### permvars is global hash defined in exec_code NOTE must deal with contents being an REF reference (list)
		elsif ($permvars_x{$element_index})
		{
			if (ref($permvars{$element_index}))
			{
				##interpolate variables in list
				for(my $index=0;$index<@{$permvars{$element_index}};$index++)
				{
					if( ${$permvars{$element_index}}[$index]=~/(\$[A-Za-z_]+\w*)/ )
					{
						splice @{$permvars{$element_index}},$index,1,&interpolate($1);
					}
				}
				
				@int_list=@{$permvars{$element_index}};
				
				## flatten array indices
				
				for(my $index=0;$index<@int_list;$index++)
				{
					if( ref($int_list[$index]) eq "ARRAY" )
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
					elsif(ref($int_list[$index]) eq "REF")
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}					
				}
				&printdebug ("interpolate returning interpolated list:@int_list<BR><BR><BR>");
				return @int_list;
			}
			else
			{
				&printdebug ("interpolate returning interpolated variable\n");
				return $permvars{$element_index};
			}
		}
		# otherwise its a new/undefined variable
		else
		{
			&printdebug ("Variable \$$element_index has not been defined or set a value");
			return undef;
		}
	}
	elsif (ref($element)) ## anonymous list
	{
		my $ref_type=ref($element);
		
		if ($ref_type eq "ARRAY")
		{
			&printdebug ("interpolate has detected an anonymous list (type 2)\n");
			return @{$element};
			
		}
		elsif($ref_type eq "SCALAR")
		{
			print "boder\n";
			return ${$element};
		}
		elsif ($ref_type eq "REF")
		{
			if (ref(${$element}) eq "REF")	
			{	
				&printdebug ("interpolate has detected an anonymous list (type 3)\n");

				## interpolate variables in list
				for(my $index=0;$index<@{${${$element}}};$index++)
				{
					if( ${${${$element}}}[$index]=~/(\$[A-Za-z_]+\w*)/ )
					{
						splice @{${${$element}}},$index,1,&interpolate($1);
					}
				}

				my @int_list;
				@int_list=@{${${$element}}};

				## flatten array indices

				for(my $index=0;$index<@int_list;$index++)
				{
					if( ref($int_list[$index]) eq "ARRAY" )
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
					elsif(ref($int_list[$index]) eq "REF")
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}					
				}			

				&printdebug ("interpolate returning interpolated list:@int_list<BR><BR><BR>");

				return @int_list;
			}
			elsif(ref(${$element}) eq "SCALAR")
			{
				return ${${$element}};
			}
			else #assume ARRAY
			{	
				&printdebug ("interpolate has detected an anonymous list (type 1)\n");

				## interpolate variables in list
				for(my $index=0;$index<@{${$element}};$index++)
				{
					if( ${${$element}}[$index]=~/(\$[A-Za-z_]+\w*)/ )
					{
						splice @{${$element}},$index,1,&interpolate($1);
					}
				}

				my @int_list;
				@int_list=@{${$element}};

				## flatten array indices

				for(my $index=0;$index<@int_list;$index++)
				{
					if( ref($int_list[$index]) eq "ARRAY" )
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
					elsif(ref($int_list[$index]) eq "REF")
					{
						splice @int_list,$index,1,&interpolate($int_list[$index]);
					}
				}			

				&printdebug ("interpolate returning interpolated list:@int_list<BR><BR><BR>");

				return @int_list;
			}
		}
		else
		{
			die "heres your problem";
		}
	}
	else
	{
		&printdebug ("interpolate has detected a scalar of value: $element\n");
		return $element;
	}	
}

sub evaluate_string
{
	$inputstring = shift;
	#### add a whitespace split too?
	
	### don't like using local declaration (perl gurus dont like it) - see if i can pass listexp around sometime
	local @listexp= split /(\s+|\&[A-Za-z_]+\w*|\$[A-Za-z_]+\w*|\bieq\b|\bine\b|\bnot\b|\bxor\b|\band\b|\bor\b|\beq\b|\bne\b|\|\||\&\&|\*\*|\||\&|\^|\>\=|\<\=|\=\=|\!\=|\!|\>|\<|\%|\+|\*|\-|\/|\)|\(|\,|\"|\'|\.\=|\[|\]|\\.|\=|\.)/,$inputstring;
	
	### stay global? NO! local or private - when a sub is called this gets called again and if its global it resets the calling routines nest depth
	local $depth = 0;
		
	my @result = &interpolate(&evaluate);
	
	&printdebug ("evaluate string function returning: @result\n");
	
	return @result;
}

### NOTE THIS IS NOT GENERAL PURPOSE STRIP WHITE FUNCTION AS IT REFERS TO GLOBAL @listexp
sub strip_white
{
	my $element = shift;
	
	######## Brackets really screw up because of this - they seem to have an extra char before '(' and after ')' them or something that makes all this bit necessary
			############### whole whitespace handling is very ropey must sort out
			#### strip trail/lead whitespace
			$element =~ s/^\s+//;
			$element =~ s/\s+$//;
			
			#### get rid of empty string anomoly
			#### also removes whitespace elements which will now = "" after whitespace trail/lead stripping
			if ($element eq "")
			{ 	
				
				while (($element eq "") and defined($element))
				{
					$element = shift @listexp;
					$element =~ s/^\s+//;
					$element =~ s/\s+$//;					
				}
				
			}
			### Make that a while instead of IF? no, infinite loop for some reason
			#### test output
			&printdebug ("\n<BR>element=\"$element\"<BR>\n");
			return $element;
	#######################################################################	

}

sub execute_function #### functions that return lists must return them as a reference!!!!!!!
{
	my $function_string = shift;
	my @parameter_list;
	my $parameter_count = 0;
	
	&printdebug ("Function \"$function_string\" operating on following parameters:\n");
	
	while (defined($parameter_list[$parameter_count]=shift))  ## doh - must ALWAYS remember to test for defined in case of 0's being passed around
	{
		&printdebug ("Paramater $parameter_count = :\"$parameter_list[$parameter_count]\"\n");
		$parameter[$parameter_count++] = $_;
	}
	### function name is now in $function_string, and all paramters are in @parameter_list REF
	&printdebug ("executing a func\n");
	
	my $result = &handle_function_call($function_string, @parameter_list);
	
	&printdebug ("execute_function returning: $result\n");
	
	return $result;
	##return 20; ## just a test value for now
}

sub isfunction
{
	my $element = shift;
	### forgot what on earth second regexp is matching with the \[\] bit   duh - its matching [], but why?
	if ((($element =~ /^\&[A-Za-z_]+\w*/) or ($element =~ /\[\][A-Za-z_]+\w*/)) and !$element_is_literal)
	{
		&printdebug ("Function detected \n");
		return 1;
	}
	else
	{
		return 0;
	}
}

1;
