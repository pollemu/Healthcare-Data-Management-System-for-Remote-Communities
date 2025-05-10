<?php
require_once '../crud.php';

class DashboardFunctions {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ✅ Call: get_total_patients()
    public function getTotalPatients() {
        $stmt = $this->conn->query("CALL GetAllPatients()");
        if (!$stmt) {
            die("Stored procedure failed");
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);  // Only one row expected
        $stmt->closeCursor(); // Important for freeing resources
        return $row['totalPatients'] ?? 0;
    }

    // ✅ Fixed: Fetch average patients per day for the past 7 days
    public function getAveragePatientsPerDay() {
        $stmt = $this->conn->query("CALL get_average_patients_per_day()");
        if (!$stmt) {
            die("Stored procedure failed");
        }

        $total = 0;
        $count = 0;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Adjust field name if needed
            $total += $row['avgPerDay'];
            $count++;
        }

        $stmt->closeCursor();
        return $count > 0 ? round($total / $count, 2) : 0;
    }
}
