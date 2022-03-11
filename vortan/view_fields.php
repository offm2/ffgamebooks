<?php
include("fastread.html");
if(isset($_SESSION["forca"])){
if (isset($_GET['pag'])&&ctype_digit($_GET["pag"]))
{
//buscar os valores passados nas forms
$pericia=$_SESSION['pericia'];$forca=$_SESSION['forca'];$sorte=$_SESSION['sorte'];
$provisoes=$_SESSION['provisoes'];
settype($pericia,"int");settype($forca,"int");settype($sorte,"int");
settype($ouro,"int");settype($provisoes,"int");
//conectar á base de dados
class MyDB extends SQLite3
{function __construct(){$this->open('ffgamebooks_vvortan-bd.db3',SQLITE3_OPEN_READONLY);}}
$db = new MyDB();
if(ctype_digit($_GET["pag"])){
$stm =$db->prepare("SELECT * FROM venom WHERE incremento=:pag");
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
$texto=utf8_encode($ver['textos']);
echo "<div id='sayt'>{$texto}</div>";
//se ouver nome de inimigos inserir
if ($ver['inimigos']!="") {
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>".$ver['inimigos']."</b></p>Skill:<input type='text' name='iskill' value='{$ver[pericia]}' readonly='readonly'>";
echo "Stamina:<input type='text' name='istamina' value='{$ver['forca']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
}}$resultado->finalize();}$db->close();
}
//se ouver luta
if(isset($_GET["iskill"])&&ctype_digit($_GET["iskill"])&&isset($_GET["istamina"])&&ctype_digit($_GET["istamina"]))
{
echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//extra damage on pag.65
if($_SESSION["extrad"]==3){$_GET["istamina"]-=3;echo"<h5>Enemy Stamina reduced by 3 points due to previous blow</h5>";$_SESSION["extrad"]="";}
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["forca"]>0&&$_GET["istamina"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){$_GET["istamina"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_GET["istamina"]-=1;}echo "<h5>{$count} You hit your enemy </h5> <h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";if($vortan==1){$dice5=mt_rand(1,6);echo"<h5>Your dice roll:{$dice5}</h5>";if($dice5==1){echo"<h5>You are poisened by the envenomed fang and lose 1 stamina point</h5>";$_SESSION["forca"]-=1;}else{echo"<h5>Vortan's fangs did not poison you</h5>";}}}
if ($_GET["istamina"]<=0){echo"<h3>You Win!</h3>";}
}
}
//beber pocao
if(isset($_GET["pag"])){if($_GET["pocao"]=="drink"){if($_SESSION["pocao"]=="stamina")
{echo"<h5>You drink a stamina potion</h5>";$_SESSION["forca"]=$_SESSION["forcainicial"];$_SESSION["pocao"]="";}
elseif($_SESSION["pocao"]=="skill")
{echo"<h5>You drink a skill potion</h5>";$_SESSION["pericia"]=$_SESSION["periciainicial"];$_SESSION["pocao"]="";}
elseif($_SESSION["pocao"]=="luck")
{echo"<h5>You drink a luck potion</h5>";$_SESSION["sorte"]=$_SESSION["sorteinicial"]+1;$_SESSION["pocao"]="";}
else {echo"<h5>You do not have any potion to drink</h5>";}}}
//comer provisoes
if(isset($_GET["pag"])){if($_GET["prov"]=="eat"){if($_SESSION["provisoes"]>0){$_SESSION["forca"]+=4;$_SESSION["provisoes"]-=1;echo"<h5>You eat a provision</h5>";}}}
}
else {echo"<h5>You need to create a character on the starting page</h5>";}
?>