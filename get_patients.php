<?php
include 'db.php';

$sql = "CALL GetAllPatients()";
$result = $conn->query($sql);

if (!$result) {
    echo "<p>Error loading patients. Please try again later.</p>";
    error_log("Stored procedure failed: " . $conn->error); 
    exit;
}


echo "<h2>Patient List:</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>";
    echo "<strong>ID:</strong> {$row['patient_id']}<br>";
    echo "<strong>Name:</strong> {$row['patient_name']}<br>";
    echo "<strong>Age:</strong> {$row['age']}<br>";
    echo "<strong>Sex:</strong> {$row['sex']}<br>";
    echo "<strong>Contact:</strong> {$row['contact_number']}<br>";
    echo "<strong>Blood Type:</strong> {$row['blood_type']}<br>";
    echo "<strong>Medical History:</strong> {$row['medical_history']}<br>";
    echo "<strong>Current Condition:</strong> {$row['current_condition']}<br>";
    echo "<strong>Imaging Reports:</strong> {$row['imaging_reports']}<br>";
    echo "<hr>";
    echo "</li>";
}
echo "</ul>";

$conn->close();
?>

<form action="index.php" method="get">
    <button type="submit">← Go Back</button>
</form>
