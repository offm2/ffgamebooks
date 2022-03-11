<?php session_start();?>
<html lang="en">
<head>
  <title>Admin page!</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <?php
 echo " <form  align='right' method='POST' action='{$_SERVER[PHP_SELF]}'><input  name='logout' type='submit' value='Logout'></form>";
  if(isset($_POST["logout"])){
 // or this would remove all the variable in the session 
session_unset(); 
echo"<h4>You have logout</h4>";}
   $i=0;
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
$_SESSION["start"]=1;
$_SESSION["pass"]=$_POST["pass"];
}}
if($_SESSION["start"]==1){
 $dir="../xmls/";
 $file=scandir($dir);
 $count=count($file);
while($h<$count)
{ if($file[$h]!=".."&&$file[$h]!="."&&$file[$h]!=""){
list($nfile,$ext)=explode(".",$file[$h]);
$nfile=(int)$nfile;
$file[$h]=$nfile;
}$h++;}
rsort($file);
//print_r($file);
 if(isset($_POST["Apr"])&&$_POST["Apr"]=="Approve")
{
if (isset($_SESSION["pass"])){
$z=hash("sha256",$_SESSION["pass"]);
$fl=$_POST["file"];
if($_SESSION["start"]==1){
 if(file_exists("../xmls/{$fl}.xml")&&$fl!=".."&&$fl!="."&&$fl!=""){
 $xml=simplexml_load_file("../xmls/{$fl}.xml");
 //update
 $xml->approval="1";
 $save=$xml->asXML("../xmls/{$fl}.xml");
  if($save=$xml->asXML("../xmls/{$fl}.xml")){
 echo"<h3>The comment has been approved!</h3>";}
 }}
 }}
 if(isset($_POST["Rem"])&&$_POST["Rem"]=="Remove")
{
if (isset($_SESSION["pass"])){
$z=hash("sha256",$_SESSION["pass"]);
$fl=$_POST["file"];
if($_SESSION["start"]==1){
if(file_exists("../xmls/{$fl}.xml")&&$fl!=".."&&$fl!="."&&$fl!=""){
 if(!unlink("../xmls/{$fl}.xml")){
 echo"<h3>The comment cannot not be Removed!</h3>";}
 else{echo"<h3>The comment has been Removed!</h3>";}}
 }
 }}
 if(isset($_GET["pag"])&&ctype_digit($_GET["pag"]))
 {$i=10;$npag=$_GET["pag"];$next=$npag+1;$p=$_GET["pag"];
$n=$_GET["pag"];
 while($i>=10*$npag&&$i<10*$next){

 if(file_exists("../xmls/{$file[$i]}.xml")&&$file[$i]!=".."&&$file[$i]!="."&&$file[$i]!=""){
 $xml=simplexml_load_file("../xmls/{$file[$i]}.xml");
 if($xml->approval=="0"){
 echo "<h3>{$xml->name}</h3> ";
 echo "<p>{$xml->comment}</p>" ;
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='file' value='{$file[$i]}'><input name='Apr' type='submit' value='Approve'></form>";
 echo"<br>";
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='file' value='{$file[$i]}'><input name='Rem' type='submit' value='Remove'></form>";}
 }$i++;
 }
 }
 else{
 while($i<10){
 if(file_exists("../xmls/{$file[$i]}.xml")&&$file[$i]!=".."&&$file[$i]!="."&&$file[$i]!=""){
 $xml=simplexml_load_file("../xmls/{$file[$i]}.xml");
  if($xml->approval=="0"){
 echo "<h3>{$xml->name}</h3> ";
 echo "<p>{$xml->comment}</p>" ;
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='file' value='{$file[$i]}'><input name='Apr' type='submit' value='Approve'></form>";
 echo"<br>";
 echo " <form method='POST' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='file' value='{$file[$i]}'><input name='Rem' type='submit' value='Remove'></form>";}
 } $i++;

 }
 }
 echo"<p style='text-align:center'>";
if(isset($_GET["pag"])&&ctype_digit($_GET["pag"])){
if($_GET["pag"]==1){
echo "<form name='back' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name=start value='0'><input type='submit' value='Previous'></form>";
echo "<form name='forward' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name=pag value='2'><input type='submit' value='Next'></form>";}
elseif($_GET["pag"]>1){
$p--;
echo "<form name='back' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name=pag value='{$p}'><input type='submit' value='Previous'></form>";
$n++;
echo "<form name='forward' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name=pag value='{$n}'><input type='submit' value='Next'></form>";
}}
else{echo "<form name='seguinte' action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value='1'><input type='submit' value='Next'></form>";}
echo"</p>"; 
}

 $db->close();
 ?>