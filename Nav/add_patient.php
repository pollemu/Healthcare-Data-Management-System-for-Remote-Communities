<?php
require_once '../crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $blood = $_POST['blood'];

    $crud = new Crud();
    $crud->create($first_name, $last_name, $age, $sex, $contact, $address, $blood);
    header('Location: get_patients.php?added=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">Add New Patient</div>
        <form method="POST">
            <input type="text" name="first_name" required>
            <label>First Name</label>

            <input type="text" name="last_name" required>
            <label>Last Name</label>

            <input type="number" name="age" required>
            <label>Age</label>

            <input type="text" name="sex" required>
            <label>Sex</label>

            <input type="text" name="contact" required>
            <label>Contact</label>

            <textarea name="address" required></textarea>
            <label>Address</label>

            <input type="text" name="blood" required>
            <label>Blood Type</label>

            <button type="submit">Add Patient</button>
        </form>
        <form action="index.php" method="get">
            <button type="submit">Back to Home</button>
        </form>
    </main>
</body>
</html>
