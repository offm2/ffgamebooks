<?php
// Part 1
$filename = "ctd012.txt";
$count = file_get_contents($filename);
if ($count == null)
{$count = 0;}
echo "<div style='background-color:black;color:blue'><h2>{$count} visits </h2> </div>";
// Part 2
$count++;
$handle = fopen($filename, "w+");
fwrite($handle, $count);
fclose($handle);
?>