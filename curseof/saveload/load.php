<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Curse of Blackwood Manor</title>
<link href="../../1.css" rel="stylesheet" type="text/css" />
<link href="../../2.css" rel="stylesheet" type="text/css" />
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
<?php include_once("../../header_html/header_bootstrap.html");?>
<?php include_once("../../menu_html/menu_bootstrap_adv2_saveload.html")?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <div id='rate1'></div>
  <p>Loading adventures</p>
    <div style="text-align:center">
    <h3>Curse of Blackwood Manor&copy</h3><h3> by Craig Dutton  </h3>
<?php
	session_start();
	ob_start();
	//form de confirmacao da password
echo "<body><form method='POST' action={$_SERVER['PHP_SELF']}>Password:<input type='text' name='pass' maxlength=12 size=12><input type='submit' value='insert'></form>";

if(isset($_POST["pass"]))
{
if(ctype_alnum($_POST["pass"])){
$path="files/{$_POST["pass"]}.txt";
if(file_exists($path))
{

//abrir e ler ficheiro
	if(!$abrir=fopen($path,"r")){
		echo "Cannot open file {$path} ";
		exit;
	}
	if(!$conteudo=fread($abrir,filesize($path))){
		echo " Could not read file {$path} ";
	    exit;
	}


//listar conteudo
list($nome,$forca,$pericia,$sorte,$provisoes,$bats,$ouro,$vash,$i1,$i2,$i3,$i4,$i5,$i6,$i7,$i8,$i9,$i10,$i11,$i12,$i13,$i14,$i15,$i16,$i17,$i18,$i19,$i20,$i21,$i22,$i23,$i24,$i25,$i26,$i27,$i28,$tdhead,$sap,$word1,$word2,$word3,$word4,$weapon,$pi,$si,$fi,$pag)=explode(",",$conteudo);
//escrever conteudo nas sessoes
$_SESSION["nome"]=$nome;$_SESSION["forca"]=$forca;$_SESSION["pericia"]=$pericia;$_SESSION["sorte"]=$sorte;
$_SESSION["provisoes"]=$provisoes;$_SESSION["bats"]=$bats;$_SESSION["ouro"]=$ouro;$_SESSION["vashnech"]=$vash;
$_SESSION["item1"]=$i1;$_SESSION["item2"]=$i2;$_SESSION["item3"]=$i3;$_SESSION["item4"]=$i4;$_SESSION["item5"]=$i5;
$_SESSION["item6"]=$i6;$_SESSION["item7"]=$i7;$_SESSION["item8"]=$i8;$_SESSION["item9"]=$i9;$_SESSION["item10"]=$i10;
$_SESSION["item11"]=$i11;$_SESSION["item12"]=$i12;$_SESSION["item13"]=$i13;$_SESSION["item14"]=$i14;$_SESSION["item15"]=$i15;
$_SESSION["item16"]=$i16;$_SESSION["item17"]=$i17;$_SESSION["item18"]=$i18;$_SESSION["item19"]=$i19;$_SESSION["item20"]=$i20;
$_SESSION["item21"]=$i21;$_SESSION["item22"]=$i22;$_SESSION["item23"]=$i23;$_SESSION["item24"]=$i24;$_SESSION["item25"]=$i25;
$_SESSION["item26"]=$i26;$_SESSION["item27"]=$i27;$_SESSION["item28"]=$i28;$_SESSION["tdhead"]=$tdhead;$_SESSION["sap"]=$sap;
$_SESSION["word1"]=$word1;$_SESSION["word2"]=$word2;$_SESSION["word3"]=$word3;$_SESSION["word4"]=$word4;$_SESSION["weapon"]=$weapon;
$_SESSION["periciainicial"]=$pi;$_SESSION["sorteinicial"]=$si;$_SESSION["forcainicial"]=$fi;$_SESSION["pag"]=$pag;
//redireccionar para a pagina principal
sleep(2);
echo "<form action='../index2.php'><input type='hidden' name='pag' value='{$pag}'><input type='submit' value='go to loaded page'>";
//echo "<a href='../index2.php'>Go to loaded page</a>You were in page {$pag}";
ob_flush();
}else {echo "<h3>File not found </h3>";}}else{die("The password must be  number or letters only");}}
echo "<h4>Insert password above to load the data in the pages</h4>";
//para a pagina de highscores
$_SESSION["stime"]=time();
$_SESSION["gamebook"]="Curse of Blackwood Manor (previously saved)";
?>
Note: if the system gets to loaded older passwords will be erased
<script>
$(document).ready(function()
{
    $("#rater").click(function()
    {
        $.ajax(
        {
            type: "GET",
            url: '../../rater/index.php',
            data: {rate: 'yes'},
            success: function(result)
            {
                var div = $("<div>").html(result);
                 var section=$("#rt4",div.get(0));
	        $("#rate1").html(section);
            }
        });
    });
	});
</script>
<p><img src="../../img/1.gif"></p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
</div>
</div>
</div>
</div>
</body>
