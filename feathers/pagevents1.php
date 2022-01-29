<?php
//restantes dados das paginas
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="3")
{
if($_SESSION['item1']=='golden_amulet'){
echo "<h5>You have a golden amulet, turn to 31.</h5>";}
else {echo"<h5>You do not have a golden amulet, turn to 12.</h5>";}
}
elseif($_GET['pag']=="5")
{
echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";
echo "<h5>You Lost 1 luck point </h5>";
$_SESSION["sorte"]-=1;
}
elseif($_GET['pag']=="6")
{
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+20;</script>";
echo "<h5>You take the 20 gold pieces </h5>";
$_SESSION["ouro"]+=20;
}
elseif($_GET["pag"]=="7")
{$_SESSION['Man_Orc']=8;$_SESSION['Street_Tug']=14;
echo "<br><p><form action='{$_SERVER[PHP_SELF]}'><p><b>Man Orc Vs Street Tug</b>";
echo "<input type='hidden' value='$_SESSION[Man_Orc]' name='manorc'><input type='hidden' value='$_SESSION[Street_Tug]' name='tug'><input type='hidden' name='pag' value='$_GET[pag]'><input type='submit' value='Fight'></form></p>";

if(isset($_GET["manorc"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["Man_Orc"]>0&&$_SESSION["Street_Tug"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+8;$resultado2=$dice3+$dice4+7;
if($resultado1>$resultado2){$_SESSION["Street_Tug"]-=2;echo "<h5>{$count} Street Tug has been hit </h5><h5>Manorc : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + 8 = {$resultado1} Vs Tug: <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + 7 = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5{$count} Nobody has been hit</h5><h5>Manorc : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + 8 = {$resultado1} Vs Tug: <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + 7 = {$resultado2}</h5>";}
else {$_SESSION["Man_Orc"]-=2;echo"<h5>{$count} Man Orc has been hit</h5><h5>Manorc : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + 8 = {$resultado1} Vs Tug: <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + 7 = {$resultado2}</h5>";}
if ($_SESSION["Man_Orc"]<=0){echo"<h3>Street Tug Wins!</h3>";}
elseif($_SESSION["Street_Tug"]<=0){echo"<h3>Man Orc Wins!</h3>";}
}
if($_SESSION["bet"]=="Man_Orc"&&$_SESSION["Street_Tug"]<=0){echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+10;</script>";echo "<h5>You take the 10 gold pieces </h5>";$_SESSION["ouro"]+=10;}
elseif($_SESSION["bet"]=="Street_Tug"&&$_SESSION["Man_Orc"]<=0){echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+10;</script>";echo "<h5>You take the 10 gold pieces </h5>";$_SESSION["ouro"]+=10;}
else{echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro-5;</script>";echo "<h5>You give the dwarf 5 gold pieces </h5>";$_SESSION["ouro"]-=5;}
}
}
elseif($_GET["pag"]=="16")
{
echo "<script type='text/javascript'>pericia=Number(document.getElementById('pericia').innerHTML);document.getElementById('pericia').innerHTML=pericia-1;</script>";
echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-6;</script>";
echo "<h5>You Lost 1 Skill point and 6 Stamina points </h5>";
$_SESSION["forca"]-=6;$_SESSION["pericia"]-=1;
}

elseif($_GET['pag']=="17")
{
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+2;</script>";
echo "<h5>You take the 2 gold pieces </h5>";
$_SESSION["ouro"]+=2;
}
elseif($_GET["pag"]=="18")
{
$_SESSION["southernerf"]=6;
if(isset($_GET["iskill"]))
{
//disputar combate com 2� southerner pag. 18
if($_SESSION["southernerf"]==6)
{
echo "<h5>Fight Second red garbed Southerner SKILL: 9 STAMINA:6</h5>";
while($_SESSION["forca"]>0&&$_SESSION["southernerf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);settype($_GET["iskill"],"integer");
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"]+1;$iskill=$_GET["iskill"]+1;
if($resultado1>$resultado2){$_SESSION["southernerf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";} 
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["southernerf"]<=0){echo"<h3>You Win!</h3>";}
}
}}
}
elseif($_GET["pag"]=="19")
{$_SESSION["sguardf"]=8;
if(isset($_GET["iskill"]))
{
//disputar combate com 2� guarda pag. 19
if($_SESSION["sguardf"]==8)
{
echo "<h5>Fight second guard SKILL: 6 STAMINA:8</h5>";
while($_SESSION["forca"]>0&&$_SESSION["sguardf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);settype($_GET["iskill"],"integer");
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"]-1;$iskill=$_GET["iskill"]-1;
if($resultado1>$resultado2){$_SESSION["sguardf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["sguardf"]<=0){echo"<h3>You Win!</h3>";}
}
}}
$_SESSION["tguardf"]=7;
if(isset($_GET["iskill"]))
{
//disputar combate com 3� guarda pag. 19
if($_SESSION["tguardf"]==7)
{
echo "<h5>Fight third guard SKILL: 6 STAMINA:7</h5>";
while($_SESSION["forca"]>0&&$_SESSION["tguardf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);settype($_GET["iskill"],"integer");
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){$_SESSION["tguardf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["tguardf"]<=0){echo"<h3>You Win!</h3>";}
}
}}
}
elseif($_GET["pag"]=="20"){$_SESSION["item1"]="golden_amulet";echo "<script type='text/javascript'>document.getElementById('item1').innerHTML='golden_amulet';</script>";}
elseif($_GET['pag']=="21")
{
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+50;</script>";
echo "<h5>You take the 50 gold pieces </h5>";
$_SESSION["ouro"]+=50;
}

include("pagevents2.php");
?>
