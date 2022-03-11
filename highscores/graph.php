<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adventure's Graphic</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
 <meta name="viewport" content="width=device-width, initial-scale=1"> 

 <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
   <!--chartist //-->
<script src="chartist/chartist.min.js"></script>
<link rel="stylesheet" href="chartist/chartist.min.css">
<body>
<div class="container">
  <div class="jumbotron" id="1">
<h3>A Fighting Fantasy gamebooks fan site </h3>
<p>Ready-to-play Fighting Fantasy style adventures</p>
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
<center>
<h3>Average of time Spent by User(s) on Finished adventures</h3>
<div class="ct-chart ct-golden-section" data-chart="chart1"></div>
<?php
$con = mysqli_connect("localhost","figh_oscar","I0.DlX^Pa=8W","figh_oscar");
if (mysqli_connect_errno())
  {
  die('Could not connect: ' . mysqli_connect_error());
  }
 $sq1="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Phoenix%'"; 
 $sq2="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Ebony Wand%'"; 
 $sq3="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE 'Kill%'"; 
 $sq4="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Manor%'";
 $sq5="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE 'Presence%'"; 
 $sq6="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Legacy%'"; 
 $sq7="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Vortan%'"; 
 $sq8="SELECT gamebook,AVG(time) AS tti FROM highscores WHERE gamebook LIKE '%Rise%'"; 
$resul1=mysqli_query($con,$sq1);if(!$resul1)
{die('Error:'.mysqli_error($con));}
$resul2=mysqli_query($con,$sq2);if(!$resul2)
{die('Error:'.mysqli_error($con));}
$resul3=mysqli_query($con,$sq3);if(!$resul3)
{die('Error:'.mysqli_error($con));}
$resul4=mysqli_query($con,$sq4);if(!$resul4)
{die('Error:'.mysqli_error($con));}
$resul5=mysqli_query($con,$sq5);if(!$resul5)
{die('Error:'.mysqli_error($con));}
$resul6=mysqli_query($con,$sq6);if(!$resul6)
{die('Error:'.mysqli_error($con));}
$resul7=mysqli_query($con,$sq7);if(!$resul7)
{die('Error:'.mysqli_error($con));}
$resul8=mysqli_query($con,$sq8);if(!$resul8)
{die('Error:'.mysqli_error($con));}
while($ver=mysqli_fetch_array($resul1))
{$_SESSION["timea1"]=$ver["tti"];$_SESSION["gam1"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul2))
{$_SESSION["timea2"]=$ver["tti"];$_SESSION["gam2"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul3))
{$_SESSION["timea3"]=$ver["tti"];$_SESSION["gam3"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul4))
{$_SESSION["timea4"]=$ver["tti"];$_SESSION["gam4"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul5))
{$_SESSION["timea5"]=$ver["tti"];$_SESSION["gam5"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul6))
{$_SESSION["timea6"]=$ver["tti"];$_SESSION["gam6"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul7))
{$_SESSION["timea7"]=$ver["tti"];$_SESSION["gam7"]=$ver["gamebook"];}
while($ver=mysqli_fetch_array($resul8))
{$_SESSION["timea8"]=$ver["tti"];$_SESSION["gam8"]=$ver["gamebook"];}

mysqli_close($con);
echo"<script>
new Chartist.Bar('.ct-chart', {
  labels: ['{$_SESSION["gam1"]}','{$_SESSION["gam2"]}','{$_SESSION["gam3"]}','{$_SESSION["gam4"]}','{$_SESSION["gam5"]}','{$_SESSION["gam6"]}','{$_SESSION["gam7"]}','{$_SESSION["gam8"]}'],
  series: [[{$_SESSION["timea1"]},{$_SESSION["timea2"]},{$_SESSION["timea3"]},{$_SESSION["timea4"]},{$_SESSION["timea5"]},{$_SESSION["timea6"]},{$_SESSION["timea7"]},{$_SESSION["timea8"]}]]
}, {
  width: 600,
  height: 400,

  seriesBarDistance: 6000,
  reverseData: true,
  horizontalBars: false

});</script>";
?>
</div>
</div>