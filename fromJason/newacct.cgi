#!/usr/bin/perl
use CGI::Carp qw(fatalsToBrowser);
use CGI;
# use CGI qw(-utf8);
# use open IO => ':utf8';
$query = new CGI;

####################################################################################################
### newacct.cgi - Page for collecting new user information, validates input and creates a new account
### necessary directories and files etc. and redirects to login page, if data is acceptable,
### redisplays form with error message(s) otherwise.
####################################################################################################

%InfoNames = ("Title" => "Title","TitleOther" => "Other Title","FirstName" => "First Name",
	"LastName" => "Last Name", "HouseNumber" => "House Number or Name", "Street" => "Street",
	"City" => "Town or City", "County" => "County or Province", "Country" => "Country",
	"Postcode" => "Postcode or ZIP", "DOBDay" => "Day", "DOBMonth" => "Month", "DOBYear" => "Year",
	"Sex" => "Sex", "Email" => "Email", "UserName" => "User Name", "Password" => "Password",
	"ConfPass" => "Confirm Password", "Question" => "Password Question",
	"Answer" => "Password Answer");

%Required = ("DOBYear"=>1,"DOBMonth"=>1,"DOBDay"=>1,"UserName" => 1, "Question" => 1,"Answer" => 1,"Email" =>1);

@Titles = ("Mr","Mrs","Miss","Ms","Dr","Other...");
@Months = ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
@Questions = ("Pets Name", "Spouses Name", "Mothers Maiden Name");

$OldestAge = 120;
$DefaultAge = 20;
@todaysdate=gmtime(time);
$ThisYear=$todaysdate[5]+1900;

#$DOBDaySelected = 1;
#$DOBMonthSelected=$Months[0];
#$DOBYearSelected = $ThisYear-$DefaultAge;

$TitleSelected=$Title[0];
$SexSelected = "Male";
$QuestionSelected = $Questions[0];

$ValidData = 0;
@errors;

open (SCRIPTLOC, "perl_scriptlocation.txt") or die "Failed to open script location file: $!";
my $perl_scriptlocation=<SCRIPTLOC>;
chomp $perl_scriptlocation;
close SCRIPTLOC;

print $query->header;

print "\n\n\n\n<!-- -------------------------- BEGIN: ff.net Script generated text ------------------------------------------- -->";

# validate user input, set error flag (ValidData) and html form elements value tags for correct input
if ($query->param('UserName')) 
{
	$ValidData = 1;
	
	# get all the parameters from query object in to a more usable variable
	# also tests for existence of data of some kind in required fields
	foreach (keys %InfoNames)
	{
		$UserData{$_} = $query->param($_);
		if ( (defined ($Required{$_})) && ($UserData{$_} eq "") )
		{
			push @errors,"Field $InfoNames{$_} required and not completed<br />";
			$ValidData = 0;
		}
	}
	# check username isnt nasty
	if( ($UserData{'UserName'}=~/[^\w-\.\@\_]/) or ($UserData{'Email'}=~/[^\w-\.\@\_]/) or ($UserData{'Password'}=~/[^\w-\.\@\_]/) or ($UserData{'UserName'}=~/\_guest.*/))
	{
		push @errors,"No characters other than A-Z, a-z, 0-9, @symbol, hyphens (-) underscores (_) and periods(.) are allowed in a username, password or email at this time";
		$ValidData=0;
	}
	if(length $UserData{'UserName'} < 6)
	{
		push @errors,"Username must be 6 chracters or longer";
		$ValidData=0;
	}
	# check for duplicate usernames
	if ($UserData{'UserName'} ne "")
	{
		if (-d "Accounts/$UserData{'UserName'}" or $UserData{'UserName'}=~/^Guest\d+$/){
			push @errors, "That Username already taken<br />";
			$query->param('UserName','');
			$ValidData = 0;
		}
	}
	## check passwords match
	if ($UserData{'Password'} ne $UserData{'ConfPass'})
	{
		print "Passwords do not match<br />";
		$ValidData = 0;
	}
	##check for a valid email address regexp: /^[\w.-]+\@([\w.-]\.)+\w+$/ or  http://search.cpan.org/search?dist=Email-Valid
	#check for valid DOB
	
	#if($ValidData){
		## update the Wordpress User Database
		#my $user=$UserData{"UserName"};
		#my $email=$UserData{"Email"};
		#my $password=$UserData{"Password"};

		#my $return_result="Great Success";
		## `/usr/local/bin/php add_account_to_wp.php $user $email $password`;


		## my $return_result=;
		#system("php", "add_account_to_wp.php", $user, $email, $password);
		#if($return_result ne "Great Success"){
		#	$ValidData=0;
		#	push @errors, "Error updating WP database: $return_result end of errors";
		#}
	#}
}

# otherwise set default html form elements value tags
else
{
	
}


if ($ValidData) # if data was correctly entered write data to relevant files and refer to confirmation page
{
	#create user directory and account file
	mkdir "Accounts/$UserData{'UserName'}" or die "cannot create User Directory: $!";
	open (ACCT, ">Accounts/$UserData{'UserName'}/account.txt") || die "cant open account file: $!";
	foreach $key (keys %InfoNames)
	{
		print ACCT "$InfoNames{$key}=$UserData{$key}\n";
	}
	close ACCT;
	
	my $mode = 0640;
	chmod $mode, "/home/figh/public_html/gamebooks/Accounts/$UserData('UserName')/account.txt";
	
	#create bookmarks directory and current book file
	mkdir "Accounts/$UserData{'UserName'}/Bookmarks";
	open (CURRENTBOOK, ">Accounts/$UserData{'UserName'}/Bookmarks/currentbook.txt") || die "cant open current book file: $!";
	print CURRENTBOOK "NONE";
	close CURRENTBOOK;
	mkdir "Accounts/$UserData{'UserName'}/Bookmarks/hosted";
	mkdir "Accounts/$UserData{'UserName'}/MyBooks";
	mkdir "Accounts/$UserData{'UserName'}/MyLibrary";	
	
	#confirmation to user
	print '<p>Thankyou.  If your browser does not redirect you <a href="http://www.fightingfantasy.net">Click here to Return to FightingFantasy.Net main page</a></p>';
	print '<script type="text/javascript">';
	print 'window.location="http://www.fightingfantasy.net/new-account-confirmation"';
	print '</script>';
}

else # print form if there was some invalid data or if this is the first invocation of page
{

	if (@errors){
		print "<p>Errors:";
		foreach (@errors){
			print $_ . "<br />";
		}
		print "</p>";
	}


print '<form method="post" action="newacct.cgi" enctype="multipart/form-data" name="new account">';

print "Please enter the following information.  Only those fields marked with a * are required.<br />  Note you must provide a valid e-mail address as your password will be emailed to you.";

print "<Table border = \"0\">";

print "<tr>";
print "<td>Title:</td>";
print "<td>";
print $query->popup_menu('Title',\@Titles,$TitleSelected);
print "</td>";
print "</tr>";

print "<tr>";
print "<td>If you selected Other for Title please enter here:</td>";
print "<td>";
print $query->textfield('TitleOther');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>First Name:</td>";
print "<td>";
print $query->textfield('FirstName');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>Last Name:</td>";
print "<td>";
print $query->textfield('LastName');
print "</td>";
print "</tr>";

=begin comment
print "<tr>";
print "<td>House Name or Number:</td>";
print "<td>";
print $query->textfield('HouseNumber');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>Street:</td>";
print "<td>";
print $query->textfield('Street');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>Town or City:</td>";
print "<td>";
print $query->textfield('City');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>County/Province:</td>";
print "<td>";
print $query->textfield('County');
print "</td>";
print "</tr>";
=end comment
=cut

print "<tr>";
print "<td>Country:</td>";
print "<td>";
print $query->popup_menu('Country',[
"Afghanistan",
"Albania",
"Algeria",
"American Samoa",
"Andorra",
"Angola",
"Anguilla",
"Antarctica",
"Antigua and Barbuda",
"Argentina",
"Armenia",
"Aruba",
"Australia",
"Austria",
"Azerbaijan",
"Bahamas",
"Bahrain",
"Bangladesh",
"Barbados",
"Belarus",
"Belgium",
"Belize",
"Benin",
"Bermuda",
"Bhutan",
"Bolivia",
"Bosnia and Herzegovina",
"Botswana",
"Bouvet Island",
"Brazil",
"British Indian Ocean territory",
"Brunei Darussalam",
"Bulgaria",
"Burkina Faso",
"Burundi",
"Cambodia",
"Cameroon",
"Canada",
"Cape Verde",
"Cayman Islands",
"Central African Republic",
"Chad",
"Chile",
"China",
"Christmas Island",
"Cocos (Keeling) Islands",
"Colombia",
"Comoros",
"Congo",
"Congo, Democratic Republic",
"Cook Islands",
"Costa Rica",
"C&ocirc;te d'Ivoire (Ivory Coast)",
"Croatia (Hrvatska)",
"Cuba",
"Cyprus",
"Czech Republic",
"Denmark",
"Djibouti",
"Dominica",
"Dominican Republic",
"East Timor",
"Ecuador",
"Egypt",
"El Salvador",
"Equatorial Guinea",
"Eritrea",
"Estonia",
"Ethiopia",
"Falkland Islands",
"Faroe Islands",
"Fiji",
"Finland",
"France",
"French Guiana",
"French Polynesia",
"French Southern Territories",
"Gabon",
"Gambia",
"Georgia",
"Germany",
"Ghana",
"Gibraltar",
"Greece",
"Greenland",
"Grenada",
"Guadeloupe",
"Guam",
"Guatemala",
"Guinea",
"Guinea-Bissau",
"Guyana",
"Haiti",
"Heard and McDonald Islands",
"Honduras",
"Hong Kong",
"Hungary",
"Iceland",
"India",
"Indonesia",
"Iran",
"Iraq",
"Ireland",
"Israel",
"Italy",
"Jamaica",
"Japan",
"Jordan",
"Kazakhstan",
"Kenya",
"Kiribati",
"Korea (north)",
"Korea (south)",
"Kuwait",
"Kyrgyzstan",
"Lao People's Democratic Republic",
"Latvia",
"Lebanon",
"Lesotho",
"Liberia",
"Libyan Arab Jamahiriya",
"Liechtenstein",
"Lithuania",
"Luxembourg",
"Macao",
"Macedonia, Former Yugoslav Republic Of",
"Madagascar",
"Malawi",
"Malaysia",
"Maldives",
"Mali",
"Malta",
"Marshall Islands",
"Martinique",
"Mauritania",
"Mauritius",
"Mayotte",
"Mexico",
"Micronesia",
"Moldova",
"Monaco",
"Mongolia",
"Montserrat",
"Morocco",
"Mozambique",
"Myanmar",
"Namibia",
"Nauru",
"Nepal",
"Netherlands",
"Netherlands Antilles",
"New Caledonia",
"New Zealand",
"Nicaragua",
"Niger",
"Nigeria",
"Niue",
"Norfolk Island",
"Northern Mariana Islands",
"Norway",
"Oman",
"Pakistan",
"Palau",
"Palestinian Territories",
"Panama",
"Papua New Guinea",
"Paraguay",
"Peru",
"Philippines",
"Pitcairn",
"Poland",
"Portugal",
"Puerto Rico",
"Qatar",
"R&eacute;union",
"Romania",
"Russian Federation",
"Rwanda",
"Saint Helena",
"Saint Kitts and Nevis",
"Saint Lucia",
"Saint Pierre and Miquelon",
"Saint Vincent and the Grenadines",
"Samoa",
"San Marino",
"Sao Tome and Principe",
"Saudi Arabia",
"Senegal",
"Serbia and Montenegro",
"Seychelles",
"Sierra Leone",
"Singapore",
"Slovakia",
"Slovenia",
"Solomon Islands",
"Somalia",
"South Africa",
"South Georgia and the South Sandwich Islands",
"Spain",
"Sri Lanka",
"Sudan",
"Suriname",
"Svalbard and Jan Mayen Islands",
"Swaziland",
"Sweden",
"Switzerland",
"Syria",
"Taiwan",
"Tajikistan",
"Tanzania",
"Thailand",
"Togo",
"Tokelau",
"Tonga",
"Trinidad and Tobago",
"Tunisia",
"Turkey",
"Turkmenistan",
"Turks and Caicos Islands",
"Tuvalu",
"Uganda",
"Ukraine",
"United Arab Emirates",
"United Kingdom",
"United States of America",
"Uruguay",
"Uzbekistan",
"Vanuatu",
"Vatican City",
"Venezuela",
"Vietnam",
"Virgin Islands (British)",
"Virgin Islands (US)",
"Wallis and Futuna Islands",
"Western Sahara",
"Yemen",
"Zaire",
"Zambia",
"Zimbabwe",
"Other (not listed)"]
,'United Kingdom');
print "</td>";
print "</tr>";

=begin comment
print "<tr>";
print "<td>Postcode:</td>";
print "<td>";
print $query->textfield('Postcode');
print "</td>";
print "</tr>";
=end comment
=cut


print "<tr>";
print "<td>*Date Of Birth:</td>";
print "<td>";
print $query->popup_menu('DOBDay',[1 .. 31],$DOBDaySelected);
print $query->popup_menu('DOBMonth',\@Months,$DOBMonthSelected);
print $query->popup_menu('DOBYear',[($ThisYear-$OldestAge) .. $ThisYear],$DOBYearSelected);
print "</td>";
print "</tr>";

print "<tr>";
print "<td>Gender:</td>";
print "<td>";
print $query->popup_menu('Sex',['Male','Female'],$SexSelected);
print "</td>";
print "</tr>";

print "<tr>";
print "<td>*Email:</td>";
print "<td>";
print $query->textfield('Email');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>*UserName:</td>";
print "<td>";
print $query->textfield('UserName');
print "</td>";
print "</tr>";

## =begin comment
print "<tr>";
print "<td>*Password:</td>";
print "<td>";
print $query->password_field('Password');
print "</td>";
print "</tr>";

print "<tr>";
print "<td>*Confirm Password:</td>";
print "<td>";
print $query->password_field('ConfPass');
print "</td>";
print "</tr>";
## =end comment
## =cut

print "<tr>";
print "<td>*Please select a question we can ask you in case you forget your password:</td>";
print "<td>";
print $query->popup_menu('Question',\@Questions,$QuestionSelected);
print "</td>";
print "</tr>";

print "<tr>";
print "<td>*Please enter the answer:</td>";
print "<td>";
print $query->textfield('Answer');
print "</td>";
print "</tr>";

print "</table>";

print<<"print_tag";
  <p> 
    <input type="submit" name="Submit" value="Submit">
    <input type="reset" name="Reset" value="Reset">
  </p>
</form>
print_tag
}

# end page


print "\n\n\n\n<!-- -------------------------- END: ff.net Script generated text ------------------------------------------- -->";
