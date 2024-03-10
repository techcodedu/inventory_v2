<?php
// edit_item.php
require_once '../../includes/session_check.php';
require_once '../../includes/database.php';
require_once '../../includes/utilities.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item_id'])) {
    $itemData = [
        'item_id' => $_POST['item_id'],
        'category_id' => $_POST['category_id'],
        'code' => $_POST['code'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'unit_of_measure' => $_POST['unit_of_measure'],
        'quantity' => $_POST['quantity'],
        'estimated_budget' => $_POST['estimated_budget'],
        'mode_of_procurement' => $_POST['mode_of_procurement'],
    ];

    if (updateItem($link, $itemData)) {
        $_SESSION['success_message'] = "Item successfully updated.";
    } else {
        $_SESSION['error_message'] = "Failed to update item.";
    }

    header('Location: index.php');
    exit();
}
?>
