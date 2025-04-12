<?php
require_once '../crud.php';


$crud = new Crud();
$patients = $crud->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Admin Panel</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">Patient Management</div>

        <div id="patientsTableContainer">
            <table id="patientsTable">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Blood Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= $patient['patient_id'] ?></td>
                            <td><?= htmlspecialchars($patient['first_name']) ?></td>
                            <td><?= htmlspecialchars($patient['last_name']) ?></td>
                            <td><?= htmlspecialchars($patient['age']) ?></td>
                            <td><?= htmlspecialchars($patient['sex']) ?></td>
                            <td><?= htmlspecialchars($patient['contact_number']) ?></td>
                            <td><?= htmlspecialchars($patient['address']) ?></td>
                            <td><?= htmlspecialchars($patient['blood_type']) ?></td>
                            <td>
                                <!-- Update Patient Form -->
                                <form method="get" action="update_patient.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>">
                                    <button type="submit" class="update-btn">Update</button>
                                </form>

                                <!-- Delete Patient Form -->
                                <form method="post" action="delete_patient.php" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                    <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <form action="index.php" method="get">
            <button type="submit">Back to Home</button>
        </form>
    </main>
</body>
</html>
