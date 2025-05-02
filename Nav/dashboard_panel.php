<?php
require_once 'dashboard_function.php';  // SAME folder
require_once '../crud.php';              // Go up for crud.php

$dashboardFunctions = new DashboardFunctions();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Call stored procedures
$totalPatients = $dashboardFunctions->getTotalPatients();
$avgPatientsData = $dashboardFunctions->getAveragePatientsPerDay();  // Fetch data for the past week

// Days of the week (for the X-axis)
$daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthcare Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .modern-sidebar {
        background-color: #1f1d2b;
        color: #fff;
        width: 250px;
        height: 100vh;
        position: fixed;
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
    }

    .modern-sidebar a {
        color: #b0b3c3;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .modern-sidebar a:hover,
    .modern-sidebar a.active {
        background-color: #27293d;
        color: #fff;
    }

    .modern-sidebar i {
        font-size: 1.25rem;
        margin-right: 1rem;
    }

    .sidebar-title {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        font-weight: bold;
        color: #fff;
    }
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
                        <a href="login.php" class="nav-link px-0 align-middle">
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
    include '../inventory.php'; 
} else {
    echo "<h2>Page not found!</h2>";
} ?>

    

        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log me out!',
            cancelButtonText: 'No, stay logged in!',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.href;
            }
        });
    });
</script>
</html>
