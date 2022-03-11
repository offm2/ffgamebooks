<?php
if ($_GET["pag"]=="21")
{$_SESSION["ouro"]+=5;
echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro+5;</script>";
}
elseif($_GET["pag"]=="22")
{if($_SESSION["provisoes"]>0){
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
echo "<h5>You decide to rest and eat a provision</h5>";
$_SESSION["forca"]+=4;$_SESSION["provisoes"]-=1;}}
elseif($_GET["pag"]=="23")
{echo "<center><form action='$_SERVER[PHP_SELF]'><input type='hidden' name='pag' value=$_GET[pag]><input type='checkbox'  name='takeroom'>Take a room";
echo"<input type='checkbox' name='eatmeal'>Eat a meal<input type='checkbox' name='eatprovision'>Eat a provision<input type='submit' value='Make'> </form></center>";
if(isset($_GET["takeroom"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-2;";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+2;</script>";
echo "<h5>You decide to take a room to sleep </h5>";
$_SESSION["ouro"]-=2;$_SESSION["forca"]+=3;
}
if(isset($_GET["eatmeal"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-2;";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+2;</script>";
echo "<h5>You decide to eat a meal</h5>";
$_SESSION["ouro"]-=2;$_SESSION["forca"]+=2;
}
if(isset($_GET["eatprovision"]))
{echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
echo "<h5>You decide to rest and eat a provision</h5>";
$_SESSION["forca"]+=4;$_SESSION["provisoes"]-=1;
}
}
elseif($_GET["pag"]=="24")
{if(rand(1,6)+rand(1,6)<0+$_SESSION["sorte"]){echo"<h5>You Have Luck go to pag. 7</h5>";} else{echo"<h3>You did not have Luck , Game Over!</h3>";}$_SESSION["sorte"]-=1;}
if($_GET["pag"]=="26")
{$_SESSION["knightf"]=18;$_SESSION["knightp"]=12;$_SESSION["knightso"]=8;$_SESSION["character"]="knight";}
elseif($_GET["pag"]=="27")
{if ($_SESSION["personagem"]=="herbalist"){echo"<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "document.pontuacao.provisoes.value=provisoes+2;</script>";$_SESSION["provisoes"]+=2;}}
elseif($_GET["pag"]=="28")
{echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;";
echo "sorte=Number(document.pontuacao.sorte.value);document.pontuacao.sorte.value=sorte+1;</script>";
$_SESSION["forca"]-=2;$_SESSION["sorte"]+=1;$_SESSION["beastf"]-=1;}
elseif($_GET["pag"]=="29")
{if($_SESSION["provisoes"]>1){
echo "<h5>you decide to rest and eat two provisions</h5>";
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+8;";
echo "document.pontuacao.provisoes.value=provisoes-2;</script>";
$_SESSION["provisoes"]-=2;$_SESSION["forca"]+=8;}
$_SESSION["note"]=32;
$role=rand(1,6);
if ($role==1)
{echo "<b>You role a dice and hit {$role} go to pag. 36 </b>";}
elseif($role==2||$role==3)
{echo "<b>You role a dice and hit {$role} go to pag. 5 </b>";}
elseif ($role==4||$role==5)
{echo "<b>You role a dice and hit {$role} go to pag. 27 </b>";}
elseif($role==6)
{echo "<b>You role a dice and hit {$role} go to pag. 18 </b>";}
}
elseif($_GET["pag"]=="31")
{if($_SESSION["provisoes"]>0){
echo "<h5>you decide to rest and eat a provision</h5>";
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
$_SESSION["provisoes"]-=1;$_SESSION["forca"]+=4;} }
if($_GET["pag"]=="33")
{$_SESSION["sorceressf"]=12;$_SESSION["sorceressp"]=9;$_SESSION["sorceresslu"]=10;$_SESSION["character"]="sorceress";}
elseif($_GET["pag"]=="35")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Kill the Beast";
}
echo"<h3>You Win</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}
elseif($_GET["pag"]=="36")
{
$_SESSION["banditf"]=6;$_SESSION["banditp"]=6;
if(isset($_GET["iskill"]))
{
//disputar combate com 2º bandido pag. 36
if($_SESSION["banditf"]==6)
{
echo "<h5>Fight second BANDIT SKILL: 6 STAMINA:6</h5>";
while($_SESSION["forca"]>0&&$_SESSION["banditf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_SESSION["banditp"];
if($resultado1>$resultado2){$_SESSION["banditf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["banditp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["banditp"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["banditp"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;</script>";}
if ($_SESSION["banditf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h3>You lose!</h3>";}
}
}
}
}
elseif($_GET["pag"]=="37")
{if(rand(1,6)+rand(1,6)<0+$_SESSION["sorte"]){echo "<h5>You where lucky turn to pag.28</h5>";}
else{echo "<h5>You were unlucky turn to pag.13</h5>";}$_SESSION["sorte"]-=1;}
elseif($_GET["pag"]=="39")
{if(rand(1,6)+rand(1,6)<0+$_SESSION["pericia"]){echo "<h5>You avoid the trap turn to pag.6</h5>";}
else{echo "<h5>You fall in the trap</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-3;</script>";
$_SESSION["forca"]-=3;if(!$_SESSION["character"]=="herbalist"){echo "<script type='text/javascript'>pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia-1;</script>";
$_SESSION["pericia"]-=1;}}}
?>
