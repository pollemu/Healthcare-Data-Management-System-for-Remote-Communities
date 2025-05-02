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
    $date_of_birth = $_POST['date_of_birth'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // Retrieve existing patient to preserve old photo if not replaced
    $patient = $crud->read($id);
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

    header('Location: get_patients.php?updated=1');
    exit;
}
?>
