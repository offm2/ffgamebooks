#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
use CGI qw(-utf8);
use open IO => ':utf8';
require "authenticate.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

$query = new CGI;


####################################################################################################
### viewfunc.cgi - small script attached to edit_funcs.cgi to allow quick viewing of an SEL library
####################################################################################################

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

$filename=$query->param('filename');
$libtype=$query->param('libtype');

## from bookeditor use only
$bookname=$query->param('bookname');

if($libname=~/[^\w\s-]/)
{
	die "Illegal filename passed to viewfunc.cgi";
}

if (&authenticate_user(\$UserName))
{

	print $query->header;

	if ($libtype eq "USER")
	{
		$filesrc="Accounts/$UserName/MyLibrary/".$filename.".sel";
	}
	elsif ($libtype eq "HOSTED")
	{
		$filesrc="Accounts/hosted/MyLibrary/".$filename.".sel";
	}
	elsif ($libtype eq "BOOK")
	{
		$filesrc="Accounts/$UserName/MyBooks/$filename/".$filename.".sel";
	}
	elsif ($libtype eq "bookref")
	{
		$filesrc="Accounts/$UserName/MyBooks/$bookname/refs/".$filename.".txt";
	}
	else
	{
		print "Invalid libtype parameter passed to viewfunc.cgi";
	}

	open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
	my $perl_scriptlocation=<SCRIPTLOC>;
	chomp $perl_scriptlocation;
	close SCRIPTLOC;

	if (open VIEWFILE, "<$filesrc"){
		while (<VIEWFILE>)
		{
			$_=~s/\</\&lt\;/g;
			$_=~s/\>/\&gt\;/g;
			$_=~s/\s\s/\&nbsp\;&nbsp\;&nbsp\;&nbsp\;\&nbsp\;\&nbsp\;\&nbsp\; /g;
			$_=~s/\s\s/\&nbsp\;&nbsp\;&nbsp\;&nbsp\;\&nbsp\;/g;
			$_=~s/\&nbsp\;\s\&nbsp\;/\&nbsp\;&nbsp\;&nbsp\;/g;
			$_=~s/^\s/\&nbsp\;\&nbsp\;\&nbsp\;\&nbsp\;/;
			print;
			print "<br />";
		}
	}
	else{
		print "<p>Could not open the file: $filename.  Reason:$!</p>";
	}

	print "<p><input type='button' value='Click to close this window' onClick='javascript:window.close();'></p>";
}
else{
	## authenticate failed, should be error message there
}

print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";