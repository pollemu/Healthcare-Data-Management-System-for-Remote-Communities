<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'crudInventory.php';
    $inventory = new CrudInventory();

    $inventory->addMedicine(
        $_POST['name'],
        $_POST['quantity'],
        $_POST['expiration'],
        $_POST['description'],
        $_POST['dosage'],
        $_POST['type']
    );

    header("Location: ../Nav/dashboard_panel.php?page=inventory");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Medicine</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 1rem;
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
          <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Medicine</h4>
        </div>
        <div class="card-body">
          <form method="POST" novalidate>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Medicine Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>

              <div class="col-md-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" min="0" required>
              </div>

              <div class="col-md-6">
                <label for="expiration" class="form-label">Expiration Date</label>
                <input type="date" class="form-control" name="expiration" id="expiration" required>
              </div>

              <div class="col-md-6">
                <label for="dosage" class="form-label">Dosage</label>
                <input type="text" class="form-control" name="dosage" id="dosage" required>
              </div>

              <div class="col-md-6">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" name="type" id="type" required>
              </div>

              <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
              </div>

              <div class="col-12 d-flex justify-content-end mt-3">
                <button type="submit" name="add" class="btn btn-primary">
                  <i class="bi bi-plus-circle"></i> Add Medicine
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>