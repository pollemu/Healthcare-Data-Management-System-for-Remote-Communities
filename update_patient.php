<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $contact = $_POST['contact'];
    $blood = $_POST['blood'];
    $history = $_POST['history'];
    $condition = $_POST['condition'];
    $reports = $_POST['reports'];

    $stmt = $conn->prepare("CALL UpdatePatient(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isissssss", $id, $name, $age, $sex, $contact, $blood, $history, $condition, $reports);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Patient updated successfully.</p>";
    } else {
        echo "<p style='color: red;'>❌ Failed to update patient: " . $stmt->error . "</p>";
    }

    $stmt->close();
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();
}
?>

<h2>Update Patient</h2>

<?php if (!isset($patient)) { ?>
    <form method="get">
        <label>Enter Patient ID:</label>
        <input type="number" name="id" required>
        <button type="submit">Search</button>
    </form>
<?php } else { ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $patient['patient_id']; ?>">

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $patient['patient_name']; ?>" required><br><br>

        <label>Age:</label><br>
        <input type="number" name="age" value="<?php echo $patient['age']; ?>" required><br><br>

        <label>Sex:</label><br>
        <select name="sex" required>
            <option value="Male" <?php if ($patient['sex'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($patient['sex'] == 'Female') echo 'selected'; ?>>Female</option>
        </select><br><br>

        <label>Contact:</label><br>
        <input type="text" name="contact" value="<?php echo $patient['contact_number']; ?>" required><br><br>

        <label>Blood Type:</label><br>
        <select name="blood" required>
            <?php
            $types = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
            foreach ($types as $type) {
                $selected = ($patient['blood_type'] == $type) ? 'selected' : '';
                echo "<option value=\"$type\" $selected>$type</option>";
            }
            ?>
        </select><br><br>

        <label>Medical History:</label><br>
        <textarea name="history" required><?php echo $patient['medical_history']; ?></textarea><br><br>

        <label>Current Condition:</label><br>
        <textarea name="condition" required><?php echo $patient['current_condition']; ?></textarea><br><br>

        <label>Imaging Reports:</label><br>
        <textarea name="reports" required><?php echo $patient['imaging_reports']; ?></textarea><br><br>

        <button type="submit" name="update">Update Patient</button>
    </form>
<?php } ?>

<br>
<form action="index.php" method="get">
    <button type="submit">← Go Back</button>
</form>
