<?php
    echo"<div class='image'><center><img src='dictionary/1.gif' width='200' height='200'></center></div>";
	//espera 2 segundo
	sleep(2);
	//remove o div da imagem
	echo"<script>$('.image').remove();</script>";
	//procura a palavra na base dados
	if(isset($_POST["word"])){
	$st = $_POST["word"];
	$str=str_replace(" ","z",$st);
	//Para palavras inglesas
	if(ctype_alnum($str)) {
    $str2=str_replace(" ","_",$st);
	$path="dictionary/1/{$str2}.txt";
	if(file_exists($path)){
	$read=file_get_contents($path);
	echo $read;
	}
	else{echo'<h4>This word is not in the dictionary yet</h4>';}
	}
else{
		echo '<h4>word not accepted</h4>';
	}
}
?>