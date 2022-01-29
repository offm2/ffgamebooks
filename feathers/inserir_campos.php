<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?php
$con = mysql_connect("localhost","ffgamebo_offm","oscarm");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("ffgamebo_books", $con);

$sql="INSERT INTO  feathers(textos,inimigos,pericia,forca,imagem)
VALUES
('$_POST[texto]','$_POST[inimigo]','$_POST[pericia]','$_POST[forca]','$_POST[imagem]')";

mysql_query($sql,$con);
mysql_close($con);
?>
</BODY>
</HTML>
