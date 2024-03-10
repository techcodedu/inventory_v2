<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userRole = $_SESSION['role'] ?? 'Guest';

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard/index.php" class="brand-link">
        <span class="brand-text font-weight-light">Inventory System</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['Username'] ?? 'Guest'; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>dashboard/index.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if (in_array($userRole, ['Administrator', 'Supply Officer'])): ?>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/items/index.php" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/admin/categories/index.php" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <?php endif; ?>
                <?php if ($userRole === 'Administrator'): ?>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>/transactions/index.php" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/reports/index.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/users/index.php" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="/inventory_v2/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
