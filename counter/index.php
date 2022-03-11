<?php
// Part 1
$filename = "ctd012.txt";
$count = file_get_contents($filename);
if ($count == null)
{$count = 0;}
//echo $count;
if (strlen($count)<6)
{
if (strlen($count)==5){$c1="0".$count;}
elseif (strlen($count)==4){$c1="00".$count;}
elseif (strlen($count)==3){$c1="000".$count;}
elseif (strlen($count)==2){$c1="0000".$count;}
elseif (strlen($count)==1){$c1="00000".$count;}
}
else{$c1=$count;}
$ext="jpg";
$p1=substr($c1,0,1);$p2=substr($c1,1,1);$p3=substr($c1,2,1);$p4=substr($c1,3,1);$p5=substr($c1,4,1);$p6=substr($c1,5,1);
echo"<p><img src='{$p1}.{$ext}'><img src='{$p2}.{$ext}'><img src='{$p3}.{$ext}'><img src='{$p4}.{$ext}'><img src='{$p5}.{$ext}'><img src='{$p6}.{$ext}'></p>";
// Part 2
$count++;
$handle = fopen($filename, "w+");
fwrite($handle, $count);
fclose($handle);
?>