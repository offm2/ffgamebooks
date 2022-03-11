<?php
echo"<fieldset>";
echo"<legend>Which of the following adventures should be converted to fully coded next?</legend>";
if(!isset($_POST["xr"]))
{
echo"<form action='{$_SERVER['PHP_SELF']}' method='post'>";
echo" From the Shadows <input type='checkbox' name='x1' value='1'>";
echo" Rise of the Night Creatures <input type='checkbox' name='x2' value='2'>";
echo" Ranger of Grewlant <input type='checkbox' name='x3' value='3'>";
echo" House of Pain <input type='checkbox' name='x4' value='4'>";
echo" Deathtrap <input type='checkbox' name='x5' value='5'>";
echo" <input type='submit' value='Submit' name='xr'></form>";
}
else
{
// Part 1
$filename = "pollv03.txt";
$get = file_get_contents($filename);
$resultados=explode("-",$get);
if(isset($_POST["x1"])&&$_POST['x1']=="1"){$resultados[0]+=1;}
if(isset($_POST["x2"])&&$_POST['x2']=="2"){$resultados[1]+=1;}
if(isset($_POST["x3"])&&$_POST['x3']=="3"){$resultados[2]+=1;}
if(isset($_POST["x4"])&&$_POST['x4']=="4"){$resultados[3]+=1;}
if(isset($_POST["x5"])&&$_POST['x5']=="5"){$resultados[4]+=1;}
//part2
$r2=implode("-",$resultados);
$put=file_put_contents($filename,$r2);
//part3
echo" From the Shadows : {$resultados[0]}";
echo" Rise of the Night Creatures : {$resultados[1]}";
echo" Ranger of Grewlant : {$resultados[2]}";
echo" House of Pain : {$resultados[3]}";
echo" Deathtrap : {$resultados[4]}";

}
echo"</fieldset>";
