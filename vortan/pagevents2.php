<?php
if($_GET["pag"]=="82")
{$dice=mt_rand(1,6);echo" Your dice outcome: <img src='../images/{$dice}.jpg'>";}
elseif($_GET["pag"]=="83")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='83'><input type='hidden' name='rope' value='add'><input type='submit' value='Add coil of rope to the inventory'></form>";if(isset($_GET['rope'])&&$_GET['rope']=='add'){$_SESSION['item7']='rope';echo"<h5>You got the coil of rope</h5>";}}
elseif($_GET["pag"]=="85")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='85'><input type='hidden' name='honey' value='add'><input type='submit' value='Take the honey jar'></form>";if(isset($_GET['honey'])&&$_GET['honey']=='add'){$_SESSION['item11']='honey_jar';$_SESSION["provisoes"]+=1;echo"<h5>You take the jar of honey, 1 provision added to the inventory</h5>";}}
elseif($_GET["pag"]=="86")
{echo"<h5>You eat the cheese</h5>";$_SESSION["forca"]+=2;}
elseif($_GET["pag"]=="87")
{echo"<h5>you gain 1 luck point</h5>";$_SESSION["sorte"]+=1;}
elseif($_GET["pag"]=="96")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='96'><input type='hidden' name='vial' value='add'><input type='submit' value='Take the vial of clear liquid'></form>";if(isset($_GET['vial'])&&$_GET['vial']=='add'){$_SESSION['item8']='vialcliquid';echo"<h5>You take the vial of clear liquid</h5>";}}
elseif($_GET["pag"]=="98")
{if(!isset($_GET["fight"])){
//acid crawler
$_SESSION["ac1per"]=8;$_SESSION["ac1for"]=9;$_SESSION["forca"]-=6;$_SESSION["pericia"]-=1;}
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='acidcrawlerstamina' value='9'>skill<input type='text' name='acidcrawlerskill' value='8'><input type='submit' value='Fight Acid Crawler'></form>";
if(isset($_GET["fight"])){if(isset($_GET["acidcrawlerskill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["ac1for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=mt_rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["ac1per"];
if($resultado1>$resultado2){$_SESSION["ac1for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["ac1for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Acid Crawler</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5><h5>Your dice roll: {$dice5}</h5>";if($dice5>4){echo"<h5> You have been hit by the acid spit</h5>";$_SESSION["forca"]-=1;}elseif($dice5<5){echo"<h5> You Manage to evade the acid spit</h5>";}}}}}}
elseif($_GET['pag']=="104")
{$_SESSION["item12"]="number_21";echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='104'><input type='hidden' name='goldscale' value='add'><input type='submit' value='Add gold scale to the inventory'></form>";if(isset($_GET['goldscale'])&&$_GET['goldscale']=='add'){
if($_SESSION["item3"]==""){$_SESSION['item3']='gold_scale';}elseif($_SESSION["item3"]=="gold_scale"){$_SESSION['item3']="2gold_scales";}elseif($_SESSION["item3"]=="2gold_scales"){$_SESSION["item3"]="3gold_scales";}elseif($_SESSION["item3"]=="3gold_scales"){$_SESSION["item3"]="4gold_scales";}
echo"<h5>You got the gold scale</h5>";}}
elseif($_GET['pag']=="108")
{if($_SESSION["item3"]=="4gold_scales"){echo"<h5>You have four gold scales</h5>";}else{echo"<h5>You do not have four gold scales</h5>";}}
elseif($_GET['pag']=="114")
{$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]}</h5>";
if($_SESSION["sorte"]<$dice1+$dice2-$_SESSION["extral"]){echo"<h5>You are Unlucky</h5>";}else{echo"<h5>You are Lucky</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="116")
{$_SESSION["partner"]="yes";}
elseif($_GET['pag']=="120")
{$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'></h5>";
if($_SESSION["pericia"]<$dice1+$dice2){echo"<h5>You are not skillful</h5>";}else{echo"<h5>You are skillful</h5>";}}
elseif($_GET['pag']=="122")
{$_SESSION["item13"]="number_40";echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='122'><input type='hidden' name='goldscale' value='add'><input type='submit' value='Add gold scale to the inventory'></form>";if(isset($_GET['goldscale'])&&$_GET['goldscale']=='add'){
if($_SESSION["item3"]==""){$_SESSION['item3']='gold_scale';}elseif($_SESSION["item3"]=="gold_scale"){$_SESSION['item3']="2gold_scales";}elseif($_SESSION["item3"]=="2gold_scales"){$_SESSION["item3"]="3gold_scales";}elseif($_SESSION["item3"]=="3gold_scales"){$_SESSION["item3"]="4gold_scales";}
echo"<h5>You got the gold scale</h5>";}}
elseif($_GET['pag']=="132")
{echo"<h5>You eat the cheese</h5>";$_SESSION["forca"]+=2;}
elseif($_GET['pag']=="135")
{if($_SESSION["item6"]=="battle_axe"){echo"<h5>You have a battle axe</h5>";}else{echo"<h5>You do not have a battle axe</h5>";}}
elseif($_GET['pag']=="136")
{if($_SESSION["item9"]=="genieandbottle"){echo"<h5>You have a Genie in a bottle</h5>";}else{echo"<h5>You do not have a genie in a bottle</h5>";}}
elseif($_GET['pag']=="141")
{$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]}</h5>";
if($_SESSION["sorte"]<$dice1+$dice2-$_SESSION["extral"]){echo"<h5>You are Unlucky</h5>";}else{echo"<h5>You are Lucky</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET['pag']=="146")
{echo"<h5>You lose 3 stamina points</h5>";$_SESSION["forca"]-=3;}
elseif($_GET['pag']=="152")
{$_SESSION["forca"]-=3;$_SESSION["pericia"]-=1;
$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'></h5>";
if($_SESSION["pericia"]<$dice1+$dice2){echo"<h5>You are not skillful</h5>";}else{echo"<h5>You are skillful</h5>";}}
elseif($_GET["pag"]=="155")
{$dice1=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'></h5>";}
elseif($_GET["pag"]=="156"){$_SESSION["extrad"]=3;}
elseif($_GET["pag"]=="158")
{if($_SESSION["item1"]=="yellow_jewel"){echo"<h5>You have a yellow jewel</h5>";}else{echo"<h5>You do not have a yellow jewel</h5>";}}
elseif($_GET["pag"]=="159")
{if($_SESSION["item4"]=="winged_helmet"){echo"<h5>You have a winged helmet</h5>";}
if($_SESSION["item10"]=="up_vial"){echo"<h5>You have the vial with the word UP engraved on it</h5>";}}
elseif($_GET['pag']=="161")
{$_SESSION["item14"]="number_91";echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='161'><input type='hidden' name='goldscale' value='add'><input type='submit' value='Add gold scale to the inventory'></form>";if(isset($_GET['goldscale'])&&$_GET['goldscale']=='add'){
if($_SESSION["item3"]==""){$_SESSION['item3']='gold_scale';}elseif($_SESSION["item3"]=="gold_scale"){$_SESSION['item3']="2gold_scales";}elseif($_SESSION["item3"]=="2gold_scales"){$_SESSION["item3"]="3gold_scales";}elseif($_SESSION["item3"]=="3gold_scales"){$_SESSION["item3"]="4gold_scales";}
echo"<h5>You got the gold scale</h5>";}}
elseif($_GET["pag"]=="162")
{if(!isset($_GET["fight"])){
//spider monkey
$_SESSION["ac1per"]=10;$_SESSION["ac1for"]=8;}
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='spidermonkeystamina' value='8'>skill<input type='text' name='spidermonkeyskill' value='10'><input type='submit' value='Fight Spider Monkey'></form>";
if(isset($_GET["fight"])){if(isset($_GET["spidermonkeyskill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;$c2=0;
while($_SESSION["forca"]>0&&$_SESSION["ac1for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=mt_rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["ac1per"];
if($resultado1>$resultado2){$_SESSION["ac1for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["ac1for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Spider Monkey</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5><h5>Your dice roll: {$dice5}</h5>";if($dice5>5){echo"<h5> You are becoming entwined in the spider web</h5>";$_SESSION["pericia"]-=1;$c2++;if($c2>1){echo"<h5>You are tangled in the webbing, you adventure ends here</h5>";break;}}elseif($dice5<6){echo"<h5> You Manage to let loose from the spider monkey web</h5>";}}
if ($_SESSION["ac1for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}}}
elseif($_GET["pag"]=="168"){echo"<h5>You lose 1 stamina point</h5>";$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="172"){$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]}</h5>";
if($_SESSION["sorte"]<$dice1+$dice2-$_SESSION["extral"]){echo"<h5>You are Unlucky</h5>";}else{echo"<h5>You are Lucky</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="174"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='174'><input type='hidden' name='yellowjewel' value='add'><input type='submit' value='Take the yellow jewel'></form>";if(isset($_GET['yellowjewel'])&&$_GET['yellowjewel']=='add'){$_SESSION['item1']='yellow_jewel';echo"<h5>You take the yellow jewel</h5>";}}
elseif($_GET["pag"]=="175"){echo"<h5>You lose 2 stamina point</h5>";$_SESSION["forca"]-=2;}
elseif($_GET["pag"]=="176"){$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]}</h5>";
if($_SESSION["sorte"]<$dice1+$dice2-$_SESSION["extral"]){echo"<h5>You are Unlucky</h5>";}else{echo"<h5>You are Lucky</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="178"){echo"<h5>You lose 2 stamina point and 1 skill point</h5>";$_SESSION["forca"]-=2;$_SESSION["pericia"]-=1;}
elseif($_GET["pag"]=="180"){$_SESSION["item15"]="5times10";}
elseif($_GET["pag"]=="181"){if($_SESSION["partner"]=="yes"){echo"<h5>Nehemina is with you</h5>";}else{echo"<h5>Nehemina is not with you</h5>";}}
elseif($_GET["pag"]=="185"){$dice1=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'></h5>";}
elseif($_GET["pag"]=="191"){$_SESSION["item9"]="";$_SESSION["sorte"]+=1;$_SESSION["sorteinicial"]+=1;$_SESSION["extral"]=2;}
elseif($_GET["pag"]=="195"){$_SESSION["pericia"]-=2;$_SESSION["periciainicial"]-=2;$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="202"){$_SESSION["pericia"]-=2;$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="203"){if($_SESSION["partner"]=="yes"){echo"<h5>Nehemina is with you</h5>";}else{echo"<h5>Nehemina is not with you</h5>";}}
include("pagevents3.php");
?>
