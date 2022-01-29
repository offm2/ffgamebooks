<fieldset>
<form name="form1" method="POST" action="battle_simulator.php">
<p>How many opponents will you fight?
<p><select name="op">
  <option value="op1">1 opponent</option>
  <option value="op2">2 opponents</option>
</select>
<p>Will you fight them together or individually?
<p><select name="ftype">
  <option value="ind">Individually</option>
  <option value="together">Together</option>
</select>
<input type="submit" name="go" value="Go to fight!">
</form>
</fieldset>
<br><br>
<?php
if(isset($_POST["op"])&&$_POST["op"]=="op1")
{
echo "<form name='form' method='POST' action='battle_simulator.php'>
<p>YOU</p><p>STAMINA :<select name='hstamina'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
  <option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option>
  <option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option>
</select>SKILL :<select name='hskill'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
</select><p>ENEMY</p><p>STAMINA :<select name='estamina'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
  <option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option>
  <option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option>
</select>SKILL :<select name='eskill'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
</select><input type='submit' value='Fight!'></p>
</form>";
}
if(isset($_POST["op"])&&$_POST["op"]=="op2")
{
echo "<form name='form' METHOD='POST' action='battle_simulator.php'>
<p>YOU</p><p>STAMINA :<select name='hstamina'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
  <option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option>
  <option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option>
</select>SKILL :<select name='hskill'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
</select><p>ENEMY</p><p>STAMINA :<select name='estamina2[]'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
  <option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option>
  <option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option>
</select>SKILL :<select name='eskill2[]'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
</select><p>ENEMY 2</p><p>STAMINA :<select name='estamina2[]'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
  <option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option>
  <option value='21'>21</option><option value='22'>22</option><option value='23'>23</option><option value='24'>24</option>
</select>SKILL :<select name='eskill2[]'>
  <option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option>
  <option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option>
  <option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option>
  <option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option>
</select><input type='hidden' name='ftype' value={$_POST["ftype"]}><input type='submit' value='Fight!'></p>
</form>";
}

?>
<?php 
//lutar contra 1 adversario
if (isset($_POST["hstamina"])&&isset($_POST["hskill"])&&isset($_POST["estamina"])&&isset($_POST["eskill"]))
{
while($_POST["hstamina"]>0&&$_POST["estamina"]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill"]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill"]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill"]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill"]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
if($_POST["estamina"]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}
//lutar contra 2 adversarios 
if(isset($_POST["hstamina"])&&isset($_POST["hskill"])&&isset($_POST["estamina2"][0])&&isset($_POST["eskill2"][0])&&isset($_POST["estamina2"][1])&&isset($_POST["eskill2"][1]))
{
if($_POST["ftype"]=="ind")
{while($_POST["hstamina"]>0&&$_POST["estamina2"][0]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][0]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][0]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][0]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina2"][0]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][0]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
if($_POST["estamina2"][0]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
echo"Fight 2nd opponent";
{while($_POST["hstamina"]>0&&$_POST["estamina2"][1]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][1]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina2"][1]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
}
if($_POST["estamina2"][1]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}
elseif($_POST["ftype"]=="together")
{
while($_POST["hstamina"]>0&&$_POST["estamina2"][0]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);$d5=mt_rand(1,6);$d6=mt_rand(1,6);$d7=mt_rand(1,6);$d8=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][0]+$d3+$d4;$t3=$_POST["hskill"]+$d5+$d6;$t4=$_POST["eskill2"][1]+$d7+$d8;
if($t1>$t2)
{$_POST['estamina2'][0]-=2;echo "<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][0]} = {$t2}</h5><h4> You Win this attack round!</h4>";}
elseif($t1==$t2){echo"<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][0]} = {$t2}</h5><h4> Nobody Wins this attack round!</h4>";}
else {$_POST["hstamina"]-=2;echo"<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][0]} = {$t2}</h5><h4>You�ve been hit by your first Opponent</h4>";}
if($t3>=$t4){echo "<h5>You : <img src='images/{$d5}.jpg'> + <img src='images/{$d6}.jpg'> + {$_POST["hskill"]} = {$t3} Vs <img src='images/{$d7}.jpg'> + <img src='images/{$d8}.jpg'> + {$_POST["eskill2"][1]} = {$t4}</h5><h4>You Parried the 2nd opponent blow</h4>";}
else {$_POST["hstamina"]-=2;echo"<h5>You : <img src='images/{$d5}.jpg'> + <img src='../images/{$d6}.jpg'> + {$_POST["hskill"]} = {$t3} Vs <img src='images/{$d7}.jpg'> + <img src='images/{$d8}.jpg'> + {$_POST["eskill2"][1]} = {$t4}</h5><h4>You�ve been hit by your second opponent </h4>";}
if($_POST["estamina2"][0]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}
echo"Fight 2nd opponent";
{while($_POST["hstamina"]>0&&$_POST["estamina2"][1]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][1]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy:<img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina2"][1]-=2;echo"<p>You:<img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][1]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
}
if($_POST["estamina2"][1]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}}
?>