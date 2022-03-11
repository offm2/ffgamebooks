<?php session_start();?>
<head><script type="text/JavaScript" src="../jsDraw2D.js"></script>
  </head>
<body><!--jquery src
<script src="../jquery-1.3.2.min.js"></script> 
 
<script> 
 $(document).ready(function() {
 	 $("#canvas").load("map.php");
   var refreshId = setInterval(function() {
      $("#canvas").load('map.php');
   }, 3000);
});
</script> //-->
<input type="button" value="Update Route" onclick="javascript:history.go(0)">
<div id="canvas" style="position:relative;width:800px;height:600px;"><h3>Progress in the adventure</h3>
<h4 align="right">View<a href="images/map00.gif">Map of Port Blacksand </a>Courtesy of the Titan rebuiling yahoo group</h4>
<h4 align="right"><a href="http://fightingfantasy.wikia.com/wiki/Port_Blacksand">Other Port Blacksand curiosities</a> </h4>
</div> 
<?php
$i=1;
//script do mapa
echo"<script type='text/javascript'>";

//contruir o mapa
//posicoes x e y
echo"var a=10;var b=10;";
//Create jsGraphics object
   echo"var gr = new jsGraphics(document.getElementById('canvas'));";
	    //Create jsColor object
   echo" var col = new jsColor('green');";

    //Create jsPen object
    echo"var pen = new jsPen(col,3);"; 
	
 if (isset($_SESSION["maptext"]))
 {
 $maptext=explode(",",$_SESSION["maptext"]);
 $mapx=explode(",",$_SESSION["mapx"]);
 $mapy=explode(",",$_SESSION["mapy"]);
 
 while($i<count($maptext))
 {

 //echo"<h4>{$maptext[$i]}</h4>";
	
	    //You can also code with inline object instantiation like below
   echo" gr.drawLine(pen,new jsPoint(a,b),new jsPoint(a+".$mapx[$i].",b+".$mapy[$i].")); ";
    //inserir texto
	echo"gr.drawText('".$maptext[$i]."',new jsPoint(a,b));";
	echo" a=a+".$mapx[$i].";b=b+".$mapy[$i].";";
	$i++;
	}
	}
echo"</script>";
?>

</body>





