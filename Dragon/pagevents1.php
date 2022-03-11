<?php
//restantes dados das paginas
if($_GET['pag']=="1"){$_SESSION["stime"]=time();}
else if($_GET['pag']=="3"){$_SESSION["sorte"]-=4;$_SESSION["ouro"]+=30;echo"<h5> You lose 4 points of luck, and got 30 gold pieces</h5>";}
else if($_GET['pag']=="4"){$_SESSION["item2"]="number_26";}
else if($_GET['pag']=='11'){if($_SESSION["item5"]=="4StoneBalls"){echo"<h5>You have the stone balls turn to 46</h5>";}
else{echo"<h5>You do not have the 4 Stone Balls Your Adventure ends here!</h5>";}}
else if($_GET['pag']=="12"){$d1=mt_rand(1,12);$d2=mt_rand(1,12);
if($d1>$d2){echo "{$d1} > {$d2} You succeed in getting out of here";}
else{echo "{$d1} < {$d2} You fail go to 64!";}}
else if($_GET['pag']=="16"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck ";$_SESSION["item2"]="CURSE";}
else{echo"<h5>You had luck";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET['pag']=="20"){$_SESSION["item4"]="number_18";}
else if($_GET['pag']=="22"){$_SESSION["item5"]="4StoneBalls";$_SESSION["item6"]="Ebony_key#11";}
else if($_GET['pag']=="32"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck , Your Adventure ends here!";}
else{echo"<h5>You had luck return to 5 ";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET["pag"]=="33"){$_SESSION["item7"]="number_7";}
else if($_GET["pag"]=="34"){$_SESSION["item8"]="Golden_Arrow";}
else if($_GET["pag"]=="35"){if($_SESSION["item9"]=="Orb"){echo"<h5>You have the Orb, turn to 9</h5>";}
else{echo"<h5>You have not got the Orb , your adventure ends here!</h5>";}}
else if($_GET["pag"]=="36"){$_SESSION["item7"]="number_15";}
else if($_GET["pag"]=="38"){$_SESSION["item9"]="Orb";}
else if($_GET['pag']=="45"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck turn to 65 ";}
else{echo"<h5>You had luck ";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET["pag"]=="49"){$_SESSION["forca"]-=4;}
else if($_GET["pag"]=="52"){$_SESSION["forca"]+=4;}
else if($_GET["pag"]=="56"){$d1=mt_rand(1,12);echo"<h5> You lose {$d1} points of Stamina</h5>";$_SESSION["forca"]-=$d1;}
else if($_GET["pag"]=="59"){if($_SESSION["item2"]=="CURSE"){echo"<h5> You have been cursed previously , turn to 13</h5>";}
else{echo"<h5>You do not have a curse, turn to 100</h5>";}}
else if($_GET["pag"]=="61"){$_SESSION["forca"]-=4;}
else if($_GET['pag']=="63"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck";}
else{echo"<h5>You had luck , turn to 81";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET["pag"]=="68"){$_SESSION["forca"]+=1;}
else if($_GET["pag"]=="70"){echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='Pull the lever'>";
echo "</form>";
if(isset($_GET["additem"])){$_SESSION["item11"]="lever_pulled";}}
else if($_GET['pag']=="72"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck";}
else{echo"<h5>You had luck , turn to 81";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET["pag"]=="74"){if($_SESSION["item8"]=="Golden_Arrow"&&$_SESSION["item12"]=="mahogany_bow"){echo"<h5>You have both items, turn to 19</h5>";}
else{echo"<h5>You have not got both items  , go to 97!</h5>";}}
else if($_GET['pag']=="76"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck, turn to 29";}
else{echo"<h5>You had luck , return to 15";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET['pag']=="77"){$d1=mt_rand(1,12);if($d1>$_SESSION["sorte"]){echo" <h5>You got no luck, your adventure ends here!";}
else{echo"<h5>You had luck , turn to 82 ";$_SESSION["item12"]="mahogany_bow";}echo"dice roll: {$d1}</h5>";$_SESSION["sorte"]-=1;}
else if($_GET["pag"]=="81"){echo" <h5>Return to paragraph 63</h5>";$_SESSION["item13"]="secretp34";}
else if($_GET["pag"]=="84"){echo"<h5>You offered the lantern</h5>";$_SESSION["item3"]="";}
else if($_GET["pag"]=="85"){if($_SESSION["item11"]=="lever_pulled"){echo"<h5>You have pulled the lever on the maze , you opened a door turn to 22</h5>";}
else{echo"<h5>You have not pulled the lever  , return to 73!</h5>";}}
else if($_GET["pag"]=="89"){if($_SESSION["item14"]=="BOWL"){echo"<h5>You have the BOWL, turn to 24</h5>";}
else{echo"<h5>You have not got the Bowl , your adventure ends here!</h5>";}}
else if($_GET["pag"]=="90"){$_SESSION["item15"]="number_1";}
else if($_GET["pag"]=="92"){$_SESSION["item14"]="BOWL";}
else if($_GET["pag"]=="97"){echo "<form name='fight' action='{$_SERVER['PHP_SELF']}' ><p><b></b></p>Skill:<input type='text' name='beastp' value='12' readonly='readonly'>";
echo "Stamina:<input type='text' name='beastf' value='14' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if($_GET["beastf"]>0)
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;$a=0;
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["forca"]>0&&$_GET["beastf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["beastp"];
if($resultado1>$resultado2){$_GET["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";$a++;}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["knightf"]-=2+7-$a;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["knightp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_GET["beastf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h5>You died!</h5>";}
}
}}
elseif($_GET["pag"]=="100")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="The Sleeping Dragon";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}
include("pagevents2.php");
?>
