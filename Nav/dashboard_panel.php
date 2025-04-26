<?php
require_once 'dashboard_function.php';  // SAME folder
require_once '../crud.php';              // Go up for crud.php

$dashboardFunctions = new DashboardFunctions();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Call stored procedures
$totalPatients = $dashboardFunctions->getTotalPatients();
$avgPatients = $dashboardFunctions->getAveragePatientsPerDay();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a { color: #fff; text-decoration: none; }
        .sidebar a:hover { text-decoration: underline; }
        .main-content { padding: 20px; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="dashboard.php?page=dashboard" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Admin Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                    <li class="nav-item">
                        <a href="?page=dashboard" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                    <a href="dashboard_panel.php?page=users" class="nav-link px-0 align-middle">
    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Patients</span>
</a>

                    </li>
                    <li>
                        <a href="?page=inventory" class="nav-link px-0 align-middle">
                            <i class="bi bi-box"></i> <span class="ms-1 d-none d-sm-inline">Medicine Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href=".." class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col py-3 main-content">
            <?php if ($page == 'dashboard') {
    // Dashboard overview content
    ?>
    <h2>Dashboard Overview</h2>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Patients</h5>
                    <p class="card-text display-4"><?= $totalPatients ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Avg. Patients/Day</h5>
                    <p class="card-text display-4"><?= $avgPatients ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
} elseif ($page == 'users') {
    include 'index.php';  
} elseif ($page == 'inventory') {
    include ''; 
} else {
    echo "<h2>Page not found!</h2>";
} ?>

    

        </div>
    </div>
</div>
</body>
</html>
