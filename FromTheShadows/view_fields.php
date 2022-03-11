<?php
include("fastreader.html");
if(isset($_GET['pag'])&&ctype_digit($_GET["pag"]))
{

//buscar os valores passados nas forms

$pericia=$_SESSION['pericia'];$forca=$_SESSION['forca'];$sorte=$_SESSION['sorte'];

$ouro=$_SESSION['ouro'];$provisoes=$_SESSION['provisoes'];

settype($pericia,"int");settype($forca,"int");settype($sorte,"int");

settype($ouro,"int");settype($provisoes,"int");

//conectar á base de dados



class MyDB extends SQLite3

{

    function __construct()

    {

        $this->open('ffgamebooks_ftshadows_-bd.db3',SQLITE3_OPEN_READONLY);

    }

}



$db = new MyDB();



if(ctype_digit($_GET["pag"])){

$stm =$db->prepare("SELECT * FROM ftshadows WHERE incremento=:pag");
$stm->bindValue(':pag',$_GET['pag']);
$resultado=$stm->execute();

if($resultado==FALSE)

{die("Error:");}}

else{echo "<h5>---No page---</h5>";}

//tilizar os dados da BaseDados

if (isset($resultado)){

while($ver=$resultado->fetchArray())

{echo "<h5 align='center'>".$ver['incremento']."</h5>";

//se existir imagem na BD

if ($ver['imagem']!="")

{echo "<img align='right' src='{$ver['imagem']}' widht=100 height=100>";}
$texto=$ver['textos'];
echo "<div id='sayt'><p>{$texto}</p></div>";



//se ouver nome de inimigos inserir

if ($ver['inimigos']!="") {

echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>".$ver['inimigos']."</b></p>Skill:<input type='text' name='iskill' value='{$ver[pericia]}' readonly='readonly'>";

echo "Stamina:<input type='text' name='istamina' value='{$ver['forca']}' readonly='readonly'>";

echo "<input type='hidden' name='pag' value={$_GET['pag']}>";

echo "<input type='submit' value='Fight'>";

echo "</form>";

}}$resultado->finalize();}$db->close();

if ($_SESSION["forca"]<4&&$_SESSION["forca"]>0&&$_SESSION["provisoes"]>0)

{echo "<h5>you decide to rest and eat a provision</h5>";

echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";

echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";

echo "document.pontuacao.provisoes.value=provisoes-1;</script>";

$_SESSION["provisoes"]-=1;$_SESSION["forca"]+=4;

}

}

//se ouver luta

if(isset($_GET["iskill"])&&ctype_digit($_GET["iskill"])&&isset($_GET["istamina"])&&ctype_digit($_GET["istamina"]))

{

echo "<img align='left' src='imagens/luta.gif'>";

$count=0;

//caso nao tenha arma diminuir a pericia do heroi

if($_SESSION["weapon"]=="no1"){echo"<h5>You have no weapon, your skill is reduced by 2 points</h5>";$_SESSION["pericia"]-=2;}

//enquanto um dos 2 nao morrer disputar combate

while($_SESSION["forca"]>0&&$_GET["istamina"]>0)

{

$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);

$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];

if($resultado1>$resultado2){$_GET["istamina"]-=2;echo "<h5>{$count} You hit your enemy </h5> <h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}

elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}

else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;</script>";}

if ($_GET["istamina"]<=0){echo"<h3>You Win!</h3>";}

}

if($_SESSION["weapon"]=="no1"){$_SESSION["weapon"]="no2";}

if($_SESSION["weapon"]=="yes1"){$_SESSION["weapon"]="yes2";}

}



?>