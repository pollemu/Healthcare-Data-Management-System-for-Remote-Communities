<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['patient_id'];

    $stmt = $conn->prepare("CALL DeletePatientById(?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<p>Patient with ID $id deleted.</p>";
    $stmt->close();
}

$conn->close();
?>

<form action="delete_patient.php" method="post">
    <label>Patient ID to Delete: <input type="number" name="patient_id" required></label><br>
    <button type="submit">Delete Patient</button>
</form>

<form action="index.php" method="get">
    <button type="submit">← Go Back</button>
</form>
