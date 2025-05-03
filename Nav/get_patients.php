<?php
require_once '../crud.php';
$crud     = new Crud();
$patients = $crud->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Patient List</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
</head>
<body class="bg-light">

<header class="bg-primary text-white text-center py-3 mb-4">
  <h1 class="h4 mb-0">Healthcare Admin Panel</h1>
</header>

<main class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-secondary">Patient Management</h3>
    <!-- BS5 data-bs-toggle / target -->
    <button id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientModal"><i class="bi bi-plus-circle"></i> Add Patient</button>
  </div>

  <div class="table-responsive">
    <table id="myTable" class="table table-bordered table-hover table-striped">
      <thead class="table-dark">
        <tr>
          <th>Patient ID</th>
          <th>Full Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($patients as $p): ?>
        <tr>
          <td><?= $p['patient_id'] ?></td>
          <td><?= htmlspecialchars("$p[first_name] $p[middle_name] $p[last_name]") ?></td>
          <td>
            <button
              class="btn btn-info btn-sm view-btn"
              data-bs-toggle="modal"
              data-bs-target="#viewModal"
              data-id="<?= $p['patient_id'] ?>"
              data-first="<?= htmlspecialchars($p['first_name']) ?>"
              data-middle="<?= htmlspecialchars($p['middle_name']) ?>"
              data-last="<?= htmlspecialchars($p['last_name']) ?>"
              data-age="<?= htmlspecialchars($p['age']) ?>"
              data-sex="<?= htmlspecialchars($p['sex']) ?>"
              data-contact="<?= htmlspecialchars($p['contact_number']) ?>"
              data-address="<?= htmlspecialchars($p['address']) ?>"
              data-blood="<?= htmlspecialchars($p['blood_type']) ?>"
              data-height="<?= htmlspecialchars($p['height']) ?>"
              data-weight="<?= htmlspecialchars($p['weight']) ?>"
              data-date_of_birth="<?= htmlspecialchars($p['date_of_birth']) ?>"
              data-image="<?= htmlspecialchars($p['photo']) ?>"
            >
              View
            </button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- Add Patient Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <div class="modal-header">
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Patient Profile</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4 text-center">
            <img id="modal-image" class="img-fluid rounded mb-3" style="max-height:180px; object-fit:cover;" />
          </div>
          <div class="col-8">
            <p><strong>Name:</strong> <span id="modal-name"></span></p>
            <p><strong>Sex:</strong> <span id="modal-sex"></span></p>
            <p><strong>DOB:</strong> <span id="modal-date_of_birth"></span></p>
            <p><strong>Address:</strong> <span id="modal-address"></span></p>
            <p><strong>Age:</strong> <span id="modal-age"></span></p>
            <p><strong>Contact:</strong> <span id="modal-contact"></span></p>
            <p><strong>Height:</strong> <span id="modal-height"></span></p>
            <p><strong>Weight:</strong> <span id="modal-weight"></span></p>
            <p><strong>Blood:</strong> <span id="modal-blood"></span></p>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a id="update-link" class="btn btn-success btn-sm">Update</a>
        <form id="delete-form" method="post" action="delete_patient.php" onsubmit="return confirm('Delete this patient?');">
          <input type="hidden" name="id" id="delete-id">
          <button class="btn btn-danger btn-sm">Delete</button>
        </form>
        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery, Bootstrap 5 & DataTables 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


<script>
  $(document).ready(function() {
    // Initialize DataTable
    var table = $('#myTable').DataTable({
      lengthChange: false
    });

    // Show SweetAlert if added=1
    if (new URLSearchParams(window.location.search).get('added') === '1') {
      Swal.fire({
        icon: 'success',
        title: 'Patient Added',
        text: 'Your new patient has been saved.',
        confirmButtonText: 'OK'
      });
    }

    // Populate View Modal on "View" button click
    $('#myTable').on('click', '.view-btn', function() {
      const d = $(this).data(); // Fetch data attributes from clicked row
      $('#modal-name').text(`${d.first} ${d.middle} ${d.last}`);
      $('#modal-age').text(d.age);
      $('#modal-sex').text(d.sex);
      $('#modal-contact').text(d.contact);
      $('#modal-address').text(d.address);
      $('#modal-blood').text(d.blood);
      $('#modal-height').text(d.height);
      $('#modal-weight').text(d.weight);
      $('#modal-date_of_birth').text(d.dateOfBirth || d.date_of_birth);
      $('#modal-image').attr('src', d.image || 'default-image.jpg');
      $('#update-link').attr('href', `update_patient.php?id=${d.id}`);
      $('#delete-id').val(d.id);
    });
  });
</script>

</body>
</html>