#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
use Archive::Zip qw( :ERROR_CODES :CONSTANTS );
use File::Path;
require "publishing.pl";
require "authenticate.pl";
require "generate_chart.pl";
require "generate_html_xml.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

####################################################################################################
### book_creator_account.cgi  Main navigation page for users own book creation area.  Display all
### users books both completed and in progress, with links to edit, publish/unpublish, and delete
### for each, as well as information such as number of pages and images in book.  Links to Create
### New Book, and the Functions Editor here as well as any other pages regarding book creation and
### editing that require a user log in.  Also manage the users disk allocation space here and
### restrict usage if exceeded.
####################################################################################################

$query = new CGI;

if (&authenticate_user(\$UserName)==1)
{
	open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
	my $perl_scriptlocation=<SCRIPTLOC>;
	chomp $perl_scriptlocation;
	close SCRIPTLOC;

	if(defined $query->param('backup'))
	{
		my $zip = Archive::Zip->new();

		my $directory="Accounts/$UserName/MyBooks";
		my $dest_dir="MyBooks/";
		warn "Can't add tree $directory\n" if $zip->addTree( $directory, $dest_dir ) != AZ_OK;
		$directory="Accounts/$UserName/MyLibrary";
		$dest_dir="MyLibrary/";
		warn "Can't add tree $directory\n" if $zip->addTree( $directory, $dest_dir ) != AZ_OK;

		print $query->header( -type => "application/octet-stream", 
					-Content_Disposition => "attachment; filename=$UserName.zip",
					-expires => 'now'
					);
		my $status=$zip->writeToFileHandle(\*STDOUT);
	}
	elsif( defined $query->param('graph') ){
		&generate_chart($UserName,$query->param('book'),$query->param('missinglinks'));
	}
	elsif( defined $query->param('html')){
		&generate_html_xml($UserName,$query->param('book'),'','','charsheet','credits','implementation','generate');
	}
	else
	{
		print $query->header();
		"\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";
		print<<"print_tag";
		<html>
		<head>
		<title>FightingFantasy.net - Your Account - Adventure Creator - Your Books</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link rel="stylesheet" href="$perl_scriptlocation/resources/css/fforgstyle.css">
		</head>
		<body>
print_tag

		## warning: $to_delete may be unsafe
		
		if(defined $query->param('delete'))
		{
			my $to_delete=$query->param('delete');
			
			if($to_delete=~/[^\w\s-]/)
			{
				print "Unsafe characters submitted to Delete request.  Request Ignored.";
			}
			else
			{
				if(-d "Accounts/$UserName/MyBooks/".$to_delete)
				{
					if(defined $query->param('delete_confirm'))
					{
						if ($query->param('delete_confirm') eq "confirm")
						{
							## delete book and files here
							print "<p>deleting $to_delete....</p>";
							
							&unpublish($UserName,$to_delete);
							
							my $deleted=rmtree("Accounts/$UserName/MyBooks/".$to_delete,0,1);
							
							print "<p>deleted: $deleted files</p>";
						}
						else
						{
							print "Book deletion of $to_delete aborted";
						}
					}
					else
					{
						print "Please confirm you wish to delete: <b>$to_delete</b>";
						print "<p><a href='book_creator_account.cgi?delete=$to_delete&delete_confirm=confirm'>Yes, I really do wish to delete this book.</a></p>";
						print "<p><a href='book_creator_account.cgi?delete=$to_delete&delete_confirm=deny'>No, I changed my mind.</a></p>";
						print "<p>Selecting any link other than Yes will abort book deletion</p>"
					}
				}
				else
				{
					print "Book $to_delete does not exist, cannot delete.";
				}
			}
		}

		print "<p><a href=\"account.cgi\">Back to online books</a></p>";

		print "<p><a href=\"edit_funcs.cgi\">Functions editor</a></p>";
		
		## note CMS specific URL here
		## print "<p><a href=\"".$perl_scriptlocation."/book_creator_account.cgi?backup=1\" target=\"_blank\">Download Backup</a><br />(The Backup will be of everything you have created with this account on FF.net)</p>";		
		print "<p><a href=\"book_creator_account.cgi?backup=1\" target=\"_blank\">Download Backup</a><br />(The Backup will be of everything you have created with this account on FF.net)</p>";		
		print "Note: Editing a Published book will automatically Unpublish it<br />";

		if (defined($query->param('publish')))
		{
			if ($query->param('publish')=~/[^\w\s-]/)
			{
				print "corrupt parameter (book to publish) passed to book_creator_account.cgi contained invalid characters";
			}
			else
			{
				&publish($UserName, $query->param('publish'));
			}
		}
		elsif (defined($query->param('unpublish')))
		{
			if ($query->param('unpublish')=~/[^\w\s-]/)
			{
				print "corrupt parameter (book to unpublish) passed to book_creator_account.cgi contained invalid characters";
			}
			else
			{
				&unpublish($UserName, $query->param('unpublish'));
			}
		}

		## open users books directory, create one if this is first time here
		opendir MYBOOKS, "Accounts/$UserName/MyBooks" or mkdir "Accounts/$UserName/MyBooks" or die "cannot create MyBooks directory directory:$!";

		## open users published list
		if (open (PUBLISHED, "<Accounts/$UserName/MyBooks/published.txt"))
		{
			while(<PUBLISHED>)
			{
				chomp;
				$published{$_}=1;
			}
		}
		## create it if we couldnt open to read
		elsif (open (PUBLISHED, ">Accounts/$UserName/MyBooks/published.txt"))
		{

		}
		else
		{
			print "failed to read/create users published list: $!";
		}

		close PUBLISHED;

		#### turn into routine so editor can keep track of bytes used
		$spaceallowedinbytes=1048576; ## 1 Mb allowed
		$bytecount=0;

		# loop through all directories (books) and get names
		while($contents = readdir MYBOOKS)
		{		
			# if the file is a directory
			if(-d "Accounts/$UserName/MyBooks/".$contents)
			{
				# if the directory is not parent or child reference
				if (($contents ne "..") and ($contents ne "."))
				{
					#then it must be a users book directory
					$book_title=$contents;

					## highly inefficient im sure - count number of references in book
					opendir REFERENCES,"Accounts/$UserName/MyBooks/$book_title/refs" or die "failed to open user book references directory for $book_title: $!";
					$refcount=0;
					while($refname = readdir REFERENCES)
					{
						next if $refname =~ /^\./;
						$refcount++;
						$bytecount += (stat("Accounts/$UserName/MyBooks/$book_title/refs/$refname"))[7];
					}
					closedir REFERENCES;

					opendir IMAGES,"Accounts/$UserName/MyBooks/$book_title/images" or die "failed to open user book images directory for $book_title: $!";
					$imagecount=-2;
					while($imagename = readdir IMAGES)
					{
						next if $imagename =~ /^\./;
						$imagecount++;
						$bytecount += (stat("Accounts/$UserName/MyBooks/$book_title/images/$imagename"))[7];
					}
					closedir IMAGES;
					print<<"print_tag";

					<p>Bookname:<b>$book_title</b><br>
					References (including introduction): $refcount<br>
					Images: $imagecount<br>
					<a href="book_editor.cgi?book=$book_title">Edit this Book</a><br />
					
					<a href="book_creator_account.cgi?delete=$book_title">Delete this Book</a><br />
					
					<a href="book_creator_account.cgi?graph=1&book=$book_title">Generate GraphViz DOT Code</a> (excludes references 'implementation","credits" and "charsheet")<br />
					<a href="book_creator_account.cgi?graph=1&book=$book_title&missinglinks=1">Generate GraphViz DOT Code</a> Include postscript for unlinked references (experimental)<br />
print_tag

					print "<a href=\"book_creator_account.cgi?html=1&book=$book_title\" target=\"_blank\">Generate HTML adventure</a> (excludes references: charsheet, implementation, credits, generate)<br />";

					# if the book is published
					if (defined($published{$book_title}))
					{
						print "<a href=\"book_creator_account.cgi?unpublish=$book_title\">Unpublish</a><BR>";
					}
					else
					{

						print "<a href=\"book_creator_account.cgi?publish=$book_title\">Publish</a><BR>";
					}
				}
			}
		}
		closedir MYBOOKS;

		print "<p>You have used: $bytecount bytes out of $spaceallowedinbytes bytes<p>";

		if (($bytecount < $spaceallowedinbytes) or ($UserName eq "hosted"))
		{
			print "<p><a href=\"create_book.cgi\">Create New Book</a></p>";
		}
		else
		{
			print "<p>You have exceeded your allocation space.  Please delete some books/images/references</p>";
		}
	} ## end else if backup
}	
else 
{
	## authenticate failed, should be error message there
}

## print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";
