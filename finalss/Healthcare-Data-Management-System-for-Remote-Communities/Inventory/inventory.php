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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                <!-- Edit Button -->
                <button 
                  class="btn btn-sm btn-outline-warning editBtn me-1"
                  data-bs-toggle="tooltip"
                  title="Edit"
                  data-id="<?= $medicine['medicine_id'] ?>"
                  data-name="<?= htmlspecialchars($medicine['medicine_name']) ?>"
                  data-quantity="<?= $medicine['quantity'] ?>"
                  data-expiration="<?= $medicine['expiration_date'] ?>"
                  data-description="<?= htmlspecialchars($medicine['description']) ?>"
                  data-dosage="<?= htmlspecialchars($medicine['dosage']) ?>"
                  data-type="<?= htmlspecialchars($medicine['type']) ?>">
                  <i class="bi bi-pencil"></i>
                </button>

                <!-- Delete Button -->
                <form method="POST" action="../Inventory/del_medicine.php" class="d-inline delete-form">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($medicine['medicine_id']) ?>">
                  <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                          data-bs-toggle="tooltip" title="Delete">
                    <i class="bi bi-trash"></i>
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
      <form method="POST" action="../Inventory/add_medicine.php" class="modal-form">
        <div class="modal-header">
          <h5 class="modal-title" id="medicineModalLabel"><i class="bi bi-capsule-plus"></i> Add New Medicine</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Medicine Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Quantity</label>
              <input type="number" name="quantity" class="form-control" min="0" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Expiration Date</label>
              <input type="date" name="expiration" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Dosage</label>
              <input type="text" name="dosage" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Type</label>
              <input type="text" name="type" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer pt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Medicine
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3">
      <form method="POST" action="../Inventory/update_medicine.php" class="modal-form">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square"></i> Edit Medicine</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="medicine_id" id="edit_id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Medicine Name</label>
              <input type="text" class="form-control" name="medicine_name" id="edit_name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="edit_quantity" min="0" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Expiration Date</label>
              <input type="date" class="form-control" name="expiration_date" id="edit_expiration" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Dosage</label>
              <input type="text" class="form-control" name="dosage" id="edit_dosage">
            </div>
            <div class="col-md-6">
              <label class="form-label">Type</label>
              <input type="text" class="form-control" name="type" id="edit_type">
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer pt-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    const table = $('#medicinesTable').DataTable({
      lengthChange: true,
      pageLength: 10,
      responsive: true
    });

    const savedPage = localStorage.getItem('datatable-page');
    if (savedPage !== null) {
      table.page(parseInt(savedPage)).draw('page');
      localStorage.removeItem('datatable-page');
    }

    $('.modal-form, .delete-form').on('submit', function () {
      const currentPage = table.page();
      localStorage.setItem('datatable-page', currentPage);
    });

    // Initialize tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
      new bootstrap.Tooltip(el);
    });

    // Show add modal
    const addModal = new bootstrap.Modal(document.getElementById('medicineModal'));
    $('#openModalBtn').on('click', () => addModal.show());

    // Fill and show edit modal
    $('#medicinesTable tbody').on('click', '.editBtn', function () {
      $('#edit_id').val($(this).data('id'));
      $('#edit_name').val($(this).data('name'));
      $('#edit_quantity').val($(this).data('quantity'));
      $('#edit_expiration').val($(this).data('expiration'));
      $('#edit_description').val($(this).data('description'));
      $('#edit_dosage').val($(this).data('dosage'));
      $('#edit_type').val($(this).data('type'));

      const editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
    });

    // SweetAlert delete
    $('#medicinesTable tbody').on('click', '.delete-btn', function () {
      const form = $(this).closest('form');
      Swal.fire({
        title: 'Are you sure?',
        text: "This medicine will be permanently deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>

</body>
</html>
