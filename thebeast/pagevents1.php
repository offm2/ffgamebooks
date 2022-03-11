<?php
//restantes dados das paginas
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="2")
{
echo "<script type='text/javascript'>sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte-1;</script>";
echo "<h5>You lost 1 luck point</h5>";
$_SESSION["sorte"]-=1;
}
elseif($_GET['pag']=="3")
{
echo "<script type='text/javascript'>sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte+1;</script>";
echo "<h5>You Won 1 luck point </h5>";
$_SESSION["sorte"]+=1;
}
elseif($_GET['pag']=="4")
{
if($_SESSION['item2']!="2knives"){echo "<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);";
echo "document.pontuacao.pericia.value=pericia-1;forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-1;";
echo "document.pontuacao.item2.value='';</script>";
echo "<h5>You lost 1 skill point </h5>";
echo "<h5>You lost 1 stamina point </h5>";
Echo "<h5>You lost the knife </h5>";
$_SESSION["pericia"]-=1;$_SESSION["forca"]-=1;$_SESSION["item2"]="";}
else {echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-1;";
echo "document.pontuacao.item2.value='knife';</script>";
echo "<h5>You lost 1 stamina point </h5>";
echo "<h5>You lost a knife</h5>";
$_SESSION["forca"]-=1;$_SESSION["item2"]="knife";
}
}
elseif($_GET["pag"]=="6")
{if($_SESSION["ouro"]>4)
{echo "<br><p align='center'><form action='{$_SERVER[PHP_SELF]}'>";
echo "<input type='hidden' value='5' name='paybandit'><input type='hidden' name='pag' value=$_GET[pag]><input type='submit' value='Pay 5 Gold pieces'></form></p>";
}
if(isset($_GET["paybandit"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-5;</script>";
echo "<h5>You paid 5 gold pieces, you do not need to fight, Go to pag.35</h5>";
$_SESSION["ouro"]-=5;
}
}
elseif($_GET["pag"]=="7")
{
echo"<br>";
if ($_SESSION["personagem"]=="herbalist")
{echo "<h5>You are the herbalist so once you  turn to another page you will restore all your stamina points</h5>";
$_SESSION["forca"]=$_SESSION["forcainicial"];
}
if($_SESSION["personagem"]=="farmer")
{echo "<h5>You are the farmer restore 2 stamina points</h5>";
echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-1;</script>";
$_SESSION["forca"]+=2;
}
if($_SESSION["personagem"]=="blacksmith")
{if($_SESSION["item2"]==""){echo "<h5>You are the blacksmith and you lost your knife but you are tough you gain 1 skill point</h5>";
echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia+1;</script>";
$_SESSION["pericia"]+=1;}
}
}

elseif($_GET['pag']=="9")
{
if ($ouro>5)
{
echo "<center>Choose the Character";
echo "<form action='{$_SERVER[PHP_SELF]}'>";
echo "<input type='radio' name='character' value='warrior'>warrior<input type='radio' name='character' value='sorceress'>sorceress";
echo "<input type='radio' name='character' value='knight'>knight <input type='hidden' name='pag' value=$_GET[pag]><input type='submit' value='Choose'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='1' name='abprov'><input type='submit' value='Buy provisions'> </form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='cmpfaca' value='2knives' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Knife'></form></center>";
}

if (isset($_GET["abprov"]))
{
echo " <script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);document.pontuacao.provisoes.value=provisoes+1;";
echo " ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-1;</script>";
$_SESSION["provisoes"]+=1;$_SESSION["ouro"]-=1;
}
if (isset($_GET["cmpfaca"]))
{
echo " <script type='text/javascript'>item2=Number(document.pontuacao.item2.value);document.pontuacao.item2.value='2knives';";
echo " ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-3;</script>";
$_SESSION["item2"]="2knives";$_SESSION["ouro"]-=3;
}
if(isset($_GET["character"]))
{
function escolha($personagem)
{$_SESSION["character"]=$personagem;}
escolha($_GET["character"]);
if ($ouro>5)
{
if($_SESSION["character"]=="warrior")
{
echo "<h5>You Choose ".$_SESSION["character"]." Go to pag. 12 </h5>";
echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);if (ouro>20){document.pontuacao.ouro.value=ouro-20;}</script>";
$_SESSION["ouro"]-=20;
}
elseif ($_SESSION["character"]=="sorceress")
{
echo "<h5>You Choose ".$_SESSION["character"]." Go to pag. 33 </h5>";
echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);if (ouro>15){document.pontuacao.ouro.value=ouro-15;}</script>";
$_SESSION["ouro"]-=15;
}
elseif ($_SESSION["character"]=="knight")
{
echo "<h5>You Choose ".$_SESSION["character"]." Go to pag . 26 </h5>";
echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);if (ouro> 5){document.pontuacao.ouro.value=ouro-5;}</script>";
$_SESSION["ouro"]-=5;
}
}
}
}
elseif($_GET["pag"]=="10")
{
if($ouro>5)
{
echo "<center><form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value=$_GET[pag]><input type='hidden' value='' name='fighta'><input type='submit' value='Fight Again'> </form>";
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='chooseo' value='' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Choose other character'></form></center>";
}
else
{echo "<center><form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='chooseo' value='' ><input type='hidden' name='pag' value={$_GET["pag"]}> <input type='submit' value='Choose other character'></form></center>";}
if(isset($_GET["fighta"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-5;forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;</script>";
echo "<h5>Return to pag. 20</h5>";$_SESSION["ouro"]-=5;$_SESSION["forca"]+=4;}
if(isset($_GET["chooseo"]))
{echo "<h5> Go to pag. 9 </h5>";}
}
elseif($_GET["pag"]=="11")
{if($_SESSION["provisoes"]>0){
echo "<h5>you decide to rest and eat a provision</h5>";
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
$_SESSION["provisoes"]-=1;$_SESSION["forca"]+=4;}
$_SESSION["note"]=30;

$role=rand(1,6);
if ($role==1||$role==2)
{echo "<b>You role a dice and hit {$role} go to pag. 36 </b>";}
elseif($role==3||$role==4)
{echo "<b>You role a dice and hit {$role} go to pag. 5 </b>";}
elseif ($role==5)
{echo "<b>You role a dice and hit {$role} go to pag. 27 </b>";}
elseif($role==6)
{echo "<b>You role a dice and hit {$role} go to pag. 18 </b>";}
}
include("pagevents2.php");
?>
