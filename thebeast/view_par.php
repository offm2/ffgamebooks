<?php
if(!isset($_GET["pag"])){
$dom = new DOMDocument("1.0", "utf-8");
$dom->loadHTMLFile('tbeast.html');
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
$div=$dom->getElementByid('0');
//texto
echo $div->textContent ;
}
else{if(ctype_digit($_GET["pag"])){
//nr da pagina
$npag=$_GET["pag"];
//ler documento html
$dom = new DOMDocument("1.0", "utf-8");
$dom->loadHTMLFile('tbeast.html');
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
$div=$dom->getElementByid($npag);
//texto
echo $div->textContent ;
}}
?> 