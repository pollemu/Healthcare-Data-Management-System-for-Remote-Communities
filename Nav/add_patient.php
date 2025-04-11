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

    $crud = new Crud();
    $crud->create($first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood);
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
  <link rel="stylesheet" href="../styles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
  <header>Healthcare Admin Panel</header>
  <main class="container mt-4">
    <div class="system-name text-center">Add New Patient</div>
    <form method="POST" class="form-container">

      <div class="form-row inline d-flex">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" class="form-control" required />
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" name="middle_name" class="form-control" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" class="form-control" required />
        </div>
      </div>

      <div class="form-group text-center">
        <label>Age</label>
        <input type="number" name="age" class="form-control short-select mx-auto" required />
      </div>

      <div class="form-group text-center">
        <label>Sex</label>
        <select name="sex" class="form-control short-select mx-auto" required>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>

      <div class="form-group text-center">
        <label>Contact</label>
        <div class="prefix-group mx-auto">
          <span class="prefix">+63</span>
          <input type="text" name="contact" class="form-control" pattern="[0-9]{10}" maxlength="10" required />
        </div>
      </div>

      <div class="form-group text-center">
        <label>Address</label>
        <textarea name="address" class="form-control mx-auto" rows="2" required></textarea>
      </div>

      <div class="form-group text-center">
        <label>Blood Type</label>
        <select name="blood" class="form-control short-select mx-auto" required>
          <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
            <option value="<?= $type ?>"><?= $type ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">Add Patient</button>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
      </div>
    </form>
  </main>
</body>
</html>
