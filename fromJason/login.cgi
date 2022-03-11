#!/usr/bin/perl

use cPanelUserConfig;
use Facebook::OpenGraph;
use CGI::Carp qw(fatalsToBrowser);
use CGI::Simple::Cookie;
use CGI;
# use Catalyst;
use File::Path;
use Digest::SHA1 qw(sha1_hex sha1_base64);
require "authenticate.pl";

use utf8;
binmode STDOUT, ':encoding(UTF-8)';
binmode STDIN, ':encoding(UTF-8)';

$query = new CGI;
# $c=new Catalyst;

## if login data supplied
if($query->param('user')){
	my $passcheck=&verify_username;
	if($passcheck==1){
		&generate_session_cookie;
		
		## redirect to account here - though this MIGHT KILL COOKIE SETTING
		print $query->header();print "Thankyou - please proceed to <a href=\"account.cgi\">your account</a>";
	}
	else{
		if($passcheck==2){
			$failure_message="Your fightingfantasy.net account is old and needs to be updated to our new system.  Please contact the webmaster of fightingfantasy.net to have it manually updated";
		}
		else{
			$failure_message="Username/Password incorrect";
			sleep 5;  ## crude brute force prevention
		}
	}
}

if(($failure_message) or($query->param('user') eq '')){

	print $query->header();
	print<<"print_tag";
<html>
<head>
</head>
<body>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '848625731860569',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Hello, ' + response.name + '!';
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>



print_tag

	print '<form method="post" action="login.cgi" enctype="multipart/form-data" name="login">';

	print "$failure_message<br />";

	print "Username:".$query->textfield('user');
	print "Password:".$query->password_field('pass');

	print<<"print_tag";
	  <p> 
	    <input type="submit" name="Submit" value="Submit">
	    <input type="reset" name="Reset" value="Reset">
	  </p>
	</form>
</body>
</html>
print_tag

}
	my $fb = Facebook::OpenGraph->new(+{
		app_id       => 848625731860569,
		secret       => '99f8a74fef0a60aa77d0dc5242630a1a',
		namespace    => 'fbgamebookstest',
		redirect_uri => 'https://fightingfantasy.net/gamebooks/login.cgi'
	  });
	  
	my $app_token_ref =$fb->get_app_token;
	$fb->set_access_token($app_token_ref);
	  
	my %cookies = CGI::Simple::Cookie->fetch;
	my $cookie;
	if (($cookies{ $fb->js_cookie_name })  && ($cookie=$cookies{ $fb->js_cookie_name }->value)) {
	# if (my $cookie = $c->req->cookie( $fb->js_cookie_name )) {
		# User is not logged in yet, but cookie is set by JS SDK on previous visit.
		my $token_ref;
		eval{$token_ref = $fb->get_user_token_by_cookie($cookie)};
		unless ($@){
			if($token_ref){
				$fb->set_access_token($token_ref->{access_token});
				my $fbID=$fb->fetch('me');
				foreach $key( keys %{$fbID}){
					print "$key : ".${$fbID}{$key}."<br />";
				}
				foreach $key(keys %{$token_ref}){
					print "$key=".${$token_ref}{$key}."<br />";				
				}
				# my $res = $fb->publish_action('Post', +{achievement => '350162835183384'});
				# print "res=";
				# foreach $key( keys %{$res}){
				# 	print "$key : ".${$res}{$key}."<br />";
				# }
		  	}
		  	else{
		  		print "Token Ref not set";
		  	}
		}
		else{
			print $@;
		}
	}
	else{
		print "No FB cookie found";
	}
###########################################################################################

sub verify_username{

	my $url_user=$query->param('user');

	## check username passed in query string
	if (defined($url_user)){
		## check username isn't nasty
		if($url_user=~/[^\w-\.\@\_]/){  ## alert - unsure of that regex. safety...
			print $query->header;
			print "User Name not recognised (2)";
			return 0;
		}
		## check user exists in play area folders
		my $directory="Accounts/".$url_user;
		if(-d $directory ){
			$user=$url_user;
			return &check_password($user);  ## duplicated except this that is
		}
		else{
			print $query->header;
			print "User Name '$url_user' not recognised (3)";
			return 0;		
		}
	}
	else{
		print $query->header;
		print "User Name not recognised (1)";
		return 0;
	}
	##... to here
}


sub check_password($user){
	if(-e "Accounts/$user/account.txt"){
		open(ACCOUNT, "<Accounts/$user/account.txt") or die "failed to open account file: $!";
		while(<ACCOUNT>){
			if(/^Password=(.*)$/){
				if($1 eq $query->param('pass')){
					close ACCOUNT;
					return 1;
				}
				else{
					close ACCOUNT;
					return 0;
				}
			}
		}
		close ACCOUNT;
		die "Password not found in file";
	}
	else{
		return 2;
	}
}

sub generate_session_cookie{
	## generate digest from seed and timestamp, store digest and user name in cookie, store timestamp in session file
	my $timestamp=time;
	
	&set_cookie(&get_digest($timestamp));
	
	## store session timestamp
	my $user=$query->param('user');
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
	my $digest=shift;
	
	my $cookie= CGI::Cookie->new(-name => 'FightingFantasy.net Session',
					-value => $digest,
					-secure => 1
					-httponly => 1
					);
	
	my $cookie2= CGI::Cookie->new(-name => 'FightingFantasy.net ID',
					-value => $query->param('user'),
					-secure => 1
					-httponly => 1
					);
					
	print "Set-Cookie: $cookie\n";
	print "Set-Cookie: $cookie2\n";
}