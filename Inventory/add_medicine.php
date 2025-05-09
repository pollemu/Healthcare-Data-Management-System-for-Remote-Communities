<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'crudInventory.php';
    $inventory = new CrudInventory();
    $inventory->addMedicine(
        $_POST['name'], $_POST['quantity'], $_POST['expiration'],
        $_POST['description'], $_POST['dosage'], $_POST['type']
    );
    header("Location: ../Nav/dashboard_panel.php?page=inventory");
    exit;
}
?>

<form method="POST">
  <div class="row g-3">
    <div class="col-md-6">
      <label for="name" class="form-label">Medicine Name</label>
      <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="col-md-6">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" class="form-control" name="quantity" id="quantity" required>
    </div>

    <div class="col-md-6">
      <label for="expiration" class="form-label">Expiration Date</label>
      <input type="date" class="form-control" name="expiration" id="expiration">
    </div>

    <div class="col-md-6">
      <label for="dosage" class="form-label">Dosage</label>
      <input type="text" class="form-control" name="dosage" id="dosage">
    </div>

    <div class="col-md-6">
      <label for="type" class="form-label">Type</label>
      <input type="text" class="form-control" name="type" id="type">
    </div>

    <div class="col-md-12">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3"></textarea>
    </div>

    <div class="col-12 d-flex justify-content-end">
      <button type="submit" name="add" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Medicine
      </button>
    </div>
  </div>
</form>