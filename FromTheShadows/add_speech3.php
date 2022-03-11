<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script>
function speakt(pag){
        $.ajax({url: "view_par.php?pag="+pag , success: function(result){
		    $("#saythis").hide();
            $("#saythis").html(result);
			var tspeak=$("#saythis").text();
			responsiveVoice.speak(tspeak);
			 }});}
</script>
<br>
<p>Note:To Hear the text click speak and wait ( Works on google chrome)</p>
<?php if (isset($_GET['pag'])&&ctype_digit($_GET["pag"])){
$npag=$_GET["pag"];}
else{$npag=0;}
echo"<div id='saythis'></div>";
echo"<input type='button'  value='Speak Text' onclick='speakt($npag)'>";
echo"<input type='button' value='Stop' onclick='responsiveVoice.cancel()'>";
?>
