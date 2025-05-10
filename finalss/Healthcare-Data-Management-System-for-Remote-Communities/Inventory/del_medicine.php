<?php
require_once 'CrudInventory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $inventory = new CrudInventory();
    $inventory->deleteMedicine($_POST['id']);
}
header("Location: ../Nav/dashboard_panel.php?page=inventory");
exit;