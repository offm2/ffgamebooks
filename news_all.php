<?php
//ini_set('display_errors', 1);
$x=1;
//
$xml=simplexml_load_file("feed.xml"); 
if(!$xml){ die ("Cannot retrieve news feed");}
foreach($xml->channel->item as $item)
{
echo "<h4><a href='{$item->link}'>{$item->title}</a></h4>";echo "<p>{$item->description}</p>";
//se chegar ás 15 noticias não fazer o display das restantes
//if($x++==15)break;
}
//print_r($xml);

?>