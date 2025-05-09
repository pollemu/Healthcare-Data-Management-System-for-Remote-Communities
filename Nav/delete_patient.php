<?php
require_once '../crud.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    
    $crud = new Crud();
    $crud->delete($id);
    header('Location: dashboard_panel.php?page=users');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Patient</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">Delete Patient</div>
        <form method="POST">
            <label>Are you sure you want to delete this patient?</label>
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <button type="submit">Yes, Delete</button>
        </form>
        <form action="get_patients.php" method="get">
            <button type="submit">Cancel</button>
        </form>
    </main>
</body>
</html>
