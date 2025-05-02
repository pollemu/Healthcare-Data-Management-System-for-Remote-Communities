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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
  <header class="bg-primary text-white text-center py-3 mb-4">
    <h1 class="h4 mb-0">Healthcare Admin Panel</h1>
  </header>

  <main class="container">
    <div class="card shadow mx-auto" style="max-width: 850px;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Add New Patient</h2>
        <form method="POST" enctype="multipart/form-data">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>First Name</label>
              <input type="text" name="first_name" class="form-control" required />
            </div>
            <div class="form-group col-md-4">
              <label>Middle Name</label>
              <input type="text" name="middle_name" class="form-control" />
            </div>
            <div class="form-group col-md-4">
              <label>Last Name</label>
              <input type="text" name="last_name" class="form-control" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label>Age</label>
              <input type="number" name="age" class="form-control" required />
            </div>
            <div class="form-group col-md-3">
              <label>Sex</label>
              <select name="sex" class="form-control" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Contact Number</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">+63</span>
                </div>
                <input type="text" name="contact" class="form-control" pattern="[0-9]{10}" maxlength="10" required />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" rows="2" required></textarea>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label>Blood Type</label>
              <select name="blood" class="form-control" required>
                <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
                  <option value="<?= $type ?>"><?= $type ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label>Date of Birth</label>
              <input type="date" name="date_of_birth" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
              <label>Height (cm)</label>
              <input type="number" step="0.01" name="height" class="form-control" required />
            </div>
            <div class="form-group col-md-2">
              <label>Weight (kg)</label>
              <input type="number" step="0.01" name="weight" class="form-control" required />
            </div>
          </div>

          <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" class="form-control-file" accept="image/*" />
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Add Patient</button>
            <a href="dashboard_panel.php" class="btn btn-secondary ml-2">Back to Home</a>
          </div>

        </form>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
