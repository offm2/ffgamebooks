<?php
if($_GET["pag"]=="141")
{
if($_SESSION['ouro']>1)
{echo "<center>Buy items ";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='1' name='sdagger'><input type='submit' value='Buy silver dagger'> </form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='orb' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Orb of Flame'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='chainmail' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Chainmail Armour'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='platemail' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Platemail Armour'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='potion' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Potion of Healing'></form></center>";
if(isset($_GET["sdagger"]))
{$_SESSION["item3"]="silver_dagger";echo"<script type='text/javascript'>document.pontuacao.item3.value='silver_dagger';</script>";
$_SESSION["ouro"]-=2;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 2;</script>";}
if(isset($_GET["orb"]))
{$_SESSION["item18"]="orb_of_flame";echo"<script type='text/javascript'>document.pontuacao.item18.value='orb_of_flame';</script>";
$_SESSION["ouro"]-=4;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 4;</script>";}
if(isset($_GET["chainmail"]))
{$_SESSION["armour"]="chainmail";echo"<script type='text/javascript'>document.pontuacao.armour.value='chainmail';</script>";
$_SESSION["ouro"]-=5;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 5;</script>";}
if(isset($_GET["platemail"]))
{$_SESSION["armour"]="platemail";echo"<script type='text/javascript'>document.pontuacao.armour.value='platemail';</script>";
$_SESSION["ouro"]-=8;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 8;</script>";}
if(isset($_GET["potion"]))
{$_SESSION["provisoes"]+=3;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 3;</script>";
$_SESSION["ouro"]-=3;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 3;</script>";}
}
$_SESSION["nbattle3"]=$_SESSION["nbattle"];}
if($_GET["pag"]=="147")
{$roll=rand(1,6);if($roll==1||$roll==2){echo "<h5>Its a potion of healing</h5>";$_SESSION["forca"]+=4;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+4;</script>";}
elseif($roll==3||$roll==4){echo"<h5>Its a potion of speed</h5>";if(isset($_GET["iskill"])){$_GET["istamina"]-=4;}}else{echo"<h5> Its a potion of clumsiness</h5>";if(isset($_GET["iskill"])){$_SESSION["forca"]-=2;}else{$_SESSION["pericia"]-=1;}}}
if($_GET["pag"]=="148")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 72 </h5>";}else{echo" <h5> You did not have luck turn to 13</h5>";}}
if($_GET["pag"]=="151"){if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You were skilled turn to 55 </h5>";}else{echo" <h5> You did not have skill turn to 131</h5>";}}
if($_GET["pag"]=="152"){$_SESSION["ouro"]+=6;$_SESSION["item15"]="golden_key";echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 6;</script>";	
echo"<script type='text/javascript'>document.getElementById('item15').innerHTML='golden_key';</script>";
if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 9 </h5>";}else{echo" <h5> You did not have luck turn to 183</h5>";}}
if($_GET["pag"]=="153"){$_SESSION["forca"]-=6;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-6;</script>";}
if($_GET["pag"]=="157"){echo"<h5>You loose one stamina point</h5>";$_SESSION["forca"]-=1;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";}
if($_GET["pag"]=="159"){if ($_SESSION["item9"]=="b_gauntlet"){echo"<h5> Turn to page 186 </h5>";}if($_SESSION["item8"]=="silver_ring"){$_SESSION["iskill"]-=1;}}
if($_GET["pag"]=="162"){$_SESSION["forca"]+=3;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+3;</script>";
if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You were skilled turn to 91 </h5>";}else{echo" <h5> You did not have skill turn to 122</h5>";}}
if($_GET["pag"]=="164"){$_SESSION["orc2p"]=8;$_SESSION["orc2f"]=7;
//disputar combate com 2� orc
if(isset($_GET["iskill"])){echo "<h5>Fight Second Orc SKILL: 8 STAMINA: 7 </h5>";
while($_SESSION["forca"]>0&&$_SESSION["orc2f"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["orc2p"];
if($resultado1<$resultado2){echo"<h5>{$count} You have been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["orc2p"]} = {$resultado2}</h5>";$_SESSION["forca"]-=2;
echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-6;</script>";}
else{echo "<h5>{$count} You hit your enemy </h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["orc2p"]} = {$resultado2}</h5>";$_SESSION["orc2f"]-=2;}
if($_SESSION["orc2f"]<=0){echo"<h3>You Win!</h3>";}}}}
if($_GET["pag"]=="165"){$_SESSION["forca"]-=1;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";
if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 43 </h5>";}else{echo" <h5> You did not have luck turn to 113</h5>";}$_SESSION["sorte"]-=1;}
if($_GET["pag"]=="166"){$_SESSION["forca"]-=1;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";}
if($_GET["pag"]=="167"){if($_SESSION["item6"]=="red_key"){echo "<h5> You have the red key and can open it go to 15 </h5>";}else{echo "<p>____</p>";}}
if($_GET["pag"]=="168"){$_SESSION["ouro"]+=6;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 6;</script>";	
$_SESSION["provisoes"]+=1;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 1;</script>";}
if($_GET["pag"]=="172"){$_SESSION["item10"]="flame_sword";echo"<script type='text/javascript'>document.getElementById('item10').innerHTML='flame_sword';</script>";
$_SESSION["sorte"]+=1;echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;</script>";}
if($_GET["pag"]=="173"){if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You are skilled  </h5>";$_SESSION["forca"]-=2;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
else{echo" <h5> You did not have skill to dodge the fireball</h5><h3>Game Over!</h3>";}}
if($_GET["pag"]=="176"){$_SESSION["item19"]="";}
if($_GET["pag"]=="178"){if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You are skilled turn to 111 </h5>";}else{echo" <h5> You did not have skill turn to 49</h5>";}}
if($_GET["pag"]=="180"||$_GET["pag"]=="181"){if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You are skilled turn to 198 </h5>";}else{echo" <h5> You did not have skill turn to 189</h5>";}}
if($_GET["pag"]=="182"){$_SESSION["forca"]-=4;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-4;</script>";}
if($_GET["pag"]=="183"){$_SESSION["ouro"]+=8;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 8;</script>";	
$_SESSION["item20"]="silver_bell";echo"<script type='text/javascript'>document.getElementById('item20').innerHTML='silver_bell';</script>";if($_SESSION["item4"]=="vial_green"){echo "<h5>You can go to page 11 </h5>";}}
if($_GET["pag"]=="185"){if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 63 </h5>";}else{echo" <h5> You did not have luck turn to 38</h5>";}$_SESSION["sorte"]-=1;}
if($_GET["pag"]=="186"){$_SESSION["item9"]="";}
if($_GET["pag"]=="187"){$_SESSION["ouro"]+=11;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 11;</script>";
$_SESSION["item19"]="flute";echo"<script type='text/javascript'>document.getElementById('item19').innerHTML='flute';</script>";}
if($_GET["pag"]=="189"){$_SESSION["forca"]-=1;echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";}
if($_GET["pag"]=="192"){if(rand(2,12)<$_SESSION["sorte"]){echo"<h5> You were lucky turn to 170 </h5>";}else{echo" <h5> You did not have return to 82</h5>";}$_SESSION["sorte"]-=1;}
if($_GET["pag"]=="196"){$_SESSION["sorte"]+=2;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+2;</script>";
if($_SESSION["provisoes"]>0){echo "<h5>you decide to rest and drink a stamina potion</h5>";
echo "<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);";
echo "forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+4;";
echo "document.getElementById('provisoes').innerHTML=provisoes-1;</script>";
$_SESSION["provisoes"]-=1;$_SESSION["forca"]+=4;}if($_SESSION["item17"]!=""){echo"<h5>The number in the ring was {$_SESSION["item17"]} </h5>";}}
if($_GET["pag"]=="197"){$_SESSION["item2"]="warhammer";echo"<script type='text/javascript'>document.getElementById('item2').innerHTML='warhammer';</script>";
if($_SESSION["pericia"]<9){$_SESSION["forca"]-=1;}elseif($_SESSION["pericia"]>9){$_SESSION["forca"]+=1;}}
if($_GET["pag"]=="200")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
if(!isset($_SESSION["gamebook"]))
{$_SESSION["gamebook"]="The Quest for the Ebony Wand";}
}
echo"<center><h2>You Win </h2></center>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}
	?>