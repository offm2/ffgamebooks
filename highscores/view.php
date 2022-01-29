<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="Ready-to-play Fighting Fantasy style adventures"><meta name="robots" content="all">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Play Fighting Fantasy style Gamebooks online!</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../feed.xml" rel="alternate" type="application/rss+xml" title="What's New on  play FF fan adventures website" />
<link rel="canonical" href="http://fanbooks.fightingfantasy.net" />
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php include_once("../header_html/header_bootstrap.html");?>
</head>
<body>
<?php include_once("../analytics_google.php"); ?>
<?php include_once("../menu_html/menu_bootstrap_udir.html")?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <p>Ready-to-play Fighting Fantasy style adventures</p>
  <p>Highscores Page</p>
  <?php
  echo"<h4>Last users to end the gamebooks</h4>";
  //conectar a base dados
  //$con = mysqli_connect("localhost","oscmon9_ffgameb","oscarm","oscmon9_ffgameb");
  //$con = mysqli_connect("localhost","ffgamebo_offm","oscarm","ffgamebo_books");
  $con = mysqli_connect("localhost","figh_oscar","I0.DlX^Pa=8W","figh_oscar");
  if (mysqli_connect_errno())
    {
    die('Could not connect: ' . mysqli_connect_error());
    }
  
  if(isset($_SESSION["ttime"])&&isset($_SESSION["nome"])&&isset($_SESSION["gamebook"]))
  {
  if($_SESSION["ttime"]>80)
  {$sql="INSERT INTO highscores(nickname,time,gamebook) VALUES ('$_SESSION[nome]','$_SESSION[ttime]','$_SESSION[gamebook]')";
  $insert=mysqli_query($con,$sql);
  if(!$insert){ die("Error: Unable to insert data into the database, make sure you have write priveledges");}
  //this would remove all the variable in the session 
  session_unset();}}
  
  $i=0;
  $sql="SELECT * FROM highscores ORDER BY incremento DESC LIMIT 150";
  $result=mysqli_query($con,$sql);if(!$result)
  {die('Error:'.mysqli_error($con));}
  echo "<table style='text-align:center;' border='0' width='90%'>
  <tr>
  <th width='10%'>Position</th>
  <th width='25%'>Nickname</th>
  <th width='25%'>Time</th>
  <th width='40%'>Gamebook</th>
  </tr>";
  while($ver=mysqli_fetch_array($result))
  {$i++;
  echo "<tr>";
  echo"<td>".$i."</td>";
  echo"<td>".$ver['nickname']."</td>";
  echo"<td>".$ver['time']."</td>";
  echo"<td>".$ver['gamebook']."</td>";
  echo"</tr>";
  }
  echo"</table>";
  echo"<br><br>";
  echo"<p><b>Note:</b> If you do not consult this page after you win each adventure, your name will not be recorded.</p>";
  mysqli_free_result($result);
  mysqli_close($con);
  
  ?>
    <div style="text-align:center"><?php include_once("../footer3.php"); ?></div>
    </div>
</div>
</div>
