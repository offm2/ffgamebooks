<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="A place to play gamebooks online in the fighting fantasy style">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks,comments"> 
<meta name="robots" content="all">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gamebooks Comment Box!</title>
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
  <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

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
<h3>Site comment box</h3>
    <h4>Site comments</h4>
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
<!--display guestbook-->
<h3>Comments Section</h3>
<a href="simple_guestbook/" target="_blank">A simple guestbook</a>
<script>
var idcomments_acct = '38732c669d4bc5e900164aa49bcec759';
var idcomments_post_id;
var idcomments_post_url;
</script>
<span id="IDCommentsPostTitle" style="display:none"></span>
<script type='text/javascript' src='https://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>                
<h4>---Or try using the new feature the Facebook Comments System---</h4>
<?php include_once("add_facebook.htm");?>
<div class="fb-page" data-href="https://www.facebook.com/TinManGames/" data-tabs="timeline,events,messages" data-width="240" data-height="480" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/TinManGames/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/TinManGames/">Tin Man Games</a></blockquote></div>
<div class="fb-comments" data-href="https://fanbooks.fightingfantasy.net/guestbook.php" data-width="240" data-numposts="8"></div>
<div class="footer"></div>
<?php include_once("footer3.php"); ?>
</div>
</div>