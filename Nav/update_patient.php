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
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $date_of_birth = $_POST['date_of_birth'];

    $photo = $patient['photo'];
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

    $crud->update($id, $first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $height, $weight, $date_of_birth, $photo);
    header('Location: dashboard_panel.php?page=users');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background-color: #f7f9fc; }
        .card { margin-top: 30px; }
        .input-group-text { width: 60px; justify-content: center; }
        img.img-thumbnail { max-height: 150px; }
        .modal-img { max-height: 150px; }
    </style>
</head>
<body>
<header class="bg-primary text-white text-center py-3 mb-4">
    <h1>Healthcare Admin Panel</h1>
</header>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="mb-0">Update Patient</h4>
                </div>
                <div class="card-body">
                    <?php if ($patient): ?>
                    <form id="updateForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>" />

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($patient['first_name']) ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($patient['middle_name']) ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($patient['last_name']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Age</label>
                                <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($patient['age']) ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sex</label>
                                <select name="sex" class="form-control">
                                    <option value="M" <?= $patient['sex'] === 'M' ? 'selected' : '' ?>>Male</option>
                                    <option value="F" <?= $patient['sex'] === 'F' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+63</span>
                                    </div>
                                    <input type="text" name="contact" class="form-control" value="<?= substr($patient['contact_number'], 3) ?>" pattern="[0-9]{10}" maxlength="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($patient['address']) ?></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Blood Type</label>
                                <select name="blood" class="form-control" required>
                                    <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $type): ?>
                                        <option value="<?= $type ?>" <?= $patient['blood_type'] == $type ? 'selected' : '' ?>><?= $type ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Height (cm)</label>
                                <input type="number" step="0.01" name="height" class="form-control" value="<?= htmlspecialchars($patient['height']) ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Weight (kg)</label>
                                <input type="number" step="0.01" name="weight" class="form-control" value="<?= htmlspecialchars($patient['weight']) ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="<?= htmlspecialchars($patient['date_of_birth']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Upload Photo</label>
                            <input type="file" name="photo" class="form-control-file" accept="image/*" onchange="previewNewPhoto(event)">
                            <?php if (!empty($patient['photo'])): ?>
                                <div class="mt-3">
                                    <img src="<?= htmlspecialchars($patient['photo']) ?>" alt="Current Photo" class="img-thumbnail" id="currentPhoto">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-success px-4" onclick="showConfirmation()">Update Patient</button>
                            <a href="dashboard_panel.php?page=users" class="btn btn-secondary px-4">Back</a>
                        </div>
                    </form>
                    <?php else: ?>
                        <div class="alert alert-danger text-center">Patient not found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Confirm Patient Update</h5>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
      <div class="modal-body">
        <ul class="list-group mb-3">
          <li class="list-group-item"><strong>Name:</strong> <span id="confName"></span></li>
          <li class="list-group-item"><strong>Age:</strong> <span id="confAge"></span></li>
          <li class="list-group-item"><strong>Sex:</strong> <span id="confSex"></span></li>
          <li class="list-group-item"><strong>Contact:</strong> <span id="confContact"></span></li>
          <li class="list-group-item"><strong>Address:</strong> <span id="confAddress"></span></li>
          <li class="list-group-item"><strong>Blood Type:</strong> <span id="confBlood"></span></li>
          <li class="list-group-item"><strong>Height:</strong> <span id="confHeight"></span> cm</li>
          <li class="list-group-item"><strong>Weight:</strong> <span id="confWeight"></span> kg</li>
          <li class="list-group-item"><strong>Date of Birth:</strong> <span id="confDOB"></span></li>
        </ul>
        <div class="text-center">
          <img id="confPhoto" class="modal-img rounded border" alt="Photo Preview">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-success" onclick="document.getElementById('updateForm').submit()">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showConfirmation() {
    const form = document.forms['updateForm'];
    const fullName = `${form['first_name'].value} ${form['middle_name'].value} ${form['last_name'].value}`;
    document.getElementById('confName').innerText = fullName;
    document.getElementById('confAge').innerText = form['age'].value;
    document.getElementById('confSex').innerText = form['sex'].value === 'M' ? 'Male' : 'Female';
    document.getElementById('confContact').innerText = '+63' + form['contact'].value;
    document.getElementById('confAddress').innerText = form['address'].value;
    document.getElementById('confBlood').innerText = form['blood'].value;
    document.getElementById('confHeight').innerText = form['height'].value;
    document.getElementById('confWeight').innerText = form['weight'].value;
    document.getElementById('confDOB').innerText = form['date_of_birth'].value;

    const fileInput = form['photo'];
    const photoPreview = document.getElementById('confPhoto');
    if (fileInput.files && fileInput.files[0]) {
        photoPreview.src = URL.createObjectURL(fileInput.files[0]);
    } else {
        photoPreview.src = document.getElementById('currentPhoto')?.src || '';
    }

    $('#confirmModal').modal('show');
}

function previewNewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('currentPhoto').src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>
</html>