<script src="https://code.responsivevoice.org/responsivevoice.js?key=VsbJnCbU"></script>
<script>
function speakt(pag)
{
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
			   responsiveVoice.speak(tspeak);			
            }
        }
        xmlhttp.open("GET","view_par.php?pag="+pag,true);
        xmlhttp.send();
    }
</script>
<br>
<p>Note:To Hear the text click speak text and wait for the speech to be heard</p>
<?php if (isset($_GET['pag'])&&ctype_digit($_GET["pag"])){
$npag=$_GET["pag"];}
else{$npag=0;}
echo"<h4><input type='button' value='Speak Text' onclick='speakt($npag)'>";
echo"<input type='button' value='Stop' onclick='responsiveVoice.cancel()'></h4>";?>
