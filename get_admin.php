<?php
include 'db.php';

$sql = "CALL GetAllAdmins()";
$result = $conn->query($sql);

if (!$result) {
    echo "<p>Error loading admins. Please try again later.</p>";
    error_log("Stored procedure failed: " . $conn->error); 
    exit;
}


while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['admin_id'] . " | Name: " . $row['admin_name'] . " | Role: " . $row['role'] . "<br>";
}

$conn->close();
?>

<form action="index.php" method="get">
    <button type="submit">← Go Back</button>
</form>