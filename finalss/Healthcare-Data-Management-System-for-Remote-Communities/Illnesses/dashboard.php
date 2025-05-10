<?php
require_once '../db.php';
$pdo = (new Database())->getConnection();

$search_term = '';
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search_term = $_POST['search_term'];
    $stmt = $pdo->prepare("CALL searchIllness(:search_term)");
    $stmt->bindParam(':search_term', $search_term);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Show all data by default
    $stmt = $pdo->query("CALL getAllIllnesses()");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Medicine Search</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <div class="card border-0 shadow-sm mb-4 p-4 bg-light">
  <div class="d-flex align-items-center">
    <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
      <i class="bi bi-capsule-pill fs-3 text-primary"></i>
    </div>
    <div>
      <h4 class="fw-bold text-dark mb-1">Illness and Medicine</h4>
      <p class="text-muted mb-0">Access treatments, symptoms, and dosage guidelines easily</p>
    </div>
  </div>
</div>



    <?php if (!empty($search_term)): ?>
        <a href="javascript:history.back()" class="btn btn-outline-danger rounded-pill ms-3 px-4 py-3">Clear</a>
    <?php endif; ?>
</form>


        
        <?php if (isset($results)): ?>
            <div class="results">
                <?php if (count($results) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Illness Name</th>
                                    <th>Symptoms</th>
                                    <th>Medicine Name</th>
                                    <th>Times per Day</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['illness_name']) ?></td>
                                        <td><?= htmlspecialchars($row['symptoms']) ?></td>
                                        <td><?= htmlspecialchars($row['medicine_name']) ?></td>
                                        <td><?= htmlspecialchars($row['dosage_per_day']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="alert alert-warning">No results found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    

   
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('.table').DataTable({
      paging: true,
      ordering: true,
      info: true,
      responsive: true,
      columnDefs: [
        { orderable: true, targets: [0, 1, 2, 3] }
      ]
    });
  });
</script>


    
    
</body>
</html>
