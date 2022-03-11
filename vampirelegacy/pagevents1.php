<?php
//restantes dados das paginas
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="5")
{$_SESSION["fe"]-=1;echo"<h5>You lose 1 faith point</h5>";
echo"<script type='text/javascript'>fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe-1;</script>";}
elseif($_GET['pag']=="6")
{$_SESSION["sorte"]-=1;echo"<h5>You lose 1 luck point</h5>";
echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
elseif($_GET['pag']=="7")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='addprov' value='add healing herbs to the inventory'>";
echo "</form>";
echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add garlic flowers to the inventory'>";
echo "</form>";
if(isset($_GET["addprov"])){$_SESSION["provisoes"]+=1;}
if(isset($_GET["additem"])){$_SESSION["item1"]="garlic_flowers";
echo"<script type='text/javascript'>
prov=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=prov+1;
document.getElementById('item1').innerHTML='garlic_flowers';</script>";}}
elseif($_GET['pag']=="8")
{$d1=mt_rand(1,6);if ($d1+2<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 19</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 125</h5>";}}
elseif($_GET['pag']=="10")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add garlic flowers to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
$_SESSION["item1"]="garlic_flowers";
echo"<script type='text/javascript'>
document.getElementById('item1').innerHTML='garlic_flowers';</script>";}
else{$d1=mt_rand(2,12);if($d1<$_SESSION["pericia"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 114</h5>";}
else{echo"<h5>Your dice roll: {$d1}, you fail, turn to 166</h5>";}}}
elseif($_GET["pag"]=="14")
{$_SESSION["fe"]+=1;echo"<h5>You gain 1 faith point</h5>";
echo"<script type=text/javascript'>fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+1;</script>";
$d1=mt_rand(3,18);if($d1<$_SESSION["forca"]){echo"<h5>Your dice roll: {$d1}, you roll lower than your current stamina, turn to 137</h5>";}
else{echo"<h5>Your dice roll: {$d1}, you roll higher than your current stamina, turn to 35</h5>";}}
elseif($_GET["pag"]=="16")
{$d1=mt_rand(2,12);if($d1<$_SESSION["sorte"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 140</h5>";}
else{echo"<h5>Your dice roll: {$d1},  you fail, turn to 112</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="20")
{$d1=mt_rand(2,12);if($d1<$_SESSION["pericia"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 139</h5>";}
else{echo"<h5>Your dice roll: {$d1}, you fail, turn to 95</h5>";}}
elseif($_GET["pag"]=="25")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add marchpane pheasant to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
$_SESSION["provisoes"]+=1;$_SESSION["item5"]="marchpane_pheasant";echo"<h5>You gain 1 provision</h5>";
echo"<script type='text/javascript'>
prov=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=prov+1;
document.getElementById('item5').innerHTML='marchpane_pheasant';
</script>";}}
elseif($_GET["pag"]=="29")
{$_SESSION["forca"]-=3;echo"<h5>You lose 3 points of stamina</h5>";
echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;
</script>";}
elseif($_GET["pag"]=="30")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add silver stake to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
$_SESSION["item2"]="silver_stake";echo"<script type='text/javascript'>
document.getElementById('item2').innerHTML='silver_stake';</script>";}}
elseif($_GET["pag"]=="31")
{$_SESSION["sorte"]-=1;$_SESSION["fe"]-=1;
echo"<h5>You lose 1 point of luck</h5>";echo"<h5>You lose 1 point of faith</h5>";
echo"<script type='text/javascript'>
sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe-1;
</script>";}
elseif($_GET["pag"]=="33")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add golden crucifix to the inventory'>";
echo "</form>"; 
if(isset($_GET["additem"])){
$_SESSION["item3"]="golden_crucifix";echo"<script type='text/javascript'>
document.getElementById('item3').innerHTML='golden_crucifix';</script>";}}
elseif($_GET["pag"]=="36")
{$_SESSION["fe"]-=1;echo"<h5>You lose 1 point of faith</h5>";
echo"<script type='text/javascript'>
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe-1;</script>";}
elseif($_GET["pag"]=="38")
{$_SESSION["forcainicial"]+=1;$_SESSION["forca"]=$_SESSION["forcainicial"];
echo"<h5>your stamina will be restored to the initial level plus 1 when you turn the page</h5>";}
elseif($_GET["pag"]=="45")
{$d1=mt_rand(2,12);if($d1<$_SESSION["pericia"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 49</h5>";}
else{echo"<h5>Your dice roll: {$d1}, you fail, turn to 153</h5>";}}
elseif($_GET["pag"]=="46"){
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>WEREWOLF</b></p>Skill:<input type='text' name='beastp' value='{$_SESSION['beastp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='beastf' value='{$_SESSION['beastf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["beastp"])&&ctype_digit($_GET["beastp"])&&ctype_digit($_GET["beastf"])&&isset($_GET["beastf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;$c2=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["beastf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["pericia"]-2;$r2=$d3+$d4+$_SESSION["beastp"];
if($r1>$r2){$_SESSION["beastf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} -2 = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["beastp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} -2 = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["beastp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;$c2++;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} -2 = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["beastp"]} = {$r2} </h5>";
if($_SESSION["fight2"]==1){echo"<h5> You have been hit a 5th time, turn to 73</h5>";break;}}
if($c2==4){echo"<h5>You have been hit more than 3 times, turn to 100</h5>";break;}
}}
if($_SESSION["beastf"]<=0){echo"<h3>You Win the fight!</h3>";}
if($_SESSION["forca"]<=0){echo"<h5>you died!</h5>";}}
elseif($_GET['pag']=="47")
{$d1=mt_rand(2,12);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 160</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 88</h5>";}}
elseif($_GET["pag"]=="49")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add magical sword to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
if($_SESSION["pericia"]<13){$_SESSION["pericia"]+=1;echo"<script type='text/javascript'>
pericia=Number(document.getElementById('pericia').innerHTML);document.getElementById('pericia').innerHTML=pericia+1;
</script>";}$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>
sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;
</script>";$_SESSION["item4"]="magical_sword";echo"<script type='text/javascript'>
document.getElementById('item4').innerHTML='magical_sword';</script>";}}
elseif($_GET["pag"]=="53")
{if($_SESSION["item4"]=="magical_sword"){echo"<h5>You have a magical sword, turn to 58</h5>";}
else{echo"<h5>You do not have a magical sword</h5>";}}
elseif($_GET["pag"]=="58"){
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>HEYDRICH'S ESSENCE </b></p>Skill:<input type='text' name='countp' value='13' readonly='readonly'>";
echo "Stamina:<input type='text' name='countf' value='15' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["countp"])&&ctype_digit($_GET["countp"])&&ctype_digit($_GET["countf"])&&isset($_GET["countf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;if($_SESSION["item1"]=="garlic_flowers"){
$a=$_SESSION["pericia"]+2;echo"<h5>Your skill for this fight is {$a} </h5>";}
else{$a=$_SESSION["pericia"];}
//luta
while($_SESSION["forca"]>0&&$_SESSION["countf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$a;$r2=$d3+$d4+$_SESSION["countp"];
if($r1>$r2){$_SESSION["countf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$a} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["countp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$a} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["countp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=3;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$a} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["countp"]} = {$r2} </h5>";}
}}
if($_SESSION["countf"]<=0){echo"<h3>You Win the fight!</h3>";}
if($_SESSION["forca"]<=0){echo"<h5>you died!</h5>";}}
elseif($_GET["pag"]=="62")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
elseif($_GET['pag']=="64")
{$_SESSION["sorte"]-=1;echo"<h5>You lose 1 luck point</h5>";$_SESSION["item3"]="";
echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
elseif($_GET['pag']=="66")
{$_SESSION["item6"]="p_genealogy";//$_SESSION["item7"]="106_pages";
$_SESSION["fe"]+=2;$_SESSION["forca"]+=2;$_SESSION["sorte"]+=1;
echo"<script type='text/javascript'>
document.getElementById('item6').innerHTML='p_genealogy';
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+2;
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+2;
sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;
</script>";
echo"<h5>You gain 2 faith points</h5><h5>You gain 2 stamina points</h5><h5>You gain 1 luck point</h5>";
}
elseif($_GET['pag']=="69")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add garlic flowers to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
$_SESSION["item1"]="garlic_flowers";
echo"<script type='text/javascript'>
document.getElementById('item1').innerHTML='garlic_flowers';</script>";}}
elseif($_GET['pag']=="74")
{$d1=mt_rand(1,6);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 93</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 5</h5>";}}
elseif($_GET['pag']=="75")
{$_SESSION["item5"]="";}
elseif($_GET["pag"]=="79")
{$d1=mt_rand(2,12);if($d1<$_SESSION["pericia"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 59</h5>";}
else{echo"<h5>Your dice roll: {$d1}, you fail, turn to 97</h5>";}}
elseif($_GET["pag"]=="82")
{$_SESSION["fe"]+=1;echo"<h5>You gain 1 point of faith</h5>";
echo"<script type='text/javascript'>
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+1;</script>";}
elseif($_GET["pag"]=="87")
{$d1=mt_rand(2,12);if($d1<$_SESSION["sorte"]){echo"<h5>Your dice roll: {$d1}, you succeed, turn to 164</h5>";}
else{echo"<h5>Your dice roll: {$d1},  you fail, turn to 105</h5>";}$_SESSION["sorte"]-=1;}
include("pagevents2.php");
?>
