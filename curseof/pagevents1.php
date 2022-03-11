<?php
//restantes dados das paginas
if($_GET['pag']=="1"){$_SESSION["stime"]=time();}
elseif($_GET['pag']=="2")
{
if($_SESSION['item1']=='skull'){
echo "<h5>You carry the skull of Librahl, go to 199.</h5>";}
else {echo"<h5>You do not carry the skull of Librahl, go to 133.</h5>";}
}
elseif($_GET['pag']=="9")
{if($_SESSION['item2']=='ring'||$_SESSION['item20']=='diamond_ring'){echo "<h5>You have a diamond ring , go to 160.</h5>";}
else{echo"<h5> You do not have a diamond ring, go to 216.</h5>";}}
elseif($_GET['pag']=="11")
{$_SESSION["item1"]='skull';echo" <h5>You got the skull of Librahl.";}
elseif($_GET['pag']=="13")
{$_SESSION["forca"]-=1;echo"<h5> Lose 1 stamina point.</h5>";}
elseif($_GET['pag']=="14")
{if($_SESSION["item3"]=="copper_key"){echo"<h5>You have a copper key , go to 118.</h5>";}}
elseif($_GET['pag']=="26")
{if($_SESSION["item4"]=="matches"){echo"<h5>You have some matches, go to 187</h5>";}}
elseif($_GET['pag']=="27")
{$_SESSION["item5"]="silver_key";echo"<h5> You found a silver key.</h5>";}
elseif($_GET['pag']=="29")
{$_SESSION["item6"]="ruby_ring";echo"<h5> You found a ruby ring.</h5>";}
elseif($_GET['pag']=="30")
{$_SESSION["item7"]="animal_bone";echo"<h5> You found an odd animal bone.</h5>";}
elseif($_GET["pag"]=="34")
{if($_SESSION["item8"]=="voodoo_doll"&&$_SESSION["item9"]=="pin"&&$_SESSION["item10"]=="hair_locket")
{echo"<h5>You have the three items, go to 2.</h5>";}}
elseif($_GET["pag"]=="41")
{if($_SESSION["item11"]=="snake_talisman"&&$_SESSION["item12"]=="HTOB")
{echo "<h5> You got both items , go to 181</h5>";}else{echo" <h5>You haven´t got both items , go to 102 </h5>";}}
elseif($_GET["pag"]=="42")
{$_SESSION["item13"]="book";echo "<h5> You have got the tome on witchcraft</h5>";}
elseif($_GET["pag"]=="51")
{if($_SESSION["item14"]=="screwdriver"){echo"<h5>You have a screwdriver, go to 180.</h5>";}}
elseif($_GET["pag"]=="52")
{$dados1=mt_rand(1,6);$dados2=mt_rand(1,6);echo "<img src=../images/{$dados1}.jpg> + <img src=../images/{$dados2}.jpg>";
$dados=$dados1+$dados2;
if ($_SESSION["sorte"]<$dados){echo "<h5>You hit {$dados} , so you are Unlucky , go to 241</h5>";}
else{echo "<h5>You hit {$dados},you are lucky , go to 162</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="65")
{$_SESSION["item15"]="wooden_stake";if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2")
{echo"<h5> Now you have a weapon, you gain 2 skill points.</h5>";$_SESSION["weapon"]="yes1";
$_SESSION["pericia"]+=2;}if($_SESSION["pericia"]>$_SESSION["periciainicial"]){echo"<h5>You are already at the maximum skill</h5>";$_SESSION["pericia"]=$_SESSION["periciainicial"];}}
elseif($_GET["pag"]=="66")
{if($_SESSION["item16"]=="medallion"){echo"<h5> You carry a gold medallion , you can turn to 147</h5>";}
$_SESSION["item17"]="talisman";}
elseif($_GET["pag"]=="67")
{$_SESSION["sap"]="yes";}
elseif($_GET["pag"]=="69")
{if($_SESSION["word1"]!=""&&$_SESSION["word2"]!=""&&$_SESSION["word3"]!=""&&$_SESSION["word4"]!=""){echo"<h5>You found the four strange words , go to 8</h5>";}
else{echo"<h5>You Did not found the four strange words, go to 133</h5>";}}
elseif($_GET["pag"]=="70")
{$_SESSION["item18"]="shovel";if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2")
{echo"<h5> Now you have a weapon, you gain 2 skill points.</h5>";$_SESSION["weapon"]="yes1";
$_SESSION["pericia"]+=2;}if($_SESSION["pericia"]>$_SESSION["periciainicial"]){echo"<h5>You are already at the maximum skill</h5>";$_SESSION["pericia"]=$_SESSION["periciainicial"];}}
elseif($_GET["pag"]=="72")
{$dice1=mt_rand(2,12); if ($dice1<$_SESSION["sorte"]){echo " <h5>You roll a {$dice1} so you had luck , go to 20 .</h5>";}
else {echo "<h5>You roll  {$dice1} so you had no luck , go to 156</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="73")
{$dice1=mt_rand(2,12); if ($dice1<$_SESSION["sorte"]){echo " <h5>You roll a {$dice1} so you had luck , go to 152 .</h5>";}
else {echo "<h5>You roll  {$dice1} so you had no luck , go to 37</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="76")
{if($_SESSION["item19"]=="shield"){echo"<h5>You carry a shield , go to 202</h5>";}
else{echo "<h5>You do not carry a shield , go 225 </h5>";}}
elseif($_GET["pag"]=="79")
{$_SESSION["note"]="Destroyer of Demons:Bone of the green,Heart of the red,Blood of the yellow,Flesh of the white.";}
elseif($_GET["pag"]=="89")
{$_SESSION["item20"]="diamond_ring";}
elseif($_GET["pag"]=="90")
{$_SESSION["word1"]="XODUS";}
elseif($_GET["pag"]=="93")
{if($_SESSION["bats"]=="yes"){echo"<h5>You have been bitten by a flock of bats, go to 207<h5>";}
else{echo"<h5>You have not been bitten, go to 224</h5>";}}
elseif($_GET["pag"]=="96")
{$_SESSION["item3"]="copper_key";echo"<h5>You found a small copper key.</h5>";}
elseif($_GET["pag"]=="97")
{$dice1=mt_rand(2,12); if ($dice1<$_SESSION["pericia"]){echo " <h5>You roll a {$dice1} so you are sucessful , go to 211 .</h5>";}
else {echo "<h5>You roll  {$dice1} so you are unsuccessful , go to 103.</h5>";}}
elseif($_GET["pag"]=="100")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";$_SESSION["word2"]="KALAK";}
elseif($_GET["pag"]=="101")
{$_SESSION["sorte"]-=2;echo"<h5>You lose 2 luck points</h5>";}
elseif($_GET["pag"]=="108")
{$_SESSION["item21"]="ruby";echo"<h5>You take the large ruby</h5>";}
elseif($_GET["pag"]=="112")
{$_SESSION["item22"]="baby_rattle";echo"<h5>You take the baby´s rattle</h5>";}
elseif($_GET["pag"]=="115")
{$_SESSION["word3"]="TEMUT";}
elseif($_GET["pag"]=="116")
{if($_SESSION["item23"]=="candles"){echo"<h5>You have the candles, go, to 26</h5>";}}
elseif($_GET["pag"]=="119")
{if($_SESSION["item15"]=="wooden_stake"){echo"<h5>You have a wooden stake , go to 89</h5>";}}
elseif($_GET["pag"]=="123")
{$_SESSION["item24"]="bedpan";echo"<h5>You take the bedpan</h5>";}
elseif($_GET["pag"]=="131")
{$_SESSION["item9"]="pin";$_SESSION["item14"]="screwdriver";$_SESSION["forca"]+=2;echo"<h5>You restore 2 stamina points</h5>";}
elseif($_GET["pag"]=="138")
{if($_SESSION["bats"]=="yes"){echo"<h5>You are under the influence of Anastasia Blackwood go to 3</h5>";}
else{echo"<h5>You are not under the influence of Anastasia Backwood , go to 186</h5>";}} 
elseif($_GET["pag"]=="141")
{if($_SESSION["vashnech"]=="yes"){echo"<h5>You have read a letter from Vashnech, go ,to 11</h5>";}
else{echo"<h5>You have not read a letter from Vashnech, go to 61</h5>";}}
elseif($_GET["pag"]=="147")
{$_SESSION["item12"]="HTOB";echo"<h5>You mark the word HTOB </h5>";}
elseif($_GET["pag"]=="149")
{echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>COUNT BLACKWOOD</b></p>Skill:<input type='text' name='bskill' value='12' readonly='readonly'>";
echo "Stamina:<input type='text' name='bstamina' value='20' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
//se ouver luta
if(isset($_GET["bskill"])&&ctype_digit($_GET["bskill"])&&ctype_digit($_GET["bstamina"])&&isset($_GET["bstamina"]))
{
echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//caso nao tenha arma diminuir a pericia do heroi
if($_SESSION["weapon"]=="no1"){echo"<h5>You have no weapon, your skill is reduced by 2 points</h5>";$_SESSION["pericia"]-=2;}
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["forca"]>0&&$_GET["bstamina"]>18)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["bskill"];
if($resultado1>$resultado2){$_GET["bstamina"]-=2;echo "<h5>{$count} You hit your enemy </h5> <h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;</script>";}
if ($_GET["bstamina"]<=18){echo"<h3>You Win you first attack round go to 58</h3>";}
}
if($_SESSION["weapon"]=="no1"){$_SESSION["weapon"]="no2";}
if($_SESSION["weapon"]=="yes1"){$_SESSION["weapon"]="yes2";}
if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
}
}
include("pagevents2.php");
?>
