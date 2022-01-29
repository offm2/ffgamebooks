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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - In the Presence of a hero</title>
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
include_once("../menu_html/menu_bootstrap_adv5.html");
?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <div id='rate1'></div>
  <p>Gamebooks playing area</p>
    <div style="text-align:center">
    <h3>In the Presence of a Hero&copy</h3><h3> by Stuart Lloyd  </h3>
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
    echo "<p class='inv'>Spells:<span contentEditable='true' id='magic1'>{$_SESSION['magic'][0]}</span> | ";
    echo "<span contentEditable='true' id='magic2'>{$_SESSION['magic'][1]}</span> | ";
    echo "<span contentEditable='true' id='magic3'>{$_SESSION['magic'][2]}<//span></p>";
    echo "<p class='inv'>items:";
    if (isset($_SESSION["item1"])&&$_SESSION["item1"]!=""){echo "<span contentEditable='true' id='item1'>{$_SESSION['item1']}</span> | ";}
    if (isset($_SESSION["item2"])&&$_SESSION["item2"]!=""){echo "<span contentEditable='true' id='item2'>{$_SESSION['item2']}</span> | ";}
    if (isset($_SESSION["item3"])&&$_SESSION["item3"]!=""){echo "<span contentEditable='true' id='item3'>{$_SESSION['item3']}</span> | ";}
    if (isset($_SESSION["item4"])&&$_SESSION["item4"]!=""){echo "<span contentEditable='true' id='item4'>{$_SESSION['item4']}</span> | ";}
    if (isset($_SESSION["item5"])&&$_SESSION["item5"]!=""){echo "<span contentEditable='true' id='item5'>{$_SESSION['item5']}</span> | ";}
    echo "</p>";
    if ($_SESSION["item6"]!=""||$_SESSION["item7"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item6"])&&$_SESSION["item6"]!=""){echo "<span contentEditable='true' id='item6'>{$_SESSION['item6']}</span> | ";}
    if (isset($_SESSION["item7"])&&$_SESSION["item7"]!=""){echo "<span contentEditable='true' id='item7'>{$_SESSION['item7']}</span> | ";}
    if ($_SESSION["item6"]!=""||$_SESSION["item7"]!=""){echo " </p>";}
    echo "<hr></hr>";
    if (!isset($_GET['pag'])){
    //inicio sem arma diminuir a pericia
    if($_SESSION["weapon"]=="no1"){echo"</h5>You have no weapon, so your skill is reduced by 4</h5>";$_SESSION["pericia"]-=4;$_SESSION["weapon"]="no2";}
    echo"<div style='text-align:center'>";
    echo "<h3>BACKGROUND</h3>";
    echo "<img style='float:right' src='imagens/hat.jpg' width=100 height=100>";
    include("texto_inicial.php");}

    include("view_fields.php");
    if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
    //restantes dados das paginas
    include("pagevents1.php");
    echo"<hr></hr>";
    echo"</div>";
    echo"<div id='sayt1'></div>";

    echo "<div id='rodape'>";
    echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
    echo "<div class='form-inline'>";
    echo "Page nr.<input type='text' class='form-control' size=4 name='pag' maxlength='3'>";
    echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
    echo" </div></form>";
    echo "</div>";
    include("historico.php");
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
                   var section=$("#rt5",div.get(0));
            $("#rate1").html(section);
              }
          });
      });
    });
  </script>
  <p><img src="../img/1.gif"></p>
  <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
  </div>
  </div>
  </div>
  </div>
