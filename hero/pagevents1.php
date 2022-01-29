<?php
//restantes dados das paginas
if($_GET['pag']=="1")
{
$_SESSION["stime"]=time();
}
elseif($_GET['pag']=="2")
{
if($_SESSION['ouro']>1)
{echo "<center>Buy items ";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='1' name='dagger'><input type='submit' value='Buy dagger'> </form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='salve' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy jar of salve'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='figurine' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy small stone figurine'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='ropeand' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy rope and grapple'></form>";
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='lantern' value='1' ><input type='hidden' name='pag' value={$_GET[pag]}> <input type='submit' value='Buy lantern'></form></center>";
if(isset($_GET["dagger"]))
{$_SESSION["item1"]="dagger";echo"<script type='text/javascript'>document.pontuacao.item1.value='dagger';</script>";
$_SESSION["ouro"]-=2;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 2;</script>";
if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2"){$_SESSION["pericia"]+=4;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 4;</script>";
echo "<h5>You now have a weapon and gained 4 points of stamina</h5>";$_SESSION["weapon"]="yes1";}
}
if(isset($_GET["salve"]))
{$_SESSION["item2"]="salve";echo"<script type='text/javascript'>document.pontuacao.item2.value='salve';</script>";
$_SESSION["ouro"]-=4;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 4;</script>";}
if(isset($_GET["figurine"]))
{$_SESSION["item3"]="figurine";echo"<script type='text/javascript'>document.pontuacao.item3.value='figurine';</script>";
$_SESSION["ouro"]-=5;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 5;</script>";
$_SESSION["sorte"]+=1;echo"<script type='text/javascript'>sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte+1;</script>";
}
if(isset($_GET["ropeand"]))
{$_SESSION["item4"]="ropeandgrapple";echo"<script type='text/javascript'>document.pontuacao.item4.value='ropeandgrapple';</script>";
$_SESSION["ouro"]-=7;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 7;</script>";}
if(isset($_GET["lantern"]))
{$_SESSION["item5"]="lantern";echo"<script type='text/javascript'>provisoes=Number(document.pontuacao.item5.value);document.pontuacao.item5.value='lantern';</script>";
$_SESSION["ouro"]-=3;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 3;</script>";}
}
else {echo "<h5>You do not have enough gold left</h5>";}
}
elseif($_GET['pag']=="3")
{$_SESSION["ouro"]+=2;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 2;</script>";
if(in_array("open",$_SESSION["magic"])){echo"<h5>You can use the open spell turn to 35</h5>";}else{echo"<h5>You do not have the open spell.</h5>";}}
elseif($_GET['pag']=="4")
{if (isset($_SESSION["hint1"])){echo"<h5>{$_SESSION["hint1"]}</h5>";}}
elseif($_GET['pag']=="5")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET['pag']=="6")
{$_SESSION["hint1"]="Hint:Clock Street";
if(in_array("open",$_SESSION["magic"])){echo"<h5>You can use the open spell turn to 27</h5>";}else{echo"<h5>You do not have the open spell.</h5>";}}
elseif($_GET['pag']=="8")
{echo"<h5>You cast the Fear Spell</h5>";$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET['pag']=="11")
{echo"<h5>You cast the Fear Spell</h5>";$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET['pag']=="13")
{$_SESSION["ouro"]-=2;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 2;</script>";}
elseif($_GET['pag']=="14")
{$_SESSION["item6"]="silver_dagger";echo"<script type='text/javascript'>document.pontuacao.item6.value='silver_dagger';</script>";if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2"){$_SESSION["pericia"]+=4;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 4;</script>";
echo "<h5>You now have a weapon and gained 4 points of stamina</h5>";$_SESSION["weapon"]="yes1";}
if($_SESSION["pericia"]<12){echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 1;</script>";$_SESSION["pericia"]+=1;}
else{echo"<h5>You are already at the maximum skill";}
if(in_array("ward",$_SESSION["magic"])){echo"<h5>You can use the ward spell, turn to 46</h5>";}}
elseif($_GET['pag']=="15")
{echo"<h5>You cast the Fear Spell</h5>";$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET['pag']=="16")
{if($_SESSION["item6"]=="silver_dagger"){echo"<h5>You already have the silver dagger turn to 50</h5>";}else{$_SESSION["item6"]="silver_dagger";
if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2"){$_SESSION["pericia"]+=4;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 4;</script>";
echo "<h5>You now have a weapon and gained 4 points of stamina</h5>";$_SESSION["weapon"]="yes";}
echo"<script type='text/javascript'>document.pontuacao.item6.value='silver_dagger';</script>";}}
elseif($_GET['pag']=="18")
{$_SESSION["forca"]-=4;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 4;</script>";
$_SESSION["pericia"]+=1;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 1;</script>";}
elseif($_GET['pag']=="19")
{echo"<h5>You lose 1 point of luck</h5>";$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte - 1;</script>";}
elseif($_GET['pag']=="20")
{if(in_array("ward",$_SESSION["magic"])){echo"<h5>You can use the ward spell, turn to 5</h5>";}}
elseif($_GET['pag']=="22")
{if(in_array("ward",$_SESSION["magic"])){echo"<h5>You can use the ward spell, turn to 46</h5>";}}
elseif($_GET['pag']=="23")
{$_SESSION["forca"]+=4;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca + 4;</script>";
$_SESSION["ouro"]+=5;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 5;</script>";}
elseif($_GET['pag']=="24")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";echo"<h5>You cast the open spell</h5>";}
elseif($_GET['pag']=="25")
{if(in_array("illusion",$_SESSION["magic"])){echo"<h5>You can use the illusion spell, turn to 40</h5>";}}
elseif($_GET['pag']=="26")
{$_SESSION["ouro"]-=1;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 1;</script>";echo"<h5>You pay a gold piece</h5>";
if(in_array("illusion",$_SESSION["magic"])){echo"<h5>You can use the illusion spell, turn to 31</h5>";}
echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='test' name='luck'><input type='submit' value='Test Luck'> </form>";
if(isset($_GET["luck"])){$die1=mt_rand(1,6);$die2=mt_rand(1,6); if($_SESSION["sorte"]<$die1+$die2){echo"<h5>You roll {$die1} + {$die2} , you got no luck turn to 41</h5>";}
else{echo"<h5>You were lucky turn to 36</h5>";}}}

include("pagevents2.php");
?>
