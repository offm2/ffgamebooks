<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Rise of the Night Creatures</title>
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
  <p>Saving adventure's progress area</p>
    <div style="text-align:center">
    <h3>Rise of the night creatures&copy</h3><h3> by T.M. Badowski  </h3>
<?php
	session_start();
//local do ficheiro
if (isset($_SESSION["pass"])){
$path="files/{$_SESSION["pass"]}.txt";
}
if($_POST["pass"]==$_SESSION["pass"]){
//criar ficheiro e escrever
if(isset($_SESSION["forca"])){

	if(!$abrir=fopen($path,"wb")){
		echo "Cannot open file {$path} ";
		exit;
	}
//escrever conteudo no ficheiro
	$conteudo="{$_SESSION['nome']},{$_SESSION['forca']},{$_SESSION['pericia']},{$_SESSION['sorte']},{$_SESSION['lproesa']},";
	$conteudo.="{$_SESSION['provisoes']},{$_SESSION['ouro']},{$_SESSION['note']},{$_SESSION['curse']},{$_SESSION['code']},";
	$conteudo.="{$_SESSION['item1']},{$_SESSION['item2']},{$_SESSION['item3']},{$_SESSION['item4']},{$_SESSION['item5']},";
	$conteudo.="{$_SESSION['item6']},{$_SESSION['item7']},{$_SESSION['item8']},{$_SESSION['item9']},{$_SESSION['item10']},";
	$conteudo.="{$_SESSION['item11']},{$_SESSION['item12']},{$_SESSION['item13']},{$_SESSION['item14']},{$_SESSION['item15']},";
	$conteudo.="{$_SESSION['item16']},{$_SESSION['item17']},{$_SESSION['item18']},{$_SESSION['item19']},{$_SESSION['item20']},";
	$conteudo.="{$_SESSION['item21']},{$_SESSION['item22']},{$_SESSION['item23']},{$_SESSION['item24']},";
	$conteudo.="{$_SESSION['weapon']},{$_SESSION['piano']},{$_SESSION['gas'];
	$conteudo.="{$_SESSION['periciainicial']},{$_SESSION['sorteinicial']},{$_SESSION['forcainicial']},{$_SESSION['pag']},";

	if(fwrite($abrir,$conteudo)===FALSE){
		echo "Cannot write to file {$path}";
		exit;
	}
	echo " <h4>Saved file sucessfully...</h5>";
	fclose($abrir);
	


	
//ficheiro com a password
/*$path2="ff.txt";

	if(!$abrir2=fopen($path2,"wb")){
		echo "Cannot open file {$path2} ";
		exit;
	}
	$conteudo2=$_SESSION["pass"];
	settype($conteudo2,"string");
	if(fwrite($abrir2,$conteudo2)===FALSE){
		echo "Cannot write to file {$path2}";
		exit;
	}
	
	fclose($abrir2);

*/
}
else {echo "<h5>Session not started , could not save </h5>";}
}
else {echo "<h5>Password not correct</h5>";}

if (isset($_SESSION["pass"])){
echo "<h3> The password is: {$_SESSION["pass"]} </h3>Note:Please save the password in a text file for later use";
}
?>
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
                 var section=$("#rt8",div.get(0));
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