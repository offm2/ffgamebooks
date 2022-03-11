<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('ffgamebooks_vvortan-bd.db3');
    }
}

$db = new MyDB();

$sql="INSERT INTO venom(textos,inimigos,pericia,forca,imagem)
VALUES
('$_POST[texto]','$_POST[inimigo]','$_POST[pericia]','$_POST[forca]','$_POST[imagem]')";

$db->exec($sql)||die("Could not insert fields in the database");
$db->close();
echo"<h3>processo de insercao finalizado!</h3>";
?>
</BODY>
</HTML>
