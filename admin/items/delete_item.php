<?php
require_once '../../includes/session_check.php';
require_once '../../includes/database.php';
require_once '../../includes/utilities.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $itemId = $_GET['id'];
    
    if (deleteItem($link, $itemId)) {
        $_SESSION['success_message'] = "Item successfully deleted.";
    } else {
        $_SESSION['error_message'] = "Failed to delete item.";
    }
}

header('Location: index.php');
exit();
?>
