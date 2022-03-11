use CGI qw(-utf8);
use open IO => ':utf8';

sub generate_chart{

	my $user=shift;
	my $book=shift;
	my $missing_links_request=shift;

	my $dot;
	my %linked;
	my $dot_generation_result=&generate_dot($user, $book, \$dot, \%linked);
	
	
	if($dot_generation_result == 0){

		print $query->header;
		$dot=~s/\n/\<br \/\>/g;
		print $dot;

		if($missing_links_request){
		
		print "<br /><br /> Missing Links:<br />";
			foreach(keys(%linked)){
				if(($linked{$_}!=1)){
					print "Reference: '$_' has no inbound link<br />";
				}
			}
		}
		#my $chart;
		#my $chart_generation_result=&make_chart($dot, \$chart);
		#
		# if($chart_generation_result == 0){
		#	print $query->header( -type=>'application/octet-stream'
		#				, -expires=>'now'
		#				, -Content_Disposition=>"attachment; filename=$book.pdf"
		#	);
		#	print $chart;
		#}
		#else{ ## display the chart generation error message
		#
		#}
	}
	else{ ## display the dot generation error message
		print $query->header;
		print $dot_generation_result;
	}
}

sub generate_dot{
	my $user=shift;
	my $book=shift;
	my $dot=shift;
	my $linked=shift;
	my $start=shift;
	my @excludes=@_;
	my %excludes;
	
	if($#excludes){
		foreach $exclude (@excludes){
			$excludes{$exclude}=1;
		}
	}
	$excludes{"."}=1;
	$excludes{".."}=1;
	$excludes{"implementation"}=1;
	$excludes{"charsheet"}=1;
	$excludes{"credits"}=1;
	
	if($start){
		return "Reference Crawling not yet implemnted";
	}
	else{ ## open entire book directory directory and do every reference (possibly dangerous need to limit somehow
		
		opendir REFS, "Accounts/$user/MyBooks/$book/refs" or return "cannot open $book directory:$!";
		while($ref = readdir REFS){
			my $ref_name=$ref;
			$ref_name=~s/\.txt$//;
			if($excludes{$ref_name} != 1){
				$$dot.="\"".$ref_name."\" -> {".&get_transformed_turn_to_list($ref,$book,$user,$linked)."}\n";
				if(!($$linked{$ref_name})){
					$$linked{$ref_name}='0';
				}
			}
		}
		closedir REFS;
	}
	$$dot="digraph G{\n".$$dot."}";
	return 0;
}

sub make_chart{

}

sub get_transformed_turn_to_list{

	my $ref=shift;
	my $book=shift;
	my $user=shift;
	my $linked=shift;
	my $link_list;
	
	if(open(REF, "<Accounts/$user/MyBooks/$book/refs/$ref")){
		while(<REF>){
			my @matches=($_=~/\<\s*ttr*\s+[^\>]*ref\s*\=\s*\"([\w\s\_\-]+)\"\s*[^\>]*\>/gi);
			foreach $match (@matches){
				$link_list.="\"".$match."\";";
				if($match){
					$$linked{$match}=1;
				}
			}
		}
		close REF;
	}
	else{
		$link_list.= "/* failed to open reference $ref */";
	}
	return $link_list;
}

1;