<?php
//iniciar sess�o
session_start();
echo "<link rel='stylesheet' href='../gamebooks_css/css/3.css' type='text/css' />";
if (isset($_SESSION["forcainicial"]))
{
//dado da pericia
$d3=$_SESSION["periciainicial"] - 4 ;
$texto2="<p><b>Your Initial Skill is {$_SESSION["periciainicial"]} </b>= <img src='../images/{$d3}.jpg'> + 4</p>";
echo $texto2;
$d1=$_SESSION["forcainicial"] - 6 ;
$texto="<p><b>Your Initial Stamina is {$_SESSION["forcainicial"]} </b>= <img src='../images/{$d1}.jpg'> + 6</p>";
echo $texto;
//dado da sorte
$d4=$_SESSION["sorteinicial"] - 6 ;
$texto3="<p><b>Your Initial Luck is {$_SESSION["sorteinicial"]} </b>= <img src='../images/{$d4}.jpg'> + 6</p>";
//textos
echo $texto3;
}
?>
