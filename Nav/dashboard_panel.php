<?php
require_once 'dashboard_function.php';

$dashboardFunctions = new DashboardFunctions();
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$totalPatients = $dashboardFunctions->getTotalPatients();
<<<<<<< HEAD
$avgPatientsData = $dashboardFunctions->getAveragePatientsPerDay(); 
=======
$avgPatientsData = $dashboardFunctions->getAveragePatientsPerDay();  // Fetch data for the past week
>>>>>>> ee75675308a9a8399e441331077f05071e445460

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
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar d-flex flex-column align-items-sm-start px-3 pt-3 text-white">
      <h5 class="text-white mb-4 px-2">Admin Panel</h5>
      <ul class="nav nav-pills flex-column w-100">
        <li>
          <a href="?page=dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>
        <li>
          <a href="?page=users" class="nav-link <?= $page == 'users' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> Patients
          </a>
        </li>
        <li>
          <a href="?page=inventory" class="nav-link <?= $page == 'inventory' ? 'active' : '' ?>">
            <i class="bi bi-box"></i> Inventory
          </a>
        </li>
        <a href="?page=illness" class="nav-link <?= $page == 'illness' ? 'active' : '' ?>">
            <i class="bi bi-thermometer-half"></i> Illness
          </a>
        </li>
        <li class="mt-auto">
          <a href="login.php" class="nav-link" id="logoutLink">
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
                    <p class="display-6 fw-bold mt-2"><?= htmlspecialchars($totalPatients) ?></p>
                  </div>
                  <i class="bi bi-heart-pulse-fill fs-1"></i>
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
<<<<<<< HEAD
                    <p class="display-6 fw-bold mt-2"><?= htmlspecialchars($avgPatientsData) ?></p>
=======
                    <p class="display-6 fw-bold mt-2"><?= htmlspecialchars($avgPatients) ?></p>
>>>>>>> ee75675308a9a8399e441331077f05071e445460
                  </div>
                  <i class="bi bi-graph-up-arrow fs-1"></i>
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php
        } elseif ($page == 'users') {
          include 'get_patients.php';
        } elseif ($page == 'inventory') {
          include '../Inventory/inventory.php';
        } elseif ($page == 'illness') {
          include '../Illnesses/dashboard.php'; 
        } else {
          echo "<h2>Page not found!</h2>";
        }

        $page = $_GET['page'] ?? 'dashboard';

      ?>
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
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> ee75675308a9a8399e441331077f05071e445460
