<?php
//Open the database 
$db = new SQLite3('tb8.12b');

//Create a basic table
$db->exec('CREATE TABLE people (pw varchar(255))');
echo "Table has been created \n";
//insert rows
$db->exec('INSERT INTO people (pw) VALUES ("8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918")');
echo "Row inserted \n";
?>