<?php
session_start(); // Start the session.
require_once '../includes/session_check.php'; // Session check to ensure user is logged in.
require_once '../includes/database.php'; // Database connection.
require_once '../includes/utilities.php'; // Utilities inclusion.
require_once '../templates/header.php'; // Header file inclusion.
require_once '../templates/navigation.php'; // Navigation sidebar inclusion.

// Initialize variables for data that might be used in charts
$itemStockByCategoryData = [];
$categoriesData = [];
$transactionsData = [];
$totalInventoryValueData = [];

// Fetch data for charts if the user is an Administrator
if ($_SESSION['role'] === 'Administrator') {
    $itemStockByCategoryData = getItemsWithStockByCategory($link);
    $categoriesData = getTotalCategories($link);
    $transactionsData = getTotalTransactions($link);
    $totalInventoryValueData = getTotalValueOfInventory($link);
}

// Pass the data to JavaScript for admin
if ($_SESSION['role'] === 'Administrator') {
    echo "<script>
            var itemStockByCategoryData = " . json_encode($itemStockByCategoryData) . ";
            var categoriesData = " . json_encode($categoriesData) . ";
            var transactionsData = " . json_encode($transactionsData) . ";
            var totalInventoryValueData = " . json_encode($totalInventoryValueData) . ";
          </script>";
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                     <h1><?php echo $_SESSION['role'] === 'Administrator' ? 'Administrator' : 'Supply Officer'; ?> Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Items Card (Visible to both Administrator and Supply Officer) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Items</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="../admin/items/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Categories Card (Visible to both Administrator and Supply Officer) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <a href="../admin/categories/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <?php if ($_SESSION['role'] === 'Administrator'): ?>
                <!-- Transactions Card (Visible to Administrator only) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Transactions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <a href="../transactions/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Reports Card (Visible to Administrator only) -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="../reports/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Detailed Statistics Section -->
            <div class="row mt-2">
                <div class="col-12">
                    <h2 class="mb-3">Detailed Statistics</h2>
                </div>
                <!-- Charts Row -->
                <div class="row">
                    <!-- Items Distribution Chart (Visible to Administrator only) -->
                    <?php if ($_SESSION['role'] === 'Administrator'): ?>
                    <div class="col-lg-6">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="card-title">Items Distribution</h5>
                                <canvas id="itemsChart" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Categories Overview Chart (Visible to both Administrator and Supply Officer) -->
                    <div class="col-lg-6 mb-4">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="card-title">Categories Overview</h5>
                                <canvas id="categoriesChart" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Overview Chart (Visible to Administrator only) -->
                    <?php if ($_SESSION['role'] === 'Administrator'): ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="card-title">Transactions Overview</h5>
                                <canvas id="transactionsChart" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once '../templates/footer.php'; // Footer file inclusion.
?>
