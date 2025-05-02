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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
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
                        <a href="login.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col py-3 main-content">
            <?php if ($page == 'dashboard') { ?>
            <h2>Dashboard Overview</h2>
            <div class="row mt-4">
                <!-- Total Patients Card -->
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Patients</h5>
                            <p class="card-text display-4"><?= $totalPatients ?></p>
                        </div>
                    </div>
                </div>

                <!-- Chart for Avg. Patients/Day -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title">Average Patients Per Day (Chart)</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted">The following chart displays the average number of patients seen per day over the past week.</p>
                            <div class="chart-container" style="position: relative; height: 400px; width: 100%;">
                                <canvas id="avgPatientsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Pass PHP data to JavaScript
                const avgPatientsData = <?php echo json_encode($avgPatientsData); ?>;  // Get array from PHP
                const daysOfWeek = <?php echo json_encode($daysOfWeek); ?>;  // Get array of days from PHP

                // Chart.js configuration
                var ctx = document.getElementById('avgPatientsChart').getContext('2d');
                var avgPatientsChart = new Chart(ctx, {
                    type: 'line',  // Line chart type
                    data: {
                        labels: daysOfWeek,  // Labels for each day of the week
                        datasets: [{
                            label: 'Average Patients',
                            data: avgPatientsData,  // Data for the average patients per day
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',  // Light red background for the chart
                            borderColor: 'rgba(255, 99, 132, 1)',  // Red color for the line
                            borderWidth: 3,  // Thicker line
                            pointBackgroundColor: 'rgba(255, 99, 132, 1)',  // Red points on the graph
                            pointRadius: 5,  // Slightly larger points
                            tension: 0.4  // Smoother line
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        family: 'Arial, sans-serif',
                                        weight: 'bold',
                                    },
                                    color: '#333',
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        family: 'Arial, sans-serif',
                                        weight: 'bold',
                                    },
                                    color: '#333',  // Dark text for X-axis labels
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 5,  // Steps for the Y-axis
                                    font: {
                                        family: 'Arial, sans-serif',
                                        weight: 'bold',
                                    },
                                    color: '#333',  // Dark text for Y-axis labels
                                }
                            }
                        }
                    }
                });
            </script>
            <?php } elseif ($page == 'users') {
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
</html>
