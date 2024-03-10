<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page at the root directory
header("location: /inventory_v2/index.php");


exit;



