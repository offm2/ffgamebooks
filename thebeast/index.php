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
<meta name="description" content="Home of the Fighting fantasy web engine">
<meta name="keywords" content="Fighting,Fantasy,Books,Gamebooks,Aventuras,fantasticas">
<meta name="robots" content="all">
<meta name="verify-v1" content="Kx2X5J2FbUfgHQi62E0B+zL7VyF2oFzXY5H823Teh3w=" />
<meta name="Author" content="Oscar Monteiro">
<title>Fighting Fantasy Gamebooks online!</title>


</head>
<body>
<style type="text/css">
body{background:url("imagens/pergaminho.jpg") 50% 20% no-repeat}
</style>

<center><h5>Play a Gamebook online</h5>
<img  src="imagens/santa.gif"><h4>Merry Christmas !!!</h4>

<script type="text/javascript">

function Typewriter(sName)
{	// PROPERTIES
	this.counter = 0;
	this.name = sName;
	this.text = "";
	this.speed = 50; // in milliseconds

	// METHODS
	this.addText = AddText;
	this.next = Next;
	this.setSpeed = SetSpeed;
	this.write = Write;

	// FUNCTIONS
	function AddText(s)
	{	this.text = s
	}
	function Next()
	{	document.getElementById('typewriter_output').innerHTML = this.text.substr(0, this.counter++);
	}
	function SetSpeed(iSpeed)
	{	this.speed = iSpeed;
	}
	function Write()
	{	setInterval(this.name+".next()",this.speed);
	}
}

</script>

<div id="typewriter_output" style="width:500px;height:120;border:1px black solid;padding:1em;background:#f3f3f3;"></div>

<script type="text/javascript">
var myTypewriter = new Typewriter("myTypewriter");
myTypewriter.addText("Have you ever played fighting fantasy books? , do you want to play it online? now you can it this straight forward adventure, mini book the beast my Victor Cheng,no need for pencil or dices anymore , as it can be all made online,are you ready for a new adventure, then put your name in and choose the character you want and hit Play your all set Good Luck!");
myTypewriter.write();
</script>

<img src="imagens/character.gif">
<form name="inicio" method="POST" action="index2.php">
<p>Insert name: <input type='text' size=15 name='nome'> </p>
<p>Choose a character: <select name='personagem'><option value='herbalist'>Herbalist</option>
<option value='farmer'>Farmer</option><option value='blacksmith'>Blacksmith</option>
<input type='submit' value='Play'></form><br>

<form>
<b>Internal Links:</b><input type="button" value="View site poll!" onClick="window.open('http://www.ffgamebooks-online.co.uk/poll/poll.php','poll')">
<input type="button" value="Site news updated!" onClick="window.open('http://www.ffgamebooks-online.co.uk/news/','Site_news')">
</form>

<h4>External Links:</h4><a href="http://www.bbc.co.uk/dna/h2g2/classic/A534674">Fighting Fantasy on BBC </a><br><a href="http://en.wikipedia.org/wiki/Fighting_Fantasy#System">Fighting Fantasy on Wikipedia</a>

<h5>If you want your adventure to be featured email me at admin@ffgamebooks-online.co.uk</h5>
</center>
</body>

