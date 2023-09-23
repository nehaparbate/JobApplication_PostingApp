<?php

// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Naruto@123');
define('DB_NAME', 'UrmApp');

// Establish database connection
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if connection was successful
if(!$db){
    die("Connection failed: " . mysqli_connect_error());
}

?>
