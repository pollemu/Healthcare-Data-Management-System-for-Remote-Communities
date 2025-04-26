<?php
require_once 'crudInventory.php';
$inventory = new CrudInventory();

$medicines = $inventory->getAllMedicines();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicine Inventory</title>
    <link rel="stylesheet" href="inventorycss.css">
</head>
<body>
    <h1>Medicine Inventory</h1>

    <button id="openModalBtn">Add New Medicine</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Expiration Date</th>
                <th>Description</th>
                <th>Dosage</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicines as $medicine): ?>
                <tr>
                    <td><?= $medicine['medicine_id'] ?></td>
                    <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                    <td><?= $medicine['quantity'] ?></td>
                    <td><?= $medicine['expiration_date'] ?></td>
                    <td><?= htmlspecialchars($medicine['description']) ?></td>
                    <td><?= htmlspecialchars($medicine['dosage']) ?></td>
                    <td><?= htmlspecialchars($medicine['type']) ?></td>
                    <td>
                        <form action="update_medicine.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $medicine['medicine_id'] ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form action="del_medicine.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $medicine['medicine_id'] ?>">
                            <button type="submit" onclick="return confirm('Delete this medicine?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="medicineModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php include 'add_medicine.php'; ?>
        </div>
    </div>

    <script>
        const modal = document.getElementById("medicineModal");
        const btn = document.getElementById("openModalBtn");
        const span = document.getElementsByClassName("close")[0];

        btn.onclick = () => modal.style.display = "block";
        span.onclick = () => modal.style.display = "none";
        window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; };
    </script>
</body>
</html>
