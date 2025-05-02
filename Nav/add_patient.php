<?php
require_once '../crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

  $photo = null;
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $targetDir = "uploads/";
    $photoName = basename($_FILES['photo']['name']);
    $targetFile = $targetDir . $photoName;

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $allowedTypes)) {
      move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile);
      $photo = $targetFile;
    }
  }

  $crud = new Crud();
  $crud->create($first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $date_of_birth, $height, $weight, $photo);

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

    .btn-container {
      display: flex;
      justify-content: center;
      gap: 1rem;
    }

    .prefix {
      background-color: #e9ecef;
      padding: 0.5rem 0.75rem;
      border: 1px solid #ced4da;
      border-right: 0;
      border-radius: 0.375rem 0 0 0.375rem;
    }

    .prefix-input {
      border-radius: 0 0.375rem 0.375rem 0;
    }

    .system-name {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <header class="text-center py-4 bg-primary text-white">
    <h1>Healthcare Admin Panel</h1>
  </header>

  <main class="container mt-5">
    <div class="form-container mx-auto" style="max-width: 900px;">
      <div class="system-name">Add New Patient</div>
      <form method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" required />
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Middle Name</label>
            <input type="text" name="middle_name" class="form-control" />
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" required />
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required />
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Sex</label>
            <select name="sex" class="form-control" required>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Contact Number</label>
            <div class="d-flex">
              <span class="prefix">+63</span>
              <input type="text" name="contact" class="form-control prefix-input" pattern="[0-9]{10}" maxlength="10" required />
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" rows="2" required></textarea>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Blood Type</label>
            <select name="blood" class="form-control" required>
              <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
                <option value="<?= $type ?>"><?= $type ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" required />
          </div>
          <div class="col-md-2 mb-3">
            <label class="form-label">Height (cm)</label>
            <input type="number" step="0.01" name="height" class="form-control" required />
          </div>
          <div class="col-md-2 mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" name="weight" class="form-control" required />
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label" for="photo">Upload Photo</label>
          <input type="file" name="photo" class="form-control" accept="image/*" />
        </div>

        <div class="btn-container mt-4">
          <button type="submit" class="btn btn-primary">Add Patient</button>
          <a href="dashboard_panel.php" class="btn btn-secondary">Back to Home</a>
        </div>
      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
