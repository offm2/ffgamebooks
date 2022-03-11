<?php
if($_GET["pag"]=="143"){
echo"<form name='eat1' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='item' value='1'>";
echo "<input type='submit' value='Pick Jade Talisman'></form>";
if($_GET["item"]==1){echo"<h5>You pick the Talisman</h5>";$_SESSION["item4"]="talisman";}}
elseif($_GET["pag"]=="145"){$_SESSION["forca"]-=4;
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
if($_GET["test"]==1){$d1=mt_rand(2,12);if($d1<=$_SESSION["sorte"]){echo"<h5>You had luck, turn to 76</h5>";}else{echo"<h5>You had no luck.</h5>";}$_SESSION["sorte"]-=1;$_SESSION["forca"]+=4;}
}
elseif($_GET["pag"]=="146"){
echo"<form name='eat1' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='eat' value='1'>";
echo "<input type='submit' value='Eat berries'></form>";
if($_GET["eat"]==1){$_SESSION["forca"]+=4;}
$_SESSION["zombiep"]=8;$_SESSION["zombief"]=10;	
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
elseif($_GET["pag"]=="148"){$_SESSION["curse"]=1;}
elseif($_GET["pag"]=="152"){$d1=mt_rand(2,12);if($d1<$_SESSION["pericia"]){echo"<h5>You had skill, turn to 46</h5>";}else{echo"<h5>You did not have skill , you have died a painful death!</h5>";}}
elseif($_GET["pag"]=="153"){$_SESSION["forca"]-=2;}
elseif($_GET["pag"]=="155"){$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="157"){$_SESSION["zombiep"]=11;$_SESSION["zombief"]=14;	
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
elseif($_GET["pag"]=="163"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot escape , your adventure is over!</h5>";}else{$d1=mt_rand(2,12);if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You could not escape,and you died, die roll :{$d1}</h5>";}}}
elseif($_GET["pag"]=="165"){$_SESSION["item22"]="silver_whistle";$_SESSION["fihunterp"]=4;$_SESSION["fihunterf"]=4;
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
if($_GET["test"]=="1"){$d1=mt_rand(2,12);echo"<h5>die rolls:{$d1}</h5>";if($d1>$_SESSION["sorte"]){
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Clawed tub</b></p>Skill:<input type='text' name='ctp' value='{$_SESSION['fihunterp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='ctf' value='{$_SESSION['fihunterf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";}$_SESSION["sorte"]-=1;}
if(isset($_GET["ctp"])&&ctype_digit($_GET["ctp"])&&ctype_digit($_GET["ctf"])&&isset($_GET["ctf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["fihunterf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["pericia"];$r2=$d3+$d4+$_SESSION["fihunterp"];
if($r1>$r2){$_SESSION["fihunterf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=4;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["fihunterp"]} = {$r2} </h5>";}
}}
if($_SESSION["fihunterf"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}}
elseif($_GET["pag"]=="167"){$_SESSION["forca"]+=4;}
elseif($_GET["pag"]=="169"){$_SESSION["item19"]="lotus_flower";}
elseif($_GET["pag"]=="171"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot test your Werewolf Prowess!</h5>";}else{$d1=mt_rand(2,12);if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You were not sucessful, die roll :{$d1}</h5>";}}}
elseif($_GET["pag"]=="172"){if($_SESSION["item16"]!=""||$_SESSION["item22"]!=""){echo"<h5>You have a silver object, turn to 105</h5>";}else{echo"<h5>You do not have a silver object</h5>";}}
elseif($_GET["pag"]=="174"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot test your Werewolf Prowess!</h5>";}else{$d1=mt_rand(2,12);$d2=mt_rand(2,12);
if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You were not sucessful, die roll :{$d1}</h5>";}
if($d2<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d2}</h5>";}else{echo"<h5>You were not sucessful, die roll :{$d2}</h5>";}
}}
elseif($_GET["pag"]=="175"){if($_SESSION["note"]!=""){echo"<h5>{$_SESSION["note"]}</h5>";}}
elseif($_GET["pag"]=="176"){$_SESSION["zombiep"]=6;$_SESSION["zombief"]=8;	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Earwig Mutant</b></p>Skill:<input type='text' name='emp' value='{$_SESSION['zombiep']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='emf' value='{$_SESSION['zombief']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["emp"])&&ctype_digit($_GET["emp"])&&ctype_digit($_GET["emf"])&&isset($_GET["emf"]))
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
elseif($_GET["pag"]=="177"){if($_SESSION["item22"]=="silver_whistle"){echo"<h5>You have a silver whistle</h5>";}else{
echo"<form name='tluck' action='{$_SERVER['PHP_SELF']}'>";
echo"<input type='hidden' name='pag' value={$_GET['pag']}>";
echo"<input type='hidden' name='test' value='1'>";
echo "<input type='submit' value='Test Luck'></form>";
if($_GET["test"]==1){$d1=mt_rand(2,12);if($d1<=$_SESSION["sorte"]){echo"<h5>You had luck, turn to 17</h5>";}else{echo"<h5>You had no luck.</h5>";}$_SESSION["sorte"]-=1;echo"<h5>Die roll:{$d1}</h5>";}}}
elseif($_GET["pag"]=="180"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot test your Werewolf Prowess!</h5>";}else{$d1=mt_rand(2,12);if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You were not sucessful, die roll :{$d1}</h5>";}}}
elseif($_GET["pag"]=="181"){$_SESSION["zombiep"]=11;$_SESSION["zombief"]=12;$_SESSION["code"]="+20+20-10";	
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>Combustion Demon</b></p>Skill:<input type='text' name='emp' value='{$_SESSION['zombiep']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='emf' value='{$_SESSION['zombief']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["emp"])&&ctype_digit($_GET["emp"])&&ctype_digit($_GET["emf"])&&isset($_GET["emf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["zombief"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["pericia"];$r2=$d3+$d4+$_SESSION["zombiep"];
if($r1>$r2){$_SESSION["zombief"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=6;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["zombiep"]} = {$r2} </h5>";}
}
if($_SESSION["zombief"]<=0){echo"<h3>You Win the fight!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}}
elseif($_GET["pag"]=="185"){$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="186"){$_SESSION["forca"]-=1;}
elseif($_GET["pag"]=="187"){$_SESSIO["forca"]-=4;if($_SESSION["code"]=="+20+20-10"){echo"<h5>code: {$_SESSION["code"]}</h5>";}else{echo"<h5>You do not know the code</h5>";}}
elseif($_GET["pag"]=="188"){$_SESSION["forca"]+=4;$_SESSION["item24"]="chalice";}
elseif($_GET["pag"]=="192"){if($_SESSION["curse"]==1){echo"<h5>You have been cursed ,so you cannot test your Werewolf Prowess!</h5>";}else{$d1=mt_rand(2,12);
if($d1<$_SESSION["lproesa"]){echo"<h5>You were sucessful, die roll: {$d1}</h5>";}else{echo"<h5>You were not sucessful, die roll :{$d1}</h5>";}
}}
elseif($_GET["pag"]=="193"){$_SESSION["item8"]="brass_key";}
elseif($_GET["pag"]=="196"){$_SESSION["item10"]="ivory_duck";if($_SESSION["note"]!=""){echo"<h5>{$_SESSION["note"]}</h5>";}}
elseif($_GET["pag"]=="199"){echo"<h5>You have got the butcher knife</h5>";$_SESSION["pericia"]+=2;}
elseif($_GET["pag"]=="200")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Rise of the Night Creatures";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}
?>
