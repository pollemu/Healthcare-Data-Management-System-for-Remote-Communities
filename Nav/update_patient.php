<?php
require_once '../crud.php';

$crud = new Crud();
$patient = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $patient = $crud->read($_GET['id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = '+63' . ltrim($_POST['contact'], '+63');
    $address = $_POST['address'];
    $blood = $_POST['blood'];

    $crud->update($id, $first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood);
    header('Location: get_patients.php?updated=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update Patient</title>
  <link rel="stylesheet" href="../styles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
  <header>Healthcare Admin Panel</header>
  <main class="container mt-4">
    <div class="system-name text-center">Update Patient</div>
    <?php if ($patient): ?>
    <form method="POST" class="form-container">
      <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>" />

      <div class="form-row inline d-flex">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($patient['first_name']) ?>" required />
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($patient['middle_name']) ?>" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($patient['last_name']) ?>" required />
        </div>
      </div>

      <div class="form-group text-center">
        <label>Age</label>
        <input type="number" name="age" class="form-control short-select mx-auto" value="<?= htmlspecialchars($patient['age']) ?>" required />
      </div>

      <div class="form-group text-center">
        <label>Sex</label>
        <select name="sex" class="form-control short-select">
          <option value="M" <?= $patient['sex'] === 'M' ? 'selected' : '' ?>>Male</option>
          <option value="F" <?= $patient['sex'] === 'F' ? 'selected' : '' ?>>Female</option>
        </select>
      </div>

      <div class="form-group text-center">
        <label>Contact</label>
        <div class="prefix-group mx-auto">
          <span class="prefix">+63</span>
          <input type="text" name="contact" class="form-control" value="<?= substr($patient['contact_number'], 3) ?>" pattern="[0-9]{10}" maxlength="10" required />
        </div>
      </div>

      <div class="form-group text-center">
        <label>Address</label>
        <textarea name="address" class="form-control mx-auto" rows="2" required><?= htmlspecialchars($patient['address']) ?></textarea>
      </div>

      <div class="form-group text-center">
        <label>Blood Type</label>
        <select name="blood" class="form-control short-select mx-auto" required>
          <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
            <option value="<?= $type ?>" <?= $patient['blood_type'] == $type ? 'selected' : '' ?>><?= $type ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
      <label for="height">Height</label>
      <input type="number" step="0.01" name="height" class="form-control" value="<?= htmlspecialchars($patient['height']) ?>" required />
      </div>

      <div class="form-group">
      <label for="weight">Weight</label>
      <input type="number" step="0.01" name="weight" class="form-control" value="<?= htmlspecialchars($patient['weight']) ?>" required />
      </div>

      <div class="form-group">
      <label for="date_of_birth">Date of Birth</label>
      <input type="date" name="date_of_birth" class="form-control" value="<?= htmlspecialchars($patient['date_of_birth']) ?>" required />
      </div>
      </div>

      <div class="form-group">
    <label for="photo">Upload Photo</label>
    <input type="file" name="photo" class="form-control" accept="image/*" />
</div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success">Update Patient</button>
        <a href="get_patients.php" class="btn btn-secondary">Back</a>
      </div>
    </form>
    <?php else: ?>
      <div class="alert alert-danger text-center">Patient not found.</div>
    <?php endif; ?>
  </main>
</body>
</html>
