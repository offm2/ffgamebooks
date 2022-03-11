<?php session_start();$b=0;
if (isset($_SESSION["history"]))
{
 $array=explode(",",$_SESSION["history"]);
 while($b<count($array))
 {
 if(array_search("1",$array)==$b)
 {$arr2.="he runs into the inn; screaming for blood.  You sigh and follow him.  #";}
 elseif(array_search("2",$array)==$b)
 {$arr2.="young man selling weapons and small items of equipment#";}
 elseif(array_search("3",$array)==$b)
 {$arr2.="You run through the door into the pub’s storeroom;you quickly look inside the pouch and find 2 gold pieces#";}
 elseif(array_search("4",$array)==$b)
 {$arr2.="There is nothing more that interests you in the market.  #";}
 elseif(array_search("5",$array)==$b)
 {$arr2.="You cast the spell (lose 1 stamina point) just as the arrow is loosed off.  It stops; inches from your chest.  #";}
 elseif(array_search("6",$array)==$b)
 {$arr2.="you light the lantern;You find a journal lying on a desk;It appears that Syleron owns a large house in Clock Street. #";}
 elseif(array_search("7",$array)==$b)
 {$arr2.="You raise your fists to fight to pirate WOUNDED PIRATE SKILL 5 STAMINA 2  #";}
 elseif(array_search("8",$array)==$b)
 {$arr2.="You cast the spell (lose 1 stamina point) and point at the dog.  It whimpers and slinks off with its tail between its legs.   #";}
 elseif(array_search("9",$array)==$b)
 {$arr2.="You browse the market stalls.  The first one you come across is a tent with a sign that reads ‘Madame Star; clairvoyant.’#";}
 elseif(array_search("10",$array)==$b)
 {$arr2.="the thug falls to the floor and then the entire inn erupts into a huge riot with fists #";}
 elseif(array_search("11",$array)==$b)
 {$arr2.="You mumble the words of the spell (lose 1 stamina point) and point at Halim.The now cowering landlord acquiesces and hands over the key.On piece of paper shows a map of Port Blacksand.  You notice a cross on a house in Clock Street. #";}
 elseif(array_search("12",$array)==$b)
 {$arr2.="you get back to the Singing Bridge without incident.  #";}
 elseif(array_search("13",$array)==$b)
 {$arr2.="You pay her (deduct 2 gold pieces from your adventure sheet).  She looks into her crystal ball .  She tells you that she can see a green cat chasing the man; intending to kill him.  I see a large house in a street with a clock in it ;‘Beware the cat!’ #";}
 elseif(array_search("14",$array)==$b)
 {$arr2.="Syleron is being quite friendly.  He opens the box; pulls out a beautiful bejewelled silver dagger; and offers it to you; Before he can give it to you; there is a smash as the cat-man with green hair crashes through the window.  #";}
  elseif(array_search("15",$array)==$b)
 {$arr2.="You invoke the power of the spell (lose 1 stamina point) and point at the thug.  The thug’s expression turns instantly from one of aggression to one of terror#";}
 elseif(array_search("16",$array)==$b)
 {$arr2.="You rush to help Syleron.  He is still alive; but he was knocked unconscious by the cat man.  Eventually; he comes round and speaks.  ‘Thank you my friend.  #";}
 elseif(array_search("17",$array)==$b)
 {$arr2.="You dash along the filthy streets heading for Lobster Wharf.  Then strong hands grab you.  One covers your mouth to prevent you from making any noise.  You struggle as you feel yourself being dragged into a small shack at the wharf.  #";}
 elseif(array_search("18",$array)==$b)
 {$arr2.="You barb strikes you in the chest.  Lose 4 stamina points and reduce your attack strength by 1 in this upcoming combat.You must fight for your life!GREEN CAT MAN SKILL 8 STAMINA 10#";}
  elseif(array_search("19",$array)==$b)
 {$arr2.="Eventually; you are standing in front of Nicodemus’s door; he slams the door and leaves you standing there; puzzled and dejected.  Lose 1 luck point.  #";}
 elseif(array_search("20",$array)==$b)
 {$arr2.="You breathe a sigh of relief and turn into Clog Street.  you notice that someone is standing near you and staring.he is dressed in a leather jerkin.  His face is not human; but has feline features#";}
 elseif(array_search("21",$array)==$b)
 {$arr2.="As you enter the tent; you are greeted by a plump woman dressed in yellow and sitting at a table.  #";}
 elseif(array_search("22",$array)==$b)
 {$arr2.="there is a smash as the cat-man with green hair crashes through the window.  He strikes Syleron in the face with a clawed hand #";}
 elseif(array_search("23",$array)==$b)
 {$arr2.="A door slams and the hands let go of you.  There are two burley men standing in front of you.  The brothers offer you two gifts.  One is a pouch containing 5 gold pieces (add 5 gold pieces to your adventure sheet).  Another is a jar of salve; which they say you should rub onto your wounds (restore 4 stamina points).  #";}
 elseif(array_search("24",$array)==$b)
 {$arr2.="You leave the bar and climb the stairs.  The room is a mess.  On piece of paper shows a map of Port Blacksand.  You notice a cross on a house in Clock Street#";}
  elseif(array_search("25",$array)==$b)
 {$arr2.="You are near the front door, but a pirate stands in your way#";}
 elseif(array_search("26",$array)==$b)
 {$arr2.="You pay 1 gold piece (deduct it from your adventure sheet).  The smiling man shows you the ace and puts it into his pack of twenty two cards.  #";}
 elseif(array_search("27",$array)==$b)
 {$arr2.="You mutter the words to the spell (lose 1 stamina point).  you hear a click and the drawer opens before you.  Inside the drawer are 3 gold pieces (add 3 gold pieces to your adventure sheet) and a bottle labelled ‘potion of giant strength’.  #";}
 elseif(array_search("28",$array)==$b)
 {$arr2.="Test your luck.  You have to run for your life; so you sprint towards the docks #";}
  elseif(array_search("29",$array)==$b)
 {$arr2.="Before you can jump onto the deck; you hear the harsh bark of a watchdog. You spin around to see a huge hound; the size of a wolf; running towards you; teeth bared #";}
 elseif(array_search("30",$array)==$b)
 {$arr2.="As you fall to the floor; you whisper the spell (lose 1 stamina point).He sees a red star tattooed there; the mark of the Red Star Brotherhood; a large gang of vicious cut-throats.  #";}
  elseif(array_search("31",$array)==$b)
 {$arr2.="You focus on your spell (lose 1 stamina point) and pick a random card; revealing the picture of the ace that your illusion has created. The Man give you your prize (add 5 gold pieces to your adventure sheet)   #";}
 elseif(array_search("32",$array)==$b)
 {$arr2.="You jump aboard the barge and head towards the door.  It is easy to break the flimsy lock on the door and to descend inside.  #";}
 elseif(array_search("33",$array)==$b)
 {$arr2.="You quickly snatch up the pirate’s cutlass (Add the cutlass to your equipment list.  You may use it as a weapon) and rush out of the inn #";}
 elseif(array_search("34",$array)==$b)
 {$arr2.="You swing your rope and fling the grapple at the open window.  The grapple digs into the window and you climb the rope.The room is a mess.On piece of paper shows a map of Port Blacksand.  You notice a cross on a house in Clock Street.#";}
  elseif(array_search("35",$array)==$b)
 {$arr2.="You cast the spell and point at the door (lose 1 stamina point).  You hear a click and the door swings open.   #";}
 elseif(array_search("36",$array)==$b)
 {$arr2.="You grab the man’s wrist and pull the ace from the fold in his tunic.  ‘Fine!  He says.  You beat me!  Here is your money.’ He hands you 5 gold pieces (add 5 gold pieces to your adventure sheet)#";}
 elseif(array_search("37",$array)==$b)
 {$arr2.="You  turn  to  face  the  thug  bare  handed.    He  wields  a  knife;  but  he  is  very  drunk.If you cast the fire bolt spell before this combat; turn to 49. DRUNKEN THUG SKILL 4 STAMINA 5   #";}
 elseif(array_search("38",$array)==$b)
 {$arr2.="Add the items you have bought to your equipment list#";}
  elseif(array_search("39",$array)==$b)
 {$arr2.="The Dragon’s Tooth Tavern ;You ask if you can investigate Syleron's room, but Halim is not having any of it #";}
 elseif(array_search("40",$array)==$b)
 {$arr2.="You find a dagger (add the dagger to your equipment list.  It can be used as a weapon) and a small pouch containing 3 gold pieces (Add 3 gold pieces to your adventure sheet).  You hastily leave the inn #";}
   elseif(array_search("41",$array)==$b)
 {$arr2.="You look under the table; but do not find anything.  The man laughs a high pitched; mocking laugh as the crowd jeers you.  You leave in haste#";}
 elseif(array_search("42",$array)==$b)
 {$arr2.="You run into the door.  Test your skill.  #";}
 elseif(array_search("43",$array)==$b)
 {$arr2.="The watchdog is a large black; vicious beast.  You must kill it. WATCHDOG SKILL 7 STAMINA 6#";}
 elseif(array_search("44",$array)==$b)
 {$arr2.="Clock Street is on the Southern side of Port Blacksand; near the Market Square;You find the large house where Syleron should be and walk through the large open door;He looks at  you and smiles.  #";}
  elseif(array_search("45",$array)==$b)
 {$arr2.="The next stall you see has a card sharp offering a prize of 5 gold pieces to anyone who can find the ace in the pack.  He charges 1 gold piece#";}
 elseif(array_search("46",$array)==$b)
 {$arr2.="You raise your hand and invoke the spell (lose 1 stamina point) just as the cat-man looses the bolt at you.  It hangs in mid air for a second before falling to the ground.  You must fight for your life!GREEN CAT MAN SKILL 8 STAMINA 10#";}
 elseif(array_search("47",$array)==$b)
 {$arr2.=".  He glares at you ‘You spilt me drink, you turd!’   He yells and punches you in the face; sending you flying.   Lose 1 stamina point.How will you deal with this thug?   #";}
 elseif(array_search("48",$array)==$b)
 {$arr2.="you feel a sharp pain in your hand (lose 1 stamina point).  You have been bitten by a rat! you leave the barge and read the journal.  It appears that Syleron owns a large house in Clock Street.    #";}
  elseif(array_search("49",$array)==$b)
 {$arr2.="A lance of fire flies from your hands (lose 1 stamina point) and strikes the thug in the chest; sending him flying backwards. You need to get out of here quick!    #";}
 elseif(array_search("50",$array)==$b)
 {$arr2.="You read the parchment.  It is a letter from Nicodemus!   #";}
 $b++;
 }
  $array2=explode("#",$arr2);
if(isset($_POST['exp']))
{
define('FPDF_FONTPATH','../fpdf/font');
require('../fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica','B',16);
$pdf->Cell(200,20,'Actions made on Presence of a Hero',0,1,'C');
$pdf->SetFont('helvetica','',14);
 for($i=0;$i<count($array2);$i++)
 {
 $y1=$i+1;
 $pdf->MultiCell(0,20,$y1.' - '.$array2[$i]);
}
$pdf->Output();
}
}
?>