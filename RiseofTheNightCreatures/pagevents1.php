<?php
//restantes dados das paginas
if($_GET['pag']=="1"){$_SESSION["stime"]=time();}
elseif($_GET["pag"]=="2")
{
$_SESSION["garf"]=6;$_SESSION["garp"]=4;
if(isset($_GET["iskill"]))
{
//disputar combate com 2º gargoyle pag. 2
if($_SESSION["garf"]==6)
{
echo "<h5>Fight second Gargoyle SKILL: 6 STAMINA:6</h5>";
while($_SESSION["forca"]>0&&$_SESSION["garf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["garp"];
if($resultado1>$resultado2){$_SESSION["garf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["garp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["garp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["garp"]} = {$resultado2}</h5>";}
if ($_SESSION["garf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}}}
elseif($_GET['pag']=="12"){$_SESSION["item1"]="monkey_head";$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";}
elseif($_GET['pag']=="13"){
if($_SESSION["gas"]=="yes"){$_SESSION["forca"]-=8;echo"<h5>You lost 8 stamina points</h5>";}
while($_SESSION["gas"]=="yes"){$d1=mt_rand(2,12);if ($d1<$_SESSION["sorte"]){echo"<h5>You had luck, die roll: {$d1}, turn to 145</h5>";$_SESSION["gas"]="no";}
else{if($_SESSION["forca"]>0){echo"<h5>You had no luck  and lose 8 stamina points ,die roll: {$d1}</h5>";$_SESSION["forca"]-=8;}else{echo"<h3>Game Over!</h3>";}}
$_SESSION["sorte"]-=1;
}
}
elseif($_GET["pag"]=="14")
{$_SESSION["sorte"]-=1;echo"<h5>You lost 1 point of luck</h5>";$_SESSION["item21"]="computer_virus";}
elseif($_GET["pag"]=="17")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";}
elseif($_GET["pag"]=="19")
{$_SESSION["item2"]="dog_tag#1";}
elseif($_GET["pag"]=="22")
{$_SESSION["sootmp"]=7;$_SESSION["sootmf"]=8;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>SOOT MONSTER</b></p>Skill:<input type='text' name='sootmp' value='{$_SESSION['sootmp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='sootmf' value='{$_SESSION['sootmf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["sootmp"])&&ctype_digit($_GET["sootmp"])&&ctype_digit($_GET["sootmf"])&&isset($_GET["sootmf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>2&&$_SESSION["sootmf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["pericia"];$r2=$d3+$d4+$_SESSION["sootmp"];
if($r1>$r2){$_SESSION["sootmf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["sootmp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["sootmp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["sootmp"]} = {$r2} </h5>";}
}}
if($_SESSION["sootmf"]<=0){echo"<h3>You Win the fight!</h3>";}
if($_SESSION["forca"]<=2){echo"<h5>turn to 127!</h5>";}}
elseif($_GET["pag"]=="24"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed and have to fight the hunters</h5>";}else{
$d1=mt_rand(2,12);if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}, turn to 139</h5>";}else{echo"<h5>You have to fight the hunters, die roll :{$d1}</h5>";}}
$_SESSION["thunterp"]=6;$_SESSION["thunterf"]=6;$_SESSION["fhunterp"]=4;$_SESSION["fhunterf"]=4;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>3rd Hunter</b></p>Skill:<input type='text' name='thunterp' value='{$_SESSION['thunterp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='thunterf' value='{$_SESSION['thunterf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["thunterp"])&&ctype_digit($_GET["thunterp"])&&ctype_digit($_GET["thunterf"])&&isset($_GET["thunterf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["thunterf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["lproesa"];$r2=$d3+$d4+$_SESSION["thunterp"];
if($r1>$r2){$_SESSION["thunterf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["thunterp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["thunterp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["thunterp"]} = {$r2} </h5>";}
}
if($_SESSION["thunterf"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
//disputar combate com 4º hunter
if($_SESSION["fhunterf"]==4)
{
echo "<h5>Fight 4th Hunter SKILL: 4 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["fhunterf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["lproesa"];$resultado2=$dice3+$dice4+$_SESSION["fhunterp"];
if($resultado1>$resultado2){$_SESSION["fhunterf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["fhunterp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["fhunterp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["lproesa"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["fhunterp"]} = {$resultado2}</h5>";}
if ($_SESSION["fhunterf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
$_SESSION["forca"]-=1;
}
if($_SESSION["forca"]<=0){echo"<h5>Game Over!</h5>";}
}
elseif($_GET["pag"]=="26"){if($_SESSION["forca"]+4<$_SESSION["forcainicial"]){$_SESSION["forca"]+=4;}else{$_SESSION["forca"]=$_SESSION["forcainicial"];}}
elseif($_GET["pag"]=="27"){$d1=mt_rand(2,12);$d2=mt_rand(2,12);echo"<h5>die roll : {$d1}</h5>";if($d1>=$d2){echo"<h5>You get your mind back, turn to 49</h5>";}else{echo"<h5>Your adventure is over!</h5>";}}
elseif($_GET["pag"]=="30"){$_SESSION["item3"]="steel_key";}
elseif($_GET["pag"]=="32"){$d1=mt_rand(2,12);echo"<h5>die roll: {$d1}</h5>";if($_SESSION["pericia"]>=$d1){echo"<h5>You are skillful turn to 143</h5>";}else{echo"<h5>You failed the test, Game over!</h5>";}}
elseif($_GET["pag"]=="33"){if($_SESSION["item4"]=="talisman"){echo"<h5>You are wearing the talisman, turn to 87</h5>";}else{echo"<h5>You are not wearing the talisman, turn to 191</h5>";}}
elseif($_GET["pag"]=="34"){$_SESSION["forca"]-=2;}
elseif($_GET["pag"]=="36"){if($_SESSION["piano"]=="yes"){echo"<h5>The piano is playing , turn to 152</h5>";}else{echo"<h5>The piano is not playing, turn to 199</h5>";}}
elseif($_GET["pag"]=="38"){if(isset($_GET["iskill"])){$_SESSION["forca"]+=4;}$_SESSION["item5"]="vv_claw";}
elseif($_GET["pag"]=="42"){$_SESSION["item6"]="dog_tag#1";$_SESSION["item7"]="dog_tag#80";}
elseif($_GET["pag"]=="44"){if($_SESSION["item8"]=="brass_key"){echo"<h5>You have a brass key , turn to 103</h5>";}else{echo"<h5>you do not have a brass key return to 196</h5>";}}
elseif($_GET["pag"]=="48"){$_SESSION["item9"]="dog_tag#40";if($_SESSION["item10"]=="ivory_duck"){$_SESSION["sorte"]+=1;echo"<h5>You 've got  the ivory duck 1 point of luck added</h5>";}}
elseif($_GET["pag"]=="49"){$_SESSION["forca"]-=4;}
elseif($_GET["pag"]=="51"){if($_SESSION["item11"]=="pickaxe"){echo"<h5>You have a pickaxe , go to 193</h5>";}$_SESSION["forca"]+=2;}
elseif($_GET["pag"]=="56"){$_SESSION["item12"]="garden_guardian";}
elseif($_GET["pag"]=="59"){$_SESSION["item11"]="pickaxe";$_SESSION["skill"]+=2;}
elseif($_GET["pag"]=="60"){if($_SESSION["item12"]=="garden_guardian"){echo"<h5>You met the garden guardian previously , turn to 102</h5>";}}
elseif($_GET["pag"]=="61"){$_SESSION["item8"]="brass_key";}
elseif($_GET["pag"]=="63"){$_SESSION["note"]="go_to_#164_first";}
elseif($_GET["pag"]=="65"){$d1=mt_rand(2,12);echo"<h5> your die roll: {$d1}</h5>";if($_SESSION["lproesa"]<$d1){echo"<h5>You did not succeed, turn to 183</h5>";$_SESSION["forca"]-=1;}else{echo"<h5>You did succeed , turn to 18.</h5>";}}
elseif($_GET["pag"]=="66")
{
$_SESSION["sghp"]=6;$_SESSION["sghf"]=8;$_SESSION["tghp"]=5;$_SESSION["tghf"]=4;$c=0;
if(isset($_GET["iskill"]))
{
//disputar combate com 2º ghoul
if($_SESSION["sghf"]==8)
{
echo "<h5>Fight second Ghoul SKILL: 6 STAMINA:8</h5>";
while($_SESSION["forca"]>0&&$_SESSION["sghf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["sghp"];
if($resultado1>$resultado2){$_SESSION["sghf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["sghp"]} = {$resultado2}</h5>";$c=0;}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["sghp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["sghp"]} = {$resultado2}</h5>";$c++;if($c>2){echo"<h5>You are paralysed and cannot fight ,so it is the end of the Adventure!</h5>";break;}}
if ($_SESSION["sghf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
//disputar combate com 3º ghoul
if($_SESSION["tghf"]==4)
{
echo "<h5>Fight Third Ghoul SKILL: 5 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["tghf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["tghp"];
if($resultado1>$resultado2){$_SESSION["tghf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["tghp"]} = {$resultado2}</h5>";$c=0;}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["tghp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["tghp"]} = {$resultado2}</h5>";$c++;if($c>2){echo"<h5>You are paralysed and cannot fight, so it is the end of the Adventure!</h5>";break;}}
if ($_SESSION["tghf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
}}
include("pagevents2.php");
?>
