<?php
if($_GET["pag"]=="12")
{$_SESSION["warriorf"]=15;$_SESSION["warriorp"]=12;$_SESSION["warriorso"]=7;$_SESSION["character"]="warrior";}
elseif($_GET["pag"]=="13")
{echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-4;";
echo "pericia=Number(document.pontuacao.pericia.value);document.pontuacao.pericia.value=pericia-1;</script>";
$_SESSION["forca"]-=4;$_SESSION["pericia"]-=1;}
elseif($_GET["pag"]=="15")
{echo "<center><form action='$_SERVER[PHP_SELF]'><input type='hidden' name='pag' value=$_GET[pag]><input type='checkbox'  name='takeroom'>Take a room";
echo"<input type='checkbox' name='eatmeal'>Eat a meal<input type='checkbox' name='eatprovision'>Eat a provision<input type='submit' value='Make'> </form></center>";
if(isset($_GET["takeroom"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-2;";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+2;</script>";
echo "<h5>You decide to take a room to sleep </h5>";
$_SESSION["ouro"]-=2;$_SESSION["forca"]+=2;
}
if(isset($_GET["eatmeal"]))
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro-2;";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+2;</script>";
echo "<h5>You decide to eat a meal</h5>";
$_SESSION["ouro"]-=2;$_SESSION["forca"]+=2;
}
if(isset($_GET["eatprovision"]))
{if($_SESSION["provisoes"]>0){
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
echo "<h5>You decide to rest and eat a provision</h5>";
$_SESSION["forca"]+=4;$_SESSION["provisoes"]-=1; }
else {echo"<h5>You have no provisions left</h5>";}
}
}
elseif($_GET["pag"]=="16")
{$_SESSION["goblinf"]=4;
if(isset($_GET["iskill"]))
{
//disputar combate com 2º goblin pag. 16
if($_SESSION["goblinf"]==4)
{
echo "<h5>Fight second goblin SKILL: 5 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["goblinf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"];
if($resultado1>$resultado2){$_SESSION["goblinf"]-=2;echo "<h5>$count you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["iskill"]} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca-2;</script>";}
if ($_SESSION["goblinf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["forca"]<=0){echo"<h4>You lose!</h4>";}
}
}}}
elseif($_GET["pag"]=="17")
{if($_SESSION["personagem"]=="blacksmith")
{echo "<script type='text/javascript'>forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+2;</script>";
$_SESSION["forca"]+=2;}}
elseif($_GET["pag"]=="18")
{if($_SESSION["personagem"]=="blacksmith"){$_SESSION["forca"]=$_SESSION["forcainicial"];}
}
elseif($_GET["pag"]=="19")
{echo "<script type='text/javascript'>ouro=Number(document.pontuacao.ouro.value);document.pontuacao.ouro.value=ouro+8;";
echo  "document.pontuacao.item2.value='2knives'</script>";
$_SESSION["ouro"]+=8;$_SESSION["item2"]="2knives";}
elseif($_GET["pag"]=="20")
{
echo "<form name='luta' action='{$_SERVER['PHP_SELF']}' ><p><b>BEAST</b></p>Skill:<input type='text' name='beastp' value='{$_SESSION[beastp]}' readonly='readonly'>";
echo "Stamina:<input type='text' name='beastf' value='{$_SESSION['beastf']}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET['pag']}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";
if(isset($_GET["beastp"])&&ctype_digit($_GET["beastp"])&&ctype_digit($_GET["beastf"])&&isset($_GET["beastf"]))
{
if($_SESSION["character"]=="knight")
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//enquanto um dos 2 nao morrer disputar combate
while($_SESSION["knightf"]>0&&$_SESSION["beastf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["knightp"];$resultado2=$dice3+$dice4+$_SESSION["beastp"];
if($resultado1>$resultado2){$_SESSION["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["knightp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";
if($_SESSION["knightso"]>2){if(rand(1,6)+rand(1,6)<0+$_SESSION["knightso"]){echo"<h5>$count You hit extra damage</h5>";}$_SESSION["knightso"]-=1;}}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["knightp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["knightf"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["knightp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_SESSION["beastf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["knightf"]<=0){echo"<h5>The Knight died turn to pag.38</h5>";}
}
}
if($_SESSION["character"]=="warrior")
{
echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//enquanto um dos 2 nao morrer disputar combate e dar opurtunidade de fuga
while($_SESSION["warriorf"]>4&&$_SESSION["beastf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["warriorp"];$resultado2=$dice3+$dice4+$_SESSION["beastp"];
if($resultado1>$resultado2){$_SESSION["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";
if($_SESSION["warriorso"]>2){if(rand(1,6)+rand(1,6)<0+$_SESSION["warriorso"]){echo"<h5>$count You hit extra damage</h5>";}$_SESSION["warriorso"]-=1;}}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["warriorf"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_SESSION["beastf"]<=0){echo"<h3>You Win!</h3>";}
}
if($_SESSION["warriorf"]<=4)
{
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='10'><input type='submit' value='Escape fight'></form>";
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='cofight'><input type='hidden' name=beastp value={$_SESSION[beastp]}><input type='submit' value='Continue fight'></form>";
if(isset($_GET["cofight"]))
{while($_SESSION["warriorf"]>0&&$_SESSION["beastf"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["warriorp"];$resultado2=$dice3+$dice4+$_SESSION["beastp"];
if($resultado1>$resultado2){$_SESSION["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["warriorf"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["warriorp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_SESSION["beastf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["warriorf"]<=0){echo "<h5>The Warrior died turn to pag.38</h5>";}
}
}
}
}
if($_SESSION["character"]=="sorceress")
{echo "<img align='left' src='imagens/luta.gif'>";
$count=0;
//enquanto um dos 2 nao morrer disputar combate e dar opurtunidade de fuga
while($_SESSION["sorceressf"]>4&&$_SESSION["beastf"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["sorceressp"];$resultado2=$dice3+$dice4+$_SESSION["beastp"];
if($resultado1>$resultado2){$_SESSION["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";
if($_SESSION["sorceresslu"]>2){if(rand(1,6)+rand(1,6)<0+$_SESSION["sorceresslu"]){echo"<h5>$count You hit the beast with a ball of fire</h5>";}$_SESSION["sorceresslu"]-=1;$_SESSION["beastp"]-=1;$_SESSION["beastf"]-=2;}}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["sorceressf"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_SESSION["beastf"]<=0){echo "<h3>You Win!</h3>";}
}
if($_SESSION["sorceressf"]<5)
{echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='10'><input type='submit' value='Escape fight'></form>";
echo "<form action='{$_SERVER['PHP_SELF']}'><input type='hidden' name='pag' value='{$_GET['pag']}'><input type='hidden' name='cofight'><input type='hidden' name=beastp value={$_SESSION['beastp']}><input type='submit' value='Continue fight'></form>";
if(isset($_GET["cofight"]))
{while($_SESSION["sorceressf"]>0&&$_SESSION["beastf"]>0)
{$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);
$resultado1=$dice1+$dice2+$_SESSION["sorceressp"];$resultado2=$dice3+$dice4+$_SESSION["beastp"];
if($resultado1>$resultado2){$_SESSION["beastf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_SESSION["beastp"]} = {$resultado2}</h5>";}
else {$_SESSION["sorceressf"]-=2;echo"<h5>{$count} You´ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["sorceressp"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$_GET["beastp"]} = {$resultado2}</h5>";}
if ($_SESSION["beastf"]<=0){echo"<h3>You Win!</h3>";}
if ($_SESSION["sorceressf"]<=0){echo "<h5>The Sorceress died turn to pag.38</h5>";}
}}}}}}
include("pagevents3.php");
?>
