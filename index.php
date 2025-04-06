<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color:rgb(119, 158, 203);
            color: white;
            padding: 20px;
            text-align: left;
            font-size: 28px;
            font-weight: bold;
        }
        main {
            text-align: center;
            padding: 40px;
        }
        .system-name {
            margin-bottom: 50px;
            font-size: 24px;
            font-weight: 500;
            color: #555;
        }
        .button-row {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 30px;
        }
        form {
            margin: 0;
        }
        button {
            width: 220px;
            height: 80px;
            font-size: 18px;
            font-weight: bold;
            background-color:rgb(119, 158, 203);
            border: none;
            cursor: pointer;
            border-radius: 8px;
            color: white;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color:rgb(119, 158, 203);
        }
        button:active {
            background-color:rgb(119, 158, 203);
        }
    </style>
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

        <div class="button-row">
            <form action="update_patient.php" method="get">
                <button type="submit">Update Patient</button>
            </form>
            <form action="delete_patient.php" method="get">
                <button type="submit">Delete Patient</button>
            </form>
        </div>
    </main>
</body>
</html>
