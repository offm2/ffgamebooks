<?php
session_start();
?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple ff gamebooks engine!</title>
<link href="1.css" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_RIGHT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<style>
#story{font-family:Arial,Verdana,times;font-size: 16px;font-weight: bold;background-color:black;color:#bc8b5a;}
#rul{font-family:Arial,Verdana,times;font-size: 16px;font-weight: bold;background-color:black;color:#bc8b5a;}
</style>

</head>

<div class="container">
  <div class="jumbotron">
<h3>A Fighting Fantasy gamebooks fan site</h3>
<h3>Play fan adventures in this simple engine</h3>
<img src="images/2.gif" class="img-circle" alt="intro image">
<h4><a href="index.php"><input type="button" value="Choose a new adventure"></a></h4>
</div>

<div class="col-sm-12">
<script>
$(document).ready(function()
{
    $("#submit").click(function()
    {
        var textpagevalue = $('input[name=pag]').val();

        $.ajax(
        {
            type: "GET",
            url: 'engine.php',
            data: {pag: textpagevalue},
            success: function(result)
            {
                var div = $("<div>").html(result);
				var section=$("#story",div.get(0));
				$("#result").html(section);
            }			
        });
    });
	});
</script>
<?php
$dir="stories";
if(isset($_POST["adventure"]))
{$file="{$dir}/{$_POST['adventure']}.html";if(file_exists($file)){$_SESSION["adventure"]=$file;}}
if(isset($_SESSION["adventure"])){
$story=$_SESSION["adventure"];
//ler documento html
$dom = new DOMDocument("1.0", "utf-8");
$dom->loadHTMLFile($story);
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
$div=$dom->getElementByid('title');
//texto
echo "<div><h3>{$div->textContent}</h3></div>" ;
echo"<h3>For reading the adventure please start on section 0</h3>";
if(ctype_digit($_GET["pag"])){
//nr da pagina
$npag=$_GET["pag"];
//ler documento html
$dom = new DOMDocument("1.0", "utf-8");
$dom->loadHTMLFile($story);
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
$div=$dom->getElementByid($npag);
//texto
echo "<textarea class='form-control' rows='25' id='story'>{$div->textContent}</textarea>" ;
}}
else {echo"<h2>Could not Load Storie</h2>";}
?>
<div id="result"></div>
<p>Insert section nr<input type="text" size="3" name="pag"><input type="button" value="Submit" id="submit">
<h4>DICE</h4>
<script>
$(document).ready(function()
{
    $("#s2").click(function()
    {
        var ndice = $('input[name=dice]').val();

        $.ajax(
        {
            type: "GET",
            url: 'engine.php',
            data: {dice: ndice},
            success: function(result)
            {
                var div = $("<div>").html(result);
				var section=$("#rd",div.get(0));
				$("#dice").html(section);
            }			
        });
    });
	});
</script>
<?php
if(ctype_digit($_GET["dice"])&&$_GET["dice"]<40)
{$i=1;echo"<p id='rd'>"; while($i<=$_GET["dice"]){$dice=mt_rand(1,6);echo "+d{$i}:{$dice} ";$i++;} echo"</p>";}?>
<p>Choose how many dice to roll:<input type="text" size="2" name="dice"><input type="button" value="Submit" id="s2">
<div id="dice"></div>
<h4>NOTES</h4>
<textarea class='form-control' rows='10'>Skill:     ,Stamina:     , Luck:    ,Gold:   , Provisions:  ,Potion:    ,Equipment:</textarea>
<script>
$(document).ready(function()
{
    $("#rs").click(function()
    {
        $.ajax(
        {
            type: "GET",
            url: 'engine.php',
            data: {rules: 1},
            success: function(result)
            {
                var div = $("<div>").html(result);
				var section=$("#rul",div.get(0));
				$("#rules").html(section);
            }			
        });
    });
	});
</script>
<?php
if(ctype_digit($_GET["rules"])&&$_GET["rules"]==1){
//ler documento html
$dom = new DOMDocument("1.0", "utf-8");
$dom->loadHTMLFile($story);
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
$div=$dom->getElementByid('rules');
//texto
echo "<textarea class='form-control' rows='25' id='rul'>{$div->textContent}</textarea>" ;
}
?>
<input type="button" value="See Rules" id="rs">
<div id="rules"></div>
<script>
$(document).ready(function()
{
    $("#s1").click(function()
    {
        $.ajax(
        {
            type: "GET",
            url: 'engine.php',
            data: {sound: 1},
            success: function(result)
            {
                var div = $("<div>").html(result);
				var section=$("#snd",div.get(0));
				$("#sound").html(section);
            }			
        });
    });
	});
</script>
<?php
if(ctype_digit($_GET["sound"])&&$_GET["sound"]==1){
echo"<h4 id='snd'>Music for the adventures</h4><iframe id='snd' width='240' height='135' src='//www.youtube.com/embed/2JnbwJwgJGg?rel=0&amp;showinfo=0&amp;autoplay=1' frameborder='0' allowfullscreen></iframe>";
}
?>
<input type="button" value="Add Sound" id="s1">
<div id="sound"></div>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>
</div>
<div class="footer">
</div>
</div>