<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $blood = $_POST['blood'];
    $history = $_POST['history'];
    $condition = $_POST['condition'];
    $reports = $_POST['reports'];

    $stmt = $conn->prepare("CALL AddNewPatient(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssss", $name, $age, $sex, $contact, $blood, $history, $condition, $reports);
    $stmt->execute();

    echo "<p>New patient added successfully.</p>";
    $stmt->close();
}

$conn->close();
?>

<h2>Add New Patient</h2>
<form action="add_patient.php" method="post">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Age: <input type="number" name="age" required></label><br>
    <label>Sex:
        <select name="sex" required>
            <option></option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select>
    </label><br>
    <label>Contact Number: <input type="text" name="contact" required></label><br>
    <label>Blood Type:
    <select name="blood" required>
        <option value=""></option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
        <option value="AB+">AB+</option>
        <option value="A">A</option>
    </select>
</label><br>
    <label>Medical History:<br><textarea name="history" rows="4" cols="50"></textarea></label><br>
    <label>Current Condition:<br><textarea name="condition" rows="4" cols="50"></textarea></label><br>
    <label>Imaging Reports:<br><textarea name="reports" rows="4" cols="50"></textarea></label><br>
    <button type="submit">Add Patient</button>
</form>

<form action="index.php" method="get">
    <button type="submit">← Go Back</button>
</form>
