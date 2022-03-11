use CGI::Carp qw(fatalsToBrowser);
use CGI;
use File::Path;
$query = new CGI;
use CGI::Cookie;
use Digest::SHA1 qw(sha1_hex sha1_base64);

sub authenticate_user{	
	my $user = shift; ## this should be a reference passed so that the value this is set to is the username
	if($query->url_param('key') eq "11223344556677889900"){
	
		my $url_user=$query->url_param('user');

		## check username passed in query string
		if (defined($url_user)){
			## check username isn't nasty
			if($url_user=~/[^\w-\.\@\_]/){
				print $query->header;
				print "User Name not recognised (2)";
				return 0;
			}
			## check user exists in play area folders
			my $directory="Accounts/".$url_user;
			if(-d $directory ){
				$$user=$url_user;
				return 1;
			}
			else{
				print $query->header;
				print "User Name not recognised (3)";
				return 0;		
			}
		}
		else{
			print $query->header;
			print "User Name not recognised (1)";
			return 0;
		}
	}
	else{
		## non Wordpress CMS user (or at least an unregistered one), check cookie to go in here
		## check for raw secure cookie
		my $validate=&check_secure_cookie($user);
		if($validate){
			return $validate;
			## makes 'return 2' for new guest users and update book creation files to exclude guests (send them to account with an error message)
			## also update check_secure_cookie to refresh guest cookies (make guest cookies expire in 2 hours or something)
			## returns 3 for existing guest users
		}
		else{
			if(&create_guest($user)){
				return 2;
			}
			else{
				print $query->header;
				print "User Name not recognised (10) create guest account failed";
				return 0;
			}
		}
	}

}

sub check_secure_cookie{
	## check existence of cookies (ID and session)
	my %cookies = CGI::Cookie->fetch;
	my $user=shift;
	
	if($cookies{'FightingFantasy.net Session'} and $cookies{'FightingFantasy.net ID'}){
			my $cookie_user=$cookies{'FightingFantasy.net ID'}->value;
			## check username isn't nasty
			if($cookie_user=~/[^\w-\.\@\_]/){
				print $query->header;
				print "User Name not recognised (5) cookie tampered with";
				return 0;
			}
			else{
				## got the username now to verify session
				my $session_cookie=$cookies{'FightingFantasy.net Session'}->value;
## !!!	this may be due to guest session expiring				
				open(SESSION, "<Accounts/$cookie_user/session.txt") or die "failed to open session file for $cookie_user:  $!";
				my $stored_time=<SESSION>;
				close SESSION;
				
				# get data
				my @data =('ohnoesyouhazhax0redmehcall teh Pentagon',$stored_time);
				my $digest=sha1_hex(@data);
				
				## check against SHA1 of stored data
				if($digest ne $session_cookie){
					return 0;
				}
				else{
					$$user=$cookie_user; ## assign the main variable $user to be used as username in account.cgi etc.
## !!!!	## refresh cookie duration all users - also refresh session time file guests only
					my $username=$$user;
					open (ACCT, "<Accounts/$username/acct_type.txt") || die "cant open account type file: $!";
					my $acct_type=<ACCT>;
					close ACCT;
					if($acct_type ne 'GUEST'){
						return 1;
					}
					else{
						return 3;
					}
				}
			}
	}
	else{
		return 0;
	}
	return 0;
}

# returns 1 for success, 0 for failure
sub create_guest{
	my $user=shift; ## reference to be filled with valid username on creation
	
	## check user has cookies enabled
	if(&cookies_enabled()){
	
		## IP logger & checker here please (also required for full account creation sometime)
		if(&repeat_attempt_checker()){
			print $query->header();
			my $ip=$query->remote_addr();
			print "Sorry, your IP address ($ip) is logged as already having recently created a temporary guest account, though we did not find your cookie.  Please wait a few minutes before trying again or consider <a href=\"fightingfantasy.net/play/newacct.cgi\">Creating a Full Account</a> for free.";
			return 0;
		}
		
		## get guest user counter
		open(GUESTS, "<Accounts/guests.txt") or die "failed to open guests index:  $!";
		my $guests_counter=<GUESTS>;
		chomp $guests_counter;
		close GUESTS;
		
		$guests_counter++;		
		
		## check new guest username availability (very minor chance of guest username and member account clash) update counter file if clash exists (maybe simply exclude 'guest' prepend from user created accounts?)
		## I have excluded '/_guest.*/' in newacct.cgi but have included this incrementer anyway just in case...
		my $guestname=("_guest"."$guests_counter");
		while(-e "Accounts/$guestname"){
			$guests_counter++;
			$guestname=("_guest"."$guests_counter");
		}

		## if create guest account
		if(&create_guest_account($guestname)){
			## if set cookie		
			if(&generate_guest_session_cookie($guestname)){
				## update guest user counter
				open(GUESTS, ">Accounts/guests.txt") or die "failed to open guests index:  $!";
				print GUESTS $guests_counter;
				close GUESTS;
				
				## return guest account creation success and session creation success
				$$user=$guestname;
				return 1;
			}
			else{
				return 0;
			}
		}
		else{
			return 0;
		}
	}
	else{
		return 0;
	}
}



## !!! cron job guest account removal needed
## !!! guest session expired message needed

sub cookies_enabled(){
	## set a cookie
	my $cookie= CGI::Cookie->new(-name => 'FightingFantasy.net Cookie Test',
					-value => 'anything',
					-secure => 1
					-httponly => 1
					);			
	print "Set-Cookie: $cookie\n";
	## check if it exists
	my %cookies = CGI::Cookie->fetch;
	if($cookies{'FightingFantasy.net Cookie Test'}){
		# print $query->header();
		# print "Cookies enabled... Attempting to create guest account...";
		return 1;
	}
	else{
		print $query->header();
### !!! make this page pretty
		print "Hello!  It appears this is your first ever visit to FightingFantasy.net gamesystem Please ensure you have cookies enabled before continuing to use the site! <a href=\"https://fightingfantasy.net/gamebooks/account.cgi\">Continue...</a>";
		return 0;
	}
}

sub generate_guest_session_cookie{
	my $user=shift;
	## generate digest from seed and timestamp, store digest and user name in cookie, store timestamp in session file
	my $timestamp=time;
	&set_cookie($user, &get_digest($timestamp));
	
	## store session timestamp

	open(SESSION, ">Accounts/$user/session.txt") or die "failed to create session file: $!";
	print SESSION $timestamp;
	close SESSION;
	my $mode = 0640;
	chmod $mode, "/home/figh/public_html/gamebooks/Accounts/$user/session.txt";
}

sub get_digest{
	my $timestamp=shift;

	## read constant seed - ust use inline constant for now
	my @data =('ohnoesyouhazhax0redmehcall teh Pentagon',$timestamp);
	
	## construct digest from seed and timestamp - note this must be awful security since timestamp is common and all they have to regex on hacking it is a x-digit long numerical string.... but hey
	my $digest=sha1_hex(@data);
	return $digest;
}

sub set_cookie{
	my $user=shift;
	my $digest=shift;
	
	my $cookie= CGI::Cookie->new(-name => 'FightingFantasy.net Session',
					-value => $digest,
					-secure => 1
					-httponly => 1
					);
	
	my $cookie2= CGI::Cookie->new(-name => 'FightingFantasy.net ID',
					-value => $user,
					-secure => 1
					-httponly => 1
					);
					
	print "Set-Cookie: $cookie\n";
	print "Set-Cookie: $cookie2\n";
}

sub create_guest_account{
	my $username=shift;
	
	%InfoNames = ("Title" => "Title","TitleOther" => "Other Title","FirstName" => "First Name",
		"LastName" => "Last Name", "HouseNumber" => "House Number or Name", "Street" => "Street",
		"City" => "Town or City", "County" => "County or Province", "Country" => "Country",
		"Postcode" => "Postcode or ZIP", "DOBDay" => "Day", "DOBMonth" => "Month", "DOBYear" => "Year",
		"Sex" => "Sex", "Email" => "Email", "UserName" => "User Name", "Password" => "Password",
		"ConfPass" => "Confirm Password", "Question" => "Password Question",
	"Answer" => "Password Answer");
	
	#create user directory and account file
	mkdir "Accounts/$username" or die "cannot create User Directory: $!";
	open (ACCT, ">Accounts/$username/account.txt") || die "cant open account file: $!";
	foreach $key (keys %InfoNames)
	{
		if($key eq "UserName"){
			print ACCT "$InfoNames{$key}=$username\n";
		}
		else{
			print ACCT "$InfoNames{$key}=\n";
		}
	}
	close ACCT;
	
	my $mode = 0640;
	chmod $mode, "/home/figh/public_html/gamebooks/Accounts/$username/account.txt";
	
	#create bookmarks directory and current book file
	mkdir "Accounts/$username/Bookmarks";
	open (CURRENTBOOK, ">Accounts/$username/Bookmarks/currentbook.txt") || die "cant open current book file: $!";
	print CURRENTBOOK "NONE";
	close CURRENTBOOK;
	mkdir "Accounts/$username/Bookmarks/hosted";
	mkdir "Accounts/$username/MyBooks"; ## not to be used until user converts
	mkdir "Accounts/$username/MyLibrary"; ## not to be used until user converts
	
	open (ACCT, ">Accounts/$username/acct_type.txt") || die "cant open account type file: $!";
	print ACCT "GUEST";
	close ACCT;
	
	return 1;
}

sub repeat_attempt_checker{ ## rudimentary, add captcha one day
## returns 0 for acceptible attempt, returns the IP address if attempt is unacceptible
### make comment list of all IP addresses that should be timestamped PERMANENT, e.g. 127.0.0.1
## note this routine DOES NOT reset the attempt timer to 5 minutes, it allows a new account every 5 minutes from an IP address.  It should be fairly easy to actually force the user to wait 5 minutes after EVERY attempt though

	my %iploghash,$ip,$timestamp;
	
	open(IPLOG, "<Accounts/IPLOG.txt") || die "unable to open IP logging please notify webmaster of this critical failure"; ## add mail to self
	while(<IPLOG>){
		chomp;
		($timestamp,$ip)= split(/\=/,$_);
		$iploghash{$ip}=$timestamp;
	}
	close IPLOG;
	
	## if a timestamp already exists for remote IP address and the timestamp is excluded, return the IP address
	if($iploghash{$query->remote_addr()} and &timestamp_is_unacceptible($iploghash{$query->remote_addr()})){
		return $query->remote_addr();
	}
	else{
		open(IPLOG, ">Accounts/IPLOG.txt") or die "failed to open logfile";
		foreach $key (keys %iploghash){
			if(&timestamp_is_unacceptible($iploghash{$key})){
				print IPLOG $iploghash{$key}."=".$key."\n";
			}
		}
		
		my $current_time=time();
		print IPLOG "$current_time"."=".$query->remote_addr();
		close IPLOG;
		
		return 0;
	}
}

sub timestamp_is_unacceptible{
	my $timestamp=shift;
	my $current_time=time();
	if($timestamp eq 'PERMANENT'){
		return 1;
	}
	elsif(($current_time-$timestamp) < 300){ ## 300 == 5 minute minimum wait between guest account creation allowed
		return 1;
	}
	else{
		return 0;
	}
}