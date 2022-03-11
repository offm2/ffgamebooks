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
	$conteudo="{$_SESSION['nome']},{$_SESSION['forca']},{$_SESSION['pericia']},{$_SESSION['sorte']},";
	$conteudo.="{$_SESSION['provisoes']},{$_SESSION['bats']},{$_SESSION['ouro']},{$_SESSION['vashnech']},";
	$conteudo.="{$_SESSION['item1']},{$_SESSION['item2']},{$_SESSION['item3']},{$_SESSION['item4']},{$_SESSION['item5']},";
	$conteudo.="{$_SESSION['item6']},{$_SESSION['item7']},{$_SESSION['item8']},{$_SESSION['item9']},{$_SESSION['item10']},";
	$conteudo.="{$_SESSION['item11']},{$_SESSION['item12']},{$_SESSION['item13']},{$_SESSION['item14']},{$_SESSION['item15']},";
	$conteudo.="{$_SESSION['item16']},{$_SESSION['item17']},{$_SESSION['item18']},{$_SESSION['item19']},{$_SESSION['item20']},";
	$conteudo.="{$_SESSION['item21']},{$_SESSION['item22']},{$_SESSION['item23']},{$_SESSION['item24']},{$_SESSION['item25']},";
	$conteudo.="{$_SESSION['item26']},{$_SESSION['item27']},{$_SESSION['item28']},{$_SESSION['tdhead']},{$_SESSION['sap']},";
	$conteudo.="{$_SESSION['word1']},{$_SESSION['word2']},{$_SESSION['word3']},{$_SESSION['word4']},{$_SESSION['weapon']},";
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