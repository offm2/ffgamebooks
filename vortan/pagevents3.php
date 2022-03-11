<?php
if($_GET["pag"]=="205")
{
if(!isset($_GET["fight"])){
//2 skeletons para lutar
$_SESSION["vp1per"]=7;$_SESSION["vp1for"]=5;$_SESSION["vp2per"]=6;$_SESSION["vp2for"]=6;}
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='skeleton1stamina' value='5'>skill<input type='text' name='skeleton1skill' value='7'><input type='submit' value='Fight First Skeleton'></form>";
echo "<p>OR</p><form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='skeleton2stamina' value='6'>skill<input type='text' name='skeleton2skill' value='6'><input type='submit' value='Fight Second Skeleton'></form>";
if(isset($_GET["fight"])){if(isset($_GET["skeleton1skill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["vp1for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=rand(1,6);$dice6=rand(1,6);$dice7=rand(1,6);$dice8=rand(1,6);$dice9=rand(1,6);$dice10=rand(1,6);$dice11=rand(1,6);$dice12=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["vp1per"];$resultado3=$dice5+$dice6+$_SESSION["vp2per"];$resultado4=$dice7+$dice8+$_SESSION["vp3per"];
$resultado5=$dice9+$dice10+$_SESSION["pericia"];$resultado6=$dice11+$dice12+$_SESSION["pericia"];
if($resultado1>$resultado2){$_SESSION["vp1for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["vp1for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the First Skeleton</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["vp1per"]} = {$resultado2}</h5>";}
if ($_SESSION["vp1for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}
if(isset($_GET["skeleton2skill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["vp2for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=rand(1,6);$dice6=rand(1,6);$dice7=rand(1,6);$dice8=rand(1,6);$dice9=rand(1,6);$dice10=rand(1,6);$dice11=rand(1,6);$dice12=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["vp1per"];$resultado3=$dice5+$dice6+$_SESSION["vp2per"];$resultado4=$dice7+$dice8+$_SESSION["vp3per"];
$resultado5=$dice9+$dice10+$_SESSION["pericia"];$resultado6=$dice11+$dice12+$_SESSION["pericia"];
if($resultado5>$resultado3){$_SESSION["vp2for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["vp2for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
elseif($resultado5==$resultado3){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by the Second Skeleton</h5><h5>You : <img src='../images/{$dice9}.jpg'> + <img src='../images/{$dice10}.jpg'> + {$_SESSION["pericia"]} = {$resultado5} Vs <img src='../images/{$dice5}.jpg'> + <img src='../images/{$dice6}.jpg'> + {$_SESSION["vp2per"]} = {$resultado3}</h5>";}
if ($_SESSION["vp2for"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo "</h3>game over!</h3>";}}}}}
elseif($_GET["pag"]=="206")
{$dice1=rand(1,6);$dice2=rand(1,6);echo"<h5>Your Dice roll :<img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> - extra luck:{$_SESSION["extral"]}</h5>";
if($_SESSION["sorte"]<$dice1+$dice2-$_SESSION["extral"]){echo"<h5>You are Unlucky</h5>";}else{echo"<h5>You are Lucky</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="207")
{$_SESSION["pericia"]-=1;$_SESSION["periciainicial"]-=1;$_SESSION["sorte"]-=2;$_SESSION["sorteinicial"]-=2;}
elseif($_GET["pag"]=="218")
{if(!isset($_GET["fight"])){
//fight vortan
$_SESSION["ac1per"]=13;$_SESSION["ac1for"]=25;}
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='fight'>stamina<input type='text' name='vortanstamina' value='25'>skill<input type='text' name='vortanskill' value='13'><input type='submit' value='Fight Vortan'></form>";
if(isset($_GET["fight"])){if(isset($_GET["vortanskill"]))
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
while($_SESSION["forca"]>0&&$_SESSION["ac1for"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);$dice5=mt_rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["ac1per"];
if($resultado1>$resultado2){$_SESSION["ac1for"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 extra point of damage</h5>";$_SESSION["ac1for"]-=1;}echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;if($_SESSION["geniepower"]==1){echo"<h5>genie power in effect, do 1 less point of damage</h5>";$_SESSION["forca"]+=1;}echo"<h5>{$count} You´ve been hit by Vortan</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["ac1per"]} = {$resultado2}</h5><h5>Your dice roll: {$dice5}</h5>";if($dice5==1){echo"<h5> You have been hit by his poisonous fangs</h5>";$_SESSION["forca"]-=1;}elseif($dice5==6){echo"<h5> You have been hit by his tail </h5>";$_SESSION["forca"]-=2;}}}}}}
elseif($_GET["pag"]=="220"){if($_SESSION["item4"]=="winged_helmet"){echo"<h5>You have a winged helmet</h5>";}else{echo"<h5>You do not have a winged helmet</h5>";}}
elseif($_GET["pag"]=="221")
{if(!isset($_GET["rem"])){$_SESSION["forca"]-=2;$_SESSION["sorte"]-=1;}
if($_SESSION["item3"]!=""||$_SESSION["item11"]!=""||$_SESSION["item10"]!=""||$_SESSION["item9"]!=""||$_SESSION["item5"]!=""){
if($_SESSION["item3"]=="gold_scale"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='goldscale' value='remove'><input type='submit' value='Remove gold scale from the inventory'></form>";if(isset($_GET['goldscale'])&&$_GET['goldscale']=='remove'){$_SESSION['item3']='';echo"<h5>You remove 1 gold scale</h5>";}}
elseif($_SESSION["item3"]=="2gold_scales"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='2goldscales' value='remove'><input type='submit' value='Remove gold scale from the inventory'></form>";if(isset($_GET['2goldscales'])&&$_GET['2goldscales']=='remove'){$_SESSION['item3']='gold_scale';echo"<h5>You remove 1 gold scale</h5>";}}
elseif($_SESSION["item3"]=="3gold_scales"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='3goldscales' value='remove'><input type='submit' value='Remove gold scale from the inventory'></form>";if(isset($_GET['3goldscales'])&&$_GET['3goldscales']=='remove'){$_SESSION['item3']='2gold_scales';echo"<h5>You remove 1 gold scale</h5>";}}
elseif($_SESSION["item3"]=="4gold_scales"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='4goldscales' value='remove'><input type='submit' value='Remove gold scale from the inventory'></form>";if(isset($_GET['4goldscales'])&&$_GET['4goldscales']=='remove'){$_SESSION['item3']='3gold_scales';echo"<h5>You remove 1 gold scale</h5>";}}
if($_SESSION["item11"]=="honey_jar"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='honeyjar' value='remove'><input type='submit' value='Remove jar with honey from the inventory'></form>";if(isset($_GET['honeyjar'])&&$_GET['honeyjar']=='remove'){$_SESSION['item11']='';echo"<h5>You remove the jar with honey</h5>";}}
if($_SESSION["item10"]=="up_vial"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='upvial' value='remove'><input type='submit' value='Remove up vial from the inventory'></form>";if(isset($_GET['upvial'])&&$_GET['upvial']=='remove'){$_SESSION['item10']='';echo"<h5>You remove the up vial</h5>";}}
if($_SESSION["item9"]=="genieandbottle"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='genie' value='remove'><input type='submit' value='Remove genie and bottle from the inventory'></form>";if(isset($_GET['genie'])&&$_GET['genie']=='remove'){$_SESSION['item3']='';echo"<h5>You remove the genie and the bottle</h5>";}}
if($_SESSION["item5"]=="old_parchment"){echo"<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='221'><input type='hidden' name='rem'><input type='hidden' name='parchment' value='remove'><input type='submit' value='Remove old parchment from the inventory'></form>";if(isset($_GET['parchment'])&&$_GET['parchment']=='remove'){$_SESSION['item5']='';echo"<h5>You remove the old parchment</h5>";}}
}else{if(!isset($_GET["rem"])){$_SESSION["forca"]-=1;}}}
elseif($_GET["pag"]=="224"){if($_SESSION["item11"]=="honey_jar"){echo"<h5> you have a jar with honey</h5>";}
elseif($_GET['pag']=="225"){
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Venom of Vortan";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}
}
?>