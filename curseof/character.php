<?php
//iniciar sess�o
session_start();
echo "<link rel='stylesheet' href='../gamebooks_css/css/3.css' type='text/css' />";

if (isset($_SESSION["forcainicial"]))
{
//dado da pericia
$d3=$_SESSION["periciainicial"] - 6 ;
$texto2="<p><b>Your Initial Skill is {$_SESSION["periciainicial"]} </b>= <img src='../images/{$d3}.jpg'> + 6</p>";
echo $texto2;
while(!isset($texto))
{if(empty($_SESSION["d1"])){$d1=rand(1,6);$_SESSION["d1"]=$d1;}
$d2=$_SESSION["forcainicial"]-12-$_SESSION["d1"];
if($d2>0&&$d2<7)
{$texto="<p><b>Your Initial Stamina is {$_SESSION["forcainicial"]} </b>= <img src='../images/{$_SESSION["d1"]}.jpg'> + <img src='../images/{$d2}.jpg'> + 12 </p>";}
else{$_SESSION["d1"]="";}
}
if(isset($texto))
{echo $texto;}

//dado da sorte
$d4=$_SESSION["sorteinicial"] - 6 ;
$texto3="<p><b>Your Initial Luck is {$_SESSION["sorteinicial"]} </b>= <img src='../images/{$d4}.jpg'> + 6</p>";
//textos
echo $texto3;
}
?>
