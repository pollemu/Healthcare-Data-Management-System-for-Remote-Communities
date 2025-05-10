<?php
require_once 'CrudInventory.php';
$inventory = new CrudInventory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory->updateMedicine(
        $_POST['medicine_id'],
        $_POST['medicine_name'],
        $_POST['quantity'],
        $_POST['expiration_date'],
        $_POST['description'],
        $_POST['dosage'],
        $_POST['type']
    );
    header("Location: ../Nav/dashboard_panel.php?page=inventory");
    exit;
}

$medicine = $inventory->getMedicine($_GET['id']);
?>

<!-- Modal -->
<div class="modal fade" id="editMedicineModal" tabindex="-1" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" novalidate>
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editMedicineModalLabel"><i class="bi bi-pencil-square"></i> Edit Medicine</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="medicine_id" value="<?= htmlspecialchars($medicine['medicine_id']) ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label for="medicine_name" class="form-label">Medicine Name</label>
              <input type="text" id="medicine_name" name="medicine_name" class="form-control" 
                     value="<?= htmlspecialchars($medicine['medicine_name']) ?>" required>
            </div>

            <div class="col-md-6">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" id="quantity" name="quantity" class="form-control" 
                     value="<?= htmlspecialchars($medicine['quantity']) ?>" min="0" required>
            </div>

            <div class="col-md-6">
              <label for="expiration_date" class="form-label">Expiration Date</label>
              <input type="date" id="expiration_date" name="expiration_date" class="form-control"
                     value="<?= htmlspecialchars(date('Y-m-d', strtotime($medicine['expiration_date']))) ?>" required>
            </div>

            <div class="col-md-6">
              <label for="dosage" class="form-label">Dosage</label>
              <input type="text" id="dosage" name="dosage" class="form-control" 
                     value="<?= htmlspecialchars($medicine['dosage']) ?>">
            </div>

            <div class="col-md-6">
              <label for="type" class="form-label">Type</label>
              <input type="text" id="type" name="type" class="form-control" 
                     value="<?= htmlspecialchars($medicine['type']) ?>">
            </div>

            <div class="col-12">
              <label for="description" class="form-label">Description</label>
              <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($medicine['description']) ?></textarea>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Cancel
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
