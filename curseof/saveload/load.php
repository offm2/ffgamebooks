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

</body>