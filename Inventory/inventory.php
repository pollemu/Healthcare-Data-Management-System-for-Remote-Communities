<?php
require_once 'CrudInventory.php';
$inventory = new CrudInventory();
$medicines = $inventory->getAllMedicines();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Medicine Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <style>
    .modal-content { border-radius: 1rem; }
    .table th, .table td { vertical-align: middle; }
    .btn-sm i { margin-right: 0; }
  </style>
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-capsule"></i> Medicine Inventory</h2>
    <button id="openModalBtn" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add New Medicine
    </button>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table id="medicinesTable" class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Medicine Name</th>
            <th>Quantity</th>
            <th>Expiration Date</th>
            <th>Description</th>
            <th>Dosage</th>
            <th>Type</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($medicines as $medicine): ?>
            <tr>
              <td><?= htmlspecialchars($medicine['medicine_id']) ?></td>
              <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
              <td><?= htmlspecialchars($medicine['quantity']) ?></td>
              <td><?= htmlspecialchars($medicine['expiration_date']) ?></td>
              <td><?= htmlspecialchars($medicine['description']) ?></td>
              <td><?= htmlspecialchars($medicine['dosage']) ?></td>
              <td><?= htmlspecialchars($medicine['type']) ?></td>
              <td class="text-center">
                <a href="update_medicine.php?id=<?= $medicine['medicine_id'] ?>" class="btn btn-sm btn-warning">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="del_medicine.php" method="POST" class="d-inline">
                  <input type="hidden" name="id" value="<?= $medicine['medicine_id'] ?>">
                  <button type="submit" onclick="return confirm('Delete this medicine?')" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="medicineModal" tabindex="-1" aria-labelledby="medicineModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="medicineModalLabel"><i class="bi bi-capsule-plus"></i> Add New Medicine</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php include 'add_medicine.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const modal = new bootstrap.Modal(document.getElementById('medicineModal'));
  document.getElementById('openModalBtn').addEventListener('click', () => modal.show());
</script>

</body>
</html>
