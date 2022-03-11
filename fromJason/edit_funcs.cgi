#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI qw(-utf8);
use open IO => ':utf8';
require "authenticate.pl";

$query = new CGI;

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

####################################################################################################
### edit_funcs.cgi - Page for editing SEL files, both users own libraries and libraries assosciated
### with users books.  Also system for including/excluding libraries to currently loaded file, either
### users own libraries (of either type) or the FF.net 'Hosted' library
####################################################################################################

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

## set output list seperator to null value to avoid accretion of spaces in SEL files
$"="";

if (&authenticate_user(\$UserName)==1)
{

print $query->header;

open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
my $perl_scriptlocation=<SCRIPTLOC>;
chomp $perl_scriptlocation;
close SCRIPTLOC;
	
print "<p>Back to <a href=\"book_creator_account.cgi\">Adventure Creator home</a></p>";
print "<p>Back to <a href=\"account.cgi\">online books</a></p>";
	
my @warning_messages = ();

my @library_text;
my $library_name;
my $library_type="NEW"; ## three valid types, USER, BOOK, NEW

my @ULibs;
my @HLibs;
my @BLibs;

@user_includes;
@user_excludes;

@hosted_includes;
@hosted_excludes;

####### Execute Editor Action

## Load
if (defined($query->param('LoadULF')))
{
	$library_name=$query->param('ULibs');
	$library_type="USER";
	
	&load_editor_library($library_type, $library_name, \@library_text, \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
}
elsif (defined($query->param('LoadBLF')))
{
	$library_name=$query->param('BLibs');
	$library_type="BOOK";
	
	&load_editor_library($library_type, $library_name, \@library_text, \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
}
elsif (defined($query->param('New')))
{
	$library_name="";
	$library_type="NEW";
	
	&load_editor_library($library_type, $library_name, \@library_text, \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
}

## Save
elsif (defined($query->param('Save')))
{
	if ($query->param('library_type') eq "NEW")
	{
		push @warning_messages, "Please use the Save As button for new files";
		&get_include_exclude_lists($query->param('library_type'),$query->param('library_name'), \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
		push @library_text, $query->param('library_text')
		
	}
	else
	{
		$library_name=$query->param('library_name');
		$library_type=$query->param('library_type');
		@library_text=($query->param('library_text'));
		&save_editor_library($query);
		push @warning_messages, "File Saved";
	}
}
elsif (defined($query->param('SaveAs')))
{
	$library_name=$query->param('NewName');
	# print $library_name;
	if (&validate_newfilename($library_name))
	{
		## set the library name in the hidden form tag to the new filename
		$library_name=$query->param('NewName');

		## users can only create user library files, set hidden form tag accordingly
		$library_type="USER";

		@library_text=($query->param('library_text'));

		## then save, setting flag as all saveas commands must be user
		&save_editor_library($query,1);
		
		push @warning_messages, "File Saved";
		
	}
	else
	{
		push @warning_messages, "Invalid filename entered for new file";
	}
}

## Delete - only USER types can be deleted
elsif (defined($query->param('Delete')))
{
	############ must add procedure to remove deleted file from all INC lists owner posseses (book and user) AND update display lists
	
	my $filename=$query->param('ULibs');
	
	## very simple validity check
	if ($filename=~/^\w+$/)
	{
		my $file_deleting = "Accounts/$UserName/MyLibrary/".$filename.".sel";
		my $include_deleting = "Accounts/$UserName/MyLibrary/".$filename.".inc";
		
		if (-e $file_deleting)
		{
			unlink $file_deleting;
			unlink $include_deleting;
			
			push @warning_messages, "$file_name deleted from your library";
		}
		else
		{
			push @warning_messages, "file delete failed as file does not exist";
		}
	}
	else
	{
		push @warning_messages, "Invalid filename for deleting";
	}
}

## New library or invalid action, assume NEW
else
{
	&load_editor_library($library_type, $library_name, \@library_text, \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
}


&get_user_libraries(\@ULibs);
&get_hosted_libraries(\@HLibs);
&get_book_libraries(\@BLibs);


####### Output Editor and relevant Loaded File info, and warning messages

	print<<"print_tag";
	
	<html>
	
	<head>
	<style type="text/css">
	<!--
	select {  width: 150px}
	-->
	</style>
	</head>
	
	<body>
	
print_tag

foreach $message (@warning_messages)
{
	print "$message<BR>"
}


print<<"print_tag";
	
	<form method="post" action="edit_funcs.cgi" enctype="multipart/form-data" name="editfunc">
	
	<input type="hidden" name="library_type" value="$library_type">
	<input type="hidden" name="library_name" value="$library_name">
	
	<p>The file currently loaded is: <b>$library_name</b></BR>
	The type of library is:<b>$library_type</b></p>
	
	
	<Table width = "100%", border = "0">
	
	<tr><td colspan="3">

	<p>$loadedfile</p>
	<p><textarea name="library_text" rows="20" cols="80">@library_text</textarea></p>

	<p>
	<input type="submit" name="Save" value="Save"><BR>
	<input type="submit" name="SaveAs" value="Save As New Library Name">
	<input type="textfield" name="NewName" default="$library_name"><BR>
	<input type="submit" name="New" value="New Library">
	</p>
	</td>
	</tr>
	
	<tr>
	
	
	<tr><td colspan="3">Library Files: Book SEL files are created automatically with a book, all functions written in that file, or functions made available by 'Including' files (see later) from either the Hosted Library or your Personal Library will be usable in your adventures</td></tr>
	
	
	<td><p>Your SEL Library Files</p>
	<p><select name="ULibs" size="20">
print_tag
	
	foreach $option(@ULibs)
	{
		print "<option value=\"$option\">$option";
	}

print<<"print_tag";
	</select></p>
	<p> 
	<input type="submit" name="LoadULF" value="Load">
	<input type="button" name="ViewULF" value="View" onClick="newurl='viewfunc.cgi?filename='+document.editfunc.ULibs.value+'&libtype=USER';window.open(newurl);">
	<input type="submit" name="Delete" value="Delete">
        </p>
	</td>
	
	<td><p>Your Book SEL Files</p>
	<p><select name="BLibs" size="20">
print_tag
	
	foreach $option(@BLibs)
	{
		print "<option value=\"$option\">$option";
	}

print<<"print_tag";
	
	</select></p>
	<p> 
	<input type="submit" name="LoadBLF" value="Load">
	<input type="button" name="ViewBLF" value="View" onClick="newurl='viewfunc.cgi?filename='+document.editfunc.BLibs.value+'&libtype=BOOK';window.open(newurl);">
        </p>
	</td>
	
	<td><p>Hosted SEL Library Files</p>
	<p><select name="HLibs" size="20">
print_tag
	
	foreach $option(@HLibs)
	{
		print "<option value=\"$option\">$option";
	}

print<<"print_tag";
	</select></p>
	<p>
	<input type="button" name="ViewHLF" value="View" onClick="newurl='viewfunc.cgi?filename='+document.editfunc.HLibs.value+'&libtype=HOSTED';window.open(newurl);">
        </p>
	</td>
	</tr>
	

	<tr>	
		<td colspan="3">
			Inclusions:
			Including a file makes the functions defined in that file available to use in the currently loaded file.<BR>
			To Include file(s), highlight those you wish to include from the excluded list and click Save<BR>
			Likewise to Exclude a file, highlight the file(s) currently included you wish to exclude and click Save<BR>
			
		</td>
	</tr>
	
	<tr>
		<td></td>
		<td>Included</td>
		<td>Excluded</td>
	</tr>
	
	<tr>
		<td>
        		User Library
        	</td>

		<td>
			<select name="ULibsInc[]" size="10" multiple="multiple">
print_tag
## note [] added for php passthrough
foreach $option (@user_includes)
{
	print "<option value=\"$option\">$option";
}
print<<"print_tag";
			</select>
		</td>
		
		<td>
			<select name="ULibsEx[]" size="10" multiple="multiple">
print_tag
## note [] added for php passthrough
foreach $option (@user_excludes)
{
	print "<option value=\"$option\">$option";
}
print<<"print_tag";
			</select>
		</td>
	
	</tr>
	
	<tr>
		<td>
			Hosted Library
        	</td>
		<td>
			<select name="HLibsInc[]" size="10" multiple="multiple">
print_tag
## note [] added for php passthrough
foreach $option (@hosted_includes)
{
	print "<option value=\"$option\">$option";
}
print<<"print_tag";
			</select>
		</td>
		<td>
			<select name="HLibsEx[]" size="10" multiple="multiple">
print_tag
## note [] added for php passthrough
foreach $option (@hosted_excludes)
{
	print "<option value=\"$option\">$option";
}



print<<"print_tag";
			</select>
		</td>
	</tr>
	</table>
	</form>
	
print_tag

print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";
}
else 
{
	## authenticate failed, should be error message there
}

sub load_editor_library ## 1)library type 2) library name::(following parameters are references to variables for filling) 3) library text 4) user included 5) user excluded 6) hosted included 7) hosted excluded
{

	my $lib_type=shift;
	my $lib_name=shift;

	if($lib_name=~/[^\w\s-]/)
	{
		die "Invalid characters in Library Name passed to edit_funcs.cgi";
	}

	my $lib_textRef=shift;
	
	my $UIncRef=shift;
	my $UExcRef=shift;
	my $HIncRef=shift;
	my $HExcRef=shift;
	
	&get_include_exclude_lists($lib_type, $lib_name, $UIncRef, $UExcRef, $HIncRef, $HExcRef);
	
	if ($lib_type eq "USER")
	{
		my $library_file=$lib_name.".sel";
		if (-e "Accounts/$UserName/MyLibrary/$library_file")
		{
			## load users library file
			open (USERLIB, "<Accounts/$UserName/MyLibrary/$library_file") or die "failed to open User Library File $library_name: $!";
			@{$lib_textRef}=<USERLIB>;
			close USERLIB;
		}
		else
		{
			die "error - User Library file to open does not exist";
		}
	}
	elsif($lib_type eq "BOOK")
	{
		my $library_file=$lib_name.".sel";
		if (-e "Accounts/$UserName/MyBooks/$lib_name/$library_file")
		{
			## load users book library file
			open (BOOKLIB, "<Accounts/$UserName/MyBooks/$lib_name/$library_file") or die "failed to open User Library File $library_name: $!";
			@{$lib_textRef}=<BOOKLIB>;
			close BOOKLIB;
		}
		else
		{
			die "error - Book Library file to open does not exist";
		}
	}
	elsif ($lib_type eq "NEW")
	{
		@{$lib_textRef}=();
	}
	else
	{
		die "Invalid file type passed to load_editor_library ";
	}
}

sub save_editor_library  ## 1) reference to query object with form info  ## 2) save as user libtype flag (1 for save as user)
{
	my $new_data=shift;
	my $save_as_user=shift;
	
	my $save_libfile;
	my $save_incfile;
	
	my @new_UIncs=$new_data->param('ULibsInc');
	my @new_UExcs=$new_data->param('ULibsEx');
	my @new_HIncs=$new_data->param('HLibsInc');
	my @new_HExcs=$new_data->param('HLibsEx');
	
	&get_include_exclude_lists($new_data->param('library_type'),$new_data->param('library_name'), \@user_includes, \@user_excludes, \@hosted_includes, \@hosted_excludes);
	
	if($new_data->param('library_name')=~/[^\w\s\-\_]/)
	{
		die "Invalid characters in save filename passed to edit_funcs.cgi";
	}

	if($new_data->param('NewName')=~/[^\w\s\-\_]/)
	{
		die "Invalid characters in SaveAs filename passed to edit_funcs.cgi";
	}

	## the IF order is important cos im crap at coding - basically a BOOK file that has been SaveAs'd relies on first IF catching the Save As flag
	## otherwise it is treated as a book file and saved to the book file
	if (($new_data->param('library_type') eq "NEW") or ($save_as_user) ) ## is effectively USER type
	{
		$save_libfile="Accounts/$UserName/MyLibrary/".$new_data->param('NewName').".sel";
		$save_incfile="Accounts/$UserName/MyLibrary/".$new_data->param('NewName').".inc";
	}
	elsif ($new_data->param('library_type') eq "USER")
	{
		$save_libfile="Accounts/$UserName/MyLibrary/".$new_data->param('library_name').".sel";
		$save_incfile="Accounts/$UserName/MyLibrary/".$new_data->param('library_name').".inc";
	}
	elsif ($new_data->param('library_type') eq "BOOK")
	{
		$save_libfile="Accounts/$UserName/MyBooks/".$new_data->param('library_name')."/".$new_data->param('library_name').".sel";
		$save_incfile="Accounts/$UserName/MyBooks/".$new_data->param('library_name')."/".$new_data->param('library_name').".inc";
	}
	else
	{
		die "Invalid library type passed to save_editor_library";
	}


	###### remove selected excludes from include lists, put excluded back into included
	## note the final lists are the GLOBAL vars from top of page - this is bad
	my $x;
	my $searching=1;

	## remove selected user includes first to keep list smaller
	foreach $new_UIncs(@new_UIncs)
	{
		for ($x=0;($x<@user_includes) && ($searching);$x++)
		{
			if ($new_UIncs eq $user_includes[$x])
			{
				$searching=0;
				splice @user_includes,$x,1;
			}
		}
		$searching=1;
	}
	## now add the new includes from the selections in the exclude list
	push @user_includes, (@new_UExcs);
	
	## do same for hosted files
	foreach $new_HIncs(@new_HIncs)
	{
		for ($x=0;($x<@hosted_includes) && ($searching);$x++)
		{
			if ($new_HIncs eq $hosted_includes[$x])
			{
				$searching=0;
				splice @hosted_includes,$x,1;
			}
		}
		$searching=1;
	}
	push @hosted_includes, (@new_HExcs);
	
	
	#### Now we do the same for the exclude list
	## this is for display purposes only, as Excludes obviously aren't saved
	## and may be quicker to simply call &get_include_exclude_list, will worry later
	
	## user files
	foreach $new_UExcs(@new_UExcs)
	{
		for ($x=0;($x<@user_excludes) && ($searching);$x++)
		{
			if ($new_UExcs eq $user_excludes[$x])
			{
				$searching=0;
				splice @user_excludes,$x,1;
			}
		}
		$searching=1;
	}
	## now add the new excludes from the selections in the include list
	push @user_excludes, (@new_UIncs);
	
	## do same for hosted files
	foreach $new_HExcs(@new_HExcs)
	{
		for ($x=0;($x<@hosted_excludes) && ($searching);$x++)
		{
			if ($new_HExcs eq $hosted_excludes[$x])
			{
				$searching=0;
				splice @hosted_excludes,$x,1;
			}
		}
		$searching=1;
	}
	push @hosted_excludes, (@new_HIncs);
	
	
	## write new library text and include list to appropriate file
	open (LIBFILE, ">$save_libfile") or die "failed to write to file:$save_libfile, reason:$!";
	my @new_text=$new_data->param('library_text');
	
	foreach(@new_text)
	{
		print LIBFILE; 
	}
	close LIBFILE;
	
	open (INCFILE, ">$save_incfile") or die "failed to write to file:$save_libfile, reason:$!";
	foreach $newUIncs(@user_includes)
	{
		if($newUIncs=~/[^\w\s-]/)
		{
			die "Invalid characters in New User Include filename passed to edit_funcs.cgi";
		}
		print INCFILE "Accounts/$UserName/MyLibrary/".$newUIncs.".sel\n";
	}
	foreach $newHIncs(@hosted_includes)
	{
		if($newHIncs=~/[^\w\s-]/)
		{
			die "Invalid characters in New Hosted Include filename passed to edit_funcs.cgi";
		}
		
		print INCFILE "Accounts/hosted/MyLibrary/".$newHIncs.".sel\n";
	}

	close INCFILE;

}

sub get_include_exclude_lists ## 1)library type 2) library name::(following parameters are references to variables for filling) 3) user included 4) user excluded 5) hosted included 6) hosted excluded
{
	my $libtype=shift;
	my $libname=shift;
	
	if($libname=~/([^\w\s-])/)
	{
		die ("Invalid characters in libname filename passed to get_include_exclude func in edit_funcs.cgi, character data was:$1 and libname=$libname query string: ".$query->param('library_name'));
	}

	my $UIncs_ref=shift;
	my $UExcs_ref=shift;
	my $HIncs_ref=shift;
	my $HExcs_ref=shift;
	
	my @hosted_files;
	my @user_files;
	
	my @included_host;
	my @included_user;
	
	#### get all the available library files first
	## get the users library files
	&get_user_libraries(\@user_files);
	
	## get the hosted library files
	&get_hosted_libraries(\@hosted_files);

	
	## get the include list for file
	if ($libtype eq "NEW") ## New files have no inclusions to start
	{
		@{$UExcs_ref}=(@user_files);
		@{$HExcs_ref}=(@hosted_files);
		@{$UIncs_ref}=();
		@{$HIncs_ref}=();
	}
	else
	{
		
		if ($libtype eq "BOOK")
		{
			open (BOOKINCS, "Accounts/$UserName/MyBooks/$libname/$libname".".inc") or die "failed to open include list for Accounts/$UserName/MyBooks/$libname/$libname"."inc";
			while(<BOOKINCS>)
			{
				chomp;
				
				my $filename;
				
				## get the filename without extension from full path
				if (/\/([^\/]+)\.sel/)
				{
					$filename=$1
				}
				else
				{
					## nothing - there are other necessary files in the directory
				}
				
				if (/\/hosted\//) ## if the filename/path contains /hosted/ (including slashes) it must be a hosted library file
				{
					push @included_host, $filename;
				}
				else ## assume its a user file
				{
					push @included_user, $filename;
				}
			}
			close BOOKINCS;
		}
		elsif ($libtype eq "USER")
		{			
			open (USERINCS, "Accounts/$UserName/MyLibrary/$libname".".inc") or die "failed to open include list for Accounts/$UserName/MyLibrary/$libname".".inc";
			while(<USERINCS>)
			{
				chomp;

				my $filename;
				
				## get the filename without extension from full path
				if (/\/([^\/]+)\.sel/)
				{
					$filename=$1
				}
				else
				{
					## nothing - there are other necessary files in the directory
				}
				
				
				if (/\/hosted\//) ## if the filename/path contains /hosted/ (including slashes) it must be a hosted library file
				{
					push @included_host, $filename;
				}
				else ## assume its a user file
				{
					push @included_user, $filename;
				}
			}
			close USERINCS;
		}
		else
		{
			die "Invalid filetype passed to get_include_exclude_lists";
		}
		
		## put the included lists into the references that want filling
		@{$UIncs_ref}=(@included_user);
		@{$HIncs_ref}=(@included_host);
		
		
		
		## now we have to sort the excluded from the included
		foreach $included_user (@included_user) ## for every user library in the list of included libraries
		{
			my $y=@user_files;  ## just seperating this as not sure what happens if you modify in middle of loop
			my $searching=1;
			
			for ($x=0;($x<$y) and ($searching);$x++)  ## go through the list of all user libraries, and remove it from the list of all user libs (we are going to use this list as our exclude list when done)
			{
				if ($included_user eq @user_files[$x])
				{
					splice @user_files, $x, 1; ## remove the entry in user_files list
					$searching=0;
				}
			}
		}
		
		foreach $included_host (@included_host) ## for every host library in the list of included libraries
		{
			my $y=@hosted_files;  ## just seperating this as not sure what happens if you modify in middle of loop
			my $searching=1;
			
			for ($x=0;($x<$y) and ($searching);$x++)  ## go through the list of all host libraries, and remove it from the list of all host libs (we are going to use this list as our exclude list when done)
			{
				if ($included_host eq @hosted_files[$x])
				{
					splice @hosted_files, $x, 1; ## remove the entry in user_files list
					$searching=0;
				}
			}
		}
		
		## put the excluded lists into the references that want filling
		@{$UExcs_ref}=(@user_files);
		@{$HExcs_ref}=(@hosted_files);
		
		## and we are done :-)

	}
}

sub validate_newfilename ## return 1 for valid or 0 for invalid
{
	my $filename=shift;
	
	
	## simple for now
	if ($filename=~/^[\w\s_\-]+$/)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

sub get_user_libraries ## 1) reference to list to fill with library names
{
	my $lib_list_ref=shift;

	opendir ULIBDIR, "Accounts/$UserName/MyLibrary" or die "failed to open your library files directory\n";
	while($filename=readdir ULIBDIR)
	{	
		if ($filename=~/.*\.sel$/)
		{			
			$filename=~s/\.sel$//;
			push @{$lib_list_ref}, $filename;
		}
	}
	closedir ULIBDIR;
}

sub get_hosted_libraries ## 1) reference to list to fill with library names
{
	my $lib_list_ref=shift;
	
	opendir HLIBDIR, "Accounts/hosted/MyLibrary" or die "failed to open hosted library files directory";
	while($filename=readdir HLIBDIR)
	{		
		if ($filename=~/.*\.sel$/)
		{
			$filename=~s/\.sel$//;
			push @{$lib_list_ref}, $filename;
		}
	}
	closedir HLIBDIR;
}

sub get_book_libraries ## 1) reference to list to fill with library names
{
	my $lib_list_ref=shift;
	
	opendir BLIBDIR, "Accounts/$UserName/MyBooks" or die "failed to open hosted library files directory";
	while($filename=readdir BLIBDIR)
	{		
		if ($filename=~/^\./) ## if its a 'dot' file
		{
		}
		else
		{
			if (-d "Accounts/$UserName/MyBooks/$filename")
			{
				push @{$lib_list_ref}, $filename;
			}
		}
	}
	closedir BLIBDIR;
}