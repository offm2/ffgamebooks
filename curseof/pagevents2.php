<?php
//beber poção
if($_SESSION["forca"]<4&&$_SESSION["forca"]>0&&$_SESSION["provisoes"]<1&&$_SESSION["potion"]=="yes")
{echo"<h5>You decide to drink the potion</h5>";$_SESSION["forca"]=$_SESSION["forcainicial"];$_SESSION["pericia"]=$_SESSION["periciainicial"];$_SESSION["potion"]="no";}
//pag203 revitalizar
if($_GET["pag"]=="203"){$_SESSION["forca"]=$_SESSION["forcainicial"];$_SESSION["pericia"]=$_SESSION["periciainicial"];$_SESSION["tdhead"]="no";}
elseif($_GET["pag"]=="152")
{$_SESSION["item25"]="dagger";if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2")
{echo"<h5> Now you have a weapon, you gain 2 skill points.</h5>";$_SESSION["weapon"]="yes1";
$_SESSION["pericia"]+=2;if($_SESSION["pericia"]>$_SESSION["periciainicial"]){echo"<h5>You are already at the maximum skill</h5>";$_SESSION["pericia"]=$_SESSION["periciainicial"];}}else{echo"<h5>You already have a weapon</h5>";}
$_SESSION["vashnech"]="yes";
}
elseif($_GET["pag"]=="155")
{$_SESSION["item19"]="shield";$_SESSION["item26"]="crucifix";echo"<h5>You got both items</h5>";}
elseif($_GET["pag"]=="159")
{$_SESSION["forca"]+=4;echo"<h5>You restore 4 stamina points</h5>";}
elseif($_GET["pag"]=="161")
{if($_SESSION["item22"]=="baby_rattle"){echo"<h5>You have a baby rattle, go to 24</h5>";}
else{echo"<h5>You do not have a baby rattle , go to 68</h5>";}}
elseif($_GET["pag"]=="164")
{if($_SESSION["item26"]=="crucifix"){echo"<h5>You carry the crucifix, go to 119</h5>";}
else{echo"<h5>You do not carry a crucifix, go to 15</h5>";}}
elseif($_GET["pag"]=="167")
{echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>FLOCK OF BATS</b></p>Skill:<input type='text' name='bskill' value='6' readonly='readonly'>";
echo "Stamina:<input type='text' name='bstamina' value='4' readonly='readonly'>";
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
while($_SESSION["forca"]>0&&$_GET["bstamina"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["bskill"];
if($resultado1>$resultado2){$_GET["bstamina"]-=2;echo "<h5>{$count} You hit your enemy </h5> <h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;$_SESSION["bats"]="yes";echo"<h5>{$count} You´ve been bitten</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["bskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;</script>";}
if ($_GET["bstamina"]<=0){echo"<h3>You Win!</h3>";}
}
if($_SESSION["weapon"]=="no1"){$_SESSION["weapon"]="no2";}
if($_SESSION["weapon"]=="yes1"){$_SESSION["weapon"]="yes2";}
if ($_SESSION["forca"]<=0){echo"<h3>Game Over!</h3>";}
}
}
elseif($_GET["pag"]=="170")
{if($_SESSION["provisoes"]<4){$kitchen=4-$_SESSION["provisoes"];echo "<h5>you take {$kitchen} provisions</h5>";$_SESSION["provisoes"]=4;}
else{echo"<h5>You cannot take more provisions</h5>";}}
elseif($_GET["pag"]=="172")
{$_SESSION["item27"]="golden_key";echo"<h5>You take the golden key</h5>";}
elseif($_GET["pag"]=="173")
{if($_SESSION["item5"]=="silver_key"){echo "<h5>You have got a silver key, go to 22</h5>";}
else{echo"<h5>You do not have a silver key , return to 31</h5>";}}
elseif($_GET["pag"]=="174")
{$_SESSION["item1"]="";$_SESSION["item2"]="";$_SESSION["item3"]="";$_SESSION["item4"]="";$_SESSION["item5"]="";$_SESSION["item6"]="";$_SESSION["item7"]="";$_SESSION["item8"]="";
$_SESSION["item9"]="";$_SESSION["item10"]="";$_SESSION["item11"]="";$_SESSION["item12"]="";$_SESSION["item13"]="";$_SESSION["item14"]="";$_SESSION["item15"]="";$_SESSION["item16"]="";
$_SESSION["item17"]="";$_SESSION["item18"]="";$_SESSION["item19"]="";$_SESSION["item20"]="";$_SESSION["item21"]="";$_SESSION["item22"]="";$_SESSION["item23"]="";$_SESSION["item24"]="";
$_SESSION["item25"]="";$_SESSION["item26"]="";$_SESSION["item27"]="";$_SESSION["item28"]="";if($_SESSION["weapon"]!="no2"){$_SESSION["weapon"]="no1";}}
elseif($_GET["pag"]=="176")
{$_SESSION["tdhead"]="yes";}
elseif($_GET["pag"]=="178")
{$_SESSION["forca"]-=4;echo"<h5>You lose 4 stamina points</h5>";}
elseif($_GET["pag"]=="179")
{if($_SESSION["bats"]=="yes"){echo"<h5>You have been bitten by a flock of bats, go to 10.</h5>";}
else{echo"<h5>You have not been bitten by a flock of bats, go to 158</h5>";}}
elseif($_GET["pag"]=="180")
{$_SESSION["forca"]-=2;echo"<h5>You lose 2 stamina points</h5>";}
elseif($_GET["pag"]=="187")
{if($_SESSION["sap"]=="yes"&&$_SESSION["item24"]=="bedpan"){echo"You carry the sap, go to 69</h5>";}
else{echo"<h5>You do not carry the sap, go to 133</h5>";}}
elseif($_GET["pag"]=="192")
{$_SESSION["item28"]="crystal_rod";echo"<h5>You have got the crystal rod</h5>";}
elseif($_GET["pag"]=="193")
{$_SESSION["potion"]="yes";echo"<h5>you got the potion</h5>";}
elseif($_GET["pag"]=="194")
{if($_SESSION["item13"]=="book"){echo"<h5>You have a book on witchcraft, go to 79</h5>";}
else{echo"<h5>You do not have a book on witchcraft, go to 213.</h5>";}}
elseif($_GET["pag"]=="199")
{if($_SESSION["item21"]=="ruby"){echo"<h5>You have the ruby , go to 116</h5>";}
else{echo"<h5>You do not have the ruby , go to 133</h5>";}}
elseif($_GET["pag"]=="202")
{if($_SESSION["item28"]=="crystal_rod"){echo"<h5>You have a crystal rod , go to 108</h5>";}
else{echo"<h5>You do not have a crystal rod , go to 225</h5>";}}
elseif($_GET["pag"]=="212")
{$_SESSION["word4"]="SEMUS";}
elseif($_GET["pag"]=="214")
{$_SESSION["item4"]="matches";$_SESSION["item8"]="voodoo_doll";echo"<h5>You got both items</h5>";}
elseif($_GET["pag"]=="215")
{$_SESSION["item10"]="hair_locket";echo"<h5>You take the locket of hair</h5>";}
elseif($_GET["pag"]=="217")
{$dados1=mt_rand(1,6);$dados2=mt_rand(1,6);echo "<img src=../images/{$dados1}.jpg> + <img src=../images/{$dados2}.jpg>";
$dados=$dados1+$dados2;
if ($_SESSION["sorte"]<$dados){echo "<h5>You hit {$dados} , so you are Unlucky , go to 100</h5>";}
else{echo "<h5>You hit {$dados},you are lucky , go to 137</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="218")
{$_SESSION["item23"]="candles";echo"<h5> You have got the candles</h5>";}
elseif($_GET["pag"]=="220")
{$_SESSION["item16"]="medallion";echo"<h5>You have got the medallion</h5>";}
elseif($_GET["pag"]=="224")
{if($_SESSION["bats"]=="yes"){echo"<h5>You have been bitten by basts go to 10</h5>";}
else{echo"<h5>You have not been bitten by bats, go to 50</h5>";}}
elseif($_GET["pag"]=="225")
{if($_SESSION["item27"]=="golden_key"){echo"<h5>You have a golden key, go to 40</h5>";}
else{echo"<h5> You do not have a golden key, go to 18</h5>";}}
elseif($_GET["pag"]=="227")
{$dados1=mt_rand(1,6);$dados2=mt_rand(1,6);echo "<img src=../images/{$dados1}.jpg> + <img src=../images/{$dados2}.jpg>";
$dados=$dados1+$dados2;
if ($_SESSION["sorte"]<$dados){echo "<h5>You hit {$dados} , so you are Unlucky , go to 170</h5>";}
else{echo "<h5>You hit {$dados},you are lucky , go to 27</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="230")
{$dados1=mt_rand(1,6);echo"<img src=../images/{$dados1}.jpg>";
if ($dados1==1||$dados1==3||$dados1==5)
{echo"<h5>You rolled an odd number , go to 96</h5>";}
else{echo"<h5>You rolled an even number , go to 128</h5>";}}
elseif($_GET["pag"]=="234")
{if($_SESSION["item24"]=="bedpan"){echo"<h5> You have got the bedpan, go to 67</h5>";}
else{echo"<h5>You haven´t got a bedpan, return to 16</h5>";}}
elseif($_GET["pag"]=="240")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="The Curse of Blackwood Manor";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}

?>
