<?php
require_once '../crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get POST data
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];
  $last_name = $_POST['last_name'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $contact = '+63' . ltrim($_POST['contact'], '+63');
  $address = $_POST['address'];
  $blood = $_POST['blood'];
  $date_of_birth = $_POST['date_of_birth'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];

  // Handle photo upload
  $photo = null;
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
      $targetDir = "uploads/"; // Folder to store uploaded images
      $photoName = basename($_FILES['photo']['name']);
      $targetFile = $targetDir . $photoName;
      
      // Check if the file is an actual image
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
      $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
      if (in_array($imageFileType, $allowedTypes)) {
          move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
          $photo = $targetFile; // Store the file path in the database
      }
  }
  
  // Create the patient record
  $crud = new Crud();
  $crud->create($first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $date_of_birth, $height, $weight, $photo);

  // Redirect after creating the patient
  header('Location: get_patients.php?added=1');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Patient</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      background-color: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

    .form-container h2 {
      margin-bottom: 1.5rem;
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 0.375rem;
    }

    .form-group label {
      font-weight: bold;
    }

    .short-select {
      width: 80%;
      margin: 0 auto;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }

    .system-name {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .prefix-group {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .prefix {
      background-color: #ddd;
      padding: 10px;
      border-radius: 0.375rem 0 0 0.375rem;
    }

    .form-row .form-group {
      width: 100%;
    }

    .form-row .form-group input {
      width: calc(100% - 70px); /* Adjust input width to accommodate prefix */
    }

    .form-row .form-group .prefix {
      margin-right: 10px;
    }

    .btn-container {
      display: flex;
      justify-content: center;
      gap: 20px;
    }
  </style>
</head>
<body>
  <header class="text-center py-4">
    <h1>Healthcare Admin Panel</h1>
  </header>
  <main class="container mt-5">
    <div class="system-name text-center">Add New Patient</div>
    <form method="POST" class="form-container" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control" />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Sex</label>
            <select name="sex" class="form-control" required>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Contact</label>
        <div class="prefix-group">
          <span class="prefix">+63</span>
          <input type="text" name="contact" class="form-control" pattern="[0-9]{10}" maxlength="10" required />
        </div>
      </div>

      <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2" required></textarea>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Blood Type</label>
            <select name="blood" class="form-control" required>
              <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
                <option value="<?= $type ?>"><?= $type ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Height (in cm)</label>
            <input type="number" step="0.01" name="height" class="form-control" required />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Weight (in kg)</label>
            <input type="number" step="0.01" name="weight" class="form-control" required />
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="photo">Upload Photo</label>
        <input type="file" name="photo" class="form-control" accept="image/*" />
      </div>

      <div class="btn-container mt-4">
        <button type="submit" class="btn btn-primary">Add Patient</button>
        <a href="dashboard_panel.php" class="btn btn-secondary">Back to Home</a>
      </div>
    </form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
