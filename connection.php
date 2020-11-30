<?php 

    define('DB_USER', 'isaacadmin');
    define('DB_PASS', '12345');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'dbhealth');

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

