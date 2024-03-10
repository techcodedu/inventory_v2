<?php

/**
 * Sanitize input data to prevent XSS attacks.
 * This function can be used to clean user input before displaying it on the webpage or processing it further.
 *
 * @param string $data The input data.
 * @return string The sanitized data.
 */
function sanitizeInput($data) {
    $data = trim($data); // Remove extra spaces, tabs, etc.
    $data = stripslashes($data); // Remove backslashes (\)
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

/**
 * Perform a safe query execution with mysqli, with prepared statements.
 * This generic function can be adapted for various types of queries (SELECT, UPDATE, INSERT, DELETE).
 *
 * @param mysqli $link The mysqli connection object.
 * @param string $query The SQL query with placeholders.
 * @param array $params The parameters to bind to the query.
 * @return mixed The result of the query execution, or false on failure.
 */
function executeQuery($link, $query, $params = []) {
    $stmt = mysqli_prepare($link, $query);
    if ($stmt === false) {
        die('Prepare failed: ' . mysqli_error($link));
    }

    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings; adjust as necessary.
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}

/**
 * Redirects to a specific URL.
 *
 * @param string $url The URL to redirect to.
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Checks if a user is logged in by verifying session variables.
 * This can be used to restrict access to certain pages.
 *
 * @return bool True if the user is logged in, false otherwise.
 */
function isLoggedIn() {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        return false;
    }
    return true;
}

// ITEMS
function getItems($link, $currentPage = 1, $itemsPerPage = 5) {
    $offset = ($currentPage - 1) * $itemsPerPage;
    $items = [];
    $sql = "SELECT * FROM items LIMIT ?, ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $offset, $itemsPerPage);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    return $items;
}
// TOTAL ITEMS FOR PAGINATION
function getTotalItemsCount($link) {
    $sql = "SELECT COUNT(*) as count FROM items";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

function isValidCategory($link, $categoryID) {
    $sql = "SELECT COUNT(*) FROM categories WHERE CategoryID = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $categoryID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $count > 0;
    }
    return false; // Default to false if query fails
}


// ADD ITEMS
/**
 * Adds a new item to the database.
 *
 * @param mysqli $link The mysqli connection object.
 * @param array $itemData An associative array containing the item's data.
 * @return bool True on success, or false on failure.
 */
function addItem($link, $itemData) {
    $query = "INSERT INTO items (CategoryID, Code, Name, Description, UnitOfMeasure, Quantity, EstimatedBudget, ModeOfProcurement) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'issssiis', 
            $itemData['category_id'],
            $itemData['code'],
            $itemData['name'],
            $itemData['description'],
            $itemData['unit_of_measure'],
            $itemData['quantity'],
            $itemData['estimated_budget'],
            $itemData['mode_of_procurement']
        );
        
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    } else {
        // Optionally log mysqli error
        error_log(mysqli_error($link));
        return false;
    }
}

// DELETE ITEM
function deleteItem($link, $itemId) {
    $sql = "DELETE FROM items WHERE ItemID = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $itemId);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            
            return false;
        }
    } else {
 
        return false;
    }
}

// EDIT ITEM
function getItem($link, $itemId) {
    $sql = "SELECT * FROM items WHERE ItemID = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $itemId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return $row;
        } else {
            mysqli_stmt_close($stmt);
            return null;
        }
    } else {
        return null;
    }
}

// UPDATE ITEM

function updateItem($link, $itemData) {
    $sql = "UPDATE items SET CategoryID = ?, Code = ?, Name = ?, Description = ?, UnitOfMeasure = ?, Quantity = ?, EstimatedBudget = ?, ModeOfProcurement = ? WHERE ItemID = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 'issssidsi', 
            $itemData['category_id'], 
            $itemData['code'], 
            $itemData['name'], 
            $itemData['description'], 
            $itemData['unit_of_measure'], 
            $itemData['quantity'], 
            $itemData['estimated_budget'], 
            $itemData['mode_of_procurement'], 
            $itemData['item_id']
        );
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            // Log error
            error_log('Update Item Error: ' . mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        // Log preparation error
        error_log('Prepare Statement Error: ' . mysqli_error($link));
        return false;
    }
}


function getCategories($link) {
    $categories = [];
    $sql = "SELECT * FROM categories";
    
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        mysqli_free_result($result);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    return $categories;
}

// statistics
function getItemsWithStockByCategory($link) {
    $sql = "SELECT c.CategoryName, SUM(i.Quantity) AS TotalQuantity, 
            COUNT(CASE WHEN i.Quantity = 0 THEN 1 END) AS StockOut 
            FROM items i 
            JOIN categories c ON i.CategoryID = c.CategoryID 
            GROUP BY c.CategoryName";
    $result = mysqli_query($link, $sql);
    $itemsStockByCategory = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $itemsStockByCategory[] = $row;
    }
    return $itemsStockByCategory;
}


function getTotalCategories($link) {
    $sql = "SELECT COUNT(*) as Total FROM categories";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['Total'] ?? 0;
}

function getTotalTransactions($link) {
    $sql = "SELECT COUNT(*) as Total FROM inventory_transactions";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['Total'] ?? 0;
}

function getTotalValueOfInventory($link) {
    $sql = "SELECT SUM(Quantity * EstimatedBudget) as TotalValue FROM items";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['TotalValue'] ?? 0;
}

 