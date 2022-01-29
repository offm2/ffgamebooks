<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="A place to play gamebooks online in the fighting fantasy style">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks"> 
<meta name="robots" content="all">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adventure's Rating!</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../feed.xml" rel="alternate" type="application/rss+xml" title="What's New on the fanbooks website" />
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_RIGHT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body>
<?php include_once("../analytics_google.php"); ?>
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
<div class="container">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site </h3>
    <h4>Rate the adventures</h4>
<p><img src="../images/2.gif" class="img-circle" alt="intro image"></p>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dp1" data-toggle="dropdown">
    Dropdown
    <span class="glyphicon glyphicon-arrow-down"></span>
  </button>
<ul class="dropdown-menu">
<?php include_once("../menu2.php"); ?>
</ul>
</div>
  </div>
<div class="col-sm-12">
<?php
echo"<div id='rt1'>";
$rater_id=1;
$rater_item_name='adventure 1 - Feathers of the Phoenix';
include("rater.php");
echo"</div><div id='rt2'>";
$rater_id=2;
$rater_item_name='adventure 2 - Quest for the Ebony Wand';
include("rater.php");
echo"</div><div id='rt3'>";
$rater_id=3;
$rater_item_name='adventure 3 - Kill the Beast';
include("rater.php");
echo"</div><div id='rt4'>";
$rater_id=4;
$rater_item_name='adventure 4 - Curse of Blackwood Manor';
include("rater.php");
echo"</div><div id='rt5'>";
$rater_id=5;
$rater_item_name='adventure 5 - The Presence of a hero';
include("rater.php");
echo"</div><div id='rt6'>";
$rater_id=6;
$rater_item_name='adventure 6 - Legacy of the Vampire';
include("rater.php");
echo"</div><div id='rt7'>";
$rater_id=7;
$rater_item_name='adventure 7 - Venom of Vortan';
include("rater.php");
echo"</div><div id='rt8'>";
$rater_id=8;
$rater_item_name='adventure 8 - Rise of the Night Creatures';
include("rater.php");
echo"</div>";
?>
</div>
	
<div class="footer">
<?php include_once("../footer3.php"); ?>
</div>
</div>