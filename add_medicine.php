<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'crudInventory.php';
    $inventory = new CrudInventory();
    $inventory->addMedicine(
        $_POST['name'], $_POST['quantity'], $_POST['expiration'],
        $_POST['description'], $_POST['dosage'], $_POST['type']
    );
    header("Location: inventory.php");
    exit;
}
?>

<h2>Add New Medicine</h2>
<form method="POST">
    <label>Medicine Name: <input type="text" name="name" required></label><br><br>
    <label>Quantity: <input type="number" name="quantity" required></label><br><br>
    <label>Expiration Date: <input type="date" name="expiration"></label><br><br>
    <label>Description: <textarea name="description"></textarea></label><br><br>
    <label>Dosage: <input type="text" name="dosage"></label><br><br>
    <label>Type: <input type="text" name="type"></label><br><br>
    <button type="submit" name="add">Add Medicine</button>
</form>
