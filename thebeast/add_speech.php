<script src="../jquery/jquery.js"></script>
<script type="text/javascript" src="../mespeak/mespeak.js"></script>
<script>
function speakt(pag)
{
    meSpeak.loadConfig("../mespeak/mespeak_config.json");
    meSpeak.loadVoice("../mespeak/voices/en/en.json");
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               tspeakall = xmlhttp.responseText;
			   var tmp=document.createElement("DIV");
			   tmp.setAttribute("id","saythis");
			   tmp.innerHTML=tspeakall;
			   var tspeak=tmp.textContent || tmp.innerText;
				meSpeak.speak(tspeak,{variant:"f2"});			
            }
        }
        xmlhttp.open("GET","view_fields.php?pag="+pag,true);
        xmlhttp.send();
    }
</script>
<br>
<p>Note:To Hear the text click speak and wait(may not work on the mobile version and IE)</p>
<?php if (isset($_GET['pag'])&&ctype_digit($_GET["pag"])){
$npag=$_GET["pag"];
echo"<input type='button' value='Speak Text' onclick='speakt($npag)'>";
echo"<input type='button' value='Stop' onclick='meSpeak.stop()'>";
}
?>
