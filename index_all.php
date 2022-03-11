<?php 
// you have to open the session to be able to modify or remove it 
session_start(); 

// or this would remove all the variable in the session 
session_unset(); 

//destroy the session 
session_destroy(); 
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta name="DESCRIPTION" content="Ready-to-play Fighting Fantasy style adventures"><meta name="robots" content="all">
<META NAME="KEYWORDS" CONTENT="fighting fantasy gamebooks, fighting fantasy, gamebooks, online gamebooks, amateur gamebooks"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Play Fighting Fantasy style Gamebooks online!</title>
<link href="1.css" rel="stylesheet" type="text/css" />
<link href="feed.xml" rel="alternate" type="application/rss+xml" title="What's New on  play FF fan adventures website" />
<link rel="canonical" href="http://fanbooks.fightingfantasy.net" />
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_RIGHT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <!-- jQuery library -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<?php include_once("analytics_google.php"); 
?> 
<div class="container">
  <div class="jumbotron" id="1">
<h3>A Fighting Fantasy gamebooks fan site </h3>
<p>Ready-to-play Fighting Fantasy style adventures</p>
<p><img src="images/2.gif" class="img-circle" alt="intro image"></p>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    Dropdown
    <span class="glyphicon glyphicon-arrow-down"></span>
  </button>
<ul class="dropdown-menu">
<?php include_once("menu.php"); ?>
</ul>
</div>
</div>
<div class="col-sm-12">
<!--add typewriter effect--->
<?php include_once("typewriter2.htm");?>
<!--random names-->
<script type="text/javascript" src="js/name_generator.js"></script>
<script type="text/javascript" src="js/english_set.js"></script>
<script type="text/javascript" src="js/getname2.js"></script>

                              				<fieldset><legend>8-Rise of the Night Creatures</legend>
							<div class="alert alert-danger" role="alert"><h5 class="alert-heading"><strong>Warning!</strong></h5>
							<p>This adventure is rated 16+ for strong content as it is an horror themed gamebook.<p></div>
							<img src="imagens/werewolf.jpg" width="143" height="143" alt="" align="left" class="border" />
							<b>No one should be prepared for this terrifying night, and you are you prepared?</b>
								<br><br>
								<form name="f8" method="POST" action="RiseofTheNightCreatures/index2.php">	     
                                <p><label class="control-label col-sm-2">Insert name:</label> <input type="text" size="15" name='nome' maxlength="15">
								<input type="button" value="Random Name" onclick="javascript:ger8();">
                                <p class="submit"><input type="submit" value="Start Adventure"></p>
								</form></fieldset>
							<p><a href="RiseofTheNightCreatures/Rise.doc" class="alignleft">Download gamebook</a></p>	

							<p style="text-align:center"><img src="images/dice3.jpg" width="30" height="30">							

                                </fieldset>
							  <fieldset>
                             <legend>5-The Presence of a Hero</legend>
						     
							 <img src="images/hat.jpg" width="143" height="183" alt="" align="left" class="border"/>
							 <b>You are a Wizard's apprentice with a goal to achieve - to be a true hero. Can you be this true hero?</b>
                             <br><br><br>
							 <script src="jquery/jquery.js"></script>
                             <script src="jquery/check.js"></script>

							 <form name="f5" method="POST" action="hero/index2.php">
                             <p><label class="control-label col-sm-2">Insert name:</label> <input type="text" size=15 name='nome' maxlength="15">
							 <input type="button" value="Random Name" onclick="javascript:ger5();">
							 <h5>choose 3 magic spells and hit start adventure</h5>
							 <p>  <input type="checkbox" name="magic[]" value="fear">FEAR
                                  <input type="checkbox" name="magic[]" value="firebolt">FIRE BOLT
                                  <input type="checkbox" name="magic[]" value="illusion">ILLUSION</p>
                                <p><input type="checkbox" name="magic[]" value="ironhand">IRON HAND
                                  <input type="checkbox" name="magic[]" value="open">OPEN
                                  <input type="checkbox" name="magic[]" value="ward">WARD</p>
                             <p class="submit"><b><input type="submit" id="submitm" value="Start Adventure"></b></p></form></fieldset>
							 <p><a target="_blank" href="hero/presenceofahero.doc">Download gamebook</a></p>
							 							
														
														
														<fieldset><legend>2-Quest for the Ebony Wand</legend>
							
							<img src="imagens/caduceus.jpg" width="143" height="143" alt="" align="left" class="border" />
							<b>The ebony wand is hidden deep inside a crypt. Can you locate and retrieve it? Now with saving system so you can return to your adventure whenever you want.</b>
								<br><br>
								<form name="f2" method="POST" action="quest/index.php">	     

                                <p class="submit"><input type="submit" value="Start Quest"></p>
								</form></fieldset>
							<p><a href="quest/WAND.doc" class="alignleft">Download gamebook</a></p>	

							<p style="text-align:center"><img src="images/dice3.jpg" width="30" height="30">							

                                <fieldset>
								<legend>6-Legacy of the Vampire</legend>
						     
							 <img src="imagens/vampire2.png" width="143" height="163" alt="" align="left" class="border"/>
							 <b>&copyMark Lain 2014, This adventure is a sequel/homage to Keith Martin's Count Heydrich adventures, Vault Of The Vampire and Revenge Of The Vampire, originally published in the Puffin Fighting Fantasy series as numbers 38 and 58 respectively. It is not necessary to have played these books before playing Legacy Of The Vampire, but familiarity with the previous books will allow the player to get more out of the experience and to pick up on cross- references. I have intentionally tried to emulate Keith Martin's Heydrich adventures by including references to Hammer Films and European vampire folklore, Skill and Faith tests, and cheat-proofing. I have deliberately not included the Blood Points mechanic as, in this third adventure, YOU are not knowingly trying to destroy Heydrich so it would make less sense here.
                             </b>
                             
							 <form name="f6" method="POST" action="vampirelegacy/index2.php">
                             <p><label class="control-label col-sm-2">Insert name:</label> <input type="text" size=15 name='nome' maxlength="15">
							 <input type="button" value="Random Name" onclick="javascript:ger6();">
                             <p class="submit"><b><input type="submit" value="Start Adventure"></b></p></form></fieldset>
							 <p><a target="_blank" href="vampirelegacy/Legacy-of-the-Vampire-FF-online.pdf">Download gamebook</a></p>
							<fieldset>
                          <legend>3-Kill the Beast</legend>
						  
						  <img src="imagens/beast.jpg" width="143" height="143" alt="" align="left" />
						  <b>Your town is being terrorised by a beast that is killing villagers - can you kill it? Choose from three character classes (Herbalist, Blacksmith or Farmer) and start your adventure.</b>
						  <br>
                          <form name="f3" method="POST" action="thebeast/index2.php">			  
                          <br><label class="control-label col-sm-2">Insert name:</label> <input type='text' size="15" name='nome' maxlength="15">
                          <input type="button" value="Random Name" onclick="javascript:ger3();">						  
                          <p><label class="control-label col-sm-2">Character:</label> <select name='personagem'><option value='herbalist'>Herbalist</option>
                          <option value='farmer'>Farmer</option><option value='blacksmith'>Blacksmith</option></select><p>
                          <p class="submit"><input type='submit' value='Start Adventure'></p>
						  </form></fieldset>
						<p><a href="thebeast/BEAST.doc">Download gamebook</a></p>
                           <p></p>
							<fieldset>
                                <legend>4-Curse of Blackwood Manor</legend>
						     
							 <img src="imagens/mansion.jpg" width="143" height="143" alt="" align="left" class="border"/>
							 <b>Can you lift the curse of the haunted Blackwood Manor?</b>
                             <br><br><br>
							 <form name="f4" method="POST" action="curseof/index.php">
                             <p class="submit"><b><input type="submit" value="Start Adventure"></b></p></form></fieldset>
							 <p><a target="_blank" href="curseof/curseofblackwoodmanor.pdf">Download gamebook</a></p>
																								 <p style="text-align:center"><img src="images/dice3.jpg" width="30" height="30"></p>
                              <script src="https://www.intensedebate.com/widgets/userComment/8298468" defer="defer" type="text/javascript"></script>


							 						 							<fieldset>
                                <legend>7-Venom of Vortan</legend>
						     
							 <img src="imagens/snake.jpg" width="143" height="163" alt="" align="left" class="border"/>
							 <b>&copyMark Lain 2015,This adventure is intended as a gentle tribute to very linear, item-heavy, old school-style dungeon trawls. The style of, and approach to, the design of this short subject is intentional and hopefully familiar to fans of early Fighting Fantasy gamebooks.
                             </b><h4>For Darren - a good man whose Stamina and Luck failed him far too soon. </h4>
                             
							 <form name="f7" method="POST" action="vortan/index.php">
                             <p class="submit"><b><input type="submit" value="Start Adventure"></b></p></form></fieldset>
							 <p><a target="_blank" href="vortan/venom_of_vortan.pdf">Download gamebook</a></p>
                             <!--changed adventure order 1st to last//-->
						  <fieldset>
                                <legend>1-Feathers of the Phoenix</legend>
						     
							 <img src="imagens/phoenix.jpg" width="143" height="143" alt="" align="left" class="border"/>
							 <b>You are looking for immortality. Can you locate the Feathers of the Phoenix?</b>
                             <br><br><br>
							 <form name="f1" method="POST" action="feathers/index.php">
                             <p class="submit"><b><input type="submit" value="Start Adventure"></b></p></form>
							 </fieldset>
							 <p><a target="_blank" href="feathers/feathersofthephoenix.pdf">Download gamebook</a>
							
							<br>
							<p style="text-align:center"><b>Windows 8 app</b></p>
							<p style="text-align:center">
							<a href="https://sourceforge.net/projects/fffanadventurefeathers/files/latest/download" rel="nofollow"><img alt="Download fighting fantasy fan adventure feathers " src="https://a.fsdn.com/con/app/sf-download-button"></a>
							 							</p>
														<p style="text-align:center">
														<a href="app/">Alternative Download</a>
														</p>
														<br>
						    <fieldset>
                                <legend>9-The Sleeping Dragon</legend>
						     
							 <img src="imagens/Dragon.png" width="143" height="143" alt="" align="left" class="border"/>
							 <b>Go on adventure in search of the sleeping dragon can you make it alive?</b>
                             <br><br><br>
							 <form name="f9" method="POST" action="Dragon/index.php">
                             <p class="submit"><b><input type="submit" value="Start Adventure"></b></p></form>
							 </fieldset>
							 <p><a target="_blank" href="Dragon/DRAGON.pdf">Download gamebook</a>
							
							<br>
						  <p style="text-align:center"><img src="images/dice3.jpg" width="30" height="30"></p>
						  <br><br>
						  <h3>Watch out the graphic on finished adventures<a target="_blank" href="highscores/graph.php"> HERE</a></h3>
						<!--news--><h4 style="text-align:center">Site News and updates</h4>
<?php include_once("news_5.php");?>					
					<p>	if you prefer you can read the books , and roll the dice online with <a target="_blank" href="roll_dice.php">this</a> php script or try the <a target="_blank" href="battle_simulator.php">battle simulator</a></p>
					<p>New dice roller Android App available <a target="_blank" href="http://fightingfantazine.proboards.com/thread/515/10-random-dice-rolls-android"> HERE</a></p>
                    <p>You can also rate the adventures<a target="_blank" href="rater/index.php">HERE</a></p>
					

<p style="text-align:center"><img src="images/2.gif"></p>                      

		<!--Major Tweets //-->
		<p>
</p>




</div>	
<div class="footer">
<?php include_once("footer3.php"); ?>
</div>
</div>