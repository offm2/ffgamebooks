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
//$_SESSION["forca"]=mt_rand(2,12) + 12;
//$_SESSION["pericia"]=mt_rand(1,6) + 6;
//$_SESSION["sorte"]=mt_rand(1,6) + 6;
$_SESSION["provisoes"]=5;$_SESSION["ouro"]=20;
$_SESSION["item1"]="";$_SESSION["item2"]="";
 //guardar valor de força inicial
$_SESSION["forcainicial"]=$_SESSION["forca"];
$_SESSION["sorteinicial"]=$_SESSION["sorte"];
$_SESSION["periciainicial"]=$_SESSION["pericia"];
//criar valores para desenho do mapa
$_SESSION["mapx"]="";$_SESSION["mapy"]="";$_SESSION["maptext"]="";
}
//iniciar valores das paginas
iniciar($_POST['nome']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Feathers of the Phoenix</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../2.css" rel="stylesheet" type="text/css" />
</head>
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
<script src="../js/reader.js"></script>
<script src="../js/fontsize.js"></script>
<body>
<?php 
include_once("../analytics_google.php");
include_once("../menu_html/menu_bootstrap_adv1.html");
?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <div id='rate1'></div>
  <p>Gamebooks playing area</p>
    <div style="text-align:center">
    <h3>Feathers of the Phoenix&copy</h3><h3> by Kieran Coghlan  </h3>
    </div>
    <?php
    echo "<img src='../img/character.jpg'>";
    //ver sessao com o nome  escolhido
    echo "Name: <b>{$_SESSION['nome'] } </b>";
    if (!isset($_GET['pag'])){
    //echo "<p><iframe src='character.php' width='370' height='150' frameborder='0' scrolling='no'></iframe></p>";
    }
    //resto do conteudo
    echo "<p>Skill:<span contentEditable='true' id='pericia'>{$_SESSION['pericia']}</span> | ";
    echo "Stamina:<span contentEditable='true' id='forca'>{$_SESSION['forca']}</span> | ";
    echo "Luck:<span contentEditable='true' id='sorte'>{$_SESSION['sorte']}</span> </p>";
    echo "<p>Gold:<span contentEditable='true' id='ouro'>{$_SESSION['ouro']}</span> | ";
    echo "Provisions:<span contentEditable='true' id='provisoes'>{$_SESSION['provisoes']}</span></p>";
    echo "<p class='inv'>items:<span contentEditable='true' id='item1'>{$_SESSION['item1']}</span> | ";
    echo "<span contentEditable='true' id='item2'>{$_SESSION['item2']}<//span></p>";
    echo "<hr></hr>";
    //inserir text to speech
    include_once("add_speech3.php");
    if (!isset($_GET['pag'])){
      echo "<p><b>BACKGROUND</b></p><p>";
      echo "<img style='float:right' src='img/phoenix.gif' width=100 height=100>";
      include("texto_inicial.php");
    }
    include("view_fields.php");
    //restantes dados das paginas
    include("pagevents1.php");
    //Game over!
    if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
    echo"<div id='sayt1'></div>";
    echo"<hr></hr>";
    echo "<div id='rodape'>";
    echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
    echo "<div class='form-inline'>";
    echo "Page nr.<input type='text' class='form-control' size=4 name='pag' maxlength='3'>";
    echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
    echo" </div></form>";
    echo "</div>";
    include("map1.php");
    ?>
<div style="text-align:center">
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
                 var section=$("#rt1",div.get(0));
	        $("#rate1").html(section);
            }			
        });
    });
	});
</script>
<?php include_once("../sound_html/sound.php");?>
<p><img src="../img/1.gif"></p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
<div><a href="https://responsivevoice.org">ResponsiveVoice-NonCommercial</a> licensed under <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/"><img title="ResponsiveVoice Text To Speech" src="https://responsivevoice.org/wp-content/uploads/2014/08/95x15.png" alt="95x15" width="95" height="15" /></a></div>
</div>
</div>
</div>
</div>
