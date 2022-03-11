<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="A place to play gamebooks online in the fighting fantasy style">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks,dictionary, amateur gamebooks"> 
<meta name="robots" content="all">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Dictionary!</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">  
<link href="1.css" rel="stylesheet" type="text/css" />
<link href="feed.xml" rel="alternate" type="application/rss+xml" title="What's New on  play FF fan adventures website" />
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


  <script>
  $(function() {

      var t = [
	  "Titan","Port Blacksand"
	  ];
	 
    $( "#word" ).autocomplete({
      source: t,
      minLength: 1
    });
  });
  </script>
</head>
<body>
<?php include_once("analytics_google.php"); ?>
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
<div class="container">
  <div class="jumbotron">
<h3>Fighting Fantasy Dictionary </h3>
    <h4>Words and respective meaning</h4>
<p><img src="images/2.gif" class="img-circle" alt="intro image"></p>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    Dropdown
    <span class="glyphicon glyphicon-arrow-down"></span>
  </button>
<ul class="dropdown-menu">
<?php include_once("menu.php"); ?>
</ul>
</div>
  </div>

<div class="col-sm-12">
<form action="<?php echo"$_SERVER[PHP_SELF]";?>" method="post">
<p><label for="word">Word: </label> <input type="text" name="word" id="word" ><input type="submit" value="Show"></p>
<?php
if(isset($_POST["word"])){
 include("dictionary/view.php");
 }
 ?>
</form>
</center>
<h5>This is a work in progress, so not many words have been added to the project so far.</h5>
<h5>If you have any words and meanings that should be here, please send your suggestions to the site's <a href="mailto:default@fanbooks.fightingfantasy.net">email</a></h5>
<h5>Fighting Fantasy is a trademark owned by Ian Livingstone and Steve Jackson</h5>


	                  
</div>
<div class="footer">
<?php include_once("footer3.php"); ?>
</div>
</div>