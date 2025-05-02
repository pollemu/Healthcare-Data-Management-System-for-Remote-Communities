<?php
require_once 'dashboard_function.php';
require_once '../crud.php';

$dashboardFunctions = new DashboardFunctions();
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

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
    body {
      background-color: #f1f3f6;
    }

    .sidebar {
      min-height: 100vh;
      background-color: #212529;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
    }

    .sidebar .nav-link {
      color: #cfd2d6;
      padding: 12px 20px;
      transition: 0.3s ease;
      border-radius: 0.375rem;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #343a40;
      color: #fff;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .main-content {
      padding: 2rem;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .card i {
      font-size: 2rem;
    }

    .dashboard-title {
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .metric-label {
      font-size: 0.95rem;
      color: rgba(255, 255, 255, 0.85);
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar d-flex flex-column align-items-sm-start px-3 pt-3 text-white">
      <h5 class="text-white mb-4 px-2">Admin Panel</h5>
      <ul class="nav nav-pills flex-column w-100">
        <li>
          <a href="?page=dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="dashboard_panel.php?page=users" class="nav-link <?= $page == 'users' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Patients
          </a>
        </li>
        <li>
          <a href="?page=inventory" class="nav-link <?= $page == 'inventory' ? 'active' : '' ?>">
            <i class="bi bi-box"></i> Inventory
          </a>
        </li>
        <li class="mt-auto">
          <a href="login.php" class="nav-link">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="col main-content">
      <?php if ($page == 'dashboard') { ?>
        <h2 class="dashboard-title">Dashboard Overview</h2>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="card-title">Total Patients</h5>
                    <div class="metric-label">Registered to Date</div>
                    <p class="display-6 fw-bold mt-2"><?= $totalPatients ?></p>
                  </div>
                  <i class="bi bi-heart-pulse-fill"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="card-title">Avg. Patients/Day</h5>
                    <div class="metric-label">This Month</div>
                    <p class="display-6 fw-bold mt-2"><?= $avgPatients ?></p>
                  </div>
                  <i class="bi bi-graph-up-arrow"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- You can add more cards here -->
        </div>
      <?php
        } elseif ($page == 'users') {
          include 'index.php';
        } elseif ($page == 'inventory') {
          include '../inventory.php';
        } else {
          echo "<h2>Page not found!</h2>";
        }
      ?>
    </div>
  </div>
</div>
</body>
</html>

