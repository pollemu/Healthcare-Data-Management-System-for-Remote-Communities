<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Healthcare Admin Panel</title>
  <link rel="stylesheet" href="../styles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    header {
      background-color: #007bff;
      color: white;
      padding: 1rem;
      text-align: center;
      font-size: 1.5rem;
    }

    .system-name {
      text-align: center;
      font-size: 2rem;
      margin: 2rem 0;
      font-weight: bold;
    }

    .form-container, .button-row {
      max-width: 400px;
      margin: auto;
      padding: 2rem;
      background-color: white;
      border-radius: 0.75rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .button-row form {
      margin-bottom: 1rem;
    }

    .button-row button, .form-container button {
      width: 100%;
    }
  </style>
</head>
<body>
<<<<<<< Updated upstream
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">HEALTHCARE SYSTEM</div>

        <div class="button-row">
            <form action="add_patient.php" method="get">
                <button type="submit">Add Patient</button>
            </form>
            <form action="get_patients.php" method="get">
                <button type="submit">View Patients</button>
            </form>
=======
  <header>Healthcare Admin Panel</header>

  <main>
    <div class="system-name">HEALTHCARE SYSTEM</div>

    <!-- Login Form -->
    <div class="form-container">
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" required />
>>>>>>> Stashed changes
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>

    <!-- Dashboard Buttons -->
    <div class="button-row mt-4">
      <form action="add_patient.php" method="get">
        <button type="submit" class="btn btn-success">Add Patient</button>
      </form>
      <form action="get_patients.php" method="get">
        <button type="submit" class="btn btn-info">View Patients</button>
      </form>
    </div>
  </main>
</body>
</html>
