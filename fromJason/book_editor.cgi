#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI qw(-utf8);
use open IO => ':utf8';
require "authenticate.pl";
require "publishing.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

$query = new CGI;


####################################################################################################
### book_editor.cgi  provide facilities for loading, editing and saving references (pages) for a 
### given book (passed as parameter to script externally).  Also link to edit book information page
####################################################################################################

## really want a list of references to pick from, and images

if (&authenticate_user(\$UserName)==1)
{

print $query->header;

open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
my $perl_scriptlocation=<SCRIPTLOC>;
chomp $perl_scriptlocation;
close SCRIPTLOC;

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

### this IF block seems a little superfluous
if (defined($query->param('book')))
{
	if ($query->param('book')=~/[^\w\s-]/)
	{
		die "Invalid character(s) in name for book passed to book_editor.cgi";
	}

	$query->param('editingbook',$query->param('book'));
	## first call to edit this book so set to unpublished
	##### need to add routine call....
	&unpublish($UserName, $query->param('book'));
}

if (defined($query->param('editingbook')))
{

	if ($query->param('editingbook')=~/[^\w\s-]/)
	{
		die "Invalid character(s) in name for book passed to book_editor.cgi";
	}

	$BookTitle = $query->param('editingbook');

	print "<p>Currently editing: <b>$BookTitle</b></p>";

	### add edit book details link
	print "<p><a href=\"create_book.cgi?currentbook=$BookTitle\">Edit Book Details</a></p>";

	if (-d "Accounts/$UserName/MyBooks/$BookTitle")
	{
		if (defined($query->param('Load Reference')))
		{
			$ref = $query->param('reference');

			if ($ref=~/[^\w\s-]/)
			{
				print "<p>Invalid character(s) in reference name to load passed to book_editor.cgi</p>";
			}
			else
			{
				if (open (REFERENCE, "<Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.txt") or print "Error - cant locate reference file: $ref")
				{
					$query->param('reftext',"");
					$query->param('reftype',"ref");
					$loadtext="";
					while(<REFERENCE>){
						$loadtext.=$_;
					}
					$query->param('reftext',$loadtext);
					print "Reference loaded<br>";
				}
			}
		}
		elsif (defined($query->param('Save Reference')))
		{
			$ref = $query->param('reference');

			if ($ref=~/[^\w\s-]/)
			{
				print "Invalid character(s) in reference name to save passed to book_editor.cgi";
			}
			elsif($ref eq "")
			{
				print "<p>No reference name supplied!</p>";
			}
			else
			{
				if($query->param('reftype') eq 'sel'){
					if(!(-e "Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.inc")){
						print "Save SEL file attempt on uncreated SEL codepage.  Please use Create SEL button on a reference before attempting to save its SEL file";
					}
					else{
						open (REFERENCE, ">Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.sel") or die "cant create reference SEL file: $!";
						print REFERENCE $query->param('reftext');
						close REFERENCE;

						print "Reference SEL Saved<br>";
					}
				}
				else{
					open (REFERENCE, ">Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.txt") or die "cant create reference file: $!";
					print REFERENCE $query->param('reftext');
					close REFERENCE;

					print "Reference Saved<br>";				
				}
			}
		}
		elsif (defined($query->param('New Reference')))
		{
			$query->param('reference',"");
			$query->param('reftext',"");
			$reftext="";
			$ref="";

		}
		elsif(defined($query->param('Delete Reference')))
		{
			my $ref=$query->param('reference');
			if($ref=~/[^\w\s-]/)
			{
				print "Invalid Characters in reference name to delete passed to book_editor.cgi<br />";
			}
			elsif(($ref eq "0") or ($ref eq "credits") or ($ref eq "charsheet"))
			{
				print "Ref $ref may not be deleted<br />";
			}
			else
			{
				## delete reference here
				if (unlink "Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.txt")
				{
					print "Deleted reference: $ref<br />";
				}
				else
				{
					print "Deleting reference: $ref - failed! - $!<br />";
				}
			}
		}

		elsif(defined($query->param('Load SEL'))){
			$ref = $query->param('reference');

			if ($ref=~/[^\w\s-]/)
			{
				print "<p>Invalid character(s) in SEL reference name to load passed to book_editor.cgi</p>";
			}
			else
			{
				if (open (REFERENCE, "<Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.sel") or print "Error - cant locate reference SEL file: $ref")
				{
					$query->param('reftext',"");
					$loadtext="";
					while(<REFERENCE>){
						$loadtext.=$_;
					}
					$query->param('reftext',$loadtext);
					$query->param('reftype',"sel");
					print "Reference SEL loaded<br>";
				}
			}
		}

		elsif(defined($query->param('Create SEL'))){
			$ref = $query->param('reference');
		
			open (REFERENCE, ">Accounts/$UserName/MyBooks/$BookTitle/refs/$ref\.inc") or die "cant create reference SEL INC file: $!";
			print REFERENCE "Accounts/$UserName/MyBooks/$BookTitle/$BookTitle\.sel\n";
			close REFERENCE;
			
			$reftext="## This is a SEL codepage that will be called only for reference $ref \n ## if you need a codepage that will be available for all references please use the SEL editor.";
			$query->param('reftext',$reftext);
			$query->param('reftype','sel');
		}

		if (!(defined($reftext=$query->param('reftext'))))
		{
			$reftext="";
		}



print<<"endJS";
<script type="text/javascript">

function add_ref_link(){
	var currenttext=document.editbook.reftext.value;
	var refnum=prompt("Please Enter the Reference you would like to link to","");
	var linktext=prompt("Please Enter the Text you would like displayed as your link","");
	currenttext=currenttext+"<tt ref=\\""+refnum+"\\">"+linktext+"</tt>";
	document.editbook.reftext.value=currenttext;
}

// not yet implemented properly
function endbook_link(){
	var currenttext=document.editbook.reftext.value;
	var linktext=prompt("Please Enter the Text you would like displayed as link to close the book","");
	var success=confirm("Is this a succesful end to the book?\\n(OK for Yes, Cancel for No)");
	var enforce=confirm("Do you want to Enforce this?\\n(Reader will not be able to use any other options on page)\\nOK for Yes, Cancel for No");

	if(success){successtext="completed";}else{successtext="failed";}
	if(enforce){
		currenttext=currenttext+"<bookend enforce adventure=\\""+successtext+"\\">"+linktext+"</bookend>";
	}
	else{
		currenttext=currenttext+"<bookend adventure=\\""+successtext+"\\">"+linktext+"</bookend>";
	}
	document.editbook.reftext.value=currenttext;
}

function autotag(){
	var currenttext=document.editbook.reftext.value;

	// catch EOF anomoly ('?' match before ([^<])screws up regex)
	currenttext=currenttext.replace(/(\\s)(turn\\s+to\\s+)(\\d+)\$/i,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>");

	// catch beginning of file anomoly ('?' match before ([^>]) screws up regex)
	currenttext=currenttext.replace(/^(turn\\s+to\\s+)(\\d+)([^<])/i,"<tt ref=\\"\$2\\">\$1\$2</tt>\$3");

	// main replace
	currenttext=currenttext.replace(/([^>])(turn\\s+to\\s+)(\\d+)([^<])/gi,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>\$4");

	// replicated for 'turning to', could probably jigger around prev regex to do the same but cba at this time
	currenttext=currenttext.replace(/^(turning\\s+to\\s+)(\\d+)([^<])/i,"<tt ref=\\"\$2\\">\$1\$2</tt>\$3");
	currenttext=currenttext.replace(/(\\s)(turning\\s+to\\s+)(\\d+)\$/i,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>");
	currenttext=currenttext.replace(/(\\s)(turning\\s+to\\s+)(\\d+)([^<])/gi,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>\$4");

	// replicated for 'entry 123'
	currenttext=currenttext.replace(/^(entry\\s+)(\\d+)([^<])/i,"<tt ref=\\"\$2\\">\$1\$2</tt>\$3");
	currenttext=currenttext.replace(/(\\s)(entry\\s+)(\\d+)\$/i,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>");
	currenttext=currenttext.replace(/(\\s)(entry\\s+)(\\d+)([^<])/gi,"\$1<tt ref=\\"\$3\\">\$2\$3</tt>\$4");

	document.editbook.reftext.value=currenttext;
}

</script>
endJS


print<<"print_tag";
<p>Back to <a href=\"book_creator_account.cgi\">Adventure Creator home</a></p>
<p>Back to <a href=\"account.cgi\">online books</a></p>
<table style=\"width:100%;\" border = 1>
<tr><td style=\"width:80%;\">
<form method="post" action="book_editor.cgi" enctype="multipart/form-data" name="editbook">
<table border = "0">
print_tag

print $query->hidden('editingbook',$BookTitle);
print $query->hidden('reftype',$query->param('reftype'));
print "<tr><td>Reference Number:".$query->textfield('reference',$ref)."</td>\n
	<td>". $query->submit('Load Reference')." (Loading will cancel unsaved text)</td></tr>\n";
print "<tr><td colspan=\"2\">\n"
.$query->button(-name=>'add_ref_link_button',-value=>'Add A Link',-onClick=>"add_ref_link();")
.$query->button(-name=>'add_bookend_button',-value=>'Add A BookEnd Link',-onClick=>"endbook_link();")
.$query->button(-name=>'autotag_button',-value=>'Auto-tag',-onClick=>"autotag();")
." (auto tag will automatically convert the words 'turn to 123' into the correct ABML tt tag)</td></tr>\n";
print "<tr><td colspan=\"2\">Reference Text:<br>".$query->textarea(-name=>'reftext',-default=>$reftext,-rows=>20,-cols=>100, -style=>"font-family:arial;width:98%")."</td></tr>\n";
##note to put in ok/cancel procedure sometime
print "<tr><td colspan=\"2\">".$query->submit('Save Reference')." Warning - Saving a reference number that already exists will OverWrite that reference!</td></tr>\n";
print "<tr><td colspan=\"2\">".$query->submit('New Reference')." Make sure you have saved any current text before clicking here</td></tr>\n";

if($ref ne "" and ($query->param('reftype') ne "sel") ){
	my $refsel=$ref."\.sel";
	if(-e "Accounts/$UserName/MyBooks/$BookTitle/refs/$refsel"){
		print "<tr><td colspan=\"2\">".$query->submit('Load SEL')." Edit the codepage for this reference alone.</td></tr>\n";
	}
	else{
		print "<tr><td colspan=\"2\">".$query->submit('Create SEL')." Create a codepage for this reference alone.  Note - be sure you want this option and do not need to edit the books code library available in the SEL editor.</td></tr>\n";
	}
}

print "</table>\n";
print "</form>\n";
print "</td>\n";
print "<td width=\"20%\">\n";


## get reference list
my $lib_list_ref=shift;
opendir REFLIST, "Accounts/$UserName/MyBooks/$BookTitle/refs" or die "failed to open $Booktitle reference directory\n";
while($filename=readdir REFLIST)
{	
	if ($filename=~/.*\.txt$/)
	{			
		$filename=~s/\.txt$//;
		push @ref_list, $filename;
	}
	
}
closedir REFLIST;
@ref_list = sort @ref_list;

print<<"print_tag";
<p>References:</p>
<form method="post" action="book_editor.cgi" enctype="multipart/form-data" name="reflistform">
<p><select name="reference" size="20">
print_tag

foreach $option(@ref_list)
{
	print "<option value=\"$option\">$option";
}
print "</select></p>\n";
print $query->hidden('editingbook',$BookTitle);

print<<"print_tag";
	<p> 
	<input type="submit" name="Load Reference" value="Load"><br />
print_tag
print "<input type=\"button\" name=\"ViewRef\" value=\"View\" onClick=\"newurl=\'viewfunc.cgi?filename=\'+document.reflistform.reference.value+\'&libtype=bookref&bookname=$BookTitle\';window.open(newurl);\" /><br />\n";
print "<input type='submit' name='Delete Reference' value='Delete' onClick='
	var deleteref=document.reflistform.reference.value;
	if((deleteref==\"0\") || (deleteref==\"charsheet\") || (deleteref==\"credits\")){
		alert(\"Sorry, but reference:\"+deleteref+\" may not be deleted\");
		return false;
	}
	else{
		var success=confirm(\"Do you really want to delete reference:\"+deleteref);
		return success;
	}
' />\n";
print<<print_tag;
</form>
</p>
</td></tr>
</table>
print_tag

		}
		else
		{
			print "Editor called without valid book parameter ($BookTitle not found).  Return to <a href=\"book_creator_account.cgi\">book creator</a> and try again\n";
		}
	}
	else
	{
		print "Editor called without book parameter.  Return to <a href=\"book_creator_account.cgi\">book creator</a> and try again\n";
	}
	print "<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";	
}	
else 
{
	print "authenticate failed in book_editor.cgi";
	## authenticate failed, should be error message there
}
