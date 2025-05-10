<?php
require_once '../crud.php';
$crud = new Crud();
$patients = $crud->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient List</title>
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
    <h2 class="mb-0"><i class="bi bi-person-vcard"></i> Patient Records</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal">
      <i class="bi bi-plus-circle"></i> Add New Patient
    </button>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <table id="patientsTable" class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($patients as $p): ?>
            <tr>
              <td class="text-center"><?php echo htmlspecialchars($p['patient_id']); ?></td>
              <td><?php echo htmlspecialchars("{$p['first_name']} {$p['middle_name']} {$p['last_name']}"); ?></td>
              <td class="text-center">
                <button class="btn btn-sm btn-outline-info me-1 view-btn"
                        data-bs-toggle="modal" data-bs-target="#viewModal"
                        data-id="<?php echo $p['patient_id']; ?>"
                        data-first="<?php echo htmlspecialchars($p['first_name']); ?>"
                        data-middle="<?php echo htmlspecialchars($p['middle_name']); ?>"
                        data-last="<?php echo htmlspecialchars($p['last_name']); ?>"
                        data-age="<?php echo htmlspecialchars($p['age']); ?>"
                        data-sex="<?php echo htmlspecialchars($p['sex']); ?>"
                        data-contact="<?php echo htmlspecialchars($p['contact_number']); ?>"
                        data-address="<?php echo htmlspecialchars($p['address']); ?>"
                        data-blood="<?php echo htmlspecialchars($p['blood_type']); ?>"
                        data-height="<?php echo htmlspecialchars($p['height']); ?>"
                        data-weight="<?php echo htmlspecialchars($p['weight']); ?>"
                        data-date_of_birth="<?php echo htmlspecialchars($p['date_of_birth']); ?>"
                        data-image="<?php echo htmlspecialchars($p['photo']); ?>">
                  <i class="bi bi-eye"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-person-plus"></i> Add New Patient</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?php include 'add_patient.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- View Patient Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bi bi-person-lines-fill"></i> Patient Profile</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img id="modal-image" class="img-fluid rounded mb-3" style="max-height: 180px; object-fit: cover;" />
          </div>
          <div class="col-md-8">
            <p><strong>Name:</strong> <span id="modal-name"></span></p>
            <p><strong>Sex:</strong> <span id="modal-sex"></span></p>
            <p><strong>DOB:</strong> <span id="modal-date_of_birth"></span></p>
            <p><strong>Address:</strong> <span id="modal-address"></span></p>
            <p><strong>Age:</strong> <span id="modal-age"></span></p>
            <p><strong>Contact:</strong> <span id="modal-contact"></span></p>
            <p><strong>Height:</strong> <span id="modal-height"></span></p>
            <p><strong>Weight:</strong> <span id="modal-weight"></span></p>
            <p><strong>Blood Type:</strong> <span id="modal-blood"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a id="update-link" class="btn btn-outline-success btn-sm">Update</a>
        <form id="delete-form" method="post" action="delete_patient.php" onsubmit="return confirm('Delete this patient?');">
          <input type="hidden" name="id" id="delete-id">
          <button class="btn btn-outline-danger btn-sm">Delete</button>
        </form>
        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#patientsTable').DataTable({ lengthChange: false });

    $('#patientsTable').on('click', '.view-btn', function () {
      const d = $(this).data();
      $('#modal-name').text(`${d.first} ${d.middle} ${d.last}`);
      $('#modal-age').text(d.age);
      $('#modal-sex').text(d.sex);
      $('#modal-contact').text(d.contact);
      $('#modal-address').text(d.address);
      $('#modal-blood').text(d.blood);
      $('#modal-height').text(d.height);
      $('#modal-weight').text(d.weight);
      $('#modal-date_of_birth').text(d.date_of_birth);
      $('#modal-image').attr('src', d.image || 'default-image.jpg');
      $('#update-link').attr('href', `update_patient.php?id=${d.id}`);
      $('#delete-id').val(d.id);
    });
  });
</script>
</body>
</html>
