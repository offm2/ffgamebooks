#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
use CGI qw(-utf8);
use open IO => ':utf8';
use File::Copy;
require "authenticate.pl";

$query = new CGI;


####################################################################################################
### create_book.cgi  Displays form for collection of information about a New book user is creating
### validates information submitted and creates necessary directories and file structures for 
### further editing
####################################################################################################

## this is all fucked - redo. see comment marked !!

my $UserName;
my $invaliddata=0;
my $faultyinput;
my %field;

### TDW - ALSO if called with 'currentbook' parameter set, edit existing book details

if (&authenticate_user(\$UserName)==1)
{

print $query->header;

open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
my $perl_scriptlocation=<SCRIPTLOC>;
chomp $perl_scriptlocation;
close SCRIPTLOC;

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

print<<"print_tag";
	<a href="book_creator_account.cgi">Return to Create Book Listings</a>
print_tag

	## number in front of fieldID determines display order.  What a mess eh?
	my %fieldID = (	"booktitle" => "Title for Book",
			"authors", => "Author(s)",
			"illustrators", => "Illustrator(s)",
			"series", => "Series",
			"seriesnumber", => "Series Number",
			"backcover" => "Story Synopsis (like the back cover of a book)",
			"booksname" => "Short name for book (Letters, Numbers and underscores only, no spaces and cannot start with digit)", ##booksname will be useful when i get round to doing real code :rollseyes:
			"rating" => "Universal is suitable for all, Restricted is 18 years and older only",
			"standard_ff" => "Make this a Standard Fighting Fantasy Adventure"
			);

	foreach (keys (%fieldID))
	{
		$field{$_}{"DescriptionTag"} = $fieldID{$_};
	}
	
	$field{'rating'}{'value'}="Restricted";

	## if we have been submitted data

	if ($query->param)
	{
		foreach (keys (%{$query->Vars}))
		{
			$field{$_}{"value"}=$query->param($_);
			if ($error=&validate_field($_,"$field{$_}{'value'}"))
			{
				$invaliddata=1;
				print "<p>Field &lt".$field{$_}{"DescriptionTag"}."&gt has been incorrectly completed: $error</p>";
			}
		}

	}
	else  ## no data therefore invalid data
	{ $invaliddata=1;}
	
	if ( !(defined($field{"booktitle"}{"value"}) ))
	{
		$invaliddata=1;
	}

	## edit book call
	if(defined($query->param('currentbook')))
	{
		my $book=$query->param('currentbook');
		if($book=~/[^\w\s-]/)
		{
			die "Invalid characters in currentbook parameter used";
		}

		## load book details
		open (BOOKINFO, "<Accounts/$UserName/MyBooks/$book/bookinfo.txt") or die "cant open book info file: $!";
		my $infield,$invalue;
		while(<BOOKINFO>)
		{
			chomp;
			($infield,$invalue) = split /=/, $_,2;
			$field{$infield}{'value'}=$invalue;
		}
		close BOOKINFO;
		
		open (BOOKBLURB, "<Accounts/$UserName/MyBooks/$book/bookblurb.txt") or die "cant open book blurb file: $!";
		while(<BOOKBLURB>)
		{
			$field{'backcover'}{'value'}.=$_;
		}
		close BOOKBLURB;
		## end load book details
	}

	## if we have been submitted invalid data to create book, or no data yet, display form for input 
	## (if we had data submitted then this is used as default data - error message from ealier should
	## be sufficient to notify of incorrect input and allow user to alter)
	if ($invaliddata)
	{
		## !! fucked cos of this.  This is where it all falls apart unless i can rehash 
		## another dimension to allow field type, and another for display order

		print<<"print_tag";
		<form method="post" action="create_book.cgi" enctype="multipart/form-data" name="new account">
		<table width = \"100%\", border = \"0\">
print_tag

		if(defined($query->param('currentbook')))
		{
			print "<tr><td>".$field{'booktitle'}{"DescriptionTag"}."</td><td>".$field{'booktitle'}{"value"}."</td></tr>";
			print $query->hidden('booktitle',$field{'booktitle'}{"value"});
		}
		else
		{
			print "<tr><td>".$field{'booktitle'}{"DescriptionTag"}."</td><td>".$query->textfield('booktitle',$field{'booktitle'}{"value"})."</td></tr>";				
		}
		print "<tr><td>".$field{'booksname'}{"DescriptionTag"}."</td><td>".$query->textfield('booksname',$field{'booksname'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'authors'}{"DescriptionTag"}."</td><td>".$query->textfield('authors',$field{'authors'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'illustrators'}{"DescriptionTag"}."</td><td>".$query->textfield('illustrator',$field{'illustrator'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'series'}{"DescriptionTag"}."</td><td>".$query->textfield('series',$field{'series'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'seriesnumber'}{"DescriptionTag"}."</td><td>".$query->textfield('seriesnumber',$field{'seriesnumber'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'rating'}{"DescriptionTag"}."<BR>".$query->popup_menu('rating',['Universal','Restricted'],$field{'rating'}{"value"})."</td></tr>";
		print "<tr><td>".$field{'standard_ff'}{"DescriptionTag"}." ".$query->checkbox_group(-name=>'standard_ff_group',-values=>['standard_ff_book'],-labels=>{'standard_ff_book'=>'(Use Warlock of Firetop Mountain Hero Generation and Ruleset)'})."</td></tr>";
		print "<tr><td>".$field{'backcover'}{"DescriptionTag"}."<BR>".$query->textarea('backcover',$field{'backcover'}{"value"},20,100)."</td></tr>";

		print<<"print_tag";
		<tr><td><input type="submit" name="Submit" value="Submit"></td></tr>
		</table>
		</form>
print_tag
	}

	## otherwise we have valid data so do the necessary
	else
	{
		print "Creating Book...<br />";
		## need to change to force a short name version from the user.
		$BookTitle=$query->param('booktitle');
		if($BookTitle=~/[^\w\s-]/)
		{
			die "Invalid characters in BookTitle used, only letter, numbers, underscores hyphens and whitespace permitted";
		}
		
		$BookTitle=~ s/\s+$//;
		
		#### create book section
		if(!(-e "Accounts/$UserName/MyBooks/$BookTitle")) ## if book directory does not already exist
		{
			mkdir "Accounts/$UserName/MyBooks/$BookTitle" or die "Failed to create new book directory $BookTitle: $!";
			mkdir "Accounts/$UserName/MyBooks/$BookTitle/refs" or die "Failed to create book references directory: $!";
			mkdir "Accounts/$UserName/MyBooks/$BookTitle/images" or die "Failed to create book images directory $BookTitle: $!";
			mkdir "Accounts/$UserName/MyBooks/$BookTitle/images/cover" or die "Failed to create book cover image directory $BookTitle: $!";
			mkdir "Accounts/$UserName/MyBooks/$BookTitle/images/embed" or die "Failed to create book embedded images directory $BookTitle: $!";

			open (INTRODUCTION, ">Accounts/$UserName/MyBooks/$BookTitle/refs/0.txt") or die "Failed to create Introduction file";
			print INTRODUCTION "Introduction.  Edit reference 0 to change your introduction, but make sure you link to your first reference\n\n";
			print INTRODUCTION "<tt ref=\"1\">Now Turn To 1</tt>";
			close INTRODUCTION;

			open (CREDITS, ">Accounts/$UserName/MyBooks/$BookTitle/refs/credits.txt") or die "failed to create Credits file";
			print CREDITS "Written By $UserName";
			close CREDITS;
			
			open (IMPLEMENTATION, ">Accounts/$UserName/MyBooks/$BookTitle/refs/implementation.txt") or die "failed to create Credits file";
			print IMPLEMENTATION "Write your implementation notes here (suggested)\nTurn To:<tti name=\"implementation\" />";
			close IMPLEMENTATION;
			
			open (BACKGROUND, ">Accounts/$UserName/MyBooks/$BookTitle/refs/background.txt") or die "failed to create Credits file";
			print BACKGROUND "Write your background here (suggested)";
			close BACKGROUND;

			open (RULES, ">Accounts/$UserName/MyBooks/$BookTitle/refs/rules.txt") or die "failed to create Credits file";
			print RULES "Write your rules here (suggested)";
			close RULES;
			
			open (REFONE, ">Accounts/$UserName/MyBooks/$BookTitle/refs/1.txt") or die "failed to create Credits file";
			print REFONE "Write your first adventure reference here (optional obviously any reference can be your first adventure reference)";
			close REFONE;

			open (CHARSHEET, ">Accounts/$UserName/MyBooks/$BookTitle/refs/charsheet.txt") or die "failed to create Character Sheet file";
			print CHARSHEET "# Write your character sheet information here";
			close CHARSHEET;

			## create standard files for standard FF adventures
			## replace with directory copy routine sometime
			if($query->param('standard_ff_group')){
				copy ("resources/ref_templates/FF/charsheet.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/charsheet.txt") or die "failed to copy standard FF template file";

				copy ("resources/ref_templates/FF/generate.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/generate.txt") or die "failed to copy standard FF template file";

				copy ("resources/ref_templates/FF/Provisions.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/Provisions.txt") or die "failed to copy standard FF template file";
				copy ("resources/ref_templates/FF/Potion of Skill.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/Potion of Skill.txt") or die "failed to copy standard FF template file";
				copy ("resources/ref_templates/FF/Potion of Stamina.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/Potion of Stamina.txt") or die "failed to copy standard FF template file";
				copy ("resources/ref_templates/FF/Potion of Luck.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/Potion of Luck.txt") or die "failed to copy standard FF template file";

				copy ("resources/ref_templates/FF/rules.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/rules.txt") or die "failed to copy standard FF template file";

				copy ("resources/ref_templates/FF/0.txt","Accounts/$UserName/MyBooks/$BookTitle/refs/0.txt") or die "failed to copy standard FF template file";
				## further rules copy required
			}

			## create SEL file and SEL inclusions file
			open (SEL, ">Accounts/$UserName/MyBooks/$BookTitle/".$BookTitle.".sel") or die "failed to create SEL file";
			print SEL "## Write your functions in here";
			close SEL;

			open (INC, ">Accounts/$UserName/MyBooks/$BookTitle/".$BookTitle.".inc") or die "failed to create sel INC file";
			if($query->param('standard_ff_group')){
				print INC "Accounts/hosted/MyLibrary/FFLib.sel";
			}
			close INC;		
		}
		#### end create book section
		
		#### edit book details section
		open (BOOKINFO, ">Accounts/$UserName/MyBooks/$BookTitle/bookinfo.txt") or die "cant create book info file: $!";
		
		foreach (keys %field)
		{
			if ($_ eq "backcover")
			{
				open (BOOKBLURB, ">Accounts/$UserName/MyBooks/$BookTitle/bookblurb.txt") or die "cant create book blurb file: $!";
				print BOOKBLURB $field{'backcover'}{'value'};
				close BOOKBLURB;
			}
			elsif (($_ eq "Submit") or ($_ eq "currentbook"))
			{
				## skip
			}
			else
			{
				print BOOKINFO $_ . "=".$field{$_}{'value'}."\n";
			}
		}
		
		close BOOKINFO;
		
		##backward compatibility with existing system
		open (BOOKBWD, ">Accounts/$UserName/MyBooks/$BookTitle/".$BookTitle.".txt") or die "cant create backward compat file: $!";
		print BOOKBWD "Series=".$field{'series'}{'value'}."\n";
		print BOOKBWD "SeriesNumber=".$field{'seriesnumber'}{'value'}."\n";
		close BOOKBWD;
		#### end edit book details section
		
		print "Book succesfully initialised.  Return to <a href=\"book_creator_account.cgi\">creation index</a> to begin adding text!";
	}
	print "</body></html>";

}
else
{
	## authenticate failed, should be error message there
}

print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";

sub validate_field ## returns string of error for bad data or 0 for ok
{
	my $fieldID = shift;
	my $fieldvalue = shift;
	my $fieldname;
	
	if ($fieldID =~ /^\d+(\w*)$/)
	{
		$fieldname=$1;
	}
	
	if ($fieldname eq "seriesnumber")
	{
		if ($fieldvalue =~ /\D/)
		{ return "Whole number ONLY Required"; }
	}
	elsif ($fieldname eq "booksname")
	{
		if ($fieldvalue =~ /^[A-Za-z_]\w*$/)
		{}
		else
		{
			return "Invalid shortname entered";
		}
	}
	return 0;
}
