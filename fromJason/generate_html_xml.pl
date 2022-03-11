use CGI qw(-utf8);
use open IO => ':utf8';

sub generate_html_xml{
	my $user=shift;
	my $book=shift;
	my $filetype=shift;
	my $singlefile=shift;
	my @excludes=@_;
	
	push @excludes,".","..";
	
	print $query->header( -type=>'text/download+xhtml'
				, -expires=>'now'
				, -Content_Disposition=>"attachment; filename=$book.xhtml"
				, -downloadname=>"$book.xhtml"
				);
	
print<<"print_tag";
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
<title>$book</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="index" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

</head>

<body>

<h1>$book</h1><br />
<h2>by $user</h2><br />

print_tag
	
	foreach $ref(&get_sorted_reflist($user,$book,@excludes)){
	
		if(open(REF, "<Accounts/$user/MyBooks/$book/refs/$ref.txt")){
		
			print "\n\n<h2><a name=\"$ref\">$ref</a></h2><br />";
		
			while(<REF>){
				# tt to anchors
				$_=~s/\<\s*tt\s+ref\s*\=\s*\"([\w\s\_\-]+)\"\s*\>/\<a href\=\"\#\1\"\>/gi;
				$_=~s/\<\/tt\>/<\/a\>/gi;
				
				# all other abml
				
				# remove open tags
				$_=~s/\<\s*event[^\>]*\>//gi;
				$_=~s/\<\s*script[^\>]*\>//gi;
				$_=~s/\<\s*option[^\>]*\>//gi;
				$_=~s/\<\s*if[^\>]*\>//gi;
				$_=~s/\<\s*else[^\>]*\>//gi;
				$_=~s/\<\s*info[^\>]*\>//gi;
				$_=~s/\<\s*include[^\>]*\>//gi;
				$_=~s/\<\s*external[^\>]*\>//gi;
				$_=~s/\<\s*bookend[^\>]*\>//gi;
				$_=~s/\<\s*tti[^\>]*\>//gi;
				
				#remove close tags
				$_=~s/\<\/\s*event[^\>]*\>//gi;
				$_=~s/\<\/\s*script[^\>]*\>//gi;
				$_=~s/\<\/\s*option[^\>]*\>//gi;
				$_=~s/\<\/\s*if[^\>]*\>//gi;
				$_=~s/\<\/\s*else[^\>]*\>//gi;
				$_=~s/\<\/\s*info[^\>]*\>//gi;
				$_=~s/\<\/\s*include[^\>]*\>//gi;
				$_=~s/\<\/\s*external[^\>]*\>//gi;
				$_=~s/\<\/\s*bookend[^\>]*\>//gi;
				
				# newlines to line breaks
				$_=~s/\n/\<br \/\>/gi;
				
				# MS 'smartquotes' and other custom character html entity replacements
				s/\x91/\&\#8216\;/g; # curly smart apostrophe left
				s/\x92/\&\#8217\;/g; # curly smart apostrophe right
				s/\x93/\&\#8220\;/g; # curly smart quotes left
				s/\x94/\&\#8221\;/g; # curly smart quotes right
				s/\x96/\-/g;
				
				# unicode smartquotes
				s/\xe2\x80\x9c/\&\#8220\;/g;  # straight smart quotes left
				s/\xe2\x80\x9d/\&\#8221\;/g;  # straight smart quotes right
				s/\xe2\x80\x98/\&\#8216\;/g;  # straight smart apostrophe left
				s/\xe2\x80\x99/\&\#8217\;/g;  # straight smart apostrophe right
	
				print;
			}
			close REF;
			print "<br /><br /><br />";
		}
		else{
			print "<br /><br />/* failed to open reference $ref */<br /><br />";
		}
	}
	
	print "</body></html>";
}


sub get_sorted_reflist{
	my $user=shift;
	my $book=shift;
	my @excludes=@_;

	my $ref,@reflist,%excludes;
	
	if($#excludes){
		foreach $exclude (@excludes){
			$excludes{$exclude}=1;
		}
	}	

	opendir REFS, "Accounts/$user/MyBooks/$book/refs" or return "cannot open $book directory:$!";
	while($ref = readdir REFS){
		my $ref_name=$ref;
		$ref_name=~s/\.txt$//;
		if($excludes{$ref_name} != 1){
			push (@reflist, $ref_name);
		}
	}
	closedir REFS;

	return sort {$a <=> $b} @reflist;
}

1;