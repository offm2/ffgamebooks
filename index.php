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
    floatPosition: google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php include_once("header_html/header_bootstrap.html");?>
</head>
<body>
<?php include_once("analytics_google.php"); ?>
<?php include_once("menu_html/menu_bootstrap.html")?>
<!--random names-->
<script type="text/javascript" src="js/name_generator.js"></script>
<script type="text/javascript" src="js/english_set.js"></script>
<script type="text/javascript" src="js/getname2.js"></script>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <p>Ready-to-play Fighting Fantasy style adventures</p>
  </div>
  <div class="col-sm-6 col-md-4">
    <fieldset class="randomitem">
        <legend>1-Feathers of the Phoenix</legend>
						     
			<img src="img/phoenix.jpg" width="143" height="143" alt="" style="float:left" class="border"/>
				<b>You are looking for immortality. Can you locate the Feathers of the Phoenix?</b>
         <br><br><br><br><br><br>
					<form name="f1" method="POST" action="feathers/index.php">
            <p class="submit"><b><input type="submit" value="Start Adventure"></b></p>
          </form>
					<p><a target="_blank" href="feathers/feathersofthephoenix.pdf">Download gamebook</a>	
          
							<p style="text-align:center"><b>Windows app</b></p>
							<p style="text-align:center">
							<a href="https://sourceforge.net/projects/fffanadventurefeathers/files/latest/download" rel="nofollow"><img alt="Download fighting fantasy fan adventure feathers " src="https://a.fsdn.com/con/app/sf-download-button"></a>
							</p>
							<p style="text-align:center">
							<a href="app/">Alternative Download</a>
							</p>
          
	</fieldset>
  </div>
  <div class="col-sm-6 col-md-4">
    <fieldset><legend>2-Quest for the Ebony Wand</legend>
							
		<img src="img/caduceus.jpg" width="143" height="143" alt="" style="float:left" class="border" />
		<b>The ebony wand is hidden deep inside a crypt. Can you locate and retrieve it? Now with saving system so you can return to your adventure whenever you want.</b>
	    <br><br><br><br><br>
			<form name="f2" method="POST" action="quest/index.php">	     
        <p class="submit"><input type="submit" value="Start Quest"></p>
			</form>
		<p><a href="quest/WAND.doc" class="alignleft">Download gamebook</a></p>	
        <br>
    </fieldset>							
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>3-Kill the Beast</legend>
			<img src="img/beast.jpg" width="143" height="143" alt="" style="float:left" />
			<b>Your town is being terrorised by a beast that is killing villagers - can you kill it? Choose from three character classes (Herbalist, Blacksmith or Farmer) and start your adventure.</b>
			<br><br><br>
        <form name="f3" method="POST" action="thebeast/index2.php">			  
          <div class="form-group">
          <label for="adv3name">Insert name:</label>
          <input type="text" class="form-control" name="nome" id="adv3name" placeholder="Name">
          <input type="button" class="btn btn-success" value="Random Name" onclick="javascript:ger3();">	
          </div>
          <div class="form-group">
          <label for="adv3character">Character:</label>
          <select class="form-control" id="adv3character" name='personagem'>
          <option value='herbalist'>Herbalist</option>
          <option value='farmer'>Farmer</option>
          <option value='blacksmith'>Blacksmith</option>
          </select>
          </div>							  
          <p class="submit"><input type='submit' value='Start Adventure'></p>
					</form>
				<p><a href="thebeast/BEAST.doc">Download gamebook</a></p>
        <p></p>
  </fieldset>
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>4-Curse of Blackwood Manor</legend>
				<img src="img/mansion.jpg" width="143" height="143" alt="" style="float:left" class="border"/>
					<b>Can you lift the curse of the haunted Blackwood Manor?</b>
            <br><br><br><br><br><br><br>
						<form name="f4" method="POST" action="curseof/index.php">
              <p class="submit"><b><input type="submit" value="Start Adventure"></b></p>
            </form>
							 <p><a target="_blank" href="curseof/curseofblackwoodmanor.pdf">Download gamebook</a></p>
  </fieldset>
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>5-The Presence of a Hero</legend>
			<img src="img/hat.jpg" width="143" height="143" alt="" style="float:left" class="border"/>
				<b>You are a Wizard's apprentice with a goal to achieve - to be a true hero. Can you be this true hero?</b>
          <br><br><br><br><br>
					<script src="jquery/jquery.js"></script>
          <script src="jquery/check.js"></script>
          <form name="f5" method="POST" action="hero/index2.php">
          <div class="form-group">
          <label for="adv5name">Insert name:</label>
          <input type="text" class="form-control" name="nome" id="adv5name" placeholder="Name">
          <input type="button" class="btn btn-success" value="Random Name" onclick="javascript:ger5();">	
          </div>
          <div class="form-check">
					<h5>choose 3 magic spells to start the adventure</h5>
					<input class="form-check-input" type="checkbox" id="check1" name="magic[]" value="fear">
          <label class="form-check-label" for="check1">FEAR</label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="checkbox" id="check2" name="magic[]" value="firebolt">
          <label class="form-check-label for="check2">FIRE BOLT</label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="checkbox" id="check3" name="magic[]" value="illusion">
          <label class="form-check-label for="check3">ILLUSION</label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="checkbox" id="check4" name="magic[]" value="ironhand">
          <label class="form-check-label for="check4">IRON HAND </label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="checkbox" id="check5" name="magic[]" value="open">
          <label class="form-check-label for="check5">OPEN</label>
          </div>
          <div class="form-check">
          <input class="form-check-input" type="checkbox" id="check6" name="magic[]" value="ward">
          <label class="form-check-label for="check6">WARD</label>
          </div>
          <p class="submit"><b><input type="submit" id="submitm" value="Start Adventure"></b></p>
          </form>
					<p><a target="_blank" href="hero/presenceofahero.doc">Download gamebook</a></p>
  </fieldset>					 			
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
		<legend>6-Legacy of the Vampire</legend>
		<img src="img/vampire2.png" width="143" height="143" alt="" style="float:left" class="border"/>
		<b>&copyMark Lain 2014, This adventure is a sequel/homage to Keith Martin's Count Heydrich adventures, Vault Of The Vampire and Revenge Of The Vampire, originally published in the Puffin Fighting Fantasy series as numbers 38 and 58 respectively. It is not necessary to have played these books before playing Legacy Of The Vampire, but familiarity with the previous books will allow the player to get more out of the experience and to pick up on cross- references. I have intentionally tried to emulate Keith Martin's Heydrich adventures by including references to Hammer Films and European vampire folklore, Skill and Faith tests, and cheat-proofing. I have deliberately not included the Blood Points mechanic as, in this third adventure, YOU are not knowingly trying to destroy Heydrich so it would make less sense here.</b>
      <form name="f6" method="POST" action="vampirelegacy/index2.php">
      <div class="form-group">
          <label for="adv6name">Insert name:</label>
          <input type="text" class="form-control" name="nome" id="adv6name" placeholder="Name">
          <input type="button" class="btn btn-success" value="Random Name" onclick="javascript:ger6();">	
      </div>
      <p class="submit"><b><input type="submit" value="Start Adventure"></b></p>
      </form>
			<p><a target="_blank" href="vampirelegacy/Legacy-of-the-Vampire-FF-online.pdf">Download gamebook</a></p>
  </fieldset>
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>7-Venom of Vortan</legend>
		<img src="img/snake.jpg" width="143" height="143" alt="" style="float:left" class="border"/>
		<b>&copyMark Lain 2015,This adventure is intended as a gentle tribute to very linear, item-heavy, old school-style dungeon trawls. The style of, and approach to, the design of this short subject is intentional and hopefully familiar to fans of early Fighting Fantasy gamebooks.</b>
    <br><br><br>
    <h4>For Darren - a good man whose Stamina and Luck failed him far too soon. </h4>
      <form name="f7" method="POST" action="vortan/index.php">
      <br>
      <p class="submit"><b><input type="submit" value="Start Adventure"></b></p>
      </form>
  </fieldset>
			<p><a target="_blank" href="vortan/venom_of_vortan.pdf">Download gamebook</a></p>
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>8-Rise of the Night Creatures</legend>
		<div class="alert alert-danger" role="alert"><h5 class="alert-heading"><strong>Warning!</strong></h5>
		<p>This adventure is rated 16+ for strong content as it is an horror themed gamebook.<p>
    </div>
		<img src="img/werewolf.jpg" width="143" height="143" alt="" style="float:left" class="border" />
		<b>No one should be prepared for this terrifying night, and you are you prepared?</b>
		<br><br><br><br><br><br>
		  <form name="f8" method="POST" action="RiseofTheNightCreatures/index2.php">	     
      <div class="form-group">
          <label for="adv8name">Insert name:</label>
          <input type="text" class="form-control" name="nome" id="adv8name" placeholder="Name">
          <input type="button" class="btn btn-success" value="Random Name" onclick="javascript:ger8();">	
      </div>
      <p class="submit"><input type="submit" value="Start Adventure"></p>
			</form>
			<p><a href="RiseofTheNightCreatures/Rise.doc" class="alignleft">Download gamebook</a></p>								
  </fieldset>
  </div>
  <div class="col-sm-6 col-md-4">
  <fieldset>
    <legend>9-The Sleeping Dragon</legend>
		<img src="img/Dragon.png" width="143" height="143" alt="" style="float:left" class="border"/>
		<b>Go on adventure in search of the sleeping dragon can you make it alive?</b>
    <br><br><br><br><br><br>
		  <form name="f9" method="POST" action="Dragon/index.php">
      <p class="submit"><b><input type="submit" value="Start Adventure"></b></p>
      </form>
			<p><a target="_blank" href="Dragon/DRAGON.pdf">Download gamebook</a>
  </fieldset>
							
  </div>
  <div class="col-sm-12">
  <!--news-->
  <h3 style="text-align:center">Site News and updates</h3>
    <div style="text-align:center">
    <?php include_once("news_5.php");?>
    <?php include_once("search_bar.htm");?>
    </div>
  </div>
  <div class="col-sm-12">
  <div style="text-align:center">
    <?php include_once("footer3.php"); ?>
  </div>
</div>
</div>
</div>
