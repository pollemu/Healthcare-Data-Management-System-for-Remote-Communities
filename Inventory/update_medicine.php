<?php
require_once 'CrudInventory.php';
$inventory = new CrudInventory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory->updateMedicine(
        $_POST['id'], $_POST['name'], $_POST['quantity'], $_POST['expiration'],
        $_POST['description'], $_POST['dosage'], $_POST['type']
    );
    header("Location: ../Nav/dashboard_panel.php?page=inventory");
    exit;
}

$medicine = $inventory->getMedicine($_GET['id']);
?>

<div class="container">
  <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">Edit Medicine</h4>
        </div>
        <div class="card-body">
          <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($medicine['medicine_id']) ?>">

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Medicine Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($medicine['medicine_name']) ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($medicine['quantity']) ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Expiration Date</label>
                <input type="date" name="expiration" class="form-control" value="<?= htmlspecialchars($medicine['expiration_date']) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Dosage</label>
                <input type="text" name="dosage" class="form-control" value="<?= htmlspecialchars($medicine['dosage']) ?>">
              </div>

              <div class="col-md-6">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" value="<?= htmlspecialchars($medicine['type']) ?>">
              </div>

              <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($medicine['description']) ?></textarea>
              </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="../Nav/dashboard_panel.php?page=inventory" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
              </a>
              <button type="submit" name="update" class="btn btn-primary">
                <i class="bi bi-save"></i> Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">