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

    $crud->update($id, $first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $height, $weight, $date_of_birth);
    
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
            <label for="height">Height (in cm)</label>
            <input type="number" step="0.01" name="height" class="form-control" value="<?= htmlspecialchars($patient['height']) ?>" required />
        </div>

        <div class="form-group">
            <label for="weight">Weight (in kg)</label>
            <input type="number" step="0.01" name="weight" class="form-control" value="<?= htmlspecialchars($patient['weight']) ?>" required />
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="<?= htmlspecialchars($patient['date_of_birth']) ?>" required />
        </div>

        <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*" />
        </div>

        <!-- Confirm Button triggers modal -->
        <div class="text-center mt-4">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmModal">Confirm</button>
            <a href="get_patients.php" class="btn btn-secondary">Back</a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirm Patient Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Patient Details:</h4>
                        <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                        <p><strong>Middle Name:</strong> <span id="modalMiddleName"></span></p>
                        <p><strong>Last Name:</strong> <span id="modalLastName"></span></p>
                        <p><strong>Age:</strong> <span id="modalAge"></span></p>
                        <p><strong>Sex:</strong> <span id="modalSex"></span></p>
                        <p><strong>Contact:</strong> <span id="modalContact"></span></p>
                        <p><strong>Address:</strong> <span id="modalAddress"></span></p>
                        <p><strong>Blood Type:</strong> <span id="modalBlood"></span></p>
                        <p><strong>Height:</strong> <span id="modalHeight"></span> cm</p>
                        <p><strong>Weight:</strong> <span id="modalWeight"></span> kg</p>
                        <p><strong>Date of Birth:</strong> <span id="modalDOB"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Patient</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php else: ?>
    <div class="alert alert-danger text-center">Patient not found.</div>
    <?php endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JS to fill modal with current form values -->
<script>
document.querySelector('[data-target="#confirmModal"]').addEventListener('click', () => {
    document.getElementById('modalFirstName').textContent = document.querySelector('input[name="first_name"]').value;
    document.getElementById('modalMiddleName').textContent = document.querySelector('input[name="middle_name"]').value;
    document.getElementById('modalLastName').textContent = document.querySelector('input[name="last_name"]').value;
    document.getElementById('modalAge').textContent = document.querySelector('input[name="age"]').value;

    const sex = document.querySelector('select[name="sex"]').value;
    document.getElementById('modalSex').textContent = (sex === 'M') ? 'Male' : 'Female';

    document.getElementById('modalContact').textContent = '+63' + document.querySelector('input[name="contact"]').value;
    document.getElementById('modalAddress').textContent = document.querySelector('textarea[name="address"]').value;
    document.getElementById('modalBlood').textContent = document.querySelector('select[name="blood"]').value;
    document.getElementById('modalHeight').textContent = document.querySelector('input[name="height"]').value;
    document.getElementById('modalWeight').textContent = document.querySelector('input[name="weight"]').value;
    document.getElementById('modalDOB').textContent = document.querySelector('input[name="date_of_birth"]').value;
});
</script>

</body>
</html>
