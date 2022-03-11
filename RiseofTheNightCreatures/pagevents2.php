<?php
if($_GET["pag"]=="68"){$_SESSION["forca"]+=4;}
elseif($_GET["pag"]=="70"){$d1=mt_rand(2,12);echo"<h5>Your die roll: {$d1}</h5>";if($_SESSION["sorte"]<$d1){echo"<h5>You are lucky , turn to 100</h5>";}else{echo"<h5>Your adventure is over!</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="71"){$_SESSION["item13"]="f_ghoul_blood";}
elseif($_GET["pag"]=="73"){if($_SESSION["item13"]!=""&&$_SESSION["item18"]!=""&&$_SESSION["item23"]!=""&&$_SESSION["item24"]!=""){echo"<h5>You have the three items</h5>";}else{echo"<h5>You do not have the three items</h5>";}}
elseif($_GET["pag"]=="77"){
$_SESSION["fihunterp"]=5;$_SESSION["fihunterf"]=8;$_SESSION["shunterp"]=5;$_SESSION["shunterf"]=6;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>1st Masked Hunter</b></p>Skill:<input type='text' name='fihunterp' value='{$_SESSION['fihunterp']}' readonly='readonly'>";
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
$_SESSION["forca"]-=1;
//disputar combate com 4º hunter
if($_SESSION["shunterf"]==6)
{
echo "<h5>Fight 2nd Masked Hunter SKILL: 5 STAMINA:6</h5>";
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
}
if($_SESSION["forca"]<=0){echo"<h5>Game Over!</h5>";}
}
elseif($_GET["pag"]=="79"){$d1=mt_rand(2,12);echo"<h5>Your die roll: {$d1}</h5>";if($_SESSION["sorte"]<$d1){echo"<h5>You are lucky</h5>";}else{echo"<h5>Your were unlucky ,turn to 29</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="80"){$d1=mt_rand(2,12);$d2=mt_rand(2,12);echo"<h5>Your die rolls: {$d1} ____ {$d2}</h5>";if($d1<=$_SESSION["lproesa"]&&$d2<=$_SESSION["sorte"]){echo"<h5>You wew successful at both tests, turn to 137</h5>";}else{echo"<h5>You've been shot brutally ,your adventure ends here</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="82"){
$_SESSION["fihunterp"]=6;$_SESSION["fihunterf"]=4;$_SESSION["shunterp"]=5;$_SESSION["shunterf"]=4;	
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
$_SESSION["forca"]-=1;
//disputar combate com 2º hunter
if($_SESSION["shunterf"]==6)
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
}
if($_SESSION["forca"]<=0){echo"<h5>Game Over!</h5>";}
}
elseif($_GET["pag"]=="83")
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
elseif($_GET["pag"]=="84"){if($_SESSION["item15"]=="white_werewolf"){echo"<h5>You fought the white werewolf</h5>";}else{echo"<h5>You have not seen a white werewolf</h5>";}}
elseif($_GET["pag"]=="85"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot fight , your adventure is over!</h5>";}else{$d1=mt_rand(2,12);if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You have been killed by the ghost, die roll :{$d1}</h5>";}}}
elseif($_GET["pag"]=="86"){$_SESSION["fihunterp"]=6;$_SESSION["fihunterf"]=8;
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
if($_GET["test"]=="1"){$d1=mt_rand(2,12);echo"<h5>die rolls:{$d1}</h5>";if($d1>$_SESSION["sorte"]){
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Militant</b></p>Skill:<input type='text' name='fihunterp' value='{$_SESSION['fihunterp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='fihunterf' value='{$_SESSION['fihunterf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";}$_SESSION["sorte"]-=1;}
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
else{$_SESSION["forca"]-=4;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["lproesa"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
}}
if($_SESSION["fihunterf"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}}
include("pagevents3.php");
?>
