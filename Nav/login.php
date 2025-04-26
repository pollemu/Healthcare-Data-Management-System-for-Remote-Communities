<?php
session_start();  // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if credentials are correct
    if ($username == 'admin' && $password == '12345') {
        $_SESSION['logged_in'] = true;  
        header('Location: dashboard_panel.php');  
        exit();
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
}
?>

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
    .form-container {
      max-width: 400px;
      margin: auto;
      padding: 2rem;
      background-color: white;
      border-radius: 0.75rem;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <header>Healthcare Admin Panel</header>
  
  <main>
    <div class="system-name">HEALTHCARE SYSTEM</div>

    <!-- Login Form -->
    <div class="form-container">
      <form action="login.php" method="POST">
        <?php if (isset($error_message)) { echo '<div class="alert alert-danger">' . $error_message . '</div>'; } ?>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </main>
</body>
</html>
