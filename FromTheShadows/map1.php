<?php
//Contruir mapa por cada accao de pagina
if($_GET["pag"]=="1"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",branno s headquarter";}
elseif($_GET["pag"]=="2"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",monk in the tavern";}
elseif($_GET["pag"]=="3"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",-60";$_SESSION["maptext"].=",back to noose";}
elseif($_GET["pag"]=="4"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",down the street";}
elseif($_GET["pag"]=="5"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",fail to kill abdul";}
elseif($_GET["pag"]=="6"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",go to the tavern";}
elseif($_GET["pag"]=="10"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",city port";}
elseif($_GET["pag"]=="11"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",arrive at red lanten";}
elseif($_GET["pag"]=="13"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",talk to guards";}
elseif($_GET["pag"]=="14"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",talk to the barmaid";}
elseif($_GET["pag"]=="16"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",-60";$_SESSION["maptext"].=",back to Gallows street";}
elseif($_GET["pag"]=="20"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",kill abdul the butcher";}
elseif($_GET["pag"]=="21"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",talk with branno";}
elseif($_GET["pag"]=="22"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",talk to old jod";}
elseif($_GET["pag"]=="23"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",enter the fat crab";}
elseif($_GET["pag"]=="25"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",search the bodies";}
elseif($_GET["pag"]=="26"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",-60";$_SESSION["maptext"].=",see fight";}
elseif($_GET["pag"]=="27"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",vortigen";}
elseif($_GET["pag"]=="28"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",aim at vortigen";}
elseif($_GET["pag"]=="32"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",go to gallow street";}
elseif($_GET["pag"]=="34"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",see vortigen";}
elseif($_GET["pag"]=="35"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",hide from guards";}
elseif($_GET["pag"]=="37"){$_SESSION["mapx"].=",30";$_SESSION["mapy"].=",15";$_SESSION["maptext"].=",zalgros";}
elseif($_GET["pag"]=="42"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",Branno s home";}
elseif($_GET["pag"]=="46"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",vortigens brother";}
elseif($_GET["pag"]=="47"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",vortigens brother";}
elseif($_GET["pag"]=="49"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",at the docks";}
elseif($_GET["pag"]=="50"){$_SESSION["mapx"].=",0";$_SESSION["mapy"].=",30";$_SESSION["maptext"].=",You Win!";}
?>