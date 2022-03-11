<body>
<input type="button" value="Roll Dice" onclick="javascript:window.location.reload(true);">
<?php
$al1=rand(1,6);$al2=rand(1,6);$al3=rand(1,6);
echo "<p> You roll one die and it gives you a <img src='images/".$al1.".jpg'></p>";
echo "<p> You roll two dice and it gives you a(n) <img src='images/".$al2.".jpg'> + <img src='images/".$al3.".jpg'></p>";
?>
<h3>Go to the <a href="roll_dice.htm">javascript version of the dice roller</a>
</body>