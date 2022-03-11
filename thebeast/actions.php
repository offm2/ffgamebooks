<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fighting Fantasy Amateur Adventure - Kill the beast  (Actions Made)</title>
<link href="../1.css" rel="stylesheet" type="text/css" />
<link href="../2.css" rel="stylesheet" type="text/css" />
</head>
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.BOTTOM_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php include_once("../header_html/header_bootstrap.html");?>
<body>
<?php include_once("../menu_html/menu_bootstrap_udir.html")?>
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12">
  <h3>A Fighting Fantasy gamebooks fan site </h3>
  <p>Actions made on the gamebook</p>
    <div style="text-align:center">
    <h3>Kill the beast&copy</h3><h3> by Victor Cheng  </h3>
    </div>
    <?php
    echo "<img src='../img/character.jpg'>";
    //ver sessao com o nome e personagem escolhidos
    echo "Name:<b>{$_SESSION['nome'] } </b>Character: <b>{$_SESSION['personagem']} </b> ";
    if (!isset($_GET['pag'])){
    //echo "<p><iframe src='character.php' width='370' height='150' frameborder='0' scrolling='no'></iframe></p>";
    }
    echo"<hr></hr>";
    ?><div id="responsecontainer"> 
<h3>Actions:</h3>
 <?php
  $b=0;
 if (isset($_SESSION["history"]))
 {
 
 $array=explode(",",$_SESSION["history"]);
 //for($i=0;$i<count($array);$i++)
 //{$y1=$i+1;echo"<h4>{$y1} - {$array[$i]} </h4>";}
  while($b<count($array))
 {
 if(array_search("1",$array)==$b)
 {$arr2.="Gather you possessions and start the adventure,";}
 elseif(array_search("2",$array)==$b)
 {$arr2.="You endure one of the most frightful hours of your life in the cave,";}
 elseif(array_search("3",$array)==$b)
 {$arr2.="Your saviour returns with evidence of the Beast 's demise,";}
 elseif(array_search("4",$array)==$b)
 {$arr2.="A tentacle coils around your leg but you slash it off with your knife,";}
  elseif(array_search("5",$array)==$b)
 {$arr2.="Fight WILD ANIMAL     SKILL   6     STAMINA   5,";}
 elseif(array_search("6",$array)==$b)
 {$arr2.="Fight Bandit or pay 5 gold pieces,";}
 elseif(array_search("7",$array)==$b)
 {$arr2.="You flee into the night. The Beast pursues you but soon gives up. ,";}
 elseif(array_search("8",$array)==$b)
 {$arr2.="You are relieved to see a town within walking distance ,";}
  elseif(array_search("9",$array)==$b)
 {$arr2.="You are in the Town looking for help,";}
 elseif(array_search("10",$array)==$b)
 {$arr2.="Your aid comes back to town ,";}
  elseif(array_search("11",$array)==$b)
 {$arr2.="You must rest a while and eat a meal. Make a note of the number 30,";}
 elseif(array_search("12",$array)==$b)
 {$arr2.="You must take control of the Warrior�s actions.,";}
 elseif(array_search("13",$array)==$b)
 {$arr2.="The Beast is far too powerful for you to handle loose 4 stamina and 1 skill points ,";}
 elseif(array_search("14",$array)==$b)
 {$arr2.="The ground beside you heaves and a great barrel of a creature bursts out from the earth ,";}
  elseif(array_search("15",$array)==$b)
 {$arr2.="You are relieved to see a town,";}
 elseif(array_search("16",$array)==$b)
 {$arr2.="Fight goblins,";}
 elseif(array_search("17",$array)==$b)
 {$arr2.="Choose you character,";}
 elseif(array_search("18",$array)==$b)
 {$arr2.="You spot a corpse lying amongst some bushes nearby,";}
  elseif(array_search("19",$array)==$b)
 {$arr2.="You find two daggers; a total of 8 Gold Pieces between them,";}
 elseif(array_search("20",$array)==$b)
 {$arr2.="Fight the Beast,";}
  elseif(array_search("21",$array)==$b)
 {$arr2.="Leaving the mill,";}
 elseif(array_search("22",$array)==$b)
 {$arr2.="the cave is abandoned and you settle down for the night. ,";}
 elseif(array_search("23",$array)==$b)
 {$arr2.="You decide to rest at an inn ,";}
 elseif(array_search("24",$array)==$b)
 {$arr2.="Test you luck; If you are Unlucky; you stumble and lose your way in the darkness.,";}
  elseif(array_search("25",$array)==$b)
 {$arr2.="Not far away is the Old Mill which you visit now and again,";}
 elseif(array_search("26",$array)==$b)
 {$arr2.="For the next paragraph only; you must take control of the Knight�s actions.,";}
 elseif(array_search("27",$array)==$b)
 {$arr2.="Turn to the paragraph number you noted earlier.,";}
 elseif(array_search("28",$array)==$b)
 {$arr2.="The Beast seizes you in a vice-like grip; you thrust your torch forwards burning its face. ,";}
  elseif(array_search("29",$array)==$b)
 {$arr2.="Make a note of the number 32 on your Adventure Sheet ,";}
 elseif(array_search("30",$array)==$b)
 {$arr2.="You continue through the valley,";}
  elseif(array_search("31",$array)==$b)
 {$arr2.="You have slept for only a few hours when a terrible roar rends the air. The Beast is close!,";}
 elseif(array_search("32",$array)==$b)
 {$arr2.="You continue through the woods,";}
 elseif(array_search("33",$array)==$b)
 {$arr2.="For the next paragraph only; you must take control of the Sorceress� actions. ,";}
 elseif(array_search("34",$array)==$b)
 {$arr2.="Your attempts to rid the Beast have been in vain;you journey back to your village. But you return only to witness devastation,";}
  elseif(array_search("35",$array)==$b)
 {$arr2.="At last; your village comes into view and you wave your arms with joy to the people,";}
 elseif(array_search("36",$array)==$b)
 {$arr2.="You are surprised by a pair of bandits,";}
 elseif(array_search("37",$array)==$b)
 {$arr2.="Test your Luck. ,";}
 elseif(array_search("38",$array)==$b)
 {$arr2.="You must call for one of the other willing heroes,";}
  elseif(array_search("39",$array)==$b)
 {$arr2.="Thrilled at your success; you journey hastily over the hills until you come into a valley ,";}
 elseif(array_search("40",$array)==$b)
 {$arr2.="You carry on through the woods without encountering any obstruction. ,";}
 $b++;
 }
  $array2=explode(",",$arr2);
 for($i=0;$i<count($array2);$i++)
 {$y1=$i+1;echo"<h4>{$y1} - {$array2[$i]} </h4>";}
echo "<form method='POST' action='actions2.php' target='_blank'>";
echo "<input type='submit' name='exp' value='export to pdf'></form>";echo"</div> ";
}
echo"<hr></hr>";
?>
<p><img src="../img/1.gif"></p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
</div>
</div>
</div>
</body>