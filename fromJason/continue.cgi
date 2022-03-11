#!/usr/bin/perl
#use CGI::Carp qw(fatalsToBrowser);
use CGI;
require "authenticate.pl";

$query = new CGI;

####################################################################################################
###  continue.cgi  Does no more than set the current book in play for user to whatever book already 
###  in play was selected on account.cgi before passing on to play.cgi.
####################################################################################################

$Book = $query->param('Book');
if($Book=~/[^\w\s-]/)
{
	die "Invalid bookname passed to continue.cgi";
}
$Author = $query->param('Author');
if($Author=~/[^\w\s-]/)
{
	die "Invalid Author passed to continue.cgi";
}

open (SCRIPTLOC, "scriptlocation.txt") or die "Failed to open script location file: $!";
my $scriptlocation=<SCRIPTLOC>;
chomp $scriptlocation;
close SCRIPTLOC;

# check for cookie to give username
if (&authenticate_user(\$UserName))
{
	open (CURRENTBOOK ,">Accounts/$UserName/Bookmarks/currentbook.txt")  or die "failed to open currentbook.txt: $!";
	print CURRENTBOOK "$Book\n$Author";
	close CURRENTBOOK;

print $query->header;
print<<print_tag;
	<html>
		<head>
			<script type="text/javascript">
				window.location="play.cgi";
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

