#!/usr/bin/perl
use CGI qw(-utf8);
use CGI::Carp qw(fatalsToBrowser);
use open IO => ':utf8';
use File::Path qw(make_path remove_tree);
use File::Copy;
require "authenticate.pl";
require "exec_code.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

$query = new CGI;

####################################################################################################
### play.cgi - The main ABML engine.  Displays the current page of the book user is playing and all
### options available.  Also displays any character sheet associated with book. Processes option
### selected on that page.  Parses page ABML document to do this, and calls the SEL engine where
### required.
####################################################################################################

### GLOBAL DECLARATIONS

### FILE GLOBALS
my $process_error=0; ## currently unknown
my $debug_files=0; ## tracks number of debug files created (see &call_exec_code) - would be static in function
my $currentref; ## current reference in book
my $UserName; ## user ID
my $Book; ## current Book
my $Author; ## Author of current book UserID
my $author_error=0;

$seloutput_present=0; ## flag gets set to 1 if &call_exec_code is called, used to determine if there is ACTION output to process tags in
@options;
@events;
@turntos;
my $currentact; ## action number record for current reference
$option_record;
$event_record;

## check for fightingfantasy cookie to give username
if (&authenticate_user(\$UserName))
{
	print $query->header(-charset=>'utf-8');

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";
	
	#### Load Bookmark information
	open (CURRENTBOOK ,"<Accounts/$UserName/Bookmarks/currentbook.txt") or die "failed to open currentbook.txt";
	$Book=<CURRENTBOOK>;
	chomp $Book;
	$Author = <CURRENTBOOK>;
	close CURRENTBOOK;
	
	open (CURRENTREF ,"<Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt") or die "failed to open currentref.txt at Accounts/$UserName/Bookmarks/$Book/currentref.txt";
	$currentref=<CURRENTREF>;
	close CURRENTREF;
	
	open (CURRENTACT ,"<Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt") or die "failed to open currentref.txt at Accounts/$UserName/Bookmarks/$Book/currentact.txt";
	$currentact=<CURRENTACT>;
	$proposedact=$currentact+1;
	close CURRENTACT;
	
	my $infield="";
	open (GETAUTHOR ,"<Accounts/$Author/MyBooks/$Book/bookinfo.txt") or die "failed to open book information file: $!";
	while($infield ne "authors")
	{
		$_=<GETAUTHOR>;
		chomp;
		($infield,$credit_author) = split /=/, $_,2;
	}
	close GETAUTHOR;
	if($credit_author eq "")
	{
		$credit_author=$Author;
	}
	
	if(open ERRORFLAGFILE ,"<Accounts/$UserName/Bookmarks/$Author/$Book/author_error.txt")
	{
		$author_error=<ERRORFLAGFILE>;
		close ERRORFLAGFILE;
	}

	&read_bookmark_tag_files();

	#### end Load Bookmark Information

	#### clear previous debug files
	my $index=0;
	while(-e ("Accounts/$UserName/Bookmarks/$Author/$Book/debug".$index.".txt"))
	{
		unlink ("Accounts/$UserName/Bookmarks/$Author/$Book/debug".$index.".txt");
		$index++;
	}
	#### end clear previous debug files


	&process_option;
	if ((! $refresh) or $author_error)
	{
		$author_error=0;
		&process_reference;
	}

	if (! $author_error)
	{
		rename "Accounts/$UserName/Bookmarks/$Author/$Book/outref.txt","Accounts/$UserName/Bookmarks/$Author/$Book/displayref.txt";
		rename "Accounts/$UserName/Bookmarks/$Author/$Book/chartemp.txt", "Accounts/$UserName/Bookmarks/$Author/$Book/charfile.txt";
		&display_reference("Accounts/$UserName/Bookmarks/$Author/$Book/displayref.txt","Accounts/$UserName/Bookmarks/$Author/$Book/charfile.txt","Accounts/$UserName/Bookmarks/$Author/$Book/actiontemp.txt",$currentref);
	}
	else
	{
		print "DONT PANIC! The book has at least 1 error on this page.  It is likely that the error is the first one, in turn causing subsequent errors<BR>";
		print "Until I get round to automatic error reporting please make a noise about this on the forums, mentioning the reference number, thankyou :-)<BR>";
		print "You may either continue playing by choosing a working link (although the integrity of the game cannot be guaranteed)<BR>";
		print "Or you may leave the story bookmarked here and return when the author has resolved the problem (your character sheet and position in the book will be remembered)";
		&display_reference("Accounts/$UserName/Bookmarks/$Author/$Book/outref.txt","Accounts/$UserName/Bookmarks/$Author/$Book/chartemp.txt","Accounts/$UserName/Bookmarks/$Author/$Book/actiontemp.txt",$currentref);
	}
	
	#### Save Bookmark Information

	if(! $author_error)
	{
		&update_tagfile();
	}
	
	open ERRORFLAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/author_error.txt" or die "failed to open/create author error flag file";
	print ERRORFLAGFILE $author_error;
	close ERRORFLAGFILE;
	#### End save Bookmark Information
}
else 
{
	## authenticate failed, authenticate.pl should have displayed exact error
}

print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";


##### process_option
sub process_option
{
	$refresh = 0;

	# make sure the option requested comes from the current valid reference
	if (defined($query->url_param('currentref')))
	{
		# check the passed reference against the stored one
		if ($query->url_param('currentref')==$currentref)
		{
			#check the action/transaction number against the passed one
			if (defined($query->url_param('newact')))
			{
				if ($query->url_param('newact') == ($currentact+1))
				{					
					# get the action required corresponding to the options available from the option file
					if (defined($query->url_param('option')))
					{
						$option = $query->url_param('option');
						
						if ($option==0)  ## the current output page has option 0 hardwired for endbook
						{
							## abandon book option
							$action="ENDBOOK Failed";
						}
						else
						{
							open (OPTIONS, "<Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";

							### this needs to be tested with an option number 1 greater than the number of options
							$.=1 ;
							
							## get corresponding action from OPTIONS file into $action
							while ( defined($action=<OPTIONS>) && $. != $option)
							{
							}

							# check that the option number requested did not exceed the actual number of options in the file
							if ($. != $option)
							{
								close OPTIONS;
								die "Option requested beyond range of options.txt";
							}
							
							if($action =~ /^TURNTO/){
								my $action_support;
								## %action_support_data global, shouldn't be really, and is not really action support, just turn-to restriction data (idea could be modified for greater flexibility though - $action_aupport_data[#count]=$1)
								while(defined($action_support=<OPTIONS>) && $action_support=~/^SUPPORTDATA\s(.*)/){$action_support_data{$1}=1;}
							}
							close OPTIONS;
						}
								
						###### main 'switch' for handling different actions #####
						$currentact++;
						$proposedact=$currentact+1;
						chomp $action;
						if ($action =~ /TURNTO\s+thumb\=([012])\s+tt_index\=([\w\d]+)\s+bookmark\=([01])\s+([\w\s]+)\<\<(.*)\s+\<\<TTSCRIPT\=(.*)/ )
						{
							my $thumb=$1;
							my $tt_index=$2;
							my $bookmark=$3;
							my $oldref=$newref = $4;
							my $tt_sel=$5;
							my $tt_script=$6;
							
							$currentact = 0;
							$proposedact=1;


							$newrefstring = "Accounts/$Author/MyBooks/$Book/refs/".$newref.".txt";

							if($tt_script){
								my @exec_return=&call_exec_code($tt_script,$newref);
								$newref=$exec_return[0];
							}

							my $restricted_pass=1;
							if(keys %action_support_data){
								$restricted_pass=$action_support_data{$newref};
							}

							if($tt_index ne "none"){
								if($turntos[$tt_index]){
									if($turntos[$tt_index] ne "infinite"){
										$turntos[$tt_index]--;
									}
								}
							}
							
							if (-e $newrefstring) # if reference entry exists
							{
							
								open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt");
								print CURRENTACT "$currentact";
								close CURRENTACT;
								
								if($restricted_pass){
									if($tt_sel=~/[^\s]/){
										&call_exec_code($tt_sel,$oldref);
									}

									if($thumb==1){
										&add_thumbprint($currentref);
									}
									elsif($thumb==2){
										&pop_thumbprint;
									}

									if($bookmark){
										&update_tagfile;
										&add_bookmark($currentref);
									}
									else{
										&remove_bookmark($currentref);
									}

									open (PREVREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt");
									print PREVREF "$currentref";
									close PREVREF;

									open (CURRENTREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt");
									print CURRENTREF "$newref";
									close CURRENTREF;

									open (ACTIONS ,">Accounts/$UserName/Bookmarks/$Author/$Book/actions.txt");
									print ACTIONS "Entered Reference $newref";
									close ACTIONS;

									if(&bookmark_exists($newref)){
										&load_bookmark($newref);
									}
									else{
										open (IFFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt");
										close IFFILE;

										@ifarray=();

										open (TAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt");
										close TAGFILE;

										@options=();
										@events=();
										@turntos=();
									}
								}
								else{
									## restricted_fail is global for now
									$restricted_fail=1; ## $name ## need to add name parameter to tt tags (really only for tts tags)
									print "Sorry, that is not a permitted/relevant reference";
								}
							}
							else
							{
								print "Author Error: reference $newref does not exist";
							}
						}
						elsif ($action =~ /TURNTOINPUT\s+thumb\=([01])\s+tt_index\=([\w\d]+)\s+bookmark\=([01])\s+([\w\s]+)\<\<(.*)\s+\<\<TTSCRIPT\=(.*)/ ){

							my $thumb=$1;
							my $tt_index=$2;
							my $bookmark=$3;
							my $name=$4;
							my $tt_sel=$5;
							my $tt_script=$6;
							
							open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt");
							print CURRENTACT "$currentact";
							close CURRENTACT;

							$newref=$query->param($name);
							
							print $query->keywords; ## what's this for???
											
							if($tt_script){
								my @exec_return=&call_exec_code($tt_script,$newref);
								$newref=$exec_return[0];
							}
							
							my $restricted_pass=1;
							if(keys %action_support_data){
								$restricted_pass=$action_support_data{$newref};
							}
							
							if($tt_index ne "none"){
								if($turntos[$tt_index]){
									if($turntos[$tt_index] ne "infinite"){
										$turntos[$tt_index]--;
									}
								}
							}
							
							$newrefstring = "Accounts/$Author/MyBooks/$Book/refs/".$newref.".txt";
							if(-e $newrefstring){
								if($restricted_pass){
									if($tt_sel=~/[^\s]/){
										&call_exec_code($tt_sel,$newref);
									}

									if($thumb==1){
										&add_thumbprint($currentref);
									}

									if($bookmark){
										&update_tagfile;
										&add_bookmark($currentref);
									}
									else{
										&remove_bookmark($currentref);
									}

									$currentact = 0;
									$proposedact=1;

									open (PREVREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt");
									print PREVREF "$currentref";
									close PREVREF;

									open (CURRENTREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt");
									print CURRENTREF "$newref";
									close CURRENTREF;

									open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt");
									print CURRENTACT "$currentact";
									close CURRENTACT;

									open (ACTIONS ,">Accounts/$UserName/Bookmarks/$Author/$Book/actions.txt");
									print ACTIONS "Entered Reference $newref";
									close ACTIONS;

									if(&bookmark_exists($newref)){
										&load_bookmark($newref);
									}
									else{
										open (IFFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt");
										close IFFILE;

										@ifarray=();

										open (TAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt");
										close TAGFILE;

										@options=();
										@events=();
										@turntos=();
									}
								}
								else{
									## restricted_fail is global for now
									$restricted_fail=$name;
									print "Sorry, that is not a permitted/relevant reference";
								}
							}
							else{
								print "Sorry, reference '$newref' does not exist";
								$restricted_fail=$name;
							}
							
						}
						elsif ($action =~ /ENDBOOK\s(\w*)/ ) ##### ENDBOOK ACTION
						{
							$parameter = $1;
							
							$t = $Book;
							$t .= ".txt";
							open (BOOKMARK ,"<Accounts/$UserName/Bookmarks/$Author/$Book/$t") or die "failed to open $t: $!";
							while (defined($input=<BOOKMARK>))
							{
								
								chomp $input;
								($field,$value) = split /=/, $input,2;
								$BookStatus{$field} = $value;
								
							}
							close BOOKMARK;
							if (($parameter eq "Completed") or ($parameter eq "completed"))
							{
								$BookStatus{"Completed"}++;
								$BookStatus{"Status"} = "Completed";
							}
							elsif (($parameter eq "Failed") or ($parameter eq "failed"))
							{
								$BookStatus{"Status"} = "Lost";											
							}
							else
							{
								print "Error: invalid parameter in options.txt to BOOKEND value";
							}
							
							open (BOOKMARK ,">Accounts/$UserName/Bookmarks/$Author/$Book/$t") or die "failed to open $t: $!";
							while ( ($field, $value) = each %BookStatus)
							{
								print BOOKMARK "$field=$value\n";
							}
							close BOOKMARK;
							
							open (PREVREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt") or die "failed to open previousref.txt";
							print PREVREF "$currentref";
							close PREVREF;
											
							open (CURRENTREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt") or die "failed to open currentref.txt";
							print CURRENTREF "credits";
							close CURRENTREF;

							@ifarray=();

							open (TAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt");
							close TAGFILE;

							@options=();
							@events=();
							
						}
						elsif ($action =~ /OPTION([\d]+)\s(.*)/ )
						{
							my $option_sel=$2;
							my $option_tag_selected=$1;
							
							open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt");
							print CURRENTACT "$currentact";
							close CURRENTACT;							
							
							&call_exec_code($option_sel);

							if ($options[$option_tag_selected] ne 'infinite')
							{
								$options[$option_tag_selected]--;
							}
						}
						elsif ($action =~ /OPTION\s(.*)/ ) ## dynamic options
						{
							my $option_sel=$1;
							
							open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt");
							print CURRENTACT "$currentact";
							close CURRENTACT;							
							
							&call_exec_code($option_sel);
						}												

						else
						{
							print "System Error: Action $action not yet supported, or unknown - this may be due to system alterations since you last played, please Abandon Adventure (you may have to click twice) and restart your adventure";
						}
					}
					else
					{
						print "Error - process_action in play.cgi called with current reference parameter but no option parameter.  Any option submitted not executed.  Continuing refreshed from last known reference.";
						$refresh = 1;
					}
				}
				elsif ($passedact == $currentact) # probably refresh
				{
					print "Probable refresh detected.  Any option resubmitted not executed.  Continuing refreshed from last known action.<BR>";
					$refresh = 1;
				}
				else # error in program or user trying to cheat
				{
					print "Query string altered or error in program, Any option submitted not executed.  Continuing refreshed from last known action<BR>";
					$refresh = 1;
				}
			}
			else
			{
				print "play.cgi called without currentact parameter.  Any option submitted not executed.  Continuing refreshed from last known reference.";
				$refresh = 1;
			}
		# refresh or currentref parameter altered or program error
		}
		else
		{
			print "Error - passed reference does not equal current reference.  Any option submitted not executed.  Continuing refreshed from last known action.<BR>";
			$refresh = 1;
		}
	}
	else
	{
		print "play.cgi called without current reference parameter.  Any option submitted not executed.  Continuing refreshed from last known reference.";
		$refresh = 1;
	}
}

sub process_reference
{
	# currentref may have changed due to a turnto action
	open (CURRENTREF ,"<Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt") or die "failed to open currentref.txt";
	$currentref = <CURRENTREF>;
	close CURRENTREF;

	#flush options file
	open (OPTIONS, ">Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
	close OPTIONS;
	
	## horde of globals here, must rectify
	$referencefile = $currentref;
	$referencefile .= ".txt";

	## needs to be here in case of refresh
	$option_record=0;
	$event_record=0;
	$tt_record=0;
	
	$tagcount=0;
	$validtagcount= 0;
	$optioncount= 0;
	
	$ifrecord=0;
	$ifnest=0;
	$ifhiddendepth=0;
	$stoppedifdepth=0;
	$eval_tags=1;
	$option_enforce=0;
	$override=0;
	
	$else_available=0;
	
	$else_depth=0;
	$else_hidden_depth=0;
	$else_is_true=0;
	$in_false_else=0;

	open (ACTIONOUTPUTFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/actiontemp.txt") or die "Can't open action output file";
	if($seloutput_present)
	{
		open (ACTIONFILE ,"<Accounts/$UserName/Bookmarks/$Author/$Book/seloutput.txt") or die "cant open seloutput file from actions";
		while (<ACTIONFILE>)
		{
			s/<([^>]*)>/&process_tag($1,1)/egi;
			s/\n/<br \/>\n/g;
			print ACTIONOUTPUTFILE;
		}
		close ACTIONFILE;
	}
	close ACTIONOUTPUTFILE;	

	$eval_tags=1;
	$override=0;

	open (OUTPUTFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/outref.txt") or die "Can't open reference output file";
	open (REFFILE ,"<Accounts/$Author/MyBooks/$Book/refs/$referencefile") or die "cant open reference $referencefile for author $Author book $Book";
	while (<REFFILE>)
	{
		s/<([^>]*)>/&process_tag($1,0)/egi;
		s/\n/<br \/>\n/g; ## this line here ONLY, not in dynamic text insertions
		print OUTPUTFILE;
	}
	close REFFILE;
	close OUTPUTFILE;
	
	$eval_tags=1;
	$override=0;
	
	if($ifnest){
		print "Unclosed &lt;if&gt; tag detected in reference: $currentref\n";
	}
	if($else_depth){
		print "Unclosed &lt;else&gt; tag detected in reference: $currentref\n";
	}
	
	## should make process_tag dynamic really, surely?
	if (open (CHARSHEET,"<Accounts/$Author/MyBooks/$Book/refs/charsheet.txt"))
	{
		open (CHARFILE, ">Accounts/$UserName/Bookmarks/$Author/$Book/chartemp.txt") or die "cannot create temporary Character Sheet file";
		
		while (<CHARSHEET>)
		{
			s/<([^>]*)>/&process_tag($1,0)/egi;
			s/\n/<br \/>\n/g;
			print CHARFILE;
		}
		
		close CHARFILE;
		close CHARSHEET;
	}
	else
	{
		## book has no character sheet defined, do nothing
	}
	
	if($ifnest){
		print "Unclosed &lt;if&gt; tag detected in charsheet\n";
	}
	if($else_depth){
		print "Unclosed &lt;else&gt; tag detected in charsheet\n";
	}
}

sub process_tag
{
	my %attributes;
	my $tag_ID;
	my $tag_is_single;
	my $original_tag;
	
	$tag = $original_tag = shift;
	my $dynamic=shift;
	if (($tagcount++) > 2000)
	{
		die "Author Error (don't worry unless you wrote this adventure you've done nothing wrong) Tags Counted Exceed 1000 Tags, Terminating process to prevent server overload.  Please use the back button to retrurn to FF pages and choose the 'Account' Link.  Let the author know of this error on the forums, thankyou.";
	}
	
	
	### replace html escaped with actual required symbols
	$tag=~s/\&gt\;/\>/g;
	$tag=~s/\&lt\;/\</g;
	$tag=~s/\&amp\;/\&/g;
	
	## determine if tag is xml single tag style and strip trailing '/' out of tag if it is
	if($tag=~s/(\/)$//){
		$tag_is_single=1;
	}

	
	#strip leading and trailing whitespace
	$tag =~ s/^\s+//;
	$tag =~ s/\s+$//;
	
	### extract the tag identifier into tag_ID and raw string of attributes into tag_attributes
	$tag=~/^(\/?\!?\-?\w+)\s*(.*)/;
	$tag_ID= $1;
	$tag_strip=$2;
	
	### now extract all attributes with values into hash keyed by attribute name
	## doesn't quite work! $2 evaluates to 1 in instances where there is no attribute value! - erm look at next while loop muppet
	while ($tag_strip=~s/\s*(\w+)\s*\=\s*\"(.*?(?<=[^\\]))\"\s*//i)  ## note regex loop appears to work by stripping attribute value pairs out of string until there is no matching pattern
	{
		my $key= lc $1;
		
		$attributes{$key}=$2;
		$attributes{$key}=~s/\\\"/\"/gi;  ## removes escape slash from escaped quotes - may be problematic if there are multiple slashes, i.e. \\\" may be reduced to just " rather than \\" - note, no it doesnt, it just removes the one :-)
	}
	while ($tag_strip=~s/\s*(\w+)\s*//i) ## now extract attribute flag types (e.g. attributes without '="value"') - assign a value of 1 just to indicate presence
	{
		my $key= lc $1;
		$attributes{$key}=1;
	}
	
	
	### switch case to deal with tags
	
	# if tag = <IF *> ############ IF TAG
	if (($tag_ID eq "IF") or ($tag_ID eq "if") )
	{
		$else_available=0;
			
		if (!($dynamic))
		{
			$ifindex=$ifrecord;
			$ifrecord += 1;
		}
		
		
		$ifnest += 1;
		
		
		# check for condition parameter (required)
		if (defined($attributes{"condition"}))
		{
			$condition = $attributes{"condition"};
			
			# check for re-evaluate parameter (optional and non-dynamic - dynamic IFs are always reval'ed)
			if (!($dynamic))
			{			
				if (defined($attributes{"reval"}))
				{
					$reval_string=$attributes{"reval"};
					if (($reval_string =~ /yes/i) or ($attributes{"reval"}==1))
					{
						$reval=1;
					}
					else
					{
						$reval=0;
					}
				}
				else
				{
					$reval = 0;
				}
			}
			else
			{
				$reval = 1;
			}
			
			if ($eval_tags) ## evaluating tags so evaluate the IF condition parameter
			{
				## get the true/false colour values
				if (defined($attributes{"truecolor"}))
				{
					$truecolor=$attributes{"truecolor"};
				}
				else
				{
					$truecolor="006600";
				}

				if (defined($attributes{"falsecolor"}))
				{
					$falsecolor=$attributes{"falsecolor"};
				}
				else
				{
					$falsecolor="333333";
				}

				
				## with addition of dynamic the reval test MUST be first relying on short-circuit
				if ( ($reval) or (not(defined($ifarray[$ifindex]))) )
				{
					
					$if_result = &evaluate_if_condition($condition);
					
					if (!($dynamic))
					{
						$ifarray[$ifindex]=$if_result;
					}
				}
				else
				{
					$if_result=$ifarray[$ifindex];
				}
				
				if ($if_result eq "false")
				{
					$eval_tags = 0;
					$stoppedifdepth=$ifnest;
					
					if ($falsecolor =~ /\bhidden\b/i)
					{
						if (($ifhiddendepth==0) and ($else_hidden_depth==0))
						{
							$ifhiddendepth=$ifnest;						
							return "<!--";
						}
						else
						{
							return "<span>";
						}

					}
					else
					{
						return "<span style=\"color:#$falsecolor;\">";
					}
				}
				else
				{
					if ($truecolor =~ /\bhidden\b/i)
					{
						if (($ifhiddendepth==0) and ($else_hidden_depth==0))
						{
							$ifhiddendepth=$ifnest;						
							return "<!--";
						}
						else
						{
							return "<span>";
						}
					}
					else
					{
						return "<span style=\"color:#$truecolor\">";
					}
				}
			}
			else ## not evaluating tags so do nothing
			{
			
			}
		}
		else
		{
			$author_error=1;
			return "<b> Author Error: IF tag without required condition parameter at this location in document </b>";
		}
		return "";
	}
	
	
	# if tag = </IF>  ############ END IF TAG
	elsif ( ($tag_ID eq "/IF") or ($tag_ID eq "/if") )
	{
		$else_available=1;
		$ifnest -= 1;
		if ($ifnest < 0)
		{
			$author_error=1;
			return "<b> Author Error: Misplaced </IF> Tag at this location in document </b>";
		}
		elsif ($ifnest < $stoppedifdepth)
		{
			if ($eval_tags)
			{
				$author_error=1;
				return "<b> Author Error: END IF nesting routine error </b>";
			}
			elsif ($ifnest == ($stoppedifdepth-1))
			{
				$eval_tags = 1;
				$stoppedifdepth=0;
				$else_is_true=1;
				if (($ifhiddendepth) and ($ifhiddendepth==($ifnest+1)))
				{
					$ifhiddendepth=0;					
					return "-->";
				}
				else
				{
					return "</span>";
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: END IF nesting routine error </b>";
			}
		}
		else
		{
			$else_is_true=0;
			if (($ifhiddendepth) and ($ifhiddendepth==($ifnest+1)))
			{
				$ifhiddendepth=0;					
				return "-->";
			}
			else
			{
				return "</span>";
			}

		}
		
		return "";
	}
	###### ELSE TAG
	elsif ( ($tag_ID eq "ELSE") or ($tag_ID eq "else") )
	{	
		if ($else_available)
		{
			$else_depth++;
			
			if ($eval_tags)
			{
				
				## get true/false colour attributes
				if (defined($attributes{"truecolor"}))
				{
					$truecolor=$attributes{"truecolor"};
				}
				else
				{
					$truecolor="006600";
				}

				if (defined($attributes{"falsecolor"}))
				{
					$falsecolor=$attributes{"falsecolor"};
				}
				else
				{
					$falsecolor="333333";
				}


				if ($else_is_true)
				{
					$else_available=0;
					
					if ($truecolor =~/^hidden$/i)
					{
						if (($ifhiddendepth==0) and ($else_hidden_depth==0))
						{
							$else_hidden_depth=$else_depth;
							return "<!--";
						}
						else
						{
							return "<span>";
						}
					}
					else
					{
						return "<span style=\"color:#$truecolor;\">";
					}
				}
				else
				{
					$eval_tags=0;
					$in_false_else=1;

					if ($falsecolor =~/^hidden$/i)
					{
						if (($ifhiddendepth==0) and ($else_hidden_depth==0))
						{
							$else_hidden_depth=$else_depth;
							return "<!--";
						}
						else
						{
							return "<span>";
						}
					}
					else
					{
						return "<span style=\"color:#$falsecolor;\">";
					}

				}				
				
			}
			else
			{
				## not evaluating tags so do nothing
			}
		}
		else
		{
			$author_error=1;
			return "<b> Author Error: ELSE tag placement error </b>";
		}
		
		return "";
	}
	##### END ELSE TAG
	elsif ( ($tag_ID eq "/ELSE") or ($tag_ID eq "/else") )
	{
		$else_available=0;
		
		$else_depth--;
		
		if ($eval_tags)
		{
			if ($else_depth < 0)
			{
				$author_error=1;
				return "<b> Author Error: Unexpected \/ELSE tag </b>";
			}
			else
			{
				
			}
		}
		else
		{
			if($in_false_else)
			{
				$in_false_else=0;
				$eval_tags=1;
			}
		}
		
		if (($else_hidden_depth) and ($else_hidden_depth==($else_depth+1)))
		{
			$else_hidden_depth=0;
			return "-->";
		}
		else
		{
			return "</span>";
		}
		
	}
	
	## needs to be outside of elsif($eval_tags) since may switch $eval_tags back on
	elsif($tag_ID eq "/ttf"){
		$validtagcount++;
		if($ttf_status eq "active"){
			$ttf_status="";
			return "</span>";
		}
		else{
			if($ttf_status eq "hidden"){
				$ttf_status="";
				$eval_tags=1;
				return "-->";
			}
			elsif($ttf_status eq "dormant"){
				$ttf_status="";
				$eval_tags=1;
			}
		}
	}

	elsif ($eval_tags)
	{

		# if tag = <TT *> ############ TURN TO TAG
		if ( ($tag_ID eq "TT") or ($tag_ID eq "tt"))
		{
			
			#check for reference paremeter (required) matches on 'ref = ""  '
			if (defined($attributes{"ref"}))
			{
				my $tt_index;
				
				if($attributes{"recall"} eq "1"){
					$attributes{"visits"}=1;
					$attributes{"override"}=1;
					$attributes{"thumbprint"}=1;
				}
				
				if(!($dynamic)){
					$tt_index=$tt_record;
					$tt_record++;
					if(!(defined($turntos[$tt_index]))) {
						if(defined($attributes{"visits"})){
							$turntos[$tt_index]=$attributes{"visits"};
						}
						else{
							$turntos[$tt_index]="infinite";
						}
					}
				}
				else{
					$tt_index="none"
				}

				if( ($dynamic) or ($turntos[$tt_index] ne "0") ){

					$turntoref = $attributes{"ref"};
					$turntoref =~ s/^\s+//;
					$turntoref =~ s/\s+$//;
					$validref = 1;
					$validtagcount++;
					$tt_active=1; ## global

					my $tt_script=$attributes{'script'};
					my $tt_ref_script="";
					
					if ($turntoref eq "PREVIOUS")
					{
						$validtagcount++;
						open (PREVREF, "<Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt") or die "Couldnt open prevref.txt";
						$turntoref = <PREVREF>;
						close PREVREF;
					}

					if ($validref)
					{
						$optioncount++;

						if ($option_enforce)
						{
							open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
							print OPTIONS $option_enforce;
							close OPTIONS;
						}
						else
						{
							my $thumb=0;
							if($attributes{"thumbprint"} eq "1"){
								$thumb=1;
							}

							my $bookmark=0;
							if(($attributes{"bookmark"} eq "1") or (defined($attributes{"visits"}))){
								$bookmark=1;
							}

							if (($attributes{"enforce"} =~ /^true$/i) or ($attributes{"enforce"} eq "1"))
							{
								$option_enforce="TURNTO thumb=$thumb tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=$tt_ref_script\n";
								&enforce_option($option_enforce);
							}
							
							if($attributes{"override"} eq "1"){
								$override=1;
							}
							
							open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
							print OPTIONS "TURNTO thumb=$thumb tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=$tt_ref_script\n";
							close OPTIONS;

						}
						return "<a class=\"tt\" href = \"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\">";
					}
					else
					{
						return "<b>Author Error: Reference in TT Tag invalid</b>";
					}
				}
				else{
					$tt_active=0;
					return "";
				}
			}
			else 
			{
				$author_error=1;
				return "<b> Author Error: Turn To Tag without required reference parameter </b>";
			}
		}

		# if tag = </TT> ########### END TURN TO TAG
		elsif ( ($tag_ID eq "/TT") or ($tag_ID eq "/tt") )
		{
			$validtagcount++;
			if($option_enforce or $override){
				$eval_tags=0;
			}
			if($tt_active){
				$tt_active=0;
				return "</a>";
			}
			else{
				return;
			}
		}
		
		
		# if tag = <tts *> ############ TURN TO SCRIPT TAG
		elsif ($tag_ID eq "tts")
		{
			
			#check for reference paremeter (required) matches on 'ref = ""  '
			if (defined($attributes{"ref"} and defined($attributes{'refscript'})))
			{
				my $tt_index;
				$ttr_available=1; ## nasty global
				if($attributes{"recall"} eq "1"){
					$attributes{"visits"}=1;
					$attributes{"override"}=1;
					$attributes{"thumbprint"}=1;
				}
				
				if(!($dynamic)){
					$tt_index=$tt_record;
					$tt_record++;
					if(!(defined($turntos[$tt_index]))) {
						if(defined($attributes{"visits"})){
							$turntos[$tt_index]=$attributes{"visits"};
						}
						else{
							$turntos[$tt_index]="infinite";
						}
					}
				}
				else{
					$tt_index="none"
				}

				if( ($dynamic) or ($turntos[$tt_index] ne "0") ){

					$turntoref = $attributes{"ref"};
					$turntoref =~ s/^\s+//;
					$turntoref =~ s/\s+$//;
					$validref = 1;
					$validtagcount++;
					$tt_active=1; ## global

					my $tt_script=$attributes{'script'};
					my $tt_ref_script=$attributes{'refscript'};
					
					if ($turntoref eq "PREVIOUS")
					{
						$validtagcount++;
						open (PREVREF, "<Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt") or die "Couldnt open prevref.txt";
						$turntoref = <PREVREF>;
						close PREVREF;
					}

					if ($validref)
					{
						$optioncount++;

						if ($option_enforce)
						{
							open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
							print OPTIONS $option_enforce;
							close OPTIONS;
						}
						else
						{
							my $thumb=0;
							if($attributes{"thumbprint"} eq "1"){
								$thumb=1;
							}

							my $bookmark=0;
							if(($attributes{"bookmark"} eq "1") or (defined($attributes{"visits"}))){
								$bookmark=1;
							}

							if (($attributes{"enforce"} =~ /^true$/i) or ($attributes{"enforce"} eq "1"))
							{
								$option_enforce="TURNTO thumb=$thumb tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=$tt_ref_script\n";
								&enforce_option($option_enforce);
							}
							
							if($attributes{"override"} eq "1"){
								$override=1;
							}
							
							open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
							print OPTIONS "TURNTO thumb=$thumb tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=$tt_ref_script\n";
							close OPTIONS;

						}
						return "<a class=\"tt\" href = \"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\">";
					}
					else
					{
						return "<b>Author Error: Reference in TT Tag invalid</b>";
					}
				}
				else{
					$tt_active=0;
					return "";
				}
			}
			else 
			{
				$author_error=1;
				return "<b> Author Error: Turn To Script Tag without required reference attribute or required refscript attribute</b>";
			}
		}

		# if tag = </TTS> ########### END TURN TO SCRIPT TAG
		elsif ($tag_ID eq "/tts")
		{
			$ttr_available=0;  ## nasty global
			$validtagcount++;
			if($option_enforce or $override){
				$eval_tags=0;
			}
			if($tt_active){
				$tt_active=0;
				return "</a>";
			}
			else{
				return "";
			}
		}
		
		elsif($tag_ID eq "rtt"){  #### RETURN TO TAG
			
			$optioncount++;
			$validtagcount++;
			$validref = 1;

			if($attributes{"recall"} eq "1"){
				$attributes{"visits"}=1;
				$attributes{"override"}=1;
				$attributes{"thumbprint"}=1;
			}
				
			my $tt_index;
			if(!($dynamic)){
				$tt_index=$tt_record;
				$tt_record++;
				if(!(defined($turntos[$tt_index]))) {
					if(defined($attributes{"visits"})){
						$turntos[$tt_index]=$attributes{"visits"};
					}
					else{
						$turntos[$tt_index]="infinite";
					}
				}
			}
			else{
				$tt_index="none"
			}
	
			if( ($dynamic) or ($turntos[$tt_index] ne "0") ){
			
				$tt_active=1;
			
				if ($option_enforce){
					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS $option_enforce;
					close OPTIONS;
				}
				else{

					my $tt_script=$attributes{'script'};

					my $bookmark=0;
					if(($attributes{"bookmark"} eq "1") or (defined($attributes{"visits"}))){
						$bookmark=1;
					}

					if (($attributes{"enforce"} =~ /^true$/i) or ($attributes{"enforce"} eq "1"))
					{
						$option_enforce="TURNTO thumb=2 tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=\n";
						&enforce_option($option_enforce);
					}
					
					if($attributes{"override"} eq "1"){
						$override=1;
					}

					my $turntoref=&get_thumbprint;
					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS "TURNTO thumb=2 tt_index=$tt_index bookmark=$bookmark $turntoref<<$tt_script <<TTSCRIPT=\n";
					close OPTIONS;
				}

				return "<a class=\"tt\" href = \"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\">";
			}
			else{
				$tt_active=0;
				return "";
			}
		}
		
		elsif($tag_ID eq "/rtt"){  ### END RETURN TO TAG
			$validtagcount++;
			if($option_enforce or $override){
				$eval_tags=0;
			}
			if($tt_active){
				$tt_active=0;
				return "</a>";
			}
			else{
			}
		}

		elsif($tag_ID eq "tti"){  ##### TURN TO INPUT TAG
			my $name;
			if (defined($attributes{"name"}))
			{
				$name = $attributes{"name"};
				$name =~ s/^\s+//;
				$name =~ s/\s+$//;
			}
			else{
				return "<br /><b>Author Error: tti tag used without required name attribute</b><br />";
			}
			if($attributes{"recall"} eq "1"){
				$attributes{"visits"}=1;
				$attributes{"override"}=1;
				$attributes{"thumbprint"}=1;
			}

			$optioncount++;
			$validtagcount++;
			
			$ttr_available=1; ## nasty global must do better
			
			my $tt_index;
			if(!($dynamic)){
				$tt_index=$tt_record;
				$tt_record++;
				if(!(defined($turntos[$tt_index]))) {
					if(defined($attributes{"visits"})){
						$turntos[$tt_index]=$attributes{"visits"};
					}
					else{
						$turntos[$tt_index]="infinite";
					}
				}
			}
			else{
				$tt_index="none"
			}
			
			if( ($dynamic) or ($turntos[$tt_index] ne "0") ){

				if ($option_enforce)
				{
					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS $option_enforce;
					close OPTIONS;
				}
				else{

					my $tti_script=$attributes{"script"};
					my $tt_ref_script=$attributes{'refscript'};

					my $thumb=0;
					if($attributes{"thumbprint"} eq "1"){
						$thumb=1;
					}

					my $bookmark=0;
					if(($attributes{"bookmark"} eq "1") or (defined($attributes{"visits"}))){
						$bookmark=1;
					}

					if (($attributes{"enforce"} =~ /^true$/i) or ($attributes{"enforce"} eq "1"))
					{
						$option_enforce="TURNTOINPUT thumb=$thumb tt_index=$tt_index bookmark=$bookmark $name<<$tti_script <<TTSCRIPT=$tt_ref_script\n";
						&enforce_option($option_enforce);
					}

					if($attributes{"override"} eq "1"){
						$override=1;
					}

					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS "TURNTOINPUT thumb=$thumb tt_index=$tt_index bookmark=$bookmark $name<<$tti_script <<TTSCRIPT=$tt_ref_script\n";
					close OPTIONS;
				}

				my $formtext= "<form method=\"post\" action=\"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\" enctype=\"multipart/form-data\" name=\"tti $name\">";
				$formtext.="<input type=\"text\" name=\"$name\" />";
				$formtext.="<input type=\"submit\" name=\"Submit\" value=\"Submit\" />";
				$formtext.="</form>";

				return $formtext;
			}
		}
		
		elsif($tag_ID eq "/tti"){
			### end tti tag should close option for rtt tags here
			if($ttr_available){
				$ttr_available=0;
				return "";
			}
			else{
				return "/tti tag used without open tti tag";
			}
		}
		
		elsif($tag_ID eq "ttr"){  ######## Turn To Restriction Tag
			if($ttr_available){
				if(defined($attributes{"ref"})){
					$validtagcount++;
					$optioncount++;
					my $ref=$attributes{"ref"};

					## need to add open tti/tts tag checker sometime
					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS "SUPPORTDATA $ref\n";
					close OPTIONS;

					return "";

				}
				else{
					return "ttr tag used without ref attribute";
				}
			}
			else{
				return "ttr tag used outside of (tti or tts) tag";
			}
		}
		
		elsif($tag_ID eq "ttf"){  ######## Turn To Failure Tag
			
			## hidden attribute needs consideration due to fact that if eval_tags is 0 (in false IF for example), it will not hide, must address when recoding - thinking about it may even abandon 'hidden' attributes altogether
			
			$validtagcount++;
			if($restricted_fail){
				$ttf_status=""; ## global flag only used in ttf open/close tag, must rectify
				if(defined($attributes{"color"})){
					$color=$attributes{"color"};
				}
				else{
					$colour="006600"; ## default active colour				
				}
				if(defined($attributes{"name"})){
					## specified restriction failure tag
					my $name=$attributes{"name"};
					if($name eq $restricted_fail){
						$ttf_status="active";
						return "<span style=\"color:#$color;\">";
					}
					else{
						$eval_tags=0;
						$ttf_status="dormant";
					}
				}
				else{
					## unspecified restriction failure tag
					$ttf_status="active";
					return "<span style=\"color:#$color;\">";
				}
			}
			else{
				$eval_tags=0; ## switch off tag evaluation since we do not want tags in this to be evaluated unless the turn-to has failed
				if(defined($attributes{"hidden"})){
					$ttf_status="hidden";
					return "<!--";
				}
				else{
					## no restriction failure, hide this not selected
					$ttf_status="dormant";
				}
				
			}
			return ""; ## dormant return
		}

		# if tag = <BookEnd *> ########### ENDBOOK TAG
		elsif ( ($tag_ID eq "BOOKEND") or ($tag_ID eq "bookend") )
		{

			$parameters = $attributes{"adventure"};

			### Bookend only allowed 1 parameter, either Completed, Failed
			if (($parameters eq "Completed") or ($parameters eq "Failed") or ($parameters eq 'failed') or ($parameters eq 'completed'))
			{
				$validtagcount++;
				$optioncount++;

				if ($option_enforce)
				{
					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS $option_enforce;
					close OPTIONS;
				}
				else
				{
					if (($attributes{"enforce"} =~ /^true$/i) or ($attributes{"enforce"} eq "1"))
					{
						$option_enforce="ENDBOOK $parameters\n";
						&enforce_option($option_enforce);
					}

					open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
					print OPTIONS "ENDBOOK $parameters\n";
					close OPTIONS;
				}
				
				return "<a class=\"be\" href = \"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\">";
				
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: Invalid parameter to Bookend tag </b>";
			}
		}



		elsif ( ($tag_ID eq "/BOOKEND") or ($tag_ID eq "/bookend") ) ########### END ENDBOOK TAG
		{
			$validtagcount++;
			if($option_enforce){
				$eval_tags=0;
			}
			return "</a>";
		}


		elsif ( ($tag_ID eq "EVENT") or ($tag_ID eq "event") ) ############## EVENT TAG
		{
			my @scriptout;
			
			if (defined($attributes{"event"}))
			{
				$validtagcount++;
				
				$sel_code = $attributes{"event"};
				## dynamic events are always executed
				if (!($dynamic))
				{
					if (!($events[$event_record]))
					{
						&call_exec_code($sel_code);
						
						open (SELOUT, "<Accounts/$UserName/Bookmarks/$Author/$Book/seloutput.txt") or die "failed to open SEL output file: $!";
						@scriptout=<SELOUT>;
						close SELOUT;
						
						## process tags that may have been returned
						for (my $counter=0;$counter < @scriptout;$counter++)
						{
							#local $else_available=0;  ## localise the else_available to prevent dynamic IF/ELSES's conflicting

							$scriptout[$counter]=~ s/<([^>]*)>/&process_tag($1,1)/egi;
						}
						
						
						if (defined($attributes{"color"}))
						{
							$event_colour=$attributes{"color"};
						}
						else
						{
							$event_colour = "36648B";
						}
					}
					else
					{
						$event_colour= "333333";
					}
				}
				else
				{
					&call_exec_code($sel_code);
					
					open (SELOUT, "<Accounts/$UserName/Bookmarks/$Author/$Book/seloutput.txt") or die "failed to open SEL output file: $!";
					@scriptout=<SELOUT>;
					close SELOUT;
					
					## process tags that may have been returned
					for (my $counter=0;$counter < @scriptout;$counter++)
					{
						#local $else_available=0;  ## localise the else_available to prevent dynamic IF/ELSES's conflicting

						$scriptout[$counter]=~ s/<([^>]*)>/&process_tag($1,1)/egi;
					}
					
					$event_colour = "006600";
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: Event tag used without required 'event' parameter </b>";
			}
			
			## reval parameter ignored in dynamic events, no record is kept of dynamic event status
			if (!($dynamic))
			{
				$events[$event_record]=1;
				$event_record++;
			}

			## why the fuck does the ternary operator not work?
			if($tag_is_single){$close_tag="</span>";}else{$close_tag="";}

			if (@scriptout > 1)
			{
				my $script_return,$script_item;
				$script_return="<span style=\"color:#$event_colour\">";

				foreach $script_item(@scriptout)
				{
					if (defined($script_item))
					{
						$script_return.=$script_item;
					}
				}
				return ($script_return.$close_tag);
			}
			elsif (@scriptout==1)
			{
				return ("<span style=\"color:#$event_colour;\">".$scriptout[0].$close_tag);
			}
			else
			{
				return ("<span style=\"color:#$event_colour;\">".$close_tag);
			}
		}

		elsif ( ($tag_ID eq "/EVENT") or ($tag_ID eq "/event") )
		{
			$validtagcount++;
			return "</span>";
		}
		
		
		elsif ( ($tag_ID eq "INFO") or ($tag_ID eq "info") ) ################### INFO tag
		{
			
			if (defined($attributes{"info"}))
			{
				$validtagcount++;
				
				$sel_code = $attributes{"info"};
				@info = &call_exec_code($sel_code);
						
				## process tags that may have been returned
				for (my $counter=0;$counter < @info;$counter++)
				{
					#local $else_available=0;  ## localise the else_available to prevent dynamic IF/ELSES's conflicting
				
					$info[$counter]=~ s/<([^>]*)>/&process_tag($1,1)/egi;
				}
				
				if ($attrubutes{"color"})
				{
					$info_colour=$attributes{"color"};
				}
				else
				{
					$info_colour = "000000";
				}
				
				if (defined($attributes{"seperator"}))
				{
					$seperator=$attributes{"seperator"};
				}
				else
				{
					$seperator="\n";
				}
				
				
				
				## why the fuck does the ternary operator not work?
				if($tag_is_single){$close_tag="</span>";}else{$close_tag="";}
				##$tag_is_single?$close_tag="</span>":$close_tag="";
				
				if (@info > 1)
				{
					$info_return="<span style=\"color:#$info_colour\">";

					foreach $info_item(@info)
					{
						if (defined($info_item))
						{
							$info_return.=$info_item.$seperator;  ## this leaves a trailing seperator duh.
						}
					}
					$info_return=~s/$seperator$//;
					return ($info_return.$close_tag);
				}
				elsif (@info==1)
				{
					return ("<span style=\"color:#$info_colour;\">$info[0]".$close_tag);
				}
				else
				{
					return ("<span style=\"color:#$info_colour;\">".$close_tag);
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: Info tag used without required 'info' parameter </b>";
			}
		}

		elsif ( ($tag_ID eq "/INFO") or ($tag_ID eq "/info") )
		{
			$validtagcount++;
			return "</span>";
		}
		
		elsif ( ($tag_ID eq "SCRIPT") or ($tag_ID eq "script") ) ############### SCRIPT tag
		{
			if (defined($attributes{"script"}))
			{
				$validtagcount++;
				
				$sel_code = $attributes{"script"};
				$script_exit = &call_exec_code($sel_code);
				
				open (SELOUT, "<Accounts/$UserName/Bookmarks/$Author/$Book/seloutput.txt") or die "failed to open SEL output file: $!";
				@scriptout=<SELOUT>;
				close SELOUT;
				
				## process tags that may have been returned
				for (my $counter=0;$counter < @scriptout;$counter++)
				{
					#local $else_available=0;  ## localise the else_available to prevent dynamic IF/ELSES's conflicting
				
					$scriptout[$counter]=~ s/<([^>]*)>/&process_tag($1,1)/egi;
				}
				
				if ($attrubutes{"color"})
				{
					$script_colour=$attributes{"color"};
				}
				else
				{
					$script_colour = "000000";
				}

				## why the fuck does the ternary operator not work?
				if($tag_is_single){$close_tag="</span>";}else{$close_tag="";}
				##$tag_is_single?$close_tag="</span>":$close_tag="";

				if (@scriptout > 1)
				{
					$script_return="<span style=\"color:#$script_colour;\">";

					foreach $script_item(@scriptout)
					{
						if (defined($script_item))
						{
							$script_return.=$script_item;
						}
					}
					return ($script_return.$close_tag);
				}
				elsif (@scriptout==1)
				{
					return ("<span style=\"color:#$script_colour;\">$scriptout[0]".$close_tag);
				}
				else
				{
					return ("<span style=\"color:#$script_colour;\">".$close_tag);
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: Script tag used without required 'script' parameter </b>";
			}
		}

		elsif ( ($tag_ID eq "/SCRIPT") or ($tag_ID eq "/script") )
		{
			$validtagcount++;
			return "</span>";
		}


		elsif ( ($tag_ID eq "OPTION") or ($tag_ID eq "option") ) #################### OPTION tag
		{			
			if (defined($attributes{"option"}))
			{
				$validtagcount++;
				
				$optionsel=$attributes{"option"};

				## dynamic options are always available
				if (($dynamic) or ($options[$option_record]>0) or (!(defined($options[$option_record]))) or ($options[$option_record] eq 'infinite') )
				{
					$optioncount++;
					
					if ($option_enforce)
					{
						open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
						print OPTIONS $option_enforce;
						close OPTIONS;
					}
					else
					{
						open (OPTIONS, ">>Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
						if($dynamic)
						{
							print OPTIONS "OPTION $optionsel\n";
						}
						else
						{
							print OPTIONS "OPTION".$option_record." $optionsel\n";
						}
						close OPTIONS;
					
					}

					## dynamic options can have no click record
					if (!($dynamic))
					{
						## deal with counting option clicks
						if (!(defined($options[$option_record])))
						{
							if (defined($attributes{"count"}))
							{
								$options[$option_record]=$attributes{"count"};
							}
							elsif (defined($attributes{"selcount"}))
							{
								my @selout=&call_exec_code($attributes{"selcount"});
								if(@selout>1)
								{
									$options[$option_record]=@selout;
								}
								else
								{
									$options[$option_record]=$selout[0];
								}
							}
							elsif (defined($attributes{"scriptcount"}))
							{
								my @selout=&call_exec_code($attributes{"scriptcount"});
								if(@selout>1)
								{
									$options[$option_record]=@selout;
								}
								else
								{
									$options[$option_record]=$selout[0];
								}
							}
							else
							{
								$options[$option_record]=1;
							}
							
							
							if ( ($options[$option_record]=~/^[\d]+$/) or ($options[$option_record]=~/^infinite$/) )
							{
								## is valid value so leave alone and do nothing
							}
							else
							{
								$author_error=1;
								return "<b> Author Error: invalid count or selcount or scriptcount parameter to option tag </b>";
							}
						}
					}
					
					$option_false=0; ## global
					if(!($dynamic)){$option_record++;}					
					return "<a  class=\"opt\" href = \"play.cgi?currentref=$currentref&option=$optioncount&newact=$proposedact\">";
				}
				else
				{
					if (defined($attributes{"usedcolor"}))
					{
						$used_color=$attributes{"usedcolor"};
					}
					else
					{
						$used_color="333333";
					}
					$option_false=1;
					if(!($dynamic)){$option_record++;}					
					return "<span style=\"color:#$used_color;\">";
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: Option tag used without required 'option' parameter </b>";
			}
		}
		
		elsif ( ($tag_ID eq "/OPTION") or ($tag_ID eq "/option") )
		{
			$validtagcount++;
			
			if ($option_false)
			{
				return "</span>";
			}
			else
			{
				$option_false=1;
				return "</a>";
			}
		}
		
		elsif ( ($tag_ID eq "INCLUDE") or ($tag_ID eq "include") )
		{
			if(defined($attributes{"file"}) or defined($attributes{"reference"}))
			{
				my $includefile;
				
				(defined($attributes{"reference"})) ? ($includefile=$attributes{"reference"}.".txt") : ($includefile=$attributes{"file"}.".txt");
				
				if(open(INCLUDEFILE, "<Accounts/$Author/MyBooks/$Book/refs/$includefile"))
				{
					my @includetext="",$includereturn="",$includeitem="",$counter=0;
				
					@includetext=<INCLUDEFILE>;
					close INCLUDEFILE;
				
					## why the fuck does the ternary operator not work?
					if($tag_is_single){$close_tag="</span>";}else{$close_tag="";}
					##$tag_is_single?$close_tag="</span>":$close_tag="";				
				
					for($counter=0;$counter < @includetext;$counter++)
					{
						$includetext[$counter]=~ s/<([^>]*)>/&process_tag($1,$dynamic)/egi;  ## is INCLUDE dynamic?  no it isn't, but we need to pass the $dynamic status through in case it has been generated by a dynamic call
					}
					
					foreach $includeitem(@includetext)
					{
						$includereturn.=$includeitem;
					}
					
					return ($includereturn.$close_tag);
				}
				else
				{
					# failed to open include file reference (probably doesn't exist) do nothing atm
					return "Failed To open Included reference $includefile";
				}
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: INCLUDE tag used without required file attribute </b>";
			
			}
		}
		elsif ( ($tag_ID eq "/INCLUDE") or ($tag_ID eq "/include") )
		{
			## like a lot of other tags the close part is really unnecessary, need to switch to xml style <TAG/> method
			return;
		}

		elsif ( ($tag_ID eq "EXTERNAL") or ($tag_ID eq "external") )
		{
			if(defined($attributes{"url"}))
			{
				my $url=$attributes{"url"};
				return "<a class=\"tt\" href=\"$url\" target=\"_blank\">";
			}
			else
			{
				$author_error=1;
				return "<b> Author Error: EXTERNAL tag used without required url parameter </b>";			
			}
		}
		elsif ( ($tag_ID eq "/EXTERNAL") or ($tag_ID eq "/external") )
		{
			return "</a>";
		}
		
		else  ######## non ABML Tag
		{
			## allow xhtml tag pass-through
			## have allowed u tag not sure if that's really valid xhtml
			if(
				($tag_ID eq "!-") or 
				($tag_ID eq "abbr") or 
				($tag_ID eq "/abbr") or 
				($tag_ID eq "acronym") or 
				($tag_ID eq "/acronym") or 
				($tag_ID eq "address") or 
				($tag_ID eq "/address") or 
				($tag_ID eq "b") or 
				($tag_ID eq "/b") or 
				($tag_ID eq "bdo") or 
				($tag_ID eq "/bdo") or 
				($tag_ID eq "big") or 
				($tag_ID eq "/big") or 
				($tag_ID eq "blockquote") or 
				($tag_ID eq "/blockquote") or 
				($tag_ID eq "br") or 
				($tag_ID eq "caption") or 
				($tag_ID eq "/caption") or 
				($tag_ID eq "cite") or 
				($tag_ID eq "/cite") or 
				($tag_ID eq "code") or 
				($tag_ID eq "/code") or 
				($tag_ID eq "col") or 
				($tag_ID eq "colgroup") or 
				($tag_ID eq "/colgroup") or 
				($tag_ID eq "dd") or 
				($tag_ID eq "/dd") or 
				($tag_ID eq "del") or 
				($tag_ID eq "/del") or 
				($tag_ID eq "dfn") or 
				($tag_ID eq "/dfn") or 
				($tag_ID eq "div") or 
				($tag_ID eq "/div") or 
				($tag_ID eq "dl") or 
				($tag_ID eq "/dl") or 
				($tag_ID eq "dt") or 
				($tag_ID eq "/dt") or 
				($tag_ID eq "em") or 
				($tag_ID eq "/em") or 
				($tag_ID eq "h1") or 
				($tag_ID eq "/h1") or 
				($tag_ID eq "h2") or 
				($tag_ID eq "/h2") or 
				($tag_ID eq "h3") or 
				($tag_ID eq "/h3") or 
				($tag_ID eq "h4") or 
				($tag_ID eq "/h4") or 
				($tag_ID eq "h5") or 
				($tag_ID eq "/h5") or 
				($tag_ID eq "h6") or 
				($tag_ID eq "/h6") or 
				($tag_ID eq "hr") or 
				($tag_ID eq "i") or 
				($tag_ID eq "/i") or 
				($tag_ID eq "ins") or 
				($tag_ID eq "/ins") or 
				($tag_ID eq "kbd") or 
				($tag_ID eq "/kbd") or 
				($tag_ID eq "li") or 
				($tag_ID eq "/li") or 
				($tag_ID eq "ol") or 
				($tag_ID eq "/ol") or 
				($tag_ID eq "p") or 
				($tag_ID eq "/p") or 
				($tag_ID eq "pre") or 
				($tag_ID eq "/pre") or 
				($tag_ID eq "q") or 
				($tag_ID eq "/q") or 
				($tag_ID eq "samp") or 
				($tag_ID eq "/samp") or 
				($tag_ID eq "small") or 
				($tag_ID eq "/small") or 
				($tag_ID eq "span") or 
				($tag_ID eq "/span") or 
				($tag_ID eq "strong") or 
				($tag_ID eq "/strong") or 
				($tag_ID eq "sub") or 
				($tag_ID eq "/sub") or 
				($tag_ID eq "sup") or 
				($tag_ID eq "/sup") or 
				($tag_ID eq "table") or 
				($tag_ID eq "/table") or 
				($tag_ID eq "tbody") or 
				($tag_ID eq "/tbody") or 
				($tag_ID eq "td") or 
				($tag_ID eq "/td") or 
				($tag_ID eq "tfoot") or 
				($tag_ID eq "/tfoot") or 
				($tag_ID eq "th") or 
				($tag_ID eq "/th") or 
				($tag_ID eq "thead") or 
				($tag_ID eq "/thead") or 
				($tag_ID eq "tr") or 
				($tag_ID eq "/tr") or 
				($tag_ID eq "ul") or 
				($tag_ID eq "/ul") or 
				($tag_ID eq "var") or 
				($tag_ID eq "/var") or 
				($tag_ID eq "a") or 
				($tag_ID eq "/a") or
				($tag_ID eq "u") or 
				($tag_ID eq "/u")
			){
				## exclude javascript events
				if(
					(defined($attributes{"onload"})) or 
					(defined($attributes{"onunload"})) or 
					(defined($attributes{"onblur"})) or 
					(defined($attributes{"onchange"})) or 
					(defined($attributes{"onfocus"})) or 
					(defined($attributes{"onreset"})) or 
					(defined($attributes{"onselect"})) or 
					(defined($attributes{"onsubmit"})) or 
					(defined($attributes{"onabort"})) or 
					(defined($attributes{"onkeydown"})) or 
					(defined($attributes{"onkeypress"})) or 
					(defined($attributes{"onkeyup"})) or 
					(defined($attributes{"onclick"})) or 
					(defined($attributes{"ondblclick"})) or 
					(defined($attributes{"onmousedown"})) or 
					(defined($attributes{"onmousemove"})) or 
					(defined($attributes{"onmouseout"})) or 
					(defined($attributes{"onmouseover"})) or 
					(defined($attributes{"onmouseup"}))
				){
					return "<br />javascript events are not permitted here in fightingfantasy.net implemntation of ABML, in tag $tag_ID<br />";
				}
				else{
					return "<".$original_tag.">";
				}
			}
			elsif(
				($tag_ID eq "head") or 
				($tag_ID eq "/head") or 
				($tag_ID eq "body") or 
				($tag_ID eq "/body") or 
				($tag_ID eq "!DOCTYPE") or 
				($tag_ID eq "area") or 
				($tag_ID eq "base") or 
				($tag_ID eq "button") or 
				($tag_ID eq "/button") or 
				($tag_ID eq "fieldset") or 
				($tag_ID eq "/fieldset") or 
				($tag_ID eq "form") or 
				($tag_ID eq "/form") or 
				($tag_ID eq "img") or 
				($tag_ID eq "input") or 
				($tag_ID eq "label") or 
				($tag_ID eq "/label") or 
				($tag_ID eq "legend") or 
				($tag_ID eq "/legend") or 
				($tag_ID eq "map") or 
				($tag_ID eq "/map") or 
				($tag_ID eq "optgroup") or 
				($tag_ID eq "/optgroup") or 
				($tag_ID eq "select") or 
				($tag_ID eq "/select") or 
				($tag_ID eq "textarea") or 
				($tag_ID eq "/textarea")
			){
				return "<br />!Tag $tag_ID allowed in ABML but not implemented here at fightingfantasy.net - yet!<br />";
			}
			else{
				return "<br />!Tag $tag_ID not recognised or not allowed!<br />";
			}
		}
	
	} ### end (if eval_tag)
	
	else ## not evaluating tags so just return blank
	{
		## only update option and event tag records for non-dynamic event and option tags that have not been evaluated
		## doesn't cater for bad authoring of document... i.e. close tags without matching open tags
		if (!($dynamic))
		{
			if (($tag_ID eq "event") or ($tag_ID eq "EVENT"))
			{
				$event_record++;
			}
			elsif(($tag_ID eq "option") or ($tag_ID eq "OPTION"))
			{

				$option_record++;
			}
			elsif(($tag_ID eq "tt") or ($tag_ID eq "TT"))
			{

				$tt_record++;
			}
			else
			{
				# tag that doesnt need logging, do nothing
			}			
		}
		else
		{
			# tag that doesnt need logging, do nothing
		}
		return "";
	}
}


sub display_reference
{
	my $displayfile=shift;
	my $charfile=shift;
	my $actionfile=shift;
	my $currentref=shift;
	
if (!(defined($proposedact)))
{
	$proposedact=$currentact+1;
}

open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
my $perl_scriptlocation=<SCRIPTLOC>;
chomp $perl_scriptlocation;
close SCRIPTLOC;

my $cover="Accounts/$Author/MyBooks/$Book/images/cover/cover.jpg";
if(-e $cover){
	$cover=$perl_scriptlocation."/".$cover;
}
else{
	# print "$cover not found";
	$cover="$perl_scriptlocation/resources/images/dragon.jpg";
}

my $illustration=("Accounts/$Author/MyBooks/$Book/images/$currentref".".jpg");
if(-e $illustration){
	$illustration=$perl_scriptlocation."/".$illustration;
}
else{
	# print "$illustration not found";
	$illustration="$perl_scriptlocation/resources/images/dragon.jpg";
}

print<<"print_tag";
<head>
<link rel="stylesheet" href="$perl_scriptlocation/resources/css/ff_play_template.css" />
<link rel="stylesheet" href="$perl_scriptlocation/resources/css/fforgstyle.css">
<link rel="stylesheet" href="$perl_scriptlocation/resources/css/inplay.css">
</head>


<body>

<div class="colmask threecol">
	<div class="colmid">
		<div class="colleft">

			<div class="col1">
				<!-- Column 1 start -->
				<div id="middle_banner"><!-- <img src="$perl_scriptlocation/resources/images/title_text.gif" / style="width:100%"> --></div>
				<div id="navigation_strip">
					<p id="play_navigation_text"><a href = "account.cgi" id="account_link">Your Account</a>- <b>$Book</b> <i>reference</i> <b>$currentref</b> - <a href = "play.cgi?currentref=$currentref&option=0&newact=$proposedact" id="abandon_link">Abandon Adventure</a></p>
				</div>

				<div id="content_window">
					<div id="content" class="parchment_background">
<!-- dynamic content here -->
print_tag
	  
open (OUTPUTFILE ,"<$displayfile") or die "Can't open reference output file";
while (<OUTPUTFILE>){
	print;
}
close OUTPUTFILE; 	  
	  
print<<"print_tag";
					</div>
					<div id="top" class="content_border_decoration"></div>
					<div id="right" class="content_border_decoration"></div>
					<div id="bottom" class="content_border_decoration"></div>
					<div id="left" class="content_border_decoration"></div>
					<div id="top_left" class="content_border_decoration corner_box"></div>
					<div id="top_right" class="content_border_decoration corner_box"></div>
					<div id="bottom_left" class="content_border_decoration corner_box"></div>
					<div id="bottom_right" class="content_border_decoration corner_box"></div>
				</div> <!-- content_window -->
				<!-- Column 1 end -->
			</div>

			<div class="col2">
				<!-- Column 2 start -->
				<div id="top_left_pane"><!-- <img src="$cover" class="image_pane_image" /> --></div>
				<div id="character_sheet_window">
					<div id="character_sheet" class="parchment_background">
<!-- dynamic content here -->
print_tag

&character_sheet($charfile);

print<<"print_tag";
					</div>
					<div class="content_border_decoration top_small"></div>
					<div class="content_border_decoration right_small"></div>
					<div class="content_border_decoration bottom_small"></div>
					<div class="content_border_decoration left_small"></div>
					<div class="content_border_decoration corner_box_small top_left_small"></div>
					<div class="content_border_decoration corner_box_small top_right_small"></div>
					<div class="content_border_decoration corner_box_small bottom_left_small"></div>
					<div class="content_border_decoration corner_box_small bottom_right_small"></div>

				</div>
				<!-- Column 2 end -->
			</div>

			<div class="col3">
				<!-- Column 3 start -->
				<div id="top_right_pane"><!-- <img src="$illustration" class="image_pane_image"/> --></div>
				<div id="actions_window">
					<div id="actions" class="parchment_background">
<!-- dynamic content here -->
print_tag

&action_sheet($actionfile);

print<<"print_tag";
					</div>
					<div class="content_border_decoration top_small"></div>
					<div class="content_border_decoration right_small"></div>
					<div class="content_border_decoration bottom_small"></div>
					<div class="content_border_decoration left_small"></div>
					<div class="content_border_decoration corner_box_small top_left_small"></div>
					<div class="content_border_decoration corner_box_small top_right_small"></div>
					<div class="content_border_decoration corner_box_small bottom_left_small"></div>
					<div class="content_border_decoration corner_box_small bottom_right_small"></div>

				</div>
				<!-- Column 3 end -->
			</div>

		</div>
	</div>
</div>

</body>


</html>
	
print_tag
	
}

sub character_sheet
{
	my $charfile=shift;
	if (open (CHARSHEET, "<$charfile"))
	{
		while (<CHARSHEET>)
		{
			print "$_";
		}
		close CHARSHEET;
	}
	else
	{
		## assume there is no charsheet so do nothing (although this could be another form of file opening error)
	}
}

sub action_sheet
{
	my $actionfile=shift;
	if (open (ACTIONSHEET, "<$actionfile"))
	{
		while (<ACTIONSHEET>)
		{
			print "$_";
		}
		close ACTIONSHEET;
	}
	else
	{
		## assume there is no action output so do nothing (although this could be another form of file opening error)
	}
}

sub evaluate_if_condition #### temporary processing for testing
{
	my $condition=shift;
	my $conditionstring;
	
	my @result = &call_exec_code($condition);
	if (@result > 1)
	{
		## is this an error?  couldn't a list just be evaluated as a true return value?
		die "IF condition parameter has been passed SEL code that evaluates to return a list";
	}
	else
	{
		$conditionstring=$result[0];
	}
	if ($conditionstring)
	{
		return "true";
	}
	else
	{
		return "false";
	}
}

sub enforce_option
{
	my $option_to_enforce=shift;

	open (OPTIONS, ">Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
	for (1..$optioncount)
	{
		print OPTIONS $option_to_enforce;
	}
	close OPTIONS;
}

sub call_exec_code
{
	my $code=shift;
	my $tag_script_input=shift;
	my $permvarspath="Accounts/$UserName/Bookmarks/$Author/$Book/permvars.txt";
	my $outputpath="Accounts/$UserName/Bookmarks/$Author/$Book/seloutput.txt";
	my $debugpath="Accounts/$UserName/Bookmarks/$Author/$Book/debug".$debug_files.".txt";
	my $libfilepath=("Accounts/$Author/MyBooks/$Book/$Book".".sel");
	my @cla=($currentref,$tag_script_input); #command line args
	
	my $reflib=$cla[0]."\.sel";
	if(-e "Accounts/$Author/MyBooks/$Book/refs/$reflib"){
		$libfilepath="Accounts/$Author/MyBooks/$Book/refs/$reflib";
	}
	
	if ($UserName ne 'hosted')
	{
		$debugpath=0;
	}
	
	my @return=&exec_code($code, $permvarspath,$outputpath,$debugpath,$libfilepath,@cla);
	
	$debug_files++;
	
	$seloutput_present=1;
	
	return @return;
}

 
sub add_thumbprint{
	my $ref=shift;
	if(open (THUMB, ">>Accounts/$UserName/Bookmarks/$Author/$Book/thumb.txt")){
		print THUMB "$ref\n";
		close THUMB;
	}
	else{
		print "failed to open thumb.txt bookmark file for $Book, user $UserName";
	}
}

sub get_thumbprint{
	if(open (THUMB, "<Accounts/$UserName/Bookmarks/$Author/$Book/thumb.txt")){
		my @thumbs;
		@thumbs=<THUMB>;
		close THUMB;
		my $ref=pop @thumbs;
		
		if($ref){
			chomp $ref;
			return $ref;
		}
		else{
			if(open (THUMB, "<Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt")){
				my $ref=<THUMB>;
				close THUMB;
				chomp $ref;
				return $ref;
			}
			else{
				print "Author Error: No previous reference or thumbprint.  Most likely a 'rtt' tag has been used on reference 0";
			}
		}
	}
	else{
		print "error unable to open thumbprint bookmark file for $UserName in bookmark: $Book by $Author";
	}

}

sub pop_thumbprint{

	if(open (THUMB, "<Accounts/$UserName/Bookmarks/$Author/$Book/thumb.txt")){
		my @thumbs;
		@thumbs=<THUMB>;
		close THUMB;
		my $ref=pop @thumbs;
		
		if($ref){
			chomp $ref;
			open (THUMB, ">Accounts/$UserName/Bookmarks/$Author/$Book/thumb.txt") or die "Failed to open thumbprint bookmark file for user $UserName in book $Book by $Author";
			foreach(@thumbs){print THUMB $_;}
			close THUMB;
			return $ref;
		}
		else{
			if(open (THUMB, "<Accounts/$UserName/Bookmarks/$Author/$Book/previousref.txt")){
				my $ref=<THUMB>;
				close THUMB;
				chomp $ref;
				return $ref;
			}
			else{
				print "Author Error: No previous reference or thumbprint.  Most likely a 'rtt' tag has been used on reference 0";
			}
		}
	}
	else{
		print "error unable to open thumbprint bookmark file for $UserName in bookmark: $Book by $Author";
	}
}

sub add_bookmark{
	my $ref=shift;
	
	if(!(&bookmark_exists($ref))){
		mkdir "Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref";
	}
	
	copy("Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt","Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref");
	copy("Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt","Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref");
}

sub remove_bookmark{
	my $ref=shift;
	
	if(&bookmark_exists($ref)){
		remove_tree("Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref");
	}
}

sub bookmark_exists{
	my $ref=shift;
	if(-e "Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref"){
		return 1;
	}
	else{
		return 0;
	}
}

sub load_bookmark{
	my $ref=shift;
	copy("Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref/tag.txt","Accounts/$UserName/Bookmarks/$Author/$Book");
	copy("Accounts/$UserName/Bookmarks/$Author/$Book/thumbs/$ref/ifref.txt","Accounts/$UserName/Bookmarks/$Author/$Book");
	&read_bookmark_tag_files();
}

sub read_bookmark_tag_files{

	open (TAGFILE, "<Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt") or die "failed to open tag.txt";

	my $event_index=0;
	my $optiontag_index=0;
	my $tt_index=0;
	my $tagtype, $tag_record;
	while (<TAGFILE>)
	{
		chomp;
		($tagtype,$tag_record)= split /=/;
		if ($tagtype eq "OPTION")
		{
			$options[$optiontag_index]=$tag_record;
			## tests later use undef tests and reading in null strings do not equal undef!
			if($options[$optiontag_index] eq "")
			{$options[$optiontag_index]=undef;}
			$optiontag_index++;
		}
		elsif($tagtype eq "EVENT")
		{
			$events[$event_index]=$tag_record;
			$event_index++;
		}
		elsif($tagtype eq "TT")
		{
			$turntos[$tt_index]=$tag_record;
			$tt_index++;
		}
		else
		{
			die "Unknown element in file tag.txt";
		}
	}
	close TAGFILE;
	
	$option_record=@options;
	$event_record=@events;
	$tt_record=@turntos;
	
	open (IFFILE ,"<Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt") or die "failed to open ifref.txt";
	my $iffileindex=0;
	while (<IFFILE>)
	{
		chomp;
		$ifarray[$iffileindex] = $_;
		## tests later use undef tests and reading in null strings do not equal undef!
		if($ifarray[$iffileindex] eq"")
		{$ifarray[$iffileindex]=undef;}
		$iffileindex++;
	}
}

sub update_tagfile{
		open (TAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt") or die "failed to open tag.txt";
		for (0..$option_record-1)
		{
			print TAGFILE "OPTION=".$options[$_]."\n";
		}
		for (0..$event_record-1)
		{
			print TAGFILE "EVENT=".$events[$_]."\n";
		}
		for(0..$tt_record-1){
			print TAGFILE "TT=".$turntos[$_]."\n";
		}
		close TAGFILE;

		open (IFFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt") or die "failed to open ifref.txt";
		$iffileindex=0;
		while ($iffileindex<$ifrecord)
		{
			print IFFILE "$ifarray[$iffileindex]\n";
			$iffileindex+=1;
		}
		close IFFILE;
}
