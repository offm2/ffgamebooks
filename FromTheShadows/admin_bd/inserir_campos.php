<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?php
$i=0;$story="fromtheshadows.html";
//ler documento html
$dom = new DOMDocument("1.0", "utf-8");$newdoc = new DOMDocument();
$dom->loadHTMLFile($story);
// We need to validate our document before refering to the id
$dom->validateOnParse = true;
//function get($node) { $doc = $node->ownerDocument; $frag = $doc->createDocumentFragment(); foreach ($node->childNodes as $child) { $frag->appendChild($child->cloneNode(TRUE)); } return $doc->saveXML($frag); }
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('ffgamebooks_ftshadows_-bd.db3');
    }
}

$db = new MyDB();
while($i<400)
{
$i++;
$div=$dom->getElementByid($i);
$html=$dom->saveHTML($div);
//echo $html;
//texto
//$sql="INSERT INTO rotnc(textos) VALUES ('$div->textContent')";
$sql="INSERT INTO ftshadows(textos) VALUES ('$html')";
$db->exec($sql)||die("Could not insert field{$i} in the database");
}
$db->close();

echo"<h3>processo de insercao finalizado!</h3>";
//$div=$dom->getElementByid(2);
//var_dump($dom);
//$div=$dom->getElementByid($i);
//echo $dom->saveHTML($div);
?>
</BODY>
</HTML>
