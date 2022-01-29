<?php
$con = mysql_connect("localhost","ffgamebo_offm","oscarm");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
//criar a tabela
mysql_select_db("ffgamebo_books",$con);
$criar="CREATE TABLE feathers(
incremento int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(incremento),
textos text,
inimigos varchar(40),
pericia int(2),
forca int(2),
imagem varchar(30)
)";
$sql=mysql_query($criar,$con);
if (!$sql)
{die('its not possible to create table');}
mysql_close($con);
?>
