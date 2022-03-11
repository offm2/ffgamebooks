<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('ffgamebooks_vvortan-bd.db3');
    }
}

$db = new MyDB();
$sql="VACUUM";

$db->exec($sql)||die("Could not delete table in the database");
$db->close();
echo"<h3>processo finalizado!</h3>";
?>