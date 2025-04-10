<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Admin Panel</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>Healthcare Admin Panel</header>
    <main>
        <div class="system-name">HEALTHCARE SYSTEM</div>

        <div class="button-row">
            <form action="add_patient.php" method="get">
                <button type="submit">Add Patient</button>
            </form>
            <form action="get_patients.php" method="get">
                <button type="submit">View Patients</button>
            </form>
        </div>
    </main>
</body>
</html>
