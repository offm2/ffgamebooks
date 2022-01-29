<fieldset>
<form name="form1" method="POST" action="combat_simulator.php">
<p>   <label>How many opponents will you fight?</label></p>
<input type="text" id="op" name="op" required size="15" placeholder="nr of opponents" maxlength="1">
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
if(isset($_POST["op"])&&$_POST["op"]=="1")
{
echo "<form name='form' method='POST' action='combat_simulator.php'>
<p>YOU</p>
<p>   <label>Stamina:</label></p>
<input type='text' id='hstamina' name='hstamina' required size='14' placeholder='stamina points' maxlength='2'>
<p>   <label>Skill:</label></p>
<input type='text' id='hskill' name='hskill' required size='12' placeholder='skill points' maxlength='2'>
<p>ENEMY</p>
<p>   <label>Stamina:</label></p>
<input type='text' id='estamina' name='estamina' required size='14' placeholder='stamina points' maxlength='2'>
<p>   <label>Skill:</label></p>
<input type='text' id='eskill' name='eskill' required size='12' placeholder='skill points' maxlength='2'>
<input type='submit' value='Fight!'></p>
</form>";
}
if(isset($_POST["op"])&&$_POST["op"]>1&&$_POST["op"]<7)
{
echo "<form name='form' METHOD='POST' action='combat_simulator.php'>
<p>YOU</p>
<p>   <label>Stamina:</label></p>
<input type='text' id='hstamina' name='hstamina' required size='14' placeholder='stamina points' maxlength='2'>
<p>   <label>Skill:</label></p>
<input type='text' id='hskill' name='hskill' required size='12' placeholder='skill points' maxlength='2'>
<p>ENEMYS</p>";
$r=$_POST["op"];$ene=1;
do{
	echo"<p>Enemy {$ene}</p>";
echo"<p>   <label>Stamina:</label></p>
<input type='text' id='estamina2[]' name='estamina2[]' required size='14' placeholder='stamina points' maxlength='2'>
<p>   <label>Skill:</label></p>
<input type='text' id='eskill2[]' name='eskill2[]' required size='12' placeholder='skill points' maxlength='2'>";
$r--;$ene++;
}while($r>0);
echo"<input type='hidden' name='ftype' value={$_POST["ftype"]}><input type='submit' value='Fight!'></p>
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
$k=-1;while($k<10){$k++;
if(isset($_POST["hstamina"])&&isset($_POST["hskill"])&&isset($_POST["estamina2"][$k])&&isset($_POST["eskill2"][$k]))
{
if($_POST["ftype"]=="ind")
{while($_POST["hstamina"]>0&&$_POST["estamina2"][$k]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][$k]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$k]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$k]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina2"][$k]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$k]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
if($_POST["estamina2"][$k]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
$kop=$k+1;$kop2=$kop+1;
if(isset($_POST["estamina2"][$kop])){echo"Fight opponent {$kop2}";}
}
elseif($_POST["ftype"]=="together")
{$kop=$k+1;
while($_POST["hstamina"]>0&&$_POST["estamina2"][$k]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);$d5=mt_rand(1,6);$d6=mt_rand(1,6);$d7=mt_rand(1,6);$d8=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][$k]+$d3+$d4;$t3=$_POST["hskill"]+$d5+$d6;$t4=$_POST["eskill2"][$kop]+$d7+$d8;
if($t1>$t2)
{$_POST['estamina2'][$k]-=2;echo "<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][$k]} = {$t2}</h5><h4> You Win this attack round!</h4>";}
elseif($t1==$t2){echo"<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][$k]} = {$t2}</h5><h4> Nobody Wins this attack round!</h4>";}
else {$_POST["hstamina"]-=2;echo"<h5>You : <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + {$_POST["hskill"]} = {$t1} Vs <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + {$_POST["eskill2"][$k]} = {$t2}</h5><h4>You've been hit by your first Opponent</h4>";}
if($t3>=$t4){echo "<h5>You : <img src='images/{$d5}.jpg'> + <img src='images/{$d6}.jpg'> + {$_POST["hskill"]} = {$t3} Vs <img src='images/{$d7}.jpg'> + <img src='images/{$d8}.jpg'> + {$_POST["eskill2"][$kop]} = {$t4}</h5><h4>You Parried the 2nd opponent blow</h4>";}
else {$_POST["hstamina"]-=2;echo"<h5>You : <img src='images/{$d5}.jpg'> + <img src='../images/{$d6}.jpg'> + {$_POST["hskill"]} = {$t3} Vs <img src='images/{$d7}.jpg'> + <img src='images/{$d8}.jpg'> + {$_POST["eskill2"][$kop]} = {$t4}</h5><h4>You've been hit by your second opponent </h4>";}
if($_POST["estamina2"][$k]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}
echo"Fight 2nd opponent";if($kop>1){break;}
{while($_POST["hstamina"]>0&&$_POST["estamina2"][$kop]>0)
{$d1=mt_rand(1,6);$d2=mt_rand(1,6);$d3=mt_rand(1,6);$d4=mt_rand(1,6);
$t1=$_POST["hskill"]+$d1+$d2;$t2=$_POST["eskill2"][$kop]+$d3+$d4;
if($t1<$t2)
{$_POST["hstamina"]-=2;echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$kop]} ) = {$t2}</p>";echo"<h4> You Lose this attack round!</h4>";
}
elseif($t1==$t2)
{echo"<p>You: <img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) = {$t1}";
echo"Enemy:<img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$kop]} ) = {$t2}</p>";echo"<h4> Nobody Wins this attack round!</h4>";
}
else
{$_POST["estamina2"][$kop]-=2;echo"<p>You:<img src='images/{$d1}.jpg'> + <img src='images/{$d2}.jpg'> + skill ( {$_POST["hskill"]} ) ={$t1}";
echo"Enemy: <img src='images/{$d3}.jpg'> + <img src='images/{$d4}.jpg'> + skill ( {$_POST["eskill2"][$kop]} ) = {$t2}</p>";echo"<h4> You Win this attack round!</h4>";
}
}
}
if($_POST["estamina2"][$kop]<=0){echo"<h3>You Win the Fight!</h3><h3>Your Stamina:{$_POST["hstamina"]}</h3>";}
if($_POST["hstamina"]<=0){echo"<h3>You Lose the Fight!</h3>";}
}}}
?>