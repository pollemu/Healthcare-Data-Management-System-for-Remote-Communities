<?php
require_once '../crud.php';
$crud = new Crud();
$patients = $crud->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Patient List</title>
  <link rel="stylesheet" href="../styles.css" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>

<body style="background-color: #f9f9f9;">

<header class="bg-primary text-white text-center py-3 mb-4">
  <h1 class="mb-0">Healthcare Admin Panel</h1>
</header>

<main class="container">
  <div class="mb-4">
    <h3 class="text-secondary">Patient Management</h3>
  </div>

  <div class="table-responsive">
    <table id="myTable" class="table table-bordered table-hover table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Patient ID</th>
          <th>Full Name</th>
          <th style="display: none;">Sex</th>
          <th style="display: none;">Blood Type</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($patients as $patient): ?>
          <tr>
            <td><?= $patient['patient_id'] ?></td>
            <td><?= htmlspecialchars($patient['first_name'] . ' ' . $patient['middle_name'] . ' ' . $patient['last_name']) ?></td>
            <td style="display: none;"><?= htmlspecialchars($patient['sex']) ?></td>
            <td style="display: none;"><?= htmlspecialchars($patient['blood_type']) ?></td>
            <td>
              <button
                class="btn btn-info btn-sm view-btn"
                data-toggle="modal"
                data-target="#viewModal"
                data-id="<?= $patient['patient_id'] ?>"
                data-first="<?= htmlspecialchars($patient['first_name']) ?>"
                data-middle="<?= htmlspecialchars($patient['middle_name']) ?>"
                data-last="<?= htmlspecialchars($patient['last_name']) ?>"
                data-age="<?= htmlspecialchars($patient['age']) ?>"
                data-sex="<?= htmlspecialchars($patient['sex']) ?>"
                data-contact="<?= htmlspecialchars($patient['contact_number']) ?>"
                data-address="<?= htmlspecialchars($patient['address']) ?>"
                data-blood="<?= htmlspecialchars($patient['blood_type']) ?>"
                data-height="<?= htmlspecialchars($patient['height']) ?>"
                data-weight="<?= htmlspecialchars($patient['weight']) ?>"
                data-date_of_birth="<?= htmlspecialchars($patient['date_of_birth']) ?>"
                data-image="<?= htmlspecialchars($patient['photo']) ?>"
              >View</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="text-right mt-4">
    <form action="dashboard_panel.php" method="get">
      <button type="submit" class="btn btn-secondary">Back to Home</button>
    </form>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="viewModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-lg shadow-lg">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="viewModalLabel">Patient Profile</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img id="modal-image" class="img-fluid shadow-sm" style="max-height: 180px; width: 100%; object-fit: cover;" alt="Patient Image">
          </div>
          <div class="col-md-8">
            <p><strong>Name:</strong> <span id="modal-name"></span></p>
            <p><strong>Sex:</strong> <span id="modal-sex"></span></p>
            <p><strong>Date of Birth:</strong> <span id="modal-date_of_birth"></span></p>
            <p><strong>Address:</strong> <span id="modal-address"></span></p>
            <p><strong>Age:</strong> <span id="modal-age"></span></p>
            <p><strong>Contact Number:</strong> <span id="modal-contact"></span></p>
            <p><strong>Height:</strong> <span id="modal-height"></span></p>
            <p><strong>Weight:</strong> <span id="modal-weight"></span></p>
            <p><strong>Blood Type:</strong> <span id="modal-blood"></span></p>
          </div>
          <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <div class="border" style="width: 120px; height: 150px; display: flex; align-items: center; justify-content: center;">
              <span class="text-muted">Photo</span>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <a id="update-link" class="btn btn-success btn-sm shadow-sm">Update</a>
        <form method="post" id="delete-form" action="delete_patient.php" onsubmit="return confirm('Are you sure you want to delete this patient?');">
          <input type="hidden" name="id" id="delete-id">
          <button type="submit" class="btn btn-danger btn-sm shadow-sm">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary btn-sm shadow-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
  $('#myTable').DataTable({
    lengthChange: false,
    columnDefs: [
      { targets: [2, 3], visible: false }
    ],
  });

    $(document).on('click', '.view-btn', function () {
      $('#modal-name').text(`${$(this).data('first')} ${$(this).data('middle')} ${$(this).data('last')}`);
      $('#modal-age').text($(this).data('age'));
      $('#modal-sex').text($(this).data('sex'));
      $('#modal-contact').text($(this).data('contact'));
      $('#modal-address').text($(this).data('address'));
      $('#modal-blood').text($(this).data('blood'));
      $('#modal-height').text($(this).data('height'));
      $('#modal-weight').text($(this).data('weight'));
      $('#modal-date_of_birth').text($(this).data('date_of_birth'));

      $('#update-link').attr('href', `update_patient.php?id=${$(this).data('id')}`);
      $('#delete-id').val($(this).data('id'));
    });
  });
</script>

<!-- Custom Styles -->
<style>
  .modal-content {
    border-radius: 10px;
    padding: 20px;
  }
  .modal-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
  }
  .modal-body p {
    font-size: 1.1rem;
    margin-bottom: 10px;
  }
  .modal-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
  }
  .modal-body img {
    border-radius: 0; /* Square corners for the image */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .btn-sm {
    padding: 8px 16px;
  }
  .btn:hover {
    opacity: 0.9;
  }
</style>

</body>
</html>
