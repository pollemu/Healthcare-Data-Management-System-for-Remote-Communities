<?php
require_once 'crudInventory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $inventory = new CrudInventory();
    $inventory->deleteMedicine($_POST['id']);
}
header("Location: inventory.php");
exit;
