<?php 
// you have to open the session to be able to modify or remove it 
session_start(); 

// or this would remove all the variable in the session 
session_unset(); 

//destroy the session 
session_destroy(); 
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="The Simple Fighting Fantasy Fan Engime!">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks,Simple Figting Fantasy Fan Engine"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple ff gamebooks fan engine!</title>
<link href="1.css" rel="stylesheet" type="text/css" />
<meta name="robots" content="all">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php include_once("../analytics_google.php"); ?>
<div class="container">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site</h3>
<h3>Play fan adventures in this simple engine</h3>
<img src="images/2.gif" class="img-circle" alt="intro image">

</div>
<div class="col-sm-12">
<div id="fb-root"></div>

<h2>Choose an adventure to play:</h2>

<form action="engine.php" method="POST">
<select name="adventure">
<option value="fromtheshadows">From the Shadows</option>
<option value="ROTNC">Rise of the Night Creatures</option>
<option value="houseofpain">House of Pain</option>
</select>
<input type="submit" Value="Submit">
</form>


<h4>The simple ff gamebooks fan engine windows app on sourceforge</h4>
<a href="https://sourceforge.net/projects/fighting-fantasy-fan-engine/files/latest/download" rel="nofollow"><img alt="Download Fighting Fantasy Fan Engine" src="https://a.fsdn.com/con/app/sf-download-button"></a>

<!--facebook like button//-->
<p>
<iframe src="http://www.facebook.com/plugins/like.php?href=http://fanbooks.fightingfantasy.net&layout=box_count&show_faces=false&width=90&action=like&font=verdana&colorscheme=light" allowtransparency='true' style="border:medium none; overflow: hidden; width: 55px; height: 65px;" frameborder="0" scrolling="no"></iframe>	
</p>

</div>
<div class="footer">
</div>
</div>
</body>