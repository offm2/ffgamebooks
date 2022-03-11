<?php session_start();
if(isset($_POST["name"])&&isset($_POST["comment"])){
//echo"{$_POST["captcha"]}=={$_SESSION["captcha"]}";
if(isset($_POST["captcha"])&&ctype_digit($_POST["captcha"])){
if($_SESSION["captcha"]==$_POST["captcha"]){
// ler contador
$filename = "ct.txt";
if (file_exists($filename)) {
    $count = file_get_contents($filename);
} else {
    file_put_contents($filename, '1');
}

$name=$_POST["name"];$name=substr($name,0,50);$name=stripslashes($name);$name=htmlspecialchars($name);$name = preg_replace("/&#?[a-z0-9]{2,8};/i","",$name);
$comment=$_POST["comment"];$comment=substr($comment,0,300);$comment=stripslashes($comment);$comment=htmlspecialchars($comment);$comment = preg_replace("/&#?[a-z0-9]{2,8};/i","",$comment);
//create file
$note=<<<XML
<save>
<name>{$name}</name>
<comment>{$comment}</comment>
<approval>0</approval>
</save>
XML;
$xml = new SimpleXMLElement($note);
if($save=$xml->asXML("xmls/{$count}.xml")){echo"<script>alert('Comment Saved, comment will be inserted once it is approved!');</script>";}
$count++;
$handle = fopen($filename, "w+");
fwrite($handle, $count);
fclose($handle);
//header("Location:{$_SERVER[PHP_SELF]}"); 
}}}

?>
<head>
<meta name="DESCRIPTION" content="A place to play gamebooks online in the fighting fantasy style">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks"> 
<meta name="robots" content="all">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple guestbook!</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../feed.xml" rel="alternate" type="application/rss+xml" title="What's New on the fanbooks website" />
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_RIGHT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body>
<?php include_once("../analytics_google.php"); ?>
 <script type="text/javascript">  
        $(document).ready(function () {  
            $('.dropdown-toggle').dropdown();  
        });  
   </script>
<div class="container">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site </h3>
    <h4>Simple guestbook</h4>
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
<div class="col-sm-12">
 <?php 
 $i=0;$b=0;$h=0;
 function createRandomPassword() {

    $chars = "1023456789";
    //
    $c = 0;
    $pass = '' ;

    while ($c <= 5) {
        $num = rand() % 10;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $c++;
    }

    return $pass;

}
$c1=createRandomPassword() ;
//echo $c1;
if(isset($_POST["comment"])){}else{$_SESSION["captcha"]=$c1;}
$p1=substr($c1,0,1);$p2=substr($c1,1,1);$p3=substr($c1,2,1);$p4=substr($c1,3,1);$p5=substr($c1,4,1);$p6=substr($c1,5,1);
 echo" <form name='form' method='POST' action='{$_SERVER[PHP_SELF]}'>
 Name:<input type='text' name='name'>
 Comment:<textarea class='form-control' rows='6' name='comment'></textarea>";
 $ext="jpg";$dirimg="img";
 echo"<p>Please insert the below numbers: <input type='text' name='captcha'></p>";
 echo"<p><img src='{$dirimg}/{$p1}.{$ext}'><img src='{$dirimg}/{$p2}.{$ext}'><img src='{$dirimg}/{$p3}.{$ext}'><img src='{$dirimg}/{$p4}.{$ext}'><img src='{$dirimg}/{$p5}.{$ext}'><img src='{$dirimg}/{$p6}.{$ext}'></p>";
 echo"<input type='submit' value='Submit'>
 </form>";
 $dir="xmls/";
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
 if(isset($_GET["pag"])&&ctype_digit($_GET["pag"]))
 {$i=10;$npag=$_GET["pag"];$next=$npag+1;$p=$_GET["pag"];
$n=$_GET["pag"];
 while($i>=10*$npag&&$i<10*$next){
 if($file[$i]!=".."&&$file[$i]!="."&&$file[$i]!=""){
  if(file_exists("xmls/{$file[$i]}.xml")){
 $xml=simplexml_load_file("xmls/{$file[$i]}.xml");
 if($xml->approval=="1"){
 echo "<h3>{$xml->name}</h3> ";
 echo "<p>{$xml->comment}</p>" ;
}}}$i++;}}
 else{
 while($i<10){
 if(file_exists("xmls/{$file[$i]}.xml")&&$file[$i]!=".."&&$file[$i]!="."&&$file[$i]!=""){
 $xml=simplexml_load_file("xmls/{$file[$i]}.xml");
  if($xml->approval=="1"){
 echo "<h3>{$xml->name}</h3> ";
 echo "<p>{$xml->comment}</p>" ;
}
 } $i++;}} 

 //last file
 //echo"{$file[0]}";

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
 ?>
 </div>
	
<div class="footer">
<?php include_once("../footer3.php"); ?>
</div>
</div>