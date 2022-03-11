<?php
if($_GET['pag']=="22")
{
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro-2;</script>";
echo "<h5>You gave him the 2 Gold Pieces </h5>";
$_SESSION["ouro"]-=2;
}
elseif($_GET['pag']=="23")
{if(rand(1,6)+rand(1,6)<0+$_SESSION["sorte"]){echo"<h5>You Had Luck go to pag. 20</h5>";} else{echo"<h3>You did not had Luck , go to page 40!</h3>";}$_SESSION["sorte"]-=1;}
elseif($_GET['pag']=="25")
{$_SESSION["item2"]="sling";echo "<script type='text/javascript'>document.getElementById('item2').innerHTML='sling';</script>";}
elseif($_GET['pag']=="26")
{echo "<br><p><form action='{$_SERVER[PHP_SELF]}'><h3>Place your bet</h3>";
echo "<center><p><input type='hidden'  name='manorc'><input type='hidden' name='pag' value='$_GET[pag]'><input type='submit' value='Bet on Man Orc'></form></p>";
echo "<p><form action='{$_SERVER[PHP_SELF]}'>";
echo "<input type='hidden' name='tug'><input type='hidden' name='pag' value='$_GET[pag]'><input type='submit' value='Bet on Street Tug'></form></p></center>";
if(isset($_GET['manorc'])){$_SESSION["bet"]="Man_Orc";echo"<h5>You bet on the Manorc</h5>";}
if(isset($_GET['tug'])){$_SESSION["bet"]="Street_Tug";echo"<h5>You bet on the Street Tug</h5>";}
}
elseif($_GET['pag']=="28")
{
if(rand(1,6)+rand(1,6)<$_SESSION["pericia"]){echo "<h5> you were skillfull turn to 27</h5>";}
else {echo" <h5>you were not skillfull turn to 24</h5>";}}
elseif($_GET['pag']=="29")
{
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+4;</script>";
echo "<h5>You take the 4 Gold Pieces </h5>";
$_SESSION["ouro"]+=4;
}
elseif($_GET['pag']=="34")
{if ($_SESSION["item2"]=="sling"){echo"<h5>You have a sling turn to 28</h5>";}
else{"<h5>You do not have a sling turn to 24</h5>";}
}
elseif($_GET['pag']=="36"){echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro+5;</script>";
echo "<h5>You take the 5 Gold Pieces </h5>";
$_SESSION["ouro"]+=5;}
elseif($_GET['pag']=="38")
{
echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";
echo "<h5>You Lost 1 luck point </h5>";$_SESSION["sorte"]-=1;
echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro-5;</script>";
echo "<h5>You lost 5 gold pieces </h5>";
$_SESSION["ouro"]+=5;
}
if($_GET["pag"]=="39")
{echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro-9;</script>";
echo "<h5>You gave them the 9 Gold Pieces </h5>";
$_SESSION["ouro"]-=9;}
elseif($_GET["pag"]=="41"||$_GET["pag"]=="48")
{
$_SESSION["smuggerf"]=4;
if(isset($_GET["iskill"]))
{
//disputar combate com 2� mugger pag. 41
if($_SESSION["smuggerf"]==4)
{
echo "<h5>Fight second mugger SKILL: 5 STAMINA:4</h5>";
while($_SESSION["forca"]>0&&$_SESSION["smuggerf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);settype($_GET["iskill"],"integer");
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"]-2;$iskill=$_GET["iskill"]-2;
if($resultado1>$resultado2){$_SESSION["smuggerf"]-=2;echo "<h5>{$count} you hit your enemy</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["smuggerf"]<=0){echo"<h3>You Win!</h3>";}
}
}}
$_SESSION["tmuggerf"]=6;
if(isset($_GET["iskill"]))
{
//disputar combate com 3� mugger pag. 41
if($_SESSION["tmuggerf"]==6)
{
echo "<h5>Fight third mugger SKILL: 8 STAMINA:6</h5>";
while($_SESSION["forca"]>0&&$_SESSION["tmuggerf"]>0)
{
$count++;$dice1=rand(1,6);$dice2=rand(1,6);$dice3=rand(1,6);$dice4=rand(1,6);settype($_GET["iskill"],"integer");
$resultado1=$dice1+$dice2+$_SESSION["pericia"];$resultado2=$dice3+$dice4+$_GET["iskill"]+1;$iskill=$_GET["iskill"]+1;
if($resultado1>$resultado2){$_SESSION["tmuggerf"]-=2;echo "<h5>$count you hit your enemy</h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
elseif($resultado1==$resultado2){echo"<h5>{$count} Nobody has been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";}
else {$_SESSION["forca"]-=2;echo"<h5>$count You�ve been hit</h5><h5>You : <img src='../images/{$dice1}.jpg'> + <img src='../images/{$dice2}.jpg'> + {$_SESSION["pericia"]} = {$resultado1} Vs <img src='../images/{$dice3}.jpg'> + <img src='../images/{$dice4}.jpg'> + {$iskill} = {$resultado2}</h5>";echo "<script type='text/javascript'>forca=Number(document.getElementById('forca').innerHTML);document.getElementById('forca').innerHTML=forca-2;</script>";}
if ($_SESSION["tmuggerf"]<=0){echo"<h3>You Win!</h3>";}
}
}}}
elseif($_GET["pag"]=="45")
{
echo "<script type='text/javascript'>sorte=Number(document.getElementById('sorte').innerHTML);document.getElementById('sorte').innerHTML=sorte-1;</script>";
echo "<h5>You Lost 1 luck point </h5>";$_SESSION["sorte"]-=1;
if(rand(1,6)+rand(1,6)<$_SESSION["sorte"]){echo "<h5> you were lucky turn to 35</h5>";}
else {echo" <h5>you were not lucky turn to 16</h5>";}
}
elseif($_GET["pag"]=="46")
{echo "<script type='text/javascript'>ouro=Number(document.getElementById('ouro').innerHTML);document.getElementById('ouro').innerHTML=ouro-15;</script>";
echo "<h5>You gave her the 15 Gold Pieces </h5>";
$_SESSION["ouro"]-=15;
}
elseif($_GET["pag"]=="50")
{
if(isset($_SESSION["stime"]))
{
$_SESSION["etime"]=time();
$_SESSION["ttime"]=$_SESSION["etime"]-$_SESSION["stime"];
$_SESSION["gamebook"]="Feathers of the Phoenix";
}
echo"<h3>You Win!</h3>";
if(isset($_SESSION["ttime"]))
{if($_SESSION["ttime"]>80){echo"<h5>You have got an highscore, see the <a href='../highscores/view.php'>Highscores page</a></h5>";}}
}

?>
