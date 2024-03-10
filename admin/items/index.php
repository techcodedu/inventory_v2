<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session and include necessary files
session_start();
require_once '../../includes/session_check.php';
require_once '../../includes/database.php';
require_once '../../includes/utilities.php';
require_once '../../templates/header.php';
require_once '../../templates/navigation.php';


$items = getItems($link);

$totalItems = getTotalItemsCount($link);
$itemsPerPage = 10;
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from URL

$items = getItems($link, $currentPage, $itemsPerPage);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemData = [
        'category_id' => $_POST['category_id'],
        'code' => $_POST['code'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'unit_of_measure' => $_POST['unit_of_measure'],
        'quantity' => $_POST['quantity'],
        'estimated_budget' => $_POST['estimated_budget'],
        'mode_of_procurement' => $_POST['mode_of_procurement'],
    ];

    // Before calling addItem
    error_log('Attempting to add item: ' . print_r($itemData, true));

    // Check if category_id is valid
    if (addItem($link, $itemData)) {
        $_SESSION['success_message'] = "Item successfully added.";
        error_log('Session success message set: ' . $_SESSION['success_message']);
        header('Location: index.php');
        exit();
    } else {
        echo "Debug: Failed to add item.";
    }

header('Location: index.php');
exit();

}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Items</h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addItemModal">
                        <i class="fas fa-plus"></i> Add New Item
                    </button>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card Header - with search filter -->
                        <div class="card-header">
                            <h3 class="card-title">Inventory Items</h3>
                             <!-- Display Success/Error Messages -->
                            <?php if (isset($_SESSION['success_message'])): ?>
                                <div id="alert-message" class="alert alert-success">
                                    <?= $_SESSION['success_message']; ?>
                                    <?php unset($_SESSION['success_message']); ?>
                                </div>
                            <?php elseif (isset($_SESSION['error_message'])): ?>
                                <div id="alert-message" class="alert alert-danger">
                                    <?= $_SESSION['error_message']; ?>
                                    <?php unset($_SESSION['error_message']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <!-- Table with enhanced data -->
                        <div class="card-body">
                            <table id="itemsTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Unit of Measure</th>
                                        <th>Quantity</th>
                                        <th>Estimated Budget</th>
                                        <th>Mode of Procurement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['Code']) ?></td>
                                            <td><?= htmlspecialchars($item['Name']) ?></td>
                                            <td><?= htmlspecialchars($item['Description']) ?></td>
                                            <td><?= htmlspecialchars($item['UnitOfMeasure']) ?></td>
                                            <td>
                                                <span class="badge badge-<?= $item['Quantity'] <= 5 ? 'danger' : 'success' ?>">
                                                    <?= htmlspecialchars($item['Quantity']) ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars(number_format($item['EstimatedBudget'], 2)) ?></td>
                                            <td><?= htmlspecialchars($item['ModeOfProcurement']) ?></td>
                                            <td>
                                               <!-- index.php -->
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editItemModal" onclick="populateEditModal(<?= $item['ItemID'] ?>);">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>

                                                <a href="/inventory_v2/admin/items/delete_item.php?id=<?= $item['ItemID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <!-- PAGINATION -->
                                 <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <?php if($currentPage > 1): ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?= $currentPage - 1 ?>">Previous</a></li>
                                        <?php endif; ?>
                                        <?php if($currentPage < $totalPages): ?>
                                        <li class="page-item"><a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <?php include 'modal/add_item_modal.php'; ?>
        <?php include 'modal/edit_item_modal.php'; ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once '../../templates/footer.php'; ?>

 