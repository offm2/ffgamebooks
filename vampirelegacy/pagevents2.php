<?php
if($_GET["pag"]=="96")
{echo "<form action='{$_SERVER['PHP_SELF']}' >";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' name='additem' value='add H talisman to the inventory'>";
echo "</form>";
if(isset($_GET["additem"])){
$_SESSION["item8"]="H_talisman";echo"<script type='text/javascript'>
document.getElementById('item8').innerHTML='H_talisman';</script>";}}
elseif($_GET['pag']=="98")
{$_SESSION["sorte"]-=1;echo"<h5>You lose 1 luck point</h5>";
echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
elseif($_GET['pag']=="100")
{$d1=mt_rand(2,12);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 32</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 73</h5>";}$_SESSION["fight2"]=1;}
elseif($_GET["pag"]=="107"){
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>GHOUL</b></p>Skill:<input type='text' name='beastp' value='{$_SESSION['ghoulp']}' readonly='readonly'>";
echo "Stamina:<input type='text' name='beastf' value='{$_SESSION['ghoulf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["beastp"])&&ctype_digit($_GET["beastp"])&&ctype_digit($_GET["beastf"])&&isset($_GET["beastf"]))
{echo"<img align='left' src='imagens/luta.gif'>";$c1=0;$c2=0;
//luta
while($_SESSION["forca"]>0&&$_SESSION["ghoulf"]>0)
{$c1++;$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$r1=$d1+$d2+$_SESSION["pericia"];$r2=$d3+$d4+$_SESSION["ghoulp"];
if($r1>$r2){$_SESSION["ghoulf"]-=2;echo"<h5>{$c1} you hit your enemy</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["ghoulp"]} = {$r2} </h5>";}
elseif($r1==$r2){echo"<h5>{$c1} Nobody has been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["ghoulp"]} = {$r2} </h5>";}
else{$_SESSION["forca"]-=2;$c2++;echo"<h5>{$c1} you have been hit</h5>
<h5>You:<img src='../images/{$d1}.jpg'> + <img src='../images/{$d2}.jpg'> + {$_SESSION["pericia"]} = {$r1} Vs
<img src='../images/{$d3}.jpg'> + <img src='../images/{$d4}.jpg'> + {$_SESSION["ghoulp"]} = {$r2} </h5>";}
if($c2==3){echo"<h5>The ghoul has won three attack rounds, turn to 85</h5>";break;}
}}
if($_SESSION["ghoulf"]<=0){echo"<h3>You Win the fight!</h3>";}
if($_SESSION["forca"]<=0){echo"<h5>you died!</h5>";}}
elseif($_GET["pag"]=="119")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
elseif($_GET['pag']=="126")
{$d1=mt_rand(2,12);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 107</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 34</h5>";}}
elseif($_GET['pag']=="127")
{$_SESSION["fe"]+=1;$_SESSION["forca"]+=2;$_SESSION["provisoes"]+=1;
echo"<script type='text/javascript'>
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+1;
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca+2;
prov=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=prov+1;
</script>";
echo"<h5>You gain 1 faith points</h5><h5>You gain 2 stamina points</h5><h5>You gain 1 provision</h5>";
}
elseif($_GET["pag"]=="132")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
elseif($_GET['pag']=="137")
{if(!isset($_GET["iskill"])){
$_SESSION["sorte"]+=1;echo"<h5>You gain 1 luck point</h5>";
echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte+1;</script>";}}
elseif($_GET['pag']=="139")
{$d1=mt_rand(2,12);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 11</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 101</h5>";}}
elseif($_GET["pag"]=="119")
{$_SESSION["forca"]-=1;echo"<h5>You lost 1 stamina point</h5>";echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-1;</script>";}
elseif($_GET['pag']=="142")
{$_SESSION["fe"]+=1;
echo"<script type='text/javascript'>
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+1;
</script>";
echo"<h5>You gain 1 faith point</h5>";
}
elseif($_GET["pag"]=="146")
{$_SESSION["forca"]-=2;echo"<h5>You lost 2 stamina points</h5>";echo"<script type='text/javascript'>
forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
elseif($_GET['pag']=="148")
{$d1=mt_rand(2,12);if ($d1<$_SESSION["fe"]){echo"<h5>Your die roll: {$d1}, turn to 160</h5>";}
else{echo"<h5>Your die roll: {$d1}, turn to 88</h5>";}}
elseif($_GET['pag']=="157")
{$_SESSION["fe"]+=1;
echo"<script type='text/javascript'>
fe=Number(document.getElementById('fe').innerHTML);document.getElementById('fe').innerHTML=fe+1;
</script>";
echo"<h5>You gain 1 faith point</h5>";
}
elseif($_GET['pag']=="165")
{$_SESSION["sorte"]-=1;echo"<h5>You lost 1 luck point</h5>";
echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";}
elseif($_GET["pag"]=="167")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Legacy of the Vampire";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}

?>
