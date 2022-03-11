<?php
echo"<fieldset>";
echo"<legend>What are your favourite adventures from the site so far?</legend>";
if(!isset($_POST["xr"]))
{
echo"<form action='{$_SERVER['PHP_SELF']}' method='post'>";
echo" Feathers of the Phoenix <input type='checkbox' name='x1' value='1'>";
echo" Quest for the Ebony Wand <input type='checkbox' name='x2' value='2'>";
echo" Kill the Beast <input type='checkbox' name='x3' value='3'>";
echo" Curse of Blackwood Manor <input type='checkbox' name='x4' value='4'>";
echo" Presence of a Hero <input type='checkbox' name='x5' value='5'>";
echo" Legacy of the Vampire <input type='checkbox' name='x6' value='6'>";
echo" Venom of Vortan <input type='checkbox' name='x7' value='7'>";
echo" <input type='submit' value='Submit' name='xr'></form>";
}
else
{
// Part 1
$filename = "pollv01.txt";
$get = file_get_contents($filename);
$resultados=explode("-",$get);
if(isset($_POST["x1"])&&$_POST['x1']=="1"){$resultados[0]+=1;}
if(isset($_POST["x2"])&&$_POST['x2']=="2"){$resultados[1]+=1;}
if(isset($_POST["x3"])&&$_POST['x3']=="3"){$resultados[2]+=1;}
if(isset($_POST["x4"])&&$_POST['x4']=="4"){$resultados[3]+=1;}
if(isset($_POST["x5"])&&$_POST['x5']=="5"){$resultados[4]+=1;}
if(isset($_POST["x6"])&&$_POST['x6']=="6"){$resultados[5]+=1;}
if(isset($_POST["x7"])&&$_POST['x7']=="7"){$resultados[6]+=1;}
//part2
$r2=implode("-",$resultados);
$put=file_put_contents($filename,$r2);
//part3
echo" Feathers of the Phoenix : {$resultados[0]}";
echo" Quest for the Ebony Wand : {$resultados[1]}";
echo" Kill the Beast : {$resultados[2]}";
echo" Curse of Blackwood Manor : {$resultados[3]}";
echo" Presence of a Hero : {$resultados[4]}";
echo" Legacy of the Vampire : {$resultados[5]}";
echo" Venom of Vortan : {$resultados[6]}";
}
echo"</fieldset>";
