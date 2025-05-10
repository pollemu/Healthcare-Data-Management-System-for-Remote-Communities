<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

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
  <title>Healthcare Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-fluid {
      height: 100vh;
    }

    .login-left {
      background: linear-gradient(to bottom right, #0d6efd, #20c997);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 2rem;
    }

    .login-left h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .login-left p {
      font-size: 1.2rem;
      max-width: 400px;
      text-align: center;
    }

    .login-right {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background-color: #f8f9fa;
    }

    .form-box {
      background: #ffffff;
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-box h2 {
      margin-bottom: 1.5rem;
      font-weight: 600;
      text-align: center;
      color: #0d6efd;
    }

    .form-control {
      border-radius: 0.5rem;
    }

    .btn-primary {
      width: 100%;
      border-radius: 0.5rem;
      background-color: #0d6efd;
      border-color: #0d6efd;
      transition: 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0b5ed7;
    }

    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row no-gutters h-100">
      <div class="col-md-6 login-left d-none d-md-flex">
        <div>
          <h1>Healthcare System</h1>
          <p>Secure access to patient records, admin tools, and real-time dashboards.</p>
        </div>
      </div>
      <div class="col-md-6 login-right">
        <div class="form-box">
          <h2>Admin Login</h2>
          <form action="login.php" method="POST">
            <?php if (isset($error_message)) { echo '<div class="alert alert-danger">' . $error_message . '</div>'; } ?>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Enter username" required />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter password" required />
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>



