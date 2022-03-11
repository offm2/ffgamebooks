<?php
if($_GET["pag"]=="104")
{$_SESSION["ouro"]+=4;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 4;</script>";}
if($_GET["pag"]=="105")
{$roll=rand(1,6);if($roll==1||$roll==3||$roll==6){echo "<h5>You roll {$roll} turn to 16</h5>";}
else{echo "<h5> You roll {$roll} turn to 45</h5>";}}
if($_GET["pag"]=="108")
{if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You are skilfull turn to 81 </h5>";}else{echo "<h5> You have been hit turn to 59 </h5>";}}
if($_GET["pag"]=="114")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 194 </h5>";}else{echo" <h5> You did not have luck turn to 93</h5>";}
$_SESSION["sorte"]-=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
if($_GET["pag"]=="115")
{$_SESSION["ouro"]+=5;echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+5;</script>";
if(rand(2,12)>$_SESSION["sorte"]){$roll=rand(1,6);if($roll==2||$roll==4||$roll==6){$_SESSION["forca"]-=2;$_SESSION["pericia"]-=1;echo"<h5>You cut the hand of your sword arm</h5>";
echo "<script type='text/javascript'>pericia=Number(document.getElementById('pericia').innerHTML);document.getElementById('pericia').innerHTML=pericia-1;</script>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
else {$_SESSION["forca"]-=2;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>"; echo "<h5> You cut your arm </h5>";}}
else{echo"<h5> you did not cut yourself</h5>";}}
if($_GET["pag"]=="118")
{$_SESSION["ouro"]+=12;$_SESSION["provisoes"]+=1;$_SESSION["sorte"]+=1;
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+12;</script>";
echo "<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes+1;</script>";
echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;</script>";}
if($_GET["pag"]=="120")
{if($_SESSION["item14"]==""){if(rand(2,12)<$_SESSION["sorte"]){echo "<h5>You were lucky turn to 100 </h5>";} else { echo "<h5> You did not have luck turn to 67 </h5>";}$_SESSION["sorte"]-=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}}
if($_GET["pag"]=="122")
{$_SESSION["forca"]-=3;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;</script>";}
if($_GET["pag"]=="123")
{$_SESSION["sorte"]+=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;</script>";$_SESSION["forca"]-=3;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;</script>";}
if($_GET["pag"]=="127")
{$roll=rand(1,6);if($roll==1||$roll==2){echo "<h5> You hit {$roll} turn to page 19 </h5>";}
elseif($roll==3||$roll==4){echo "<h5> You hit {$roll} turn to page 104 </h5>";}else {echo " <h5> You hit {$roll} turn to page 86 </h5>";}}
if($_GET["pag"]=="128")
{if(rand(2,12)<$_SESSION["sorte"]){echo "<h5>You were lucky turn to 153 </h5>";} else { echo "<h5> You did not have luck turn to 149 </h5>";}$_SESSION["sorte"]-=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
if($_GET["pag"]=="130")
{$_SESSION["forca"]+=4;$_SESSION["provisoes"]+=3;$_SESSION["sorte"]+=1;
echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+4;</script>";
echo "<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes+3;</script>";
echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;</script>";}
if($_GET["pag"]=="133")
{
$_SESSION["zpericia1"]=6;
echo "<h5> The shadow lord has cast zombies </h5>";
echo "<form name='luta' action='{$_SERVER[PHP_SELF]}' ><p><b>ZOMBIES</b></p>Skill:<input type='text' name='zskill' value='{$_SESSION[zpericia1]}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET[pag]}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["zskill"]))
{
$die=rand(1,6);$_SESSION["zforce1"]=5*$die;
echo "<h5> The shadow lord has cast {$die} zombies </h5>";
echo "Stamina:<input type='text' name='zstamina' value='{$_SESSION["zforce1"]}' readonly='readonly'>";
echo "<img align='left' src='imagens/luta.gif'>";
//contador de n� de batalhas e hits consecutivos
$count=0;
$cqhits=0;
//fazer feiti�o de fogo
if ($_SESSION["item1"]=="fireball"){$i=0;while($i<1){$i++;
if(rand(2,12)<$_SESSION["sorte"]){$_GET["istamina"]-=4;echo "<h5>$i You hit the creature with a fireball</h5>";}else{echo "<h5>$i The fireball missed</h5>";}
}}
/*utilizar o anel de bronze
if($_SESSION["item16"]=="bronze_ring"&&$_SESSION["nbattle2"]<$_SESSION["nbattle"]&&$_SESSION["nbattle2"]+3>$_SESSION["nbattle"])
{$_SESSION["pericia"]+=1;}
//utilizar o orb of flame
if($_SESSION["item18"]=="orb_of_flame"&&$_SESSION["nbattle3"]<$_SESSION["nbattle"]&&$_SESSION["nbattle3"]+3>$_SESSION["nbattle"])
{$_GET["istamina"]-=4;echo "<h5> You hit the creature with the orb of flame</h5>";}*/
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["forca"]>0&&$_SESSION["zforce1"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["zpericia1"];

if($resultado1>$resultado2){$_SESSION["zforce1"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["zpericia1"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>$count You've been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["zpericia1"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
}
if ($_SESSION["zforce1"]<=0){$_SESSION["nbattle"]+=1;echo"<h3>You Win!</h3>";}
}}
if($_GET["pag"]=="134")
{if(rand(2,12)<$_SESSION["sorte"]){echo "<h5>You were lucky turn to 75 </h5>";} else { echo "<h5> You leave the chamber turn to 68 </h5>";}$_SESSION["sorte"]-=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
if($_GET["pag"]=="135")
{$_SESSION["forca"]=$_SESSION["forcainicial"];}
if($_GET["pag"]=="138")
{$_SESSION["forca"]-=2;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";
$roll=rand(1,6);if($roll==1||$roll==2){echo "<h5> You hit {$roll} turn to page 19 </h5>";}
elseif($roll==3||$roll==4){echo "<h5> You hit {$roll} turn to page 104 </h5>";}else {echo " <h5> You hit {$roll} turn to page 86 </h5>";}}
if($_GET["pag"]=="139")
{$_SESSION["forca"]-=2;	if($_SESSION["item19"]!=""){$_GET["istamina"]-=2;$_GET["iskill"]-=1;}
echo "<form action='{$_SERVER[PHP_SELF]}'>";echo "<input type='hidden' name='pag' value={$_GET["pag"]}><input type='hidden' name='escape139'><input type='submit' value='Escape fight'></form>";
if (isset($_GET["escape139"])){$_SESSION["forca"]-=2;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";
echo"<h5>Go to page 110 </h5>";}}
if($_GET["pag"]=="140")
{if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You are skilful turn to 6 </h5>";}else{echo "<h5> You were not skilful turn to 23 </h5>";}}
include("pagevents5.php");	
	?>