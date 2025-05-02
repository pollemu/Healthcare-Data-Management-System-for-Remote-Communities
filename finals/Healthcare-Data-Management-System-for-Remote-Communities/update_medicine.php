<?php
require_once 'crudInventory.php';
$inventory = new CrudInventory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory->updateMedicine(
        $_POST['id'], $_POST['name'], $_POST['quantity'], $_POST['expiration'],
        $_POST['description'], $_POST['dosage'], $_POST['type']
    );
    header("Location: inventory.php");
    exit;
}

$medicine = $inventory->getMedicine($_GET['id']);
?>

<h2>Edit Medicine</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $medicine['medicine_id'] ?>">
    <label>Medicine Name: <input type="text" name="name" value="<?= $medicine['medicine_name'] ?>" required></label><br><br>
    <label>Quantity: <input type="number" name="quantity" value="<?= $medicine['quantity'] ?>" required></label><br><br>
    <label>Expiration Date: <input type="date" name="expiration" value="<?= $medicine['expiration_date'] ?>"></label><br><br>
    <label>Description: <textarea name="description"><?= $medicine['description'] ?></textarea></label><br><br>
    <label>Dosage: <input type="text" name="dosage" value="<?= $medicine['dosage'] ?>"></label><br><br>
    <label>Type: <input type="text" name="type" value="<?= $medicine['type'] ?>"></label><br><br>
    <button type="submit" name="update">Update Medicine</button>
</form>
