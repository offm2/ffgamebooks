<?php session_start();
$_SESSION["forca"]=mt_rand(2,12) + 12;
$_SESSION["pericia"]=mt_rand(1,6) + 6;
$_SESSION["sorte"]=mt_rand(1,6) + 6;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Character's Creation!</title>
<link href="../1.css" rel="stylesheet" type="text/css" />

<link href="../feed.xml" rel="alternate" type="application/rss+xml" title="What's New on  play FF fan adventures website" />
<link rel="canonical" href="http://fanbooks.fightingfantasy.net" />
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
<!--random names-->
<script type="text/javascript" src="../js/name_generator.js"></script>
<script type="text/javascript" src="../js/english_set.js"></script>
<script type="text/javascript" src="../js/getname2.js"></script>
</head>
<body onLoad="javascript:ger4()";>
<?php include_once("../analytics_google.php"); ?>
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
<div class="container">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site </h3>
    <h4>Adventurer Name and characteristics</h4>
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
<form name="f4" method="POST" action="index2.php">
<p><label class="control-label">Character name:</label> <input type="text" size=15 name='nome' maxlength="15">
<?php 
echo"<p><label class='control-label'>Skill : </label><input type='text' value='{$_SESSION["pericia"]}'></p>";
echo"<p><label class='control-label'>Stamina : </label><input type='text' value='{$_SESSION["forca"]}'></p>";
echo"<p><label class='control-label'>Luck : </label><input type='text' value='{$_SESSION["sorte"]}'></p>"; 
?>
<p class="submit"><b><input type="submit" value="Start Adventure"><input type="button" onclick="javascript:location.reload(true);" value="Make new character"></b></p></p>
</form>
</div>
	
<div class="footer">
<?php include_once("../footer3.php"); ?>
</div>
</div>

