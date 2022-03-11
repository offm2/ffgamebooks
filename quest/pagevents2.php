<?php
if($_GET["pag"]=="29")
{$_SESSION["note"]="<h5>Note: To drink the white liquid you may go to pag. 147 and remember the page you were before at any time.</h5>";}
if($_GET["pag"]=="32")
{$_SESSION["item4"]="vial_green";echo"<script type='text/javascript'>document.getElementById('item4').innerHTML='vial_green';</script>";}
if($_GET["pag"]=="33")
{$_SESSION["forca"]-=2;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 2;</script>";}
if($_GET["pag"]=="35")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 1;</script>";
$_SESSION["item3"]="silver_dagger";echo"<script type='text/javascript'>document.getElementById('item3').innerHTML='silver_dagger';</script>";}
if($_GET["pag"]=="37")
{$roll=rand(1,6);if($roll==1||$roll==2){$goto=19;}elseif($roll==3||$roll==4){$goto=104;}else{$goto=86;}
echo"<h5>You can pick down the object or you continue and hit {$roll} turn to {$goto} </h5>";}
if($_GET["pag"]=="39")
{$_SESSION["forca"]+=1;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca + 1;</script>";}
if($_GET["pag"]=="41")
{$_SESSION["forca"]+=4;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca + 4;</script>";
if($_SESSION["item4"]=="vial_green"){$_SESSION["provisoes"]+=1;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 1;</script>";
}
}
if($_GET["pag"]=="44")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5>You were lucky turn to page 123. </h5>";}else{echo"<h5>You were not lucky turn to page 69. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}
if($_GET["pag"]=="45")
{$_SESSION["forca"]-=3;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 3;</script>";}
if($_GET["pag"]=="46")
{$_SESSION["ouro"]+=25;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 25;</script>";
$_SESSION["provisoes"]+=1;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 1;</script>";
}
if($_GET["pag"]=="47")
{$_SESSION["ouro"]+=7;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro + 7;</script>";}
if($_GET["pag"]=="49")
{$_SESSION["forca"]-=4;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 4;</script>";
if(rand(2,12)>$_SESSION["sorte"]){$roll=rand(1,6);$_SESSION["forca"]-=$roll;echo"<h5>You lost {$roll} more points because of the cuts.";echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - {$roll};</script>";}
$_SESSION["sorte"]-=1;}
if($_GET["pag"]=="50")
{$_SESSION["forca"]-=2;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 2;</script>";}
if($_GET["pag"]=="51")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5>You were lucky turn to page 34. </h5>";}else{echo"<h5>You were not lucky turn to page 142. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}
if($_GET["pag"]=="55")
{$_SESSION["item11"]="wand";echo"<script type='text/javascript'>document.getElementById('item11').innerHTML='wand';</script>";}
if($_GET["pag"]=="57")
{if ($_SESSION["item1"]=="fireball"&&$_SESSION["item5"]=="earth_spell"&&$_SESSION["item12"]=="wind_spell"&&$_SESSION["item13"]=="lightning")
{echo "<h5> You have the 4 spells turn to page 169 </h5>";}else {echo "<h5> You do not have the 4 spells go to page 143 </h5>";}} 
if($_GET["pag"]=="58")
{$_SESSION["item14"]="word:skulls";echo"<script type='text/javascript'>document.getElementById('item14').innerHTML='word:skulls';</script>";}
if($_GET["pag"]=="59")
{$_SESSION["forca"]-=4;echo"<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca - 4;</script>";
$_SESSION["pericia"]-=1;echo"<script type='text/javascript'>pericia=Number(document.getElementById('pericia').innerHTML);document.getElementById('pericia').innerHTML=pericia - 1;</script>";}
if($_GET["pag"]=="61")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5>You were lucky turn to page 103. </h5>";}else{echo"<h5>You leave the room turn to page 54. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}
if($_GET["pag"]=="63")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5>You were lucky turn to page 195. </h5>";}else{echo"<h5>You were not lucky turn to page 182. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}
if($_GET["pag"]=="64")
{if(rand(2,12)<$_SESSION["sorte"]){echo"<h5>You were lucky turn to page 7. </h5>";}else{$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte + 1; </script>";
echo"<h5>You were not lucky turn to page 88. </h5>";}
$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte - 1; </script>";}	
if($_GET["pag"]=="71")
{$_SESSION["item8"]="silver_ring";echo"<script type='text/javascript'>document.getElementById('item8').innerHTML='silver_ring';</script>";}
if($_GET["pag"]=="75")
{if($_SESSION["item4"]=="vial_green"){echo"<h5>You can turn to page 98.</h5>";}}
if($_GET["pag"]=="76")
{if($_SESSION["item15"]=="golden_key"){echo"<h5>You can turn to pag 137.</h5>";}}
if($_GET["pag"]=="78")
{echo"<h5>Turn to 56.</h5>";}
if($_GET["pag"]=="79")
{$_SESSION["item16"]="bronze_ring";echo"<script type='text/javascript'>document.getElementById('item16').innerHTML='bronze_ring';</script>";
$_SESSION["item17"]="Number:19";echo"<script type='text/javascript'>document.getElementById('item17').innerHTML='Number:19';</script>";
$_SESSION["nbattle2"]=$_SESSION["nbattle"];}
if($_GET["pag"]=="80")
{if($_SESSION['ouro']>1)
{echo "<center>Buy items ";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='1' name='sdagger'><input type='submit' value='Buy silver dagger'> </form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='orb' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Orb of Flame'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='chainmail' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Chainmail Armour'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='platemail' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Platemail Armour'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='potion' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy Potion of Healing'></form></center>";
if(isset($_GET["sdagger"]))
{$_SESSION["item3"]="silver_dagger";echo"<script type='text/javascript'>document.getElementById('item3').innerHTML='silver_dagger';</script>";
$_SESSION["ouro"]-=2;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 2;</script>";}
if(isset($_GET["orb"]))
{$_SESSION["item18"]="orb_of_flame";echo"<script type='text/javascript'>document.getElementById('item18').innerHTML='orb_of_flame';</script>";
$_SESSION["ouro"]-=4;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 4;</script>";}
if(isset($_GET["chainmail"]))
{$_SESSION["armour"]="chainmail";echo"<script type='text/javascript'>document.getElementById('armour').innerHTML='chainmail';</script>";
$_SESSION["ouro"]-=5;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 5;</script>";}
if(isset($_GET["platemail"]))
{$_SESSION["armour"]="platemail";echo"<script type='text/javascript'>document.getElementById('armour').innerHTML='platemail';</script>";
$_SESSION["ouro"]-=8;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 8;</script>";}
if(isset($_GET["potion"]))
{$_SESSION["provisoes"]+=3;echo"<script type='text/javascript'>provisoes=Number(document.getElementById('provisoes').innerHTML);document.getElementById('provisoes').innerHTML=provisoes + 3;</script>";
$_SESSION["ouro"]-=3;echo"<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro - 3;</script>";}
}
$_SESSION["nbattle3"]=$_SESSION["nbattle"];}
include("pagevents3.php");
?>