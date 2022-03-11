#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
use File::Path;
require "authenticate.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

$query = new CGI;

####################################################################################################
### account.cgi - main navigation page for user.  Select book to play, display books :'in play',
### 'hosted', 'members' and 'featured', and links to book editor area.  Anywhere else in the
### online game area should be linked to here if it requires a user log in.
####################################################################################################

$userage; ## leaving global for covenience sake atm

# make sure a valid user is calling this file
if (&authenticate_user(\$UserName)){
	print $query->header;
	open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
	my $perl_scriptlocation=<SCRIPTLOC>;
	chomp $perl_scriptlocation;
	close SCRIPTLOC;	
	
print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

	## display top banner, account options etc.
	if($UserName=~/^\_guest/){
		print "Welcome, Guest<br />";
		print "We are sorry for the poor presentational aspects at this time, and also note as a Guest User you will not be able to access any of the Book Creating functionality of the site - any links you select that would allow you to do so will simply present a blank page at this time - Sorry!<br />";
		print "Note the walkthroughs, charts etc. are only available from the main site!<br />"
	}
	else{print "Welcome ".$UserName;}
	&display_account_options;
	# &display_featured_books;
	&display_book_view_options;
	
	
	$view_selected=$query->param('view');
	
	if ($view_selected eq "Membersbooks")
	{
		&display_member_books;
	}
	elsif ($view_selected eq "Hostedbooks")
	{
		&display_hosted_books;
	}
	elsif ($view_selected eq "OwnBooks")
	{
		&display_users_books;
	}
	elsif ($view_selected eq "InPlay"){
		&display_books_in_play;
	}
	else ## default to Hosted books 
	{
		&display_hosted_books;
	}
	
	print "<a href=\"/index.html\">FF.net Homepage</a>";
	print "</body></html>";
}
else 
{
	print $query->header;
	print "Authenticate failed";
	## authenticate failed, should be error message there
}

print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";

##########################
sub welcome_user
{
	##my $DOBDay,$DOBMonth,$DOBYear;

	##open (USERACCOUNTINFO, "<Accounts/$UserName/account.txt") or die "failed to open user account file for $UserName: $!";
	##$namefound=0;
	##while (<USERACCOUNTINFO>)
	##{
	##	chomp;
	##	($field, $value) = split /=/,$_,2;
	##	if (defined($field))
	##	{
	##		if ( ($field eq "First Name") and defined($value) )
	#		{
	#			$realname = $value;
	#		}
	#		elsif($field eq "Day")
	#		{
	#			$DOBDay=$value;
	#		}
	#		elsif($field eq "Month")
	#		{
	#			$DOBMonth=$value;
	#		}
	#		elsif($field eq "Year")
	#		{
	#			$DOBYear=$value;
	#		}	
	#	}
	#	else
	#	{
	#		print "corrupt user account file - field \"First Name\" not found";
	#	}
	#}#

	#$userage=&calculate_ageinyears($DOBDay,$DOBMonth,$DOBYear);
        $userage=18;
}

sub display_account_options
{
	## <a href="user_profile_editor.cgi">Edit Your Profile</a><br />
	if(!($UserName=~/^\_guest/)){
	print <<"print_tag";
	<br />
	<a href="book_creator_account.cgi">Adventure Creator</a><br />
	<br />
print_tag
	}
	else{
		print "<br />";
		print "<a href=\"https://fightingfantasy.net/play/newacct.cgi\">Create Account</a><br />";
		print "<a href=\"https://fightingfantasy.net/\">Main Site</a><br />";
		print "<br />";
	}
}

sub display_book_view_options
{
	print <<"print_tag";
	
	View Books: <a href="account.cgi?view=Hostedbooks">Hosted Books</a> - <a href="account.cgi?view=Membersbooks">FF.net Community Member Books</a> - <a href="account.cgi?view=InPlay">Books In Play</a> - <a href="account.cgi?view=OwnBooks">Your Books</a>
	
print_tag
}

sub display_featured_books
{
	## print "<br>routine for featured books to go here<br>";
}

sub display_member_books
{
	my $status,$completed,$attempts;
	
	print "<br /><br />Displaying <b>Members Books</b><br /><br />";
	
	open(PUBLISHED, "<Accounts/published.txt") or die "failed to open published list file: $!";
	
	$counter=0;
	while (<PUBLISHED>)
	{
		$memberbook = $_;
		$memberauthor = <PUBLISHED>;
		
		chomp $memberauthor;
		chomp $memberbook;
		
		# skip if this is the 'hosted' author
		if ($memberauthor ne "hosted")
		{
			$counter++;
			
			($status,$completed,$attempts)=&get_bookmark_info($memberauthor,$memberbook,$UserName);
			&display_book($memberauthor,$memberbook,$status,$attempts,$completed,1,$userage);
			print "<br /><br />";
		}
	}
	
	close PUBLISHED;
	
	print "<p>Listed all members books, total number: <b>$counter</b></p>";
	
}

### need to decide on how to handle bookmarked books that have been unpublished (not removed)
sub display_books_in_play
{
	my $bmdir,$authdir;
	my $counter=0;
	my $status,$completed,$attempts;	

	print "<BR><BR>Displaying <B>Books In Play</B><BR><BR>";

	if (opendir BMAUTHOR, "Accounts/$UserName/Bookmarks")
	{
		while($authdir=readdir BMAUTHOR)
		{
			if(-d "Accounts/$UserName/Bookmarks/".$authdir)
			{
				if(($authdir ne ".") and ($authdir ne ".."))
				{
					if(opendir BMDIR, "Accounts/$UserName/Bookmarks/".$authdir)
					{
						while($bmdir=readdir BMDIR)
						{
							if(-d "Accounts/$UserName/Bookmarks/".$authdir."/".$bmdir)
							{
								if(($bmdir ne ".") and ($bmdir ne ".."))
								{
									($status,$completed,$attempts)=&get_bookmark_info($authdir,$bmdir,$UserName);
									if ($status eq "Playing")
									{
										&display_book($authdir,$bmdir,$status,$attempts,$completed,1,$userage);
										print "<br /><br />";
										$counter++;
									}
								}
							}
						}
						closedir BMDIR;
					}
					else
					{
						print "Error - could not open bookmark directory for author $authdir";
					}
				}
			}
		}
		closedir BMAUTHOR;
		print "Listed all books marked as still in play: $counter<br /><br />";
	}
	else
	{
		print "Error - Bookmark Directory not created<br /><br />";
	}
}

sub display_users_books
{
	my $bookdir;
	my $counter=0;
	my $status,$completed,$attempts;	

	print "<BR><BR>Displaying <B>Your Books</B> (whether published or not to allow for testing)<BR><BR>";

	if (opendir USERBOOKS, "Accounts/$UserName/MyBooks")
	{
		while($bookdir=readdir USERBOOKS)
		{
			if(-d "Accounts/$UserName/MyBooks/".$bookdir)
			{
				if(($bookdir ne ".") and ($bookdir ne ".."))
				{
					($status,$completed,$attempts)=&get_bookmark_info($UserName,$bookdir,$UserName);
					&display_book($UserName,$bookdir,$status,$attempts,$completed,0,$userage);
					print "<br /><br />";
					$counter++;
				}
			}
		}
		
		print "Listed all users own books: $counter<br /><br />";
		closedir USERBOOKS;
	}
	else
	{
		print "You have not created any books of your own yet<br /><br />";
	}
}

sub display_hosted_books
{
	my $status,$completed,$attempts;

	print "<BR><BR>Displaying <b>Hosted Books</b><br /><br />";
	
	# read bookmark data into hashes for playing status, number of times completed and number of attempts
	
	open(PUBLISHED, "<Accounts/hosted/MyBooks/published.txt") or die "failed to open hosted published list file: $!";

	$counter=0;
	while (<PUBLISHED>)
	{
		$counter++;
		$memberbook = $_;
		
		chomp $memberbook;
		
		($status,$completed,$attempts)=&get_bookmark_info("hosted",$memberbook,$UserName);
		&display_book("hosted",$memberbook,$status,$attempts,$completed,1,$userage);
		print "<br /><br />";
		
	}
	
	close PUBLISHED;
	
	print "<p>Listed all hosted books, total number: <b>$counter</b></p>";
}

sub display_book
{
	my $author=shift;
	my $bookname=shift;
	my $status=shift;
	my $attempts=shift;
	my $completed=shift;
	my $check_age=shift;
	my $userage=shift;

	## check book still exists
	if (-d "Accounts/$author/MyBooks/$bookname")
	{
		my $rating=&get_book_rating($author,$bookname);
		my $displayauthor=&getauthor($author,$bookname);
		my $refs=&get_number_of_refs($author,$bookname);

		print "<b>$bookname</b><br />";
		print "by <i>$displayauthor</i><br />";
		print "References: $refs<br />";
		print "Rating: $rating<br />";
		print "Attempted by you: $attempts times<br />";
		print "Completed by you: $completed times<br />";

		if($check_age and ($rating eq "Restricted"))
		{
			if($userage < 18)
			{
				print "This book has been rated as being suitable for Adult audience only";
			}
			else
			{
				if ($status eq "Playing")
				{
					print "<a href=\"continue.cgi?Book=$bookname&Author=$author\">Continue book</a>";
				}
				elsif (($status eq "Completed") or ($status eq "Lost"))
				{
					print "<a href=\"startbook.cgi?Book=$bookname&Author=$author\">Replay Book</a>";
				}
				else
				{
					print "<a href=\"startbook.cgi?Book=$bookname&Author=$author\">Play Book</a>";
				}		
			}
		}
		else ## assume Universal returned or check age not necessary
		{
			if ($status eq "Playing")
			{
				print "<a href=\"continue.cgi?Book=$bookname&Author=$author\">Continue book</a>";
			}
			elsif (($status eq "Completed") or ($status eq "Lost"))
			{
				print "<a href=\"startbook.cgi?Book=$bookname&Author=$author\">Replay Book</a>";
			}
			else
			{
				print "<a href=\"startbook.cgi?Book=$bookname&Author=$author\">Play Book</a>";
			}
		}
	}
	else ## author has deleted a bookmarked book, display book information known from bookmark, delete bookmark, inform user of deletion
	{
		print "<b>$bookname</b><br />";
		print "author name now unknown<br />";
		print "Attempted: $attempts times<br />";
		print "Completed: $completed times<br />";
		print "This book has now been deleted by the author.  Your bookmark for this book is being removed<br />";
		if(-d "Accounts/$UserName/Bookmarks/".$author."/".$bookname)
		{
### DANGER?
			my $deleted=rmtree("Accounts/$UserName/Bookmarks/".$author."/".$bookname,0,1);
			print "Deleted $deleted files<br />";
		}
		else
		{
			print "Notify webmaster of bookmark detection failure<br />";
		}
	}
}


sub get_bookmark_info
{
	my $author=shift;
	my $book=shift;
	my $user=shift;
	
	my $status="Not Played";
	my $completed=0;
	my $attempts=0;
	my $bookmarkfile = $book.".txt";
	
	# if there is a bookmark for this author in the users bookmarks
	if (-e "Accounts/$user/Bookmarks/$author")
	{
		# if there is bookmark info for the specific book
		if (-e "Accounts/$user/Bookmarks/$author/$book")
		{
			#read in bookmark info					
			if (open (BOOKMARK ,"<Accounts/$user/Bookmarks/$author/$book/$bookmarkfile"))
			{
				while (defined($input=<BOOKMARK>))
				{
					chomp $input;
					($field,$value) = split /=/, $input,2;
					if ($field eq "Status")
					{
						$status = $value;
					}
					if ($field eq "Completed")
					{
						$completed = $value;
					}
					if ($field eq "Attempts")
					{
						$attempts = $value;
					}
				}
				close BOOKMARK;
			}
			else
			{
				## failed to open bookmark file
				print "Error - failed to open user: $user Bookmark file for author: $author, Book: $book";
			}
		}
		else
		{
			## user has no bookmark information for this authors book
			#print "No Bookmark Information for this book";
		}
	}
	else
	{
		## user has no bookmark information for this author
		#print "No Bookmark Information in - $user - for - $author -";
	}
	
	return ($status,$completed,$attempts);
}

sub calculate_ageinyears
{
	my $DOBDay, $DOBMonth, $DOBYear, $ageinyears;
	my $sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst;
	($DOBDay,$DOBMonth,$DOBYear)=(shift,shift,shift);
	
	($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=gmtime(time);
	
	if($DOBMonth eq "January")
	{
		$DOBMonth=0;
	}
	elsif($DOBMonth eq "February")
	{
		$DOBMonth=1;	
	}
	elsif($DOBMonth eq "March")
	{
		$DOBMonth=2;	
	}
	elsif($DOBMonth eq "April")
	{
		$DOBMonth=3;	
	}	
	elsif($DOBMonth eq "May")
	{
		$DOBMonth=4;	
	}	
	elsif($DOBMonth eq "June")
	{
		$DOBMonth=5;	
	}	
	elsif($DOBMonth eq "July")
	{
		$DOBMonth=6;	
	}	
	elsif($DOBMonth eq "August")
	{
		$DOBMonth=7;	
	}	
	elsif($DOBMonth eq "September")
	{
		$DOBMonth=8;	
	}	
	elsif($DOBMonth eq "October")
	{
		$DOBMonth=9;	
	}	
	elsif($DOBMonth eq "November")
	{
		$DOBMonth=10;	
	}	
	elsif($DOBMonth eq "December")
	{
		$DOBMonth=11;	
	}
	else
	{
		# print "Invalid Month date in Age field of User Account ($DOBMonth)- Please contact Webmaster on Forums";
	}

	$year+=1900;
	$ageinyears=$year-$DOBYear;
	
	if($mon<$DOBMonth)
	{
		$ageinyears--;
	}
	elsif($mon==$DOBMonth)
	{
		if($mday<=$DOBDay)
		{
			$ageinyears--;
		}
	}
	return $ageinyears;
}

sub get_book_rating
{
	my $author,$book,$rating;
	($author,$book)=(shift,shift);
	$rating="Restricted";
	if (open(BOOKINFO, "<Accounts/$author/MyBooks/$book/bookinfo.txt"))
	{
		while(<BOOKINFO>)
		{
			chomp;
			if(/rating\=(.*)/)
			{
				if(($1 eq "Restricted") or ($1 eq "Universal"))
				{
					return $1;
				}
				else
				{
					print "Unknown Rating in bookmark file";
					return $rating;
				}
			}
		}
		close BOOKINFO;
		print "Rating missing in bookmark file, applying Restricted rating (18 and over only)";
		open (BOOKINFO, ">>Accounts/$author/MyBooks/$book/bookinfo.txt") or print "Failed to book information file for book: $book, by author: $author";
		print BOOKINFO "rating=Restricted\n";
		close BOOKINFO;
		return $rating;
		
	}
	else
	{
		print "failed to open book information file for book: $book, by author: $author";
		return $rating;
	}
}

sub getauthor
{
	my $passed_author, $author, $book;
	($author,$book)=(shift,shift);
	$passed_author=$author;
	
	my $infield="";
	open (GETAUTHOR ,"<Accounts/$author/MyBooks/$book/bookinfo.txt") or die "failed to open book information file, Accounts/$author/MyBooks/$book/bookinfo.txt: $!";
	while($infield ne "authors")
	{
		$_=<GETAUTHOR>;
		chomp;
		($infield,$author) = split /=/, $_,2;
	}
	close GETAUTHOR;
	if($author eq "")
	{
		return $passed_author;
	}
	return $author;
}

sub get_number_of_refs
{
	my $author,$book;
	($author,$book)=@_;
	if (opendir REFERENCES,"Accounts/$author/MyBooks/$book/refs")
	{
		my $refcount=0;
		while($refname = readdir REFERENCES)
		{
			$refcount++;
		}
		closedir REFERENCES;
		
		return $refcount-5;
	}
	else
	{
		print "failed to open user book references directory for $book_title: $!";
	}
}
