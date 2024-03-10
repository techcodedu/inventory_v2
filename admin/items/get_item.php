<?php
require_once '../../includes/session_check.php';  
require_once '../../includes/database.php';  
require_once '../../includes/utilities.php';  

// Check if an item ID is provided
if (isset($_GET['item_id']) && is_numeric($_GET['item_id'])) {
    $itemId = intval($_GET['item_id']);
    $item = getItem($link, $itemId);

    // Check if the item was found
    if ($item !== null) {
        // Send back the item details as JSON
        header('Content-Type: application/json');
        echo json_encode($item);
    } else {
        // Item not found, send an error message
        http_response_code(404); // Not Found
        echo json_encode(['error' => 'Item not found.']);
    }
} else {
    // Invalid request, send an error message
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid item ID.']);
}
?>
