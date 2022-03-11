<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('ffgamebooks_ftshadows_-bd.db3');
    }
}

$db = new MyDB();
$sql="CREATE TABLE ftshadows(
incremento INTEGER PRIMARY KEY AUTOINCREMENT,
textos text,
inimigos varchar(40),
pericia int(2),
forca int(2),
imagem varchar(30)
)";
$db->exec($sql)||die("Could not create table in the database");
$db->close();
echo"<h3>processo finalizado!</h3>";
?>
