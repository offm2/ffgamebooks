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
$_SESSION["provisoes"]=10;$_SESSION["ouro"]=20;
$_SESSION["item1"]="sword";$_SESSION["item2"]="lantern";$_SESSION["item3"]="";$_SESSION["item4"]="";$_SESSION["item5"]="";$_SESSION["item6"]="";$_SESSION["item7"]="";$_SESSION["item8"]="";
$_SESSION["item9"]="";$_SESSION["item10"]="";$_SESSION["item11"]="";$_SESSION["item12"]="";$_SESSION["item13"]="";$_SESSION["item14"]="";$_SESSION["item15"]="";$_SESSION["item16"]="";
$_SESSION["item17"]="";$_SESSION["item18"]="";$_SESSION["item19"]="";$_SESSION["item20"]="";$_SESSION["item21"]="";$_SESSION["item22"]="";$_SESSION["item23"]="";$_SESSION["item24"]="";
$_SESSION["item25"]="";$_SESSION["item26"]="";$_SESSION["item27"]="";$_SESSION["item28"]="";
$_SESSION["weapon"]="yes1";
 //guardar valor de força inicial
$_SESSION["forcainicial"]=$_SESSION["forca"];
$_SESSION["sorteinicial"]=$_SESSION["sorte"];
$_SESSION["periciainicial"]=$_SESSION["pericia"];

}
//iniciar valores das paginas
iniciar($_POST['nome']);
}
echo "<head>";
echo "<meta name='viewport' content='width=device-width'>";
echo "<title>Home of the gamebooks web engine!</title>";
echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>';
?>
<link href="../2.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="../js/1.js"></script>
<?php
//configura estilo da pagina
echo "<link rel='stylesheet' media='screen and (max-width:480px)' href='../gamebooks_css/css/1.css' type='text/css' />";
echo "<link rel='stylesheet' media='screen and (min-width:481px) and (max-width:4800px)' href='../gamebooks_css/css/2.css' type='text/css' />";
echo"<script type='text/javascript' src='../fontsize.js'></script>";
echo "</head>";
echo "<body>";
?>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"</script>
<?php include_once("../analytics_google.php"); ?>
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
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
<h3>From the Shadows&copy</h3><h3> Editor: Victor Cheng </h3><h3>CONTRIBUTORS: Sylas, Cobb Webb, Al sander, Khaxzan, Odo_ital, Archmage</h3>
</center> 
</div>

<?php
echo "<div id='header'>";
echo "<img src='imagens/character.jpg'>";
//ver sessao com o nome  escolhido
echo "Name: <b>{$_SESSION['nome'] } </b> ";
if (!isset($_GET['pag'])){
echo "<p><iframe src='character.php' width='370' height='150' frameborder='0' scrolling='no'></iframe></p>";
}
//resto do conteudo
//inserir text to speech
include("add_speech3.php");
echo "<form name='pagina' action='{$_SERVER[PHP_SELF]}'>";
echo "Page nr.<input type='text' size=4 name='pag' maxlength='3'>";
echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
echo "</form>";

echo "</div>";
echo "<div id='menu'>";
echo "<b>Menu</b>";
echo "<li><a href='../index.php'>New</a></li>";
echo "<li><a href='saveload/load.php'>Load</a></li>";
echo "<li><a target='_blank' href='saveload/save.php'>Save</a></li>";
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
echo "<p><b>BACKGROUND</b></p><p>";
echo "<img style='float:right' src='imagens/bn.jpg' widht=100 height=100>";
include("texto_inicial.php");}

include("view_fields.php");
//restantes dados das paginas
include("pagevents1.php");
//
if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";} 
echo"<div id='sayt1'></div>";
echo "</div>";
echo "<div id='rodape'>";
echo "<form name='pontuacao'>";
echo "Skill:<input type='text' size=2 name='pericia' value={$_SESSION['pericia']}>";
echo "Stamina:<input type='text' size=2 name='forca'value={$_SESSION['forca']}>";
echo "Luck:<input type='text' size=2 name='sorte' value={$_SESSION['sorte']}>";
echo "Gold:<input type='text' size=2 name='ouro' value={$_SESSION['ouro']}>";
echo "Provisions:<input type='text' size=1 name='provisoes' value={$_SESSION['provisoes']}>";
echo "<p class='inv'>items:<input type='text' size=8 name='item1' value={$_SESSION['item1']}><input type='text' size=8 name='item2' value={$_SESSION['item2']}> ";
echo "<input type='text' size=8 name='item3' value={$_SESSION['item3']}><input type='text' size=8 name='item4' value={$_SESSION['item4']}><input type='text' size=8 name='item5' value={$_SESSION['item5']}> ";
echo "<input type='text' size=8 name='item6' value={$_SESSION['item6']}><input type='text' size=8 name='item7' value={$_SESSION['item7']}><input type='text' size=8 name='item8' value={$_SESSION['item8']}> ";
echo "<input type='text' size=8 name='item9' value={$_SESSION['item9']}><input type='text' size=8 name='item10' value={$_SESSION['item10']}><input type='text' size=8 name='item11' value={$_SESSION['item11']}> ";
echo "<input type='text' size=8 name='item12' value={$_SESSION['item12']}><input type='text' size=8 name='item13' value={$_SESSION['item13']}><input type='text' size=8 name='item14' value={$_SESSION['item14']}> ";
echo "<input type='text' size=8 name='item15' value={$_SESSION['item15']}><input type='text' size=8 name='item16' value={$_SESSION['item16']}><input type='text' size=8 name='item17' value={$_SESSION['item17']}>";
echo "<input type='text' size=8 name='item18' value={$_SESSION['item18']}><input type='text' size=8 name='item19' value={$_SESSION['item19']}><input type='text' size=8 name='item20' value={$_SESSION['item20']}>";
echo "<input type='text' size=8 name='item21' value={$_SESSION['item21']}><input type='text' size=8 name='item22' value={$_SESSION['item22']}><input type='text' size=8 name='item23' value={$_SESSION['item23']}>";
echo "<input type='text' size=8 name='item24' value={$_SESSION['item24']}><input type='text' size=8 name='item25' value={$_SESSION['item25']}><input type='text' size=8 name='item26' value={$_SESSION['item26']}>";
echo "<input type='text' size=8 name='item27' value={$_SESSION['item27']}><input type='text' size=8 name='item28' value={$_SESSION['item28']}></p>";
echo "</form>";
echo "</div>";
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
                 var section=$("#rt9",div.get(0));
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
