<?php
if($_GET["pag"]=="27")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";echo"<h5>You cast the open spell</h5>";
$_SESSION["ouro"]+=3;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 3;</script>";$_SESSION["potion"]=1;
$_SESSION["provisoes"]+=1;echo"<script type='text/javascript'>prov=Number(document.pontuacao.provisoes.value);document.pontuacao.provisoes.value=prov+1;</script>";
}
elseif($_GET["pag"]=="28")
{$die1=mt_rand(1,6);$die2=mt_rand(1,6);if($_SESSION["sorte"]<$die1+$die2){echo"<h5>You roll {$die1}+{$die2} you got no luck and been hit in the chest, and lost 4 stamina points</h5>";
$_SESSION["forca"]-=4;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 4;</script>";}
else{echo"<h5>You roll {$die1}+{$die2} you had luck, and been able to dodge the arrow</h5>";}}
elseif($_GET["pag"]=="29")
{if(in_array("fear",$_SESSION["magic"])){echo"<h5>You can use the fear spell, turn to 8</h5>";}}
elseif($_GET["pag"]=="30")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET["pag"]=="31")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";
$_SESSION["ouro"]+=5;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 5;</script>";
echo"<h5>You cast the spell, lost 1 stamina point and gain 5 gold pieces";}
elseif($_GET["pag"]=="32")
{if($_SESSION["item5"]=="lantern"){echo"<h5>You have the lantern turn to 6</h5>";}else{echo"<h5>You do not have a lantern turn to 48</h5>";}}
elseif($_GET["pag"]=="33")
{$_SESSION["item7"]="cutlass";echo"<script type='text/javascript'>document.pontuacao.item7.value='cutlass';</script>";
if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2"){$_SESSION["pericia"]+=4;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 4;</script>";
echo "<h5>You now have a weapon and gained 4 points of stamina</h5>";$_SESSION["weapon"]="yes1";}}
elseif($_GET["pag"]=="35")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";
echo"<h5>You cast the open spell,1 point of stamina removed</h5>";}
elseif($_GET["pag"]=="36")
{$_SESSION["ouro"]+=5;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 5;</script>";
echo"<h5>You gain 5 gold pieces";}
elseif($_GET["pag"]=="39")
{echo "<form action='{$_SERVER[PHP_SELF]}'><input type='hidden' name='pag' value={$_GET[pag]}><input type='hidden' value='yes' name='meal'><input type='submit' value='Buy Meal'> </form>";
if(isset($_GET["meal"])&&$_GET["meal"]=="yes"){$_SESSION["forca"]+=2;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 2;</script>";
echo"<h5>You gain 2 stamina points and give the 3 gold pieces</h5>";
$_SESSION["ouro"]-=3;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro - 3;</script>";}
if(in_array("fear",$_SESSION["magic"])||in_array("open",$_SESSION["magic"])||$_SESSION["item4"]!="")
{if(in_array("fear",$_SESSION["magic"])){echo"<h5>You can use the fear spell, turn to 11</h5>";}
if(in_array("open",$_SESSION["magic"])){echo"<h5>You can use the open spell, turn to 24</h5>";}
if($_SESSION["item4"]!=""){echo"<h5>You can use the rope and grapple, turn to 34</h5>";}
}else{$_SESSION["sorte"]-=1;echo"<script type='text/javascript'>sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte - 1;</script>";echo"<h5>You lose 1 point of luck</h5>";}}
elseif($_GET["pag"]=="40")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";
$_SESSION["item1"]="dagger";echo"<script type='text/javascript'>document.pontuacao.item1.value='dagger';</script>";
if($_SESSION["weapon"]=="no1"||$_SESSION["weapon"]=="no2"){$_SESSION["pericia"]+=4;echo"<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia + 4;</script>";
echo "<h5>You now have a weapon and gained 4 points of stamina</h5>";$_SESSION["weapon"]="yes1";}
$_SESSION["ouro"]+=3;echo"<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro + 3;</script>";}
elseif($_GET["pag"]=="42")
{$dice1=mt_rand(1,6);$dice2=mt_rand(1,6);if($_SESSION["pericia"]>$dice1+$dice2){echo"<h5>You got a {$dice1}+{$dice2} so you smash the door open, turn to 20</h5>";}
else{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";
echo"<h5>You got a {$dice1}+{$dice2}and cannot open the door,and lose 1 point of stamina";if(in_array("open",$_SESSION["magic"])){echo"<h5>You can use the open spell, turn to 35</h5>";}}}
elseif($_GET["pag"]=="46")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET["pag"]=="47")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";
if(in_array("fear",$_SESSION["magic"])){echo"<h5>You can use the fear spell, turn to 15</h5>";}
if(in_array("illusion",$_SESSION["magic"])){echo"<h5>You can use the illussion spell, turn to 30</h5>";}}
elseif($_GET["pag"]=="48")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET["pag"]=="49")
{$_SESSION["forca"]-=1;echo"<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca - 1;</script>";}
elseif($_GET["pag"]=="50")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Presence of a Hero";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}

?>
