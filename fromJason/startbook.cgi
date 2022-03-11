#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
require "authenticate.pl";

$query = new CGI;

####################################################################################################
### startbook.cgi - sets up book records in user account to allow play of book selected from
### account.cgi, then redirects to play.cgi
####################################################################################################

$Book = $query->param('Book');
$Author = $query->param('Author');

open (SCRIPTLOC, "scriptlocation.txt") or die "Failed to open script location file: $!";
my $scriptlocation=<SCRIPTLOC>;
chomp $scriptlocation;
close SCRIPTLOC;

if($Book=~/[^\w\s-]/)
{
	die "Illegal Bookname passed to startbook.cgi";
}

if($Author=~/[^\w\s-]/)
{
	die "Illegal Author name passed to startbook.cgi";
}

%Bookmarkdata = ("Status" => 0, "Completed" => 0, "Attempts" => 0);

# need to check the book passed in query string is a valid book
# also need to check username cookie is valid

# check for cookie to give username
if (&authenticate_user(\$UserName))
{

	$Bookmarkfile = $Book;
	$Bookmarkfile .= ".txt";
	
	#check to see if bookmark directory for user exists
	if (-e "Accounts/$UserName/Bookmarks/$Author")
	{
		#check to see if there is already a bookmark for this book
		$d="Accounts/$UserName/Bookmarks/$Author/$Book";
		if (opendir D,$d) #if there is, get existing bookmark data
		{
			open (BOOKFILE ,"<Accounts/$UserName/Bookmarks/$Author/$Book/$Bookmarkfile")  or die "failed to open Accounts/$UserName/Bookmarks/$Author/$Book/$Bookmarkfile: $!";
			while (defined($input=<BOOKFILE>))
			{
				chomp $input;
				($field,$value) = split /=/, $input,2;
				$Bookmarkdata{$field} = $value;

				# ## Leave this out and come up with better 'back button cheating catcher' solution
				# catch those ppl who dont like their starting character and are trying to use the back button to get a new one :-)
				if ($field eq "Status")
				{
					if ($value eq "Playing")
					{
						print $query->header;
						print "Using the back button or refresh button to get a better character is not allowed.  All FF books are designed to have a path where even the weakest character can win - try and find it.";
						print "<a href=\"continue.cgi?Book=$Book&amp;Author=$Author\">Continue</a>";
						exit;
					}
				}



			}
			close BOOKFILE;
			
			if(!(-e "Accounts/$UserName/Bookmarks/$Author/$Book/thumbs")){
				mkdir "Accounts/$UserName/Bookmarks/$Author/$Book/thumbs" or die "failed to create thumbs directory for Book";
			}
		}
		else #if not, create a new bookmark directory in the users account
		{
			mkdir "Accounts/$UserName/Bookmarks/$Author/$Book";
		}
	}
	else ## otherwise create author directory and book directory
	{
		mkdir "Accounts/$UserName/Bookmarks/$Author" or die "failed to create Bookmarks directory for Author";
		mkdir "Accounts/$UserName/Bookmarks/$Author/$Book" or die "failed to create Bookmarks directory for Book";
		mkdir "Accounts/$UserName/Bookmarks/$Author/$Book/thumbs" or die "failed to create thumbs directory for Book";
	}
	
	# increase attempts by one, set status to Playing and write bookmark file back out
	$Bookmarkdata{'Attempts'}++;
	$Bookmarkdata{'Status'} = "Playing";
	open (BOOKFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/$Bookmarkfile")  or die "failed to open $Bookmarkfile: $!";
	foreach $key (keys %Bookmarkdata)
	{
		print BOOKFILE "$key=$Bookmarkdata{$key}\n";
	}
	close BOOKFILE;
	
	# set currentref.  will be 0 for the moment (the ref for introduction) until i come up with a better character generation and introductory algorithm
	open (CURRENTREF ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentref.txt")  or die "failed to open currentref.txt: $!";
	print CURRENTREF "0";
	close CURRENTREF;
	
	# set current action
	open (CURRENTACT ,">Accounts/$UserName/Bookmarks/$Author/$Book/currentact.txt")  or die "failed to open currentact.txt: $!";
	print CURRENTACT "0";
	close CURRENTACT;
	
	# this is duplicated in continue.cgi - gotta be a better way of sorting this
	open (CURRENTBOOK ,">Accounts/$UserName/Bookmarks/currentbook.txt")  or die "failed to open currentbook.txt: $!";
	print CURRENTBOOK "$Book\n$Author";
	close CURRENTBOOK;
	
	open (OPTIONS, ">Accounts/$UserName/Bookmarks/$Author/$Book/options.txt") or die "failed to open options.txt for $Book, user $UserName";
	print OPTIONS "TURNTO thumb=0 tt_index=0 bookmark=0 0<<  <<TTSCRIPT=\n";
	close OPTIONS;
	
	## should be able to merge this file with TAG file eventually
	open (IFFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/ifref.txt");
	close IFFILE;

	open (TAGFILE ,">Accounts/$UserName/Bookmarks/$Author/$Book/tag.txt");
	close TAGFILE;
	
	open (THUMB ,">Accounts/$UserName/Bookmarks/$Author/$Book/thumb.txt");
	close THUMB;
	
	## flush/create permvars file for this book
	open (PERMVARS, ">Accounts/$UserName/Bookmarks/$Author/$Book/permvars.txt");
	close PERMVARS;	
	
print $query->header;
print<<print_tag;
	<html>
		<head>
			<script type="text/javascript">
				window.location="play.cgi?currentref=0&newact=1&option=1";
			</script>
		</head>
		<body>
			Your browser should redirect you in a few seconds if not please <a href="$scriptlocation/play.cgi">Click Here</a>	
		</body>
	</html>
print_tag
	
	
}
else 
{
	## authenticate failed, should be error message there
}