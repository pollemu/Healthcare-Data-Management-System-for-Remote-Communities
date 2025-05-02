<?php
require_once 'db.php';
$pdo = (new Database())->getConnection();

if (isset($_POST['search'])) {
    $search_term = $_POST['search_term'];
    $stmt = $pdo->prepare("CALL searchIllness(:search_term)");
    $stmt->bindParam(':search_term', $search_term);
    $stmt->execute();
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
</head>
<body>
    <div class="container">
        <h1>Search for Illness and Medicine</h1>
        
        <form method="POST">
            <input type="text" name="search_term" placeholder="Search for illness..." required>
            <button type="submit" name="search">Search</button>
        </form>
        
        <?php if (isset($results)): ?>
            <div class="results">
                <h2>Search Results</h2>
                <?php if (count($results) > 0): ?>
                    <table>
                        <thead>
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
                <?php else: ?>
                    <p>No results found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
