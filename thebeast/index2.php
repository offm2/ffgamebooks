<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
//sessao para iniciar guerreiros pag.9
$_SESSION["warriorf"]=15;$_SESSION["warriorp"]=12;$_SESSION["warriorso"]=7;
$_SESSION["knightf"]=18;$_SESSION["knightp"]=10;$_SESSION["knightso"]=8;
$_SESSION["sorceressf"]=12;$_SESSION["sorceressp"]=9;$_SESSION["sorceresslu"]=10;

//criar personagem
if (isset($_POST['nome']))
{
function iniciar($nome,$personagem)
{
if (ctype_alnum($nome))
{$_SESSION["nome"]=$nome;}
else{$_SESSION["nome"]="Unknown name";}
$_SESSION["personagem"]=$personagem;
$_SESSION["forca"]=mt_rand(1,6) + 6;
$_SESSION["pericia"]=mt_rand(1,6) + 4;
$_SESSION["sorte"]=mt_rand(1,6) + 6;
$_SESSION["ouro"]=30;$_SESSION["provisoes"]=5;
$_SESSION["item1"]="torch";$_SESSION["item2"]="knife";
//iniciar sessão com historico das accões
$_SESSION["history"]="";
//sessao para iniciar beast pag.20
$_SESSION["beastf"]=15;$_SESSION["beastp"]=12;}
//iniciar valores das paginas
iniciar($_POST['nome'],$_POST['personagem']);
//forca inicial do blacksmith aumentada em 2 pontos
if ($_SESSION["personagem"]=="blacksmith")
{$_SESSION["forca"]+=2;}
 //guardar valor de força inicial
$_SESSION["forcainicial"]=$_SESSION["forca"];
$_SESSION["sorteinicial"]=$_SESSION["sorte"];
$_SESSION["periciainicial"]=$_SESSION["pericia"];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Kill the Beast</title>
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
<body>
<?php 
include_once("../analytics_google.php");
include_once("../menu_html/menu_bootstrap_adv3.html");
?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <div id='rate1'></div>
  <p>Gamebooks playing area</p>
    <div style="text-align:center">
    <h3>Kill the beast&copy</h3><h3> by Victor Cheng  </h3>
    </div>

<?php
    echo "<img src='../img/character.jpg'>";
//ver sessao com o nome e personagem escolhidos
echo "Name:<b>{$_SESSION['nome'] } </b>Character: <b>{$_SESSION['personagem']} </b> ";
if (!isset($_GET['pag'])){
//echo "<p><iframe src='character.php' width='300' height='150' frameborder='0' scrolling='no'></iframe></p>";
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
    include("add_speech3.php");
if (!isset($_GET['pag'])){
	echo"<div id='sayt'>";
  echo"<div style='text-align:center'>";
echo "<h3>INTRODUCTION</h3>";
echo "<img align=right src='imagens/vista_longe.jpg' widht=100 height=100>";
echo "<p>For many years your village has lived in relative peace away from the perils of adventure and the laws of corruption. Occasional attacks from bandits and wild animals are only a mild hindrance compared to the damage caused by bad weather. Homes can be rebuilt and crops re-sown. But now, a new threat has befallen your village. It came from nowhere: demolishing houses, crushing crops underfoot, and carrying away helpless villagers. You tried to stop it to no avail. Its soil-covered hide turned aside any blows you managed to land. It was no use. The last thing you remember is a great mound of a body dripping with mud and roots dragging behind it. It had tentacles, primitive limbs and big eyes - dreadful, demonic eyes.</p><br>";
echo "<p>You wake shortly after being seen to by the village healer. Your head still hurts a little from when the creature swatted you aside. Looking around, you are filled with sorrow seeing part of your village in ruins. 'It happened so fast, so sudden,' says the woman next to you. 'The Beast came from nowhere. It went on a rampage. It took my boy…my…' You try to comfort her as she bursts into tears.</p><br> ";
echo "<p>That night, the village elders gather to discuss what can be done to prevent further devastation. Since there is not a single fighter among you, it is decided that one person must brave the moors following the river to seek aid from the next town. The rest must get to work setting up barricades and defences should the Beast return. Thirty Gold Pieces is all that can be spared. Three courageous souls step up to volunteer: a herbalist, a farmer and a blacksmith. The village elders choose you. But which of these characters do you want to be? </p><br> ";
echo "Go to paragraph <a href='index2.php?pag=17'>17</a> to learn more about them. </div></div>";}

include("view_fields.php");
//restantes dados das paginas
include("pagevents1.php");
if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
//
echo"<div id='sayt1'></div>";
echo"<hr></hr>";
echo "<div id='rodape'>";
echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
echo "<div class='form-inline'>";
echo "Page nr.<input type='text' class='form-control' size=4 name='pag' maxlength='3'>";
echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
echo" </div></form>";
echo "</div>";
include("historico.php");
?>
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
                 var section=$("#rt3",div.get(0));
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

