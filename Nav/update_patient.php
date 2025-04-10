<?php
require_once '../crud.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $crud = new Crud();
    $patient = $crud->read($id); // Fetch the patient's current data
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $blood = $_POST['blood'];

    $crud = new Crud();
    $crud->update($id, $first_name, $last_name, $age, $sex, $contact, $address, $blood);
    header('Location: get_patients.php?updated=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">Update Patient</div>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>">

            <input type="text" name="first_name" value="<?= htmlspecialchars($patient['first_name']) ?>" required>
            <label>First Name</label>
            
            <input type="text" name="last_name" value="<?= htmlspecialchars($patient['last_name']) ?>" required>
            <label>Last Name</label>
            
            <input type="number" name="age" value="<?= htmlspecialchars($patient['age']) ?>" required>
            <label>Age</label>
            
            <input type="text" name="sex" value="<?= htmlspecialchars($patient['sex']) ?>" required>
            <label>Sex</label>
            
            <input type="text" name="contact" value="<?= htmlspecialchars($patient['contact_number']) ?>" required>
            <label>Contact</label>
            
            <textarea name="address" required><?= htmlspecialchars($patient['address']) ?></textarea>
            <label>Address</label>

            <input type="text" name="blood" value="<?= htmlspecialchars($patient['blood_type']) ?>" required>
            <label>Blood Type</label>

            <button type="submit">Update Patient</button>
        </form>
        <form action="get_patients.php" method="get">
            <button type="submit">Back to Patient List</button>
        </form>
    </main>
</body>
</html>
