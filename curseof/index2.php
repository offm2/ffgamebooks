<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

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
$_SESSION["provisoes"]=4;$_SESSION["ouro"]=20;
$_SESSION["item1"]="";$_SESSION["item2"]="";$_SESSION["item3"]="";$_SESSION["item4"]="";$_SESSION["item5"]="";$_SESSION["item6"]="";$_SESSION["item7"]="";$_SESSION["item8"]="";
$_SESSION["item9"]="";$_SESSION["item10"]="";$_SESSION["item11"]="";$_SESSION["item12"]="";$_SESSION["item13"]="";$_SESSION["item14"]="";$_SESSION["item15"]="";$_SESSION["item16"]="";
$_SESSION["item17"]="";$_SESSION["item18"]="";$_SESSION["item19"]="";$_SESSION["item20"]="";$_SESSION["item21"]="";$_SESSION["item22"]="";$_SESSION["item23"]="";$_SESSION["item24"]="";
$_SESSION["item25"]="";$_SESSION["item26"]="";$_SESSION["item27"]="";$_SESSION["item28"]="";
$_SESSION["bats"]="";$_SESSION["vashnech"]="";$_SESSION["tdhead"]="";$_SESSION["sap"]="";
$_SESSION["word1"]="";$_SESSION["word2"]="";$_SESSION["word3"]="";$_SESSION["word4"]="";
$_SESSION["weapon"]="no1";
 //guardar valor de força inicial
$_SESSION["forcainicial"]=$_SESSION["forca"];
$_SESSION["sorteinicial"]=$_SESSION["sorte"];
$_SESSION["periciainicial"]=$_SESSION["pericia"];

}
//iniciar valores das paginas
iniciar($_POST['nome']);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Curse of Blackwood Manor</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../2.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
<?php
include_once("../analytics_google.php");
include_once("../menu_html/menu_bootstrap_adv4.html");
?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <div id='rate1'></div>
  <p>Gamebooks playing area</p>
    <div style="text-align:center">
    <h3>Curse of Blackwood Manor&copy</h3><h3> by Craig Dutton  </h3>
    </div>
    <?php
    echo "<img src='../img/character.jpg'>";
    //ver sessao com o nome  escolhido
    echo "Name: <b>{$_SESSION['nome'] } </b>";
    if (!isset($_GET['pag'])){
    //echo "<p><iframe src='character.php' width='370' height='150' frameborder='0' scrolling='no'></iframe></p>";
    }

    if (!isset($_GET['pag'])){
    echo "<p><b>BACKGROUND</b></p><p>";
    echo "<img style='float:right' src='imagens/mansion.jpg' widht=100 height=100>";
    include("texto_inicial.php");}

    include("view_fields.php");
    //restantes dados das paginas
    include("pagevents1.php");
    //
    if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
    echo"<div id='sayt1'></div>";
    echo "<hr></hr>";
  //resto do conteudo
  echo "<p>Skill:<span contentEditable='true' id='pericia'>{$_SESSION['pericia']}</span> | ";
  echo "Stamina:<span contentEditable='true' id='forca'>{$_SESSION['forca']}</span> | ";
  echo "Luck:<span contentEditable='true' id='sorte'>{$_SESSION['sorte']}</span> </p>";
  echo "<p>Gold:<span contentEditable='true' id='ouro'>{$_SESSION['ouro']}</span> | ";
  echo "Provisions:<span contentEditable='true' id='provisoes'>{$_SESSION['provisoes']}</span> | ";
    echo "<hr></hr>";
    echo "<p class='inv'>items:";
    if (isset($_SESSION["item1"])&&$_SESSION["item1"]!=""){echo "<span contentEditable='true' id='item1'>{$_SESSION['item1']}</span> | ";}
    if (isset($_SESSION["item2"])&&$_SESSION["item2"]!=""){echo "<span contentEditable='true' id='item2'>{$_SESSION['item2']}</span> | ";}
    if (isset($_SESSION["item3"])&&$_SESSION["item3"]!=""){echo "<span contentEditable='true' id='item3'>{$_SESSION['item3']}</span> | ";}
    if (isset($_SESSION["item4"])&&$_SESSION["item4"]!=""){echo "<span contentEditable='true' id='item4'>{$_SESSION['item4']}</span> | ";}
    if (isset($_SESSION["item5"])&&$_SESSION["item5"]!=""){echo "<span contentEditable='true' id='item5'>{$_SESSION['item5']}</span> | ";}
    echo "</p>";
    if ($_SESSION["item6"]!=""||$_SESSION["item7"]!=""||$_SESSION["item8"]!=""||$_SESSION["item9"]!=""||$_SESSION["item10"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item6"])&&$_SESSION["item6"]!=""){echo "<span contentEditable='true' id='item6'>{$_SESSION['item6']}</span> | ";}
    if (isset($_SESSION["item7"])&&$_SESSION["item7"]!=""){echo "<span contentEditable='true' id='item7'>{$_SESSION['item7']}</span> | ";}
    if (isset($_SESSION["item8"])&&$_SESSION["item8"]!=""){echo "<span contentEditable='true' id='item8'>{$_SESSION['item8']}</span> | ";}
    if (isset($_SESSION["item9"])&&$_SESSION["item9"]!=""){echo "<span contentEditable='true' id='item9'>{$_SESSION['item9']}</span> | ";}
    if (isset($_SESSION["item10"])&&$_SESSION["item10"]!=""){echo "<span contentEditable='true' id='item10'>{$_SESSION['item10']}</span> | ";}
    if ($_SESSION["item6"]!=""||$_SESSION["item7"]!=""||$_SESSION["item8"]!=""||$_SESSION["item9"]!=""||$_SESSION["item10"]!=""){echo " </p>";}
    if ($_SESSION["item11"]!=""||$_SESSION["item12"]!=""||$_SESSION["item13"]!=""||$_SESSION["item14"]!=""||$_SESSION["item15"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item11"])&&$_SESSION["item11"]!=""){echo "<span contentEditable='true' id='item11'>{$_SESSION['item11']}</span> | ";}
    if (isset($_SESSION["item12"])&&$_SESSION["item12"]!=""){echo "<span contentEditable='true' id='item12'>{$_SESSION['item12']}</span> | ";}
    if (isset($_SESSION["item13"])&&$_SESSION["item13"]!=""){echo "<span contentEditable='true' id='item13'>{$_SESSION['item13']}</span> | ";}
    if (isset($_SESSION["item14"])&&$_SESSION["item14"]!=""){echo "<span contentEditable='true' id='item14'>{$_SESSION['item14']}</span> | ";}
    if (isset($_SESSION["item15"])&&$_SESSION["item15"]!=""){echo "<span contentEditable='true' id='item15'>{$_SESSION['item15']}</span> | ";}
    if ($_SESSION["item11"]!=""||$_SESSION["item12"]!=""||$_SESSION["item13"]!=""||$_SESSION["item14"]!=""||$_SESSION["item15"]!=""){echo "</p>";}
    if ($_SESSION["item16"]!=""||$_SESSION["item17"]!=""||$_SESSION["item18"]!=""||$_SESSION["item19"]!=""||$_SESSION["item20"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item16"])&&$_SESSION["item16"]!=""){echo "<span contentEditable='true' id='item16'>{$_SESSION['item16']}</span> | ";}
    if (isset($_SESSION["item17"])&&$_SESSION["item17"]!=""){echo "<span contentEditable='true' id='item17'>{$_SESSION['item17']}</span> | ";}
    if (isset($_SESSION["item18"])&&$_SESSION["item18"]!=""){echo "<span contentEditable='true' id='item18'>{$_SESSION['item18']}</span> | ";}
    if (isset($_SESSION["item19"])&&$_SESSION["item19"]!=""){echo "<span contentEditable='true' id='item19'>{$_SESSION['item19']}</span> | ";}
    if (isset($_SESSION["item20"])&&$_SESSION["item20"]!=""){echo "<span contentEditable='true' id='item20'>{$_SESSION['item20']}</span> | ";}
    if ($_SESSION["item16"]!=""||$_SESSION["item17"]!=""||$_SESSION["item18"]!=""||$_SESSION["item19"]!=""||$_SESSION["item20"]!=""){echo "</p>";}
    if ($_SESSION["item21"]!=""||$_SESSION["item22"]!=""||$_SESSION["item23"]!=""||$_SESSION["item24"]!=""||$_SESSION["item25"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item21"])&&$_SESSION["item21"]!=""){echo "<span contentEditable='true' id='item21'>{$_SESSION['item21']}</span> | ";}
    if (isset($_SESSION["item12"])&&$_SESSION["item12"]!=""){echo "<span contentEditable='true' id='item22'>{$_SESSION['item22']}</span> | ";}
    if (isset($_SESSION["item13"])&&$_SESSION["item13"]!=""){echo "<span contentEditable='true' id='item23'>{$_SESSION['item23']}</span> | ";}
    if (isset($_SESSION["item14"])&&$_SESSION["item14"]!=""){echo "<span contentEditable='true' id='item24'>{$_SESSION['item24']}</span> | ";}
    if (isset($_SESSION["item15"])&&$_SESSION["item15"]!=""){echo "<span contentEditable='true' id='item25'>{$_SESSION['item25']}</span> | ";}
    if ($_SESSION["item21"]!=""||$_SESSION["item22"]!=""||$_SESSION["item23"]!=""||$_SESSION["item24"]!=""||$_SESSION["item25"]!=""){echo "</p>";}
    if ($_SESSION["item26"]!=""||$_SESSION["item27"]!=""||$_SESSION["item28"]!=""){echo "<p class='inv'>";}
    if (isset($_SESSION["item26"])&&$_SESSION["item26"]!=""){echo "<span contentEditable='true' id='item26'>{$_SESSION['item26']}</span> | ";}
    if (isset($_SESSION["item27"])&&$_SESSION["item27"]!=""){echo "<span contentEditable='true' id='item27'>{$_SESSION['item27']}</span> | ";}
    if (isset($_SESSION["item28"])&&$_SESSION["item28"]!=""){echo "<span contentEditable='true' id='item28'>{$_SESSION['item28']}</span> | ";}
    if ($_SESSION["item26"]!=""||$_SESSION["item27"]!=""||$_SESSION["item28"]!=""){echo "</p>";}

    echo "<hr></hr>";
    echo "<p class='inv'>words:";
    if (isset($_SESSION["word1"])&&$_SESSION["word1"]!=""){echo "<span contentEditable='true' id='word1'>{$_SESSION['word1']}</span> | ";}
    if (isset($_SESSION["word2"])&&$_SESSION["word2"]!=""){echo "<span contentEditable='true' id='word2'>{$_SESSION['word2']}</span> | ";}
    if (isset($_SESSION["word3"])&&$_SESSION["word3"]!=""){echo "<span contentEditable='true' id='word3'>{$_SESSION['word3']}</span> | ";}
    if (isset($_SESSION["word4"])&&$_SESSION["word4"]!=""){echo "<span contentEditable='true' id='word4'>{$_SESSION['word4']}</span> | ";}
    echo "</p>";

    echo"<hr></hr>";
    echo "<div id='rodape'>";
    echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
    echo "<div class='form-inline'>";
    echo "Page nr.<input type='text' class='form-control' size=4 name='pag' maxlength='3'>";
    echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
    echo" </div></form>";
    echo "</div>";
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
                   var section=$("#rt4",div.get(0));
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
