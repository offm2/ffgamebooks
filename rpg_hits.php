<!DOCTYPE html> 
<html> 
  <head> 
  <?php
  //start
$n=1;
//directory
$pdir="rpg_hits";

//Looks into the directory and returns the files, no subdirectories
//print("<select name='music'>");
//The path to the style directory
$dirpath = getcwd()."/{$pdir}";
$dh = opendir($dirpath);
$file=readdir($dh);


while (false !== ($file = readdir($dh))) {
//retirar da string $file as tres primeiras posicoes
//e saber a extensao da string $file
list($comeco,$ext)=explode(".",$file);
$pos=substr($file,0,3);
if($ext=="mp3"){
//Don't list subdirectories
if (!is_dir("$dirpath/$file")) {

//Listar Data e nome do ficheiro
//echo "<option value='mp3_hits/$file'>$file ".date ("M d Y H:i:s.", filemtime($dirpath."\\".$file)). "</option> ";
//titulo
$mtitle[$n]=$comeco;
//src
$msrc[$n]=$file;
$n++;
}
}
}
closedir($dh);
//ver nr de canções
//print_r($mtitle);
//Close Select
//echo "</select>";
//nr of songs
$nsongs=count($mtitle);
//start
$nstart=1;
//for random music display
$rnumber=mt_rand($nstart,$nsongs);
//saber a duração da musica para o refresh
require_once("mp3_length.php");
$mp3=new MP3File("{$pdir}/{$msrc[$rnumber]}");
$duracao=$mp3->getDurationEstimate();//faster for CBR only
//$duracao=mp3->getDuration();//slower for VBR and CBR
  print("<meta http-equiv='refresh' content='{$duracao}'>");
  ?>
    <title>HTML5 Audio player</title> 
	<link href="1.css" rel="stylesheet" type="text/css" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  </head> 
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
<body>
<div class="container">
  <div class="jumbotron" id="1">
<h3>A Fighting Fantasy gamebooks fan site </h3>
<p>The RPG Hits from rpgmaker</p>
<p><img src="images/2.gif" class="img-circle" alt="intro image"></p>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dp1" data-toggle="dropdown">
    Dropdown
    <span class="glyphicon glyphicon-arrow-down"></span>
  </button>
<ul class="dropdown-menu">
<?php include_once("menu.php"); ?>
</ul>
</div>
</div>
<div class="col-sm-12">
<?php
function start(){
	//display form with script
print("<h4>Now Playing:</h4>");
print("<h3>" . $GLOBALS['mtitle'][$GLOBALS['rnumber']] . "<h3>");
print("<form name='form' method='POST' action={$_SERVER['PHP_SELF']}>");
print("<p><audio id='embmusic' controls='controls' autoplay><source SRC='{$GLOBALS['pdir']}/{$GLOBALS['msrc'][$GLOBALS['rnumber']]}' type='audio/mp3'/> Your browser does not support the audio tag.</audio>");
print("<p><input type='submit' value='change music'>");
	}
	start();
?>
<pre>
RMN Music Pack is a collection of videogame music composed by members of http://www.rpgmaker.net for anyone and 
everyone to use in their non-commercial videogame projects. RMN Music Pack was created in three-months timeframe 
as an event organized by 800 M.P.H. and NewBlack with assistance of Kenton Anderson. 

You can find the full list of submissions at http://rpgmaker.net/events/rmn_music_pack


Special thanks to everyone partaking the event, http://www.rpgmakerweb.com/, Clyve, Liberty, Archeia and Jonnie19

And all the attending artists: Jasprelao, Jeremiah "McTricky" George, Jude, Gamesfreak13563, Tarranon, Cornflake, 
Xcalnarok, Lana42, Kunsel, Subaru, NathanGDay, Snowy Fox, ReclaimedGlory, Apoc, hyde9318 and 800 M.P.H.

Album cover artwork has been made by http://yaichino.deviantart.com/ and CD artwork by http://23hauntsme.deviantart.com/



RMN Music Pack is licensed under a Creative Commons Attribution-NonCommercial 3.0 Unported License.

If you use our music in your projects, please credit the artists!

Enjoy!
</pre>
</div>
<div class="footer">
<?php include_once("footer3.php"); ?>
</div>
</div>
</body>
</html>
