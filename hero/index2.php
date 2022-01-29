<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
//criar personagem
if (isset($_POST['nome']))
{
function iniciar($nome)
{
if (ctype_alnum($nome))
{$_SESSION["nome"]=$nome;}
else{$_SESSION["nome"]="Unknown name";}
$_SESSION["forca"]=mt_rand(1,6) + 11;
$rper=mt_rand(1,6);$_SESSION["rper"]=$rper;
if($rper==1||$rper==2)
{$_SESSION["pericia"]=7;}
elseif($rper==3||$rper==4)
{$_SESSION["pericia"]=8;}
elseif($rper==5||$rper==6)
{$_SESSION["pericia"]=9;}
$_SESSION["sorte"]=mt_rand(1,6) + 6;
$_SESSION["provisoes"]=5;$_SESSION["ouro"]=0;
$_SESSION["item1"]="";$_SESSION["item2"]="";$_SESSION["item3"]="";$_SESSION["item4"]="";$_SESSION["item5"]="";$_SESSION["item6"]="";$_SESSION["item7"]="";
$_SESSION["potion"]="";$_SESSION["weapon"]="no1";
 //guardar valor de força inicial
$_SESSION["forcainicial"]=$_SESSION["forca"];
$_SESSION["sorteinicial"]=$_SESSION["sorte"];
$_SESSION["periciainicial"]=$_SESSION["pericia"];
//magia
if(isset($_POST["magic"])&&count($_POST["magic"])==3)
{
$_SESSION["magic"]=$_POST["magic"];
}
else{$_SESSION["magic"]=array("fear","firebolt","illusion");}
}
//iniciar valores das paginas
iniciar($_POST['nome']);
}
if(!isset($_SESSION["magic"])){$_SESSION["magic"]=array("fear","firebolt","illusion");}
echo "<head>";
echo "<meta name='viewport' content='width=device-width'>";
echo "<title>Home of the gamebooks web engine!</title>";
echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>';
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../2.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="../js/reader.js"></script>
<?php
//configura estilo da pagina
echo "<link rel='stylesheet' media='screen and (max-width:480px)' href='../gamebooks_css/css/1.css' type='text/css' />";
echo "<link rel='stylesheet' media='screen and (min-width:481px) and (max-width:4800px)' href='../gamebooks_css/css/2.css' type='text/css' />";
echo"<script type='text/javascript' src='../fontsize.js'></script>";
?>
</head>
<body>

<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    autoDisplay: false,
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php include_once("../analytics_google.php"); ?>
<div class="container-fluid">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site </h3>
    <h3>Gameplay Area</h3>
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
<div>
<center>
<h3>In the Presence of a Hero&copy</h3><h3> by Stuart Lloyd  </h3>
</center>
</div>
<?php
echo "<div id='header'>";
echo "<img src='imagens/personagem.jpg'>";
//ver sessao com o nome  escolhido
echo "Name: <b>{$_SESSION['nome'] } </b> ";
if (!isset($_GET['pag'])){
echo "<p><iframe src='character.php' width='370' height='150' frameborder='0' scrolling='no'></iframe></p>";
}
//resto do conteudo
echo "<form name='pontuacao'>";
echo "Skill:<input type='text' size=2 name='pericia' value={$_SESSION['pericia']}>";
echo "Stamina:<input type='text' size=2 name='forca'value={$_SESSION['forca']}>";
echo "Luck:<input type='text' size=2 name='sorte' value={$_SESSION['sorte']}>";
echo "Gold:<input type='text' size=2 name='ouro' value={$_SESSION['ouro']}>";
echo "Provisions:<input type='text' size=1 name='provisoes' value={$_SESSION['provisoes']}>";
echo"<p class='inv'>Spells:<input type='text' size='8' name='magic1' value={$_SESSION['magic'][0]}><input type='text' size='8' name='magic2' value={$_SESSION['magic'][1]}><input type='text' size='8' name='magic3' value={$_SESSION['magic'][2]}>
items:<input type='text' size=8 name='item1' value={$_SESSION['item1']}><input type='text' size=8 name='item2' value={$_SESSION['item2']}><input type='text' size=8 name='item3' value={$_SESSION['item3']}><input type='text' size=8 name='item4' value={$_SESSION['item4']}><input type='text' size=8 name='item5' value={$_SESSION['item5']}>
<input type='text' size=8 name='item6' value={$_SESSION['item6']}><input type='text' size=8 name='item7' value={$_SESSION['item7']}></p>";
echo "</form>";
echo "</div>";
echo "<div id='menu'>";
echo "<b>Menu</b>";
echo "<li><a href='../index.php'>New</a></li>";
echo"<li><a target='_blank' href='actions.php'>Actions made</a></li>";
echo "<li><button id='rater'>Rate this adventure!</button></li>";
echo "<li><a target='_blank' href='../embed.htm'>Add Sound</a></li>";
echo "<li><a target='_blank' href='reviews.php'>Reviews</a></li>";

//modificar tamanho fonte
echo"<h5>font size</h5>";
echo"<h1><a href='javascript:decreaseFontSize();'>-</a> <a href='javascript:increaseFontSize();'>+</a></h1>";
echo "</div>";
echo "<div id='content'>";
//rater
echo"<div id='rate1'></div>";
/*echo"<button type='button' id='start' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Fast reading</button>";*/
echo'<button id="start">Start</button><button id="stop">Stop</button>';
if (!isset($_GET['pag'])){
//inicio sem arma diminuir a pericia
if($_SESSION["weapon"]=="no1"){echo"</h5>You have no weapon, so your skill is reduced by 4</h5>";$_SESSION["pericia"]-=4;$_SESSION["weapon"]="no2";}
echo "<h3>BACKGROUND</h3>";
echo "<img style='float:right' src='imagens/hat.jpg' width=100 height=100>";
include("texto_inicial.php");}

include("view_fields.php");
if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
//restantes dados das paginas
include("pagevents1.php");
echo"<div id='sayt1'></div>";
//inserir text to speech
include("add_speech3.php");
echo "</div>";
echo "<div id='rodape'>";
echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
echo "Page nr.<input type='text' size=4 name='pag' maxlength='3'>";
echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b></form>";
//echo "<h4>To hear the text please install the <a target='_blank' href='https://chrome.google.com/webstore/detail/speakit/pgeolalilifpodheeocdmbhehgnkkbak'>Speakit!</a> plugin for Google Chrome</h4>";
echo "</div>";
include("historico.php");
?>
<center>
<script>
$(document).ready(function()
{
    $("#rater").click(function()
    {
        $.ajax(
        {
            type: "GET",
            url: '../rater/index.php',
            data: {rate: 'yes'},
            success: function(result)
            {
                var div = $("<div>").html(result);
                 var section=$("#rt5",div.get(0));
	        $("#rate1").html(section);
            }
        });
    });
	});
</script>
<p><img src="../images/1.gif"></p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
<div><a href="http://responsivevoice.org">ResponsiveVoice-NonCommercial</a> licensed under <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img title="ResponsiveVoice Text To Speech" src="https://responsivevoice.org/wp-content/uploads/2014/08/95x15.png" alt="95x15" width="95" height="15" /></div>
</center>
</div>
