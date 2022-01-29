<?php session_start();
$_SESSION["forca"]=mt_rand(2,12) + 12;
$_SESSION["pericia"]=mt_rand(1,6) + 6;
$_SESSION["sorte"]=mt_rand(1,6) + 6;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="Ready-to-play Fighting Fantasy style adventures"><meta name="robots" content="all">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks, Feathers of the Phoenix"> 
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
    floatPosition: google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php include_once("../header_html/header_bootstrap.html");?>
</head>
<body onLoad="javascript:ger4()";>
<?php include_once("../analytics_google.php"); ?>
<?php include_once("../menu_html/menu_bootstrap_udir.html")?>
<!--random names-->
<script type="text/javascript" src="../js/name_generator.js"></script>
<script type="text/javascript" src="../js/english_set.js"></script>
<script type="text/javascript" src="../js/getname2.js"></script>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
    <h4> Creating Character statistics for the adventure</h4>
    <form name="f4" method="POST" action="index2.php">
    <p><img width='55' height='80' src="../img/character_m.png"><img width='55' height='80' src="../img/character_f.png"></p>
    <div class="form-group">
    <label for="adv1name">Insert name:</label>
    <input type="text" class="form-control" name="nome" id="adv1name" placeholder="Name">
    </div>
    <?php 
    echo"<div class='form-group'>";
    echo"<label for='skill'>Skill : </label><input type='text' class='form-control' id='skill' value='{$_SESSION["pericia"]}'></p>";
    echo"<p><label for='stamina'>Stamina : </label><input type='text' class='form-control' id='stamina' value='{$_SESSION["forca"]}'></p>";
    echo"<p><label for='luck'>Luck : </label><input type='text' class='form-control' value='{$_SESSION["sorte"]}'></p>"; 
    echo"</div>";
    ?>
    <p class="submit"><b><input type="submit" value="Start Adventure"><input type="button" onclick="javascript:location.reload(true);" value="Make new character"></b></p></p>
    </form>
    <div style="text-align:center">
    <?php include_once("../footer3.php"); ?>
    </div>
    </div>
</div>
</div>