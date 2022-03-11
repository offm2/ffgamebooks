<?php
if($_GET["pag"]=="88"){$d1=mt_rand(2,12);echo"<h5>Your die roll: {$d1}</h5>";if($_SESSION["sorte"]<$d1){echo"<h5>You are lucky, turn to 62</h5>";}else{echo"<h5>Your were unlucky ,turn to 185</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="90"){if($_SESSION["item3"]=="steel_key"){echo"<h5>You have the stell key, turn to 135</h5>";}else{echo"<h5>You do not have the steel key , return to 35</h5>";}}
elseif($_GET["pag"]=="94"){$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="96"){$_SESSION["item16"]="silver_dagger";}
elseif($_GET["pag"]=="98"){$_SESSION["forca"]-=4;if($_SESSION["item17"]=="despair_doll"){echo"<h5>You have the doll of despair , turn to 59</h5>";}else{echo"<h5>You do not have the doll of despair</h5>";}}
elseif($_GET["pag"]=="99"){$d1=mt_rand(2,12);echo"<h5>Your die roll: {$d1}</h5>";if($_SESSION["lproesa"]<$d1){echo"<h5>if you decide to test the Werewolf Prowess, you were successful,turn to 121</h5>";}else{echo"<h5>Your were not sucessful ,turn to 84</h5>";}}
elseif($_GET["pag"]=="101"){if($_SESSION["item11"]=="pickaxe"){echo"<h5>You have a pickaxe, turn to 61</h5>";}else{echo"<h5>You do not have a pickaxe</h5>";}}
elseif($_GET["pag"]=="104"){
$_SESSION["fihunterp"]=4;$_SESSION["fihunterf"]=2;$_SESSION["shunterp"]=5;$_SESSION["shunterf"]=4;$_SESSION["thunterp"]=4;$_SESSION["thunterf"]=4;		
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>1st Hunter</b></p>Skill:<input type='text' name='fihunterp' value='{$_SESSION['fihunterp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='fihunterf' value='{$_SESSION['fihunterf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["fihunterp"])&&ctype_digit($_GET["fihunterp"])&&ctype_digit($_GET["fihunterf"])&&isset($_GET["fihunterf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["fihunterf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["lproesa"];$r2=$d3+$d4+$_SESSION["fihunterp"];
if($r1>$r2){$_SESSION["fihunterf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
}
if($_SESSION["fihunterf"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}

//disputar combate com 2 º hunter
if($_SESSION["shunterf"]==4)
{
echo "<h5>Fight 2nd Hunter SKILL: 5 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["shunterf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["lproesa"];$resultado2=$dice3+$dice4+$_SESSION["shunterp"];
if($resultado1>$resultado2){$_SESSION["shunterf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["shunterp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["shunterp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["shunterp"]} = {$resultado2}</h5>";}
if ($_SESSION["shunterf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
//disputar combate com 2 º hunter
if($_SESSION["thunterf"]==4)
{
echo "<h5>Fight 3rd Hunter SKILL: 4 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["thunterf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["lproesa"];$resultado2=$dice3+$dice4+$_SESSION["shunterp"];
if($resultado1>$resultado2){$_SESSION["thunterf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["thunterp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["thunterp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["thunterp"]} = {$resultado2}</h5>";}
if ($_SESSION["thunterf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
}
if($_SESSION["forca"]<=0){echo"<h5>Game Over!</h5>";}
}
elseif($_GET["pag"]=="106"){
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
echo"<form name='tprowess' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='2'>";
echo "<input type='submit' value='Test Werewolf Prowess'></form>";
echo"<form name='tprowess' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='item' value='1'>";
echo "<input type='submit' value='Take the calamus'></form>";
if($_GET["test"]==1){$d1=mt_rand(2,12);if($d1<=$_SESSION["sorte"]){echo"<h5>You had luck, turn to 134</h5>";}else{echo"<h5>You had no luck.</h5>";}$_SESSION["sorte"]-=1;}
if($_GET["test"]==2){$d1=mt_rand(2,12);if($d1<=$_SESSION["lproesa"]){echo"<h5>You were successful on the Werewolf Prowess test</h5>";}else{echo"<h5>You were not successful</h5>";}}
if($_GET["item"]==1){$_SESSION["item18"]="calamus";}}
elseif($_GET["pag"]=="107"){
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
echo"<form name='eat1' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='eat' value='1'>";
echo "<input type='submit' value='Eat any of the food'></form>";
if($_GET["test"]==1){$d1=mt_rand(2,12);if($d1<=$_SESSION["sorte"]){echo"<h5>You had luck, turn to 134</h5>";}else{echo"<h5>You had no luck.</h5>";}$_SESSION["sorte"]-=1;}
if($_GET["eat"]==1){$_SESSION["forca"]+=4;}}
elseif($_GET["pag"]=="111"){$_SESSION["item3"]="steel_key";}
elseif($_GET["pag"]=="116"){$_SESSION["forca"]+=1;}
elseif($_GET["pag"]=="117"){$_SESSION["item19"]="lotus_flower";}
elseif($_GET["pag"]=="118"){$_SESSION["zombiep"]=8;$_SESSION["zombief"]=10;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Zombies</b></p>Skill:<input type='text' name='zombiep' value='{$_SESSION['zombiep']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='zombief' value='{$_SESSION['zombief']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["zombiep"])&&ctype_digit($_GET["zombiep"])&&ctype_digit($_GET["zombief"])&&isset($_GET["zombief"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["zombief"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["lproesa"];$r2=$d3+$d4+$_SESSION["zombiep"];
if($r1>$r2){$_SESSION["zombief"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
}
if($_SESSION["zombief"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
elseif($_GET["pag"]=="119"){$_SESSION["item20"]="wormwood_herb";$_SESSION["item23"]="spikenard_oil";}
elseif($_GET["pag"]=="123"){$_SESSION["zombiep"]=11;$_SESSION["zombief"]=14;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>White Werewolf</b></p>Skill:<input type='text' name='wwp' value='{$_SESSION['zombiep']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='wwf' value='{$_SESSION['zombief']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["wwp"])&&ctype_digit($_GET["wwp"])&&ctype_digit($_GET["wwf"])&&isset($_GET["wwf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["zombief"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["lproesa"];$r2=$d3+$d4+$_SESSION["zombiep"];
if($r1>$r2){$_SESSION["zombief"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
}
if($_SESSION["zombief"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
elseif($_GET["pag"]=="130"){$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="131"){$_SESSION["item13"]="f_ghoul_blood";}
elseif($_GET["pag"]=="132"){$_SESSION["item17"]="despair_doll";}
elseif($_GET["pag"]=="135"){
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'><input type='submit' value='Test Luck'></form>";
if($_GET["test"]==1){$d1=mt_rand(2,12);if($d1<=$_SESSION["sorte"]){echo"<h5>You had luck, turn to 63</h5>";}else{echo"<h5>You had no luck.</h5>";}$_SESSION["sorte"]-=1;}
}
elseif($_GET["pag"]=="137"){$_SESSION["lproesa"]-=1;}
elseif($_GET["pag"]=="138"){$_SESSION["zombiep"]=7;$_SESSION["zombief"]=6;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Crazed Bastard</b></p>Skill:<input type='text' name='cbastardp' value='{$_SESSION['zombiep']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='cbastardf' value='{$_SESSION['zombief']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["cbastardp"])&&ctype_digit($_GET["cbastardp"])&&ctype_digit($_GET["cbastardf"])&&isset($_GET["cbastardf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["zombief"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["lproesa"];$r2=$d3+$d4+$_SESSION["zombiep"];
if($r1>$r2){$_SESSION["zombief"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
}
if($_SESSION["zombief"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
elseif($_GET["pag"]=="141"){$_SESSION["provisoes"]+=1;}
elseif($_GET["pag"]=="142"){if($_SESSION["item21"]=="computer_virus"){echo"<h5>You had been cursed by a computer virus</h5>";if($_SESSION["item5"]!=""&&$_SESSION["item19"]!=""){echo"<h5>You have the items , turn to 89</h5>";}else{echo"<h5>You do not have the items , turn to 129</h5>";}}else{echo"<h5>You had not been cursed , your free to roam, turn to 108</h5>";}}
include("pagevents4.php");
?>