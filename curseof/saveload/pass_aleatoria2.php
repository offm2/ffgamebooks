<?php

/**
 * The letter l (lowercase L) and the number 1
 * have been removed, as they can be mistaken
 * for each other.
 */

function createRandomPassword() {

    $chars = "1023456789";
    //srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 2) {
        $num = rand() % 10;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}

// Usage
$password = createRandomPassword();
echo "Your random password is: <h2>{$password}</h2>";

?> 
