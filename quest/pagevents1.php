<?php
//restantes dados das paginas
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="3")
{
$_SESSION["zombie2f"]=8;$_SESSION["zombie3f"]=8;$_SESSION["zombie4f"]=8;
if(isset($_GET["iskill"]))
{
//disputar combate com 2� zombie pag. 3
if($_SESSION["zombie2f"]==8)
{echo "<h5>Fight Second Crypt Zombie Skill: 8 Stamina: {$_SESSION["zombie2f"]}</h5>";
while($_SESSION["forca"]>0&&$_SESSION["zombie2f"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){if($_SESSION["item2"]=="warhammer"){$_SESSION["zombie2f"]-=4;echo "<h5>$count you hit your enemy with the Warhammer</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else{$_SESSION["zombie2f"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["zombie2f"]<=0){echo"<h3>You Win!</h3>";}
}
}
if($_SESSION["zombie3f"]==8)
{echo "<h5>Fight Third Crypt Zombie Skill: 8 Stamina: 8</h5>";
while($_SESSION["forca"]>0&&$_SESSION["zombie3f"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){if($_SESSION["item2"]=="warhammer"){$_SESSION["zombie3f"]-=4;echo "<h5>$count you hit your enemy with the Warhammer</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else{$_SESSION["zombie3f"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["zombie3f"]<=0){echo"<h3>You Win!</h3>";}
}
}
if($_SESSION["zombie4f"]==8)
{echo "<h5>Fight Fourth Crypt zombie Skill: 8 Stamina: 8</h5>";
while($_SESSION["forca"]>0&&$_SESSION["zombie4f"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){if($_SESSION["item2"]=="warhammer"){$_SESSION["zombie4f"]-=4;echo "<h5>$count you hit your enemy with the Warhammer</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else{$_SESSION["zombie4f"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["zombie4f"]<=0){echo"<h3>You Win!</h3>";}
}
}

}}
if($_GET["pag"]=="5")
{$_SESSION["ouro"]+=2;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 2;</script>";}
if($_GET["pag"]=="7")
{$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";
if($_SESSION["item4"]=="vial_green"){echo"<h5>You can turn to page 10.</h5>";}}
if($_GET["pag"]=="8")
{
if(rand(2,12)<$_SESSION["sorte"]-2){echo"<h5>You were lucky turn to page 145. </h5>";}else{echo"<h5>You were not lucky turn to page 164. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}
if($_GET["pag"]=="9")
{$roll=rand(1,6);if ($roll<4){$_SESSION["forca"]-=4;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 4; </script>";echo"<h5>You hit $roll so you lost 4 STAMINA points.</h5>";}
else{$_SESSION["forca"]-=3;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 3; </script>";echo"<h5>You hit $roll you lost 3 STAMINA points.</h5>";}
}
if($_GET["pag"]=="10")
{$_SESSION["item1"]="fireball";echo"<script type='text/javascript'>document.getElementById('item1').innerHTML='fireball';</script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";}
if($_GET["pag"]=="11")
{$_SESSION["item5"]="earth_spell";echo"<script type='text/javascript'>document.getElementById('item5').innerHTML='earth_spell';</script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";}
if($_GET["pag"]=="12")
{$_SESSION["item6"]="red_key";echo"<script type='text/javascript'>document.getElementById('item6').innerHTML='red_key';</script>";
$_SESSION["ouro"]+=3;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 3;</script>";}
if($_GET["pag"]==="13")
{$_SESSION["forca"]-=2;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 2;</script>";}
if($_GET["pag"]=="15")
{if(rand(2,12)<$_SESSION["pericia"]){echo"<h5> You were successful turn to 27.</h5>";}else{echo"<h5>You were unsuccessful turn to 184.</h5>";}}
if($_GET["pag"]=="16")
{$_SESSION["forca"]-=2;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 2;</script>";}
if($_GET["pag"]=="17")
{$_SESSION["item7"]="N:Grimbar";echo"<script type='text/javascript'>document.getElementById('item7').innerHTML='N:Grimbar';</script>";}
if($_GET["pag"]=="20")
{$_SESSION["gargoyle2f"]=14;
if(isset($_GET["iskill"]))
{
//disputar combate com 2� Gargoyle pag 20
if($_SESSION["gargoyle2f"]==14)
{echo "<h5>Fight second Gargoyle Skill: 8 Stamina: {$_SESSION["gargoyle2f"]} </h5>";
while($_SESSION["forca"]>0&&$_SESSION["gargoyle2f"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($_SESSION["item8"]=="silver_ring"){
if($resultado1+1>$resultado2){$resultado1=$resultado1+1;$_SESSION["gargoyle2f"]-=3;echo"<h5> $count You Hit your enemy with extra damage</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} +1 = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";$_SESSION["forca"]+=1;}
else{
$roll=rand(1,6);if($roll==1||$roll==6){$resultado1=$resultado1+1;$_SESSION["forca"]-=4;echo"<h5>$count You've been hit with 4 points of damage by the Gargoyle</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} +1 = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-4;</script>";}
else{$resultado1=$resultado1+1;$_SESSION["forca"]-=3;echo"<h5>$count You've been hit with 3 points of damage by the Gargoyle</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} +1 = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;</script>";}
}}
else{
if($resultado1>$resultado2){$_SESSION["gargoyle2f"]-=2;echo"<h5> $count You Hit your enemy </h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else{
$roll=rand(1,6);if($roll==1||$roll==6){$_SESSION["forca"]-=4;echo"<h5>$count You've been hit with 4 points of damage by the Gargoyle</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-4;</script>";}
else{$_SESSION["forca"]-=3;echo"<h5>$count You've been hit with 3 points of damage by the Gargoyle</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-3;</script>";}
}}if($_SESSION["gargoyle2f"]<=0){echo "<h3>You Win!</h3>";}
}}
}}
if($_GET["pag"]=="24")
{$_SESSION["item9"]="b_gauntlet";echo"<script type='text/javascript'>document.getElementById('item9').innerHTML='b_gauntlet';</script>";
$_SESSION["ouro"]+=9;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 9;</script>";}
if($_GET["pag"]=="26")
{if($_SESSION["item4"]=="vial_green"){echo"<h5>You can turn to page 92.</h5>";}
$_SESSION["provisoes"]+=2;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 2;</script>";
}
if($_GET["pag"]=="27")
{$_SESSION["ouro"]+=12;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 12;</script>";}
include("pagevents2.php");
?>
