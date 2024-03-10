<?php

require_once 'config.php'; // This includes DB_SERVER, DB_USERNAME, DB_PASSWORD, and DB_NAME constants

// Attempt to connect to MySQL database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
