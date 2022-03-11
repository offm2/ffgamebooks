<?php 
// you have to open the session to be able to modify or remove it 
session_start(); 

// or this would remove all the variable in the session 
session_unset(); 

//destroy the session 
session_destroy(); 
?> 
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta name="description" content="A site dedicated to Fighting Fantasy gamebooks, play a gamebook online">
<meta name="keywords" content="Fighting,Fantasy,Books,Gamebooks,Aventuras,fantasticas">
<meta name="robots" content="all">
<meta name="Author" content="Oscar Monteiro">
<title>Home of the fighting fantasy web engine!</title>


</head>
<body>


<center><h5>Play Fighting Style Gamebooks online</h5>

<form name="inicio" method="POST" action="index2.php">
<p>Insert name: <input type='text' size=15 name='nome'> </p>
<p>Select Potion: <select name='potion'><option value='stamina'>Stamina</option><option value='skill'>Skill</option><option value='luck'>Luck</option></select></p>
<input type='submit' value='insert'></form><br>
<h4>Site best viewed in 1024*768 screen resolution</h4>




</center>
</body>

