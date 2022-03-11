<?php
echo"<p></p>";
echo"<fieldset>";
echo"<legend>Which system is the best for eating provisions and taking potions?</legend>";
if(!isset($_POST["zr"]))
{
echo"<form action='{$_SERVER['PHP_SELF']}' method='post'>";
echo" <p>Manually choose when to eat, as in Venon of Vortan's method<input type='radio' name='z1' value='1'></p>";
echo" <p>Automatically as all the other adventures<input type='radio' name='z2' value='2'></p>";
echo" <p>It is not important<input type='radio' name='z3' value='3'></p>";
echo" <input type='submit' value='Submit' name='zr'></form>";
}
else
{
// Part 1
$filename = "pollv04.txt";
$get = file_get_contents($filename);
$resultados=explode("-",$get);
if(isset($_POST["z1"])&&$_POST['z1']=="1"){$resultados[0]+=1;}
if(isset($_POST["z2"])&&$_POST['z2']=="2"){$resultados[1]+=1;}
if(isset($_POST["z3"])&&$_POST['z3']=="3"){$resultados[2]+=1;}
//part2
$r2=implode("-",$resultados);
$put=file_put_contents($filename,$r2);
//part3
echo" <p>Choose when to eat : {$resultados[0]}</p>";
echo" <p>Automatically when stamina is low: {$resultados[1]}</p>";
echo" <p>Is is not important : {$resultados[2]}</p>";
}
echo"</fieldset>";
?>