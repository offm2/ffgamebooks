<?php
session_start();
//Open the database 
 $db = new SQLite3('tb8.12b');
$results = $db->query('SELECT pw FROM people');
$row = $results->fetchArray();
$passfdb=$row["pw"];
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'>
 Password:<input type='password' name='pass'><input type='submit' value='Submit'></form>";
 if(isset($_POST["pass"])&&ctype_alnum($_POST["pass"]))
 {
$z=hash("sha256",$_POST["pass"]);
if($z==$passfdb){
$_SESSION["pass"]=$z;
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'>
New Password:<input type='password' name='npass'><input type='submit' value='Submit'></form>";
}}
if(isset($_POST['npass'])&&ctype_alnum($_POST['npass'])){
//echo"{$_SESSION["pass"]}=={$passfdb}";
if(isset($_SESSION["pass"])&&$_SESSION["pass"]==$passfdb){
$pass=hash("sha256",$_POST['npass']);
//update rows
$db->exec("UPDATE people SET pw='{$pass}' WHERE rowid=1 ");
echo "Password updated \n";
}else{echo"The password has not changed yet \n";}}
$db->close();
?>