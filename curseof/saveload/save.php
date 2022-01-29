<?php
session_start();
//form de confirmacao da password
echo "<form method='POST' action='go.php'>Password:<input type='text' name='pass' size=12><input type='submit' value='confirm'></form>";
echo "<h4>Put the password bellow and confirm </h4>";
	/**
 * The letter l (lowercase L) and the number 1
 * have been removed, as they can be mistaken
 * for each other.
 */

function createRandomPassword() {

    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz1023456789";
    //srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

    while ($i <= 7) {
        $num = rand() % 59;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }

    return $pass;

}

// Usage
$password = createRandomPassword();
echo "Your save password is: <h2>{$password}</h2>";
$_SESSION["pass"]=$password;


?>