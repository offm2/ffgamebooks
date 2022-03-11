####################################################################################################
### publish.pl - routines to update the users list and the master list of books when being published
### or unpublised
####################################################################################################

sub publish
{
	$UserName=shift;
	$bookname=shift;
	
	if(-d "Accounts/$UserName/MyBooks/$bookname"){
	
		if (open (PUBLISHED, "<Accounts/$UserName/MyBooks/published.txt"))
		{
			while(<PUBLISHED>)
			{
				chomp;
				$already_published{$_}=1;
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

		if($already_published{$bookname}!=1)
		{
			## open users published list or create it if not there (i.e. first time user has gone to create adventure section)
			if (open (PUBLISHED, ">>Accounts/$UserName/MyBooks/published.txt"))
			{
				print PUBLISHED "$bookname\n";
			}
			else
			{
				print "failed to open/create users published list: $!";
			}

			close PUBLISHED;

			if (open (PUBLISHED, ">>Accounts/published.txt"))
			{
				print PUBLISHED "$bookname\n$UserName\n";
			}
			else
			{
				print "failed to open/create global published list: $!";
			}

			close PUBLISHED;
		}
	}
	else{
		print "$bookname not found in your Books";
	}
}

sub unpublish
{
	$UserName=shift;
	$bookname=shift;
	
	
	if (open (PUBLISHED, "<Accounts/$UserName/MyBooks/published.txt"))
	{
		## read in list of published books, skipping the unpublished one
		while (<PUBLISHED>)
		{
			chomp;
			if ($bookname eq $_)
			{
				$found=1;
			}
			else
			{
				push @published, $_;
			}
		}
		
		close PUBLISHED;
		
		if ($found != 1)
		{
			## removed for the moment, book may not actually be published ## print "Error - book to unpublish not found in users published list<BR>";
		}
		
		## write list back out without unpublished book
		open (PUBLISHED, ">Accounts/$UserName/MyBooks/published.txt") or die "failed to open/create users published list: $!";
		foreach (@published)
		{
			print PUBLISHED "$_\n";
		}
		
		close PUBLISHED;
	}
	else
	{
		die "failed to open users published list: $!";
	}
	
	
	@published = ();
	
	if (open (PUBLISHED, "<Accounts/published.txt"))
	{
		## read in list of published books, skipping the unpublished one
		while (<PUBLISHED>)
		{
			$publishedbook=$_;
			chomp $publishedbook;
			
			$author=<PUBLISHED>;
			chomp $author;
			
			if ($bookname eq $publishedbook)
			{
				if ($author=$UserName)
				{
					$found=1;
				}
				else
				{	
					push @published, $publishedbook, $author;
				}
			}
			else
			{
				push @published, $publishedbook, $author;
			}
		}
		
		close PUBLISHED;
		
		if ($found != 1)
		{
			## removed for the moment, book may not actually be published ## print "Error - book to unpublish not found in global published list<BR>";
		}
		
		## write list back out without unpublished book
		open (PUBLISHED, ">Accounts/published.txt") or die "failed to open/create global published list: $!";
		foreach (@published)
		{
			print PUBLISHED "$_\n";
		}
		
		close PUBLISHED;
	}
	else
	{
		die "failed to open global published list: $!";
	}
}

1;