<?php
require_once '../crud.php';


$crud = new Crud();
$patients = $crud->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient List</title>
  <link rel="stylesheet" href="../styles.css">
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header>Healthcare Admin Panel</header>
<main class="container mt-5">
  <div class="system-name mb-4">Patient Management</div>

  <table id="myTable" class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Patient ID</th>
        <th>Full Name</th>
        <!-- Hidden headers -->
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
          <!-- Hidden searchable fields -->
          <td style="display: none;"><?= htmlspecialchars($patient['sex']) ?></td>
          <td style="display: none;"><?= htmlspecialchars($patient['blood_type']) ?></td>
          <td>
            <button
              class="btn btn-primary btn-sm view-btn"
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
            >View</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <form action="index.php" method="get">
    <button type="submit" class="btn btn-secondary">Back to Home</button>
  </form>
</main>

<!-- Modal -->
<div class="modal fade" id="viewModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Patient Profile</h5>
      </div>
      
      <div class="px-4 py-3">
        <div class="row">
          <!-- Left Column -->
          <div class="col-8">
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

          <!-- Right Column: Photo Box -->
          <div class="col-4 text-center">
            <div style="width: 100px; height: 120px; border: 1px solid #000; margin: auto;">
              <small>Photo</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <a id="update-link" class="btn btn-success">Update</a>
        <form method="post" id="delete-form" action="delete_patient.php" onsubmit="return confirm('Are you sure you want to delete this patient?');">
          <input type="hidden" name="id" id="delete-id">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize DataTable
    let table = new DataTable('#myTable', {
      lengthChange: false,
      columnDefs: [
        { targets: [2, 3], visible: false }  // Sex and Blood Type hidden but searchable
      ]
    });

    // Fix: Delegated click handler for paginated rows
    $(document).on('click', '.view-btn', function () {
      const id = $(this).data('id');
      const first = $(this).data('first');
      const middle = $(this).data('middle');
      const last = $(this).data('last');
      const age = $(this).data('age');
      const sex = $(this).data('sex');
      const contact = $(this).data('contact');
      const address = $(this).data('address');
      const blood = $(this).data('blood');
      const height = $(this).data('height');
      const weight = $(this).data('weight');
      const date_of_birth = $(this).data('date_of_birth');

      $('#modal-name').text(`${first} ${middle} ${last}`);
      $('#modal-age').text(age);
      $('#modal-sex').text(sex);
      $('#modal-contact').text(contact);
      $('#modal-address').text(address);
      $('#modal-blood').text(blood);
      $('#modal-height').text(height);
      $('#modal-weight').text(weight);
      $('#modal-date_of_birth').text(date_of_birth);

      $('#update-link').attr('href', `update_patient.php?id=${id}`);
      $('#delete-id').val(id);
    });
  });
</script>

</body>
</html>
