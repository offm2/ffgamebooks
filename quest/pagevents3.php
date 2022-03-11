<?php
if($_GET["pag"]=="81")
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
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["zpericia1"];

if($resultado1>$resultado2){$_SESSION["zforce1"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["zpericia1"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["zpericia1"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
}
if ($_SESSION["zforce1"]<=0){$_SESSION["nbattle"]+=1;echo"<h3>You Win!</h3>";}
}}
if($_GET["pag"]=="83")
{$_SESSION["provisoes"]+=2;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 2;</script>";
$_SESSION["ouro"]+=1;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 1;</script>";}
if($_GET["pag"]=="84")
{$_SESSION["provisoes"]+=3;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 3;</script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1;</script>";}
if($_GET["pag"]=="85")
{$die=rand(1,6);
if($die==1||$die==3||$die==6){echo "<h5> You hit {$die} so you could not open the door </h5>";$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 1;</script>";}
else{echo "<h5> You Knock down the door you can turn to 181 . </h5>";$_SESSION["forca"]-=2;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 2;</script>";}}
if($_GET["pag"]=="86")
{$_SESSION["ouro"]+=1;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 1;</script>";}
if($_GET["pag"]=="88")
{$_SESSION["forca"]=$_SESSION["forcainicial"];}
if($_GET["pag"]=="90")
{$die3=rand(1,6);echo "<h5>You have been hit by the slime acid lose {$die3} Stamina points</h5>";$_SESSION["forca"]-=$die3;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-Number({$die3});</script>";
if($_SESSION["item4"]=="vial_green"){echo"<h5>You can turn to page 102.</h5>";}}
if($_GET["pag"]=="92")
{$_SESSION["item13"]="lightning";echo"<script type='text/javascript'>item13=Number(document.getElementById('item13').innerHTML);document.getElementById('item13').innerHTML='lightning'; </script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";
$_SESSION["provisoes"]+=1;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 1; </script>";}
if($_GET["pag"]=="94")
{if($_SESSION["item19"]=="flute"){echo"<h5> You have a flute if you wish you can turn to page 176</h5>";}
if($_SESSION["item20"]=="silver_bell"){echo"<h5> You have a silver bell if you wish to use it turn to 193</h5>";}}
if($_GET["pag"]=="96")
{$_SESSION["forca"]-=2;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";if (rand(2,12)<$_SESSION["pericia"]){echo "<h5> You are skilful and you could dodge the acid throw</h5>";}
else{$_SESSION["forca"]-=3;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;</script>";echo"<h5> The acid hits you</h5>";}}
if($_GET["pag"]=="97")
{$_SESSION["forca"]-=1;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";}
if($_GET["pag"]=="99")
{$_SESSION["ouro"]+=11;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 11;</script>";}
if($_GET["pag"]=="101")
{$_SESSION["ouro"]+=6;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 6;</script>";
$_SESSION["item8"]="silver_ring";echo"<script type='text/javascript'>document.getElementById('item8').innerHTML='silver_ring';</script>";}
if($_GET["pag"]=="102")
{$_SESSION["item12"]="wind_spell";echo"<script type='text/javascript'>document.getElementById('item12').innerHTML='wind_spell';</script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";}
if($_GET["pag"]=="103")
{$_SESSION["forca"]+=4;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+4;</script>";
$_SESSION["pericia"]+=1;echo "<script type='text/javascript'>pericia=Number(document.getElementById('pericia').innerHTML);document.getElementById('pericia').innerHTML=pericia+1;</script>";}
include("pagevents4.php");
?>