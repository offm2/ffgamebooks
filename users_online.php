<?php
$timeout = 300*12; // 5 minutes *12=30m
$time = time();
$ip = $_SERVER["REMOTE_ADDR"];
$file = "utiliz_online.txt";
$arr = file($file);
$users = 0;
for ($i = 0; $i < count($arr); $i++){
    if ($time - intval(substr($arr[$i], strpos($arr[$i], "    ") + 4)) > $timeout){
        unset($arr[$i]);
        $arr = array_values($arr);
        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
    }
    $users++;
}
echo $users." User(s) Online";
// Only add entry if user isn't already there, otherwise just edit timestamp
for ($i = 0; $i < count($arr); $i++){
    if (substr($arr[$i], 0, strlen($ip)) == $ip){
        $arr[$i] = substr($arr[$i], 0, strlen($ip))."    ".$time."\n";
        $arr = array_values($arr);
        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
        exit;   
    }
}
file_put_contents($file, $ip."    ".$time."\n", FILE_APPEND);