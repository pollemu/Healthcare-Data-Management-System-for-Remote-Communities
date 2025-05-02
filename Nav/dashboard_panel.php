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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<!-- Sidebar -->
<div class="modern-sidebar">
    <div class="sidebar-title">
        <i class="bi bi-hospital"></i> Admin Panel
    </div>
    <a href="?page=dashboard" class="<?= ($page === 'dashboard') ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="dashboard_panel.php?page=users" class="<?= ($page === 'users') ? 'active' : '' ?>">
        <i class="bi bi-people"></i> Patients
    </a>
    <a href="dashboard_panel.php?page=inventory" class="<?= ($page === 'inventory') ? 'active' : '' ?>">
        <i class="bi bi-box"></i> Inventory
    </a>
    <a href="login.php" id="logoutLink">
    <i class="bi bi-box-arrow-right"></i> Logout
</a>
</div>

<!-- Main Content -->
<div class="main-content" style="margin-left: 250px; padding: 2rem;">
    <?php if ($page == 'dashboard') { ?>
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
