<?php
require_once '../crud.php';

$crud = new Crud();
$patient = null;

if (isset($_GET['id'])) {
    $patient = $crud->read($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main class="container mt-4">
        <div class="system-name text-center">Patient Details</div>

        <?php if ($patient): ?>
        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <td><?= htmlspecialchars($patient['first_name']) ?></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><?= htmlspecialchars($patient['middle_name']) ?></td>
            </tr>
            <tr>
                <th>Last Name</th>
                <td><?= htmlspecialchars($patient['last_name']) ?></td>
            </tr>
            <tr>
                <th>Age</th>
                <td><?= htmlspecialchars($patient['age']) ?></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td><?= $patient['sex'] === 'M' ? 'Male' : 'Female' ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?= htmlspecialchars($patient['contact_number']) ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= htmlspecialchars($patient['address']) ?></td>
            </tr>
            <tr>
                <th>Blood Type</th>
                <td><?= htmlspecialchars($patient['blood_type']) ?></td>
            </tr>
        </table>
        <div class="text-center">
            <a href="get_patients.php" class="btn btn-secondary">Back</a>
        </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">Patient not found.</div>
        <?php endif; ?>
    </main>
</body>
</html>
