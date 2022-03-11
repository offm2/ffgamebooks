<?php
//restantes dados das paginas
if(isset($_GET["pocao"])||isset($_GET["prov"]))
{}else{
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="4")
{$_SESSION["sorte"]+=1;echo"<h5>1 luck point added</h5>"; }
elseif($_GET['pag']=="9")
{if($_SESSION["item1"]=="yellow_jewel"){echo"<h5>You have an yellow jewel, turn to 87</h5>";}else{echo"<h5>You do not have an yellow jewel, turn to 38</h5>";}}
elseif($_GET['pag']=="11")
{$_SESSION["item2"]="number_7";echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='11'><input type='hidden' name='goldscale' value='add'><input type='submit' value='Add gold scale to the inventory'></form>";if(isset($_GET['goldscale'])&&$_GET['goldscale']=='add'){
if($_SESSION["item3"]==""){$_SESSION['item3']='gold_scale';}elseif($_SESSION["item3"]=="gold_scale"){$_SESSION['item3']="2gold_scales";}elseif($_SESSION["item3"]=="2gold_scales"){$_SESSION["item3"]="3gold_scales";}elseif($_SESSION["item3"]=="3gold_scales"){$_SESSION["item3"]="4gold_scales";}
echo"<h5>You got the gold scale</h5>";}}
elseif($_GET['pag']=="13")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='13'><input type='hidden' name='testluck' value='1'><input type='submit' value='Test Luck'></form>";
if(isset($_GET['testluck'])&&$_GET['testluck']=="1"){$dice1=mt_rand(1,6);$dice2=mt_rand(1,6);if($dice1+$dice2-$_SESSION["extral"]>$_SESSION["sorte"]){echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]} > Luck: {$_SESSION["sorte"]}<h5>You were unlucky turn to 65</h5>";}else{echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]} < Luck: {$_SESSION["sorte"]}<h5>You had luck, turn to 83</h5>";}
$_SESSION["sorte"]-=1;}}
elseif($_GET['pag']=="14")
{if($_SESSION["item4"]=="winged_helmet"){echo"<h5>You have the winged helmet and can turn to 119</h5>";}else{echo"<h5>You have not the winged helmet, turn to 175</h5>";}}
elseif($_GET['pag']=="18")
{$_SESSION["item5"]="old_parchment";}
elseif($_GET['pag']=="22")
{$_SESSION["geniepower"]=1;$_SESSION["forcainicial"]+=1;$_SESSION["forca"]+=1;$_SESSION["item9"]="";}
elseif($_GET['pag']=="27")
{$_SESSION["sorte"]+=1;}
elseif($_GET['pag']=="42")
{$_SESSION["sorte"]-=1;}
elseif($_GET['pag']=="44")
{$_SESSION["sorte"]+=1;}
elseif($_GET['pag']=="45")
{if($_SESSION["item6"]=="battle_axe"){echo"<h5>You have a battle axe</h5>";}
else{echo"<h5>You do not have a battle axe</h5>";}}
elseif($_GET['pag']=="46")
{if($_SESSION["item7"]=="rope"){echo"<h5>You have a coil of rope</h5>";}
else{echo"<h5>You do not have a coil of rope</h5>";}}
elseif($_GET['pag']=="47")
{$_SESSION["sorte"]+=1;}
elseif($_GET['pag']=="49")
{if($_SESSION["item8"]=="vialcliquid"){echo"<h5>You have the vial of clear liquid</h5>";}else{echo"<h5>You do not have the vial of clear liquid</h5>";}}
elseif($_GET['pag']=="51")
{if($_SESSION["item3"]=="4gold_scales"){echo"<h5>You have four gold scales</h5>";}else{echo"<h5>You do not have four gold scales</h5>";}}
elseif($_GET['pag']=="52")
{if($_SESSION["item4"]=="winged_helmet"){echo"<h5>You have a winged helmet</h5>";}else{echo"<h5>You do not have a winged helmet</h5>";}}
elseif($_GET['pag']=="53")
{$_SESSION["item9"]="";}
elseif($_GET['pag']=="54")
{$_SESSION["item9"]="genieandbottle";}
elseif($_GET["pag"]=="60")
{$dice1=mt_rand(1,6);$dice2=mt_rand(1,6);if($dice1+$dice2>$_SESSION["pericia"]){echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> > Skill: {$_SESSION["pericia"]}<h5>Your roll is higher than your skill turn to 7</h5>";}else{echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> < Skill: {$_SESSION["pericia"]}<h5>You roll lower or equal to your skill , turn to 169</h5>";}}
elseif($_GET["pag"]=="61")
{if ($_SESSION["forca"]+4<$_SESSION["forcainicial"])
{$_SESSION["forca"]+=5;}else{$_SESSION["forca"]=$_SESSION["forcainicial"];}}
elseif($_GET["pag"]=="62")
{$_SESSION["forca"]-=4;}
elseif($_GET["pag"]=="64")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='64'><input type='hidden' name='getaxe' value='1'><input type='submit' value='Get the axe'></form>";
if(isset($_GET['getaxe'])&&$_GET['getaxe']=="1")
{$_SESSION["item6"]="battle_axe";$_SESSION["pericia"]+=1;}}
elseif($_GET["pag"]=="66"){$_SESSION["forca"]+=3;}
elseif($_GET["pag"]=="70")
{echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='70'><input type='hidden' name='getvial' value='1'><input type='submit' value='Get Vial'></form>";
if(isset($_GET['getvial'])&&$_GET['getvial']=="1")
{$_SESSION["item10"]="up_vial";}}
elseif($_GET["pag"]=="71")
{$_SESSION["sorte"]-=2;}
elseif($_GET["pag"]=="76")
{if($_SESSION["item6"]=="battle_axe"){echo"<h5>You have a battle axe</h5>";}else{echo"<h5>You do not have a battle axe</h5>";}}
elseif($_GET["pag"]=="79")
{$dice1=mt_rand(1,6);$dice2=mt_rand(1,6);$dice3=mt_rand(1,6);if($dice1+$dice2+$dice3<$_SESSION["forca"]){echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'>+ <img src='../images/{$dice3}.jpg'> < Stamina: {$_SESSION["forca"]}<h5>Your dice roll is lower than your stamina turn to 220</h5>";}else{echo"<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + <img src='../images/{$dice3}.jpg'> > Stamina: {$_SESSION["forca"]}<h5>You roll higher or equal to your stamina , turn to 62</h5>";}}
elseif($_GET["pag"]=="80")
{if(!isset($_GET["fight"])){
//3 viperman para lutar
$_SESSION["vp1per"]=7;$_SESSION["vp1for"]=6;$_SESSION["vp2per"]=6;$_SESSION["vp2for"]=9;$_SESSION["vp3per"]=8;$_SESSION["vp3for"]=8;}
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='viperman1stamina' value='6'>skill<input type='text' name='viperman1skill' value='7'><input type='submit' value='Fight First Viperman'></form>";
echo "<p>OR</p><form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='viperman2stamina' value='9'>skill<input type='text' name='viperman2skill' value='6'><input type='submit' value='Fight Second Viperman'></form>";
echo "<p>OR</p><form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='viperman3stamina' value='8'>skill<input type='text' name='viperman3skill' value='8'><input type='submit' value='Fight Third Viperman'></form>";
if(isset($_GET["fight"])){if(isset($_GET["viperman1skill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["vp1for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=rand(1,6);$dice6=rand(1,6);$dice7=rand(1,6);$dice8=rand(1,6);$dice9=rand(1,6);$dice10=rand(1,6);$dice11=rand(1,6);$dice12=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["vp1per"];$resultado3=$dice5+$dice6+$_SESSION["vp2per"];$resultado4=$dice7+$dice8+$_SESSION["vp3per"];
$resultado5=$dice9+$dice10+$_SESSION["pericia"];$resultado6=$dice11+$dice12+$_SESSION["pericia"];
if($resultado1>$resultado2){$_SESSION["vp1for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["vp1for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the First Viperman</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
if($_SESSION["vp2for"]>0){if($resultado5>=$resultado3){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Second Viperman</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}}
if($_SESSION["vp3for"]>0){if($resultado6>=$resultado4){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Third Viperman</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}}
if ($_SESSION["vp1for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}
if(isset($_GET["viperman2skill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["vp2for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=rand(1,6);$dice6=rand(1,6);$dice7=rand(1,6);$dice8=rand(1,6);$dice9=rand(1,6);$dice10=rand(1,6);$dice11=rand(1,6);$dice12=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["vp1per"];$resultado3=$dice5+$dice6+$_SESSION["vp2per"];$resultado4=$dice7+$dice8+$_SESSION["vp3per"];
$resultado5=$dice9+$dice10+$_SESSION["pericia"];$resultado6=$dice11+$dice12+$_SESSION["pericia"];
if($resultado5>$resultado3){$_SESSION["vp2for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["vp2for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
elseif($resultado5==$resultado3){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Second Viperman</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
if($_SESSION["vp1for"]>0){if($resultado1>=$resultado2){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the First Viperman</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}}
if($_SESSION["vp3for"]>0){if($resultado6>=$resultado4){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Third Viperman</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}}
if ($_SESSION["vp2for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}
if(isset($_GET["viperman3skill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["vp3for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=rand(1,6);$dice6=rand(1,6);$dice7=rand(1,6);$dice8=rand(1,6);$dice9=rand(1,6);$dice10=rand(1,6);$dice11=rand(1,6);$dice12=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["vp1per"];$resultado3=$dice5+$dice6+$_SESSION["vp2per"];$resultado4=$dice7+$dice8+$_SESSION["vp3per"];
$resultado5=$dice9+$dice10+$_SESSION["pericia"];$resultado6=$dice11+$dice12+$_SESSION["pericia"];
if($resultado6>$resultado4){$_SESSION["vp3for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["vp3for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Third Viperman</h5><h5>You : <img src='../images/{$dice11}.jpg'> + <img src='../images/{$dice12}.jpg'> + {$_SESSION["pericia"]} = {$resultado6} Vs <img src='../images/{$dice7}.jpg'> + <img src='../images/{$dice8}.jpg'> + {$_SESSION["vp3per"]} = {$resultado4}</h5>";}
if($_SESSION["vp2for"]>0){if($resultado5>=$resultado3){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Second Viperman</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}}
if($_SESSION["vp1for"]>0){if($resultado6>=$resultado4){echo "<h5>{$count} You Parried his blow</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the First Viperman</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}}
if ($_SESSION["vp3for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}}}
include("pagevents2.php");
}
?>
