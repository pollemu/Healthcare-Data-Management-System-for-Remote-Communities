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

        $row = $stmt->fetch(PDO::FETCH_ASSOC);  // fixed
        $stmt->closeCursor(); // important for PDO after CALL
        return $row['totalPatients'] ?? 0;
    }

    // ✅ Call: get_average_patients_per_day()
    public function getAveragePatientsPerDay() {
        $stmt = $this->conn->query("CALL get_average_patients_per_day()");
        if (!$stmt) {
            die("Stored procedure failed");
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);  // fixed
        $stmt->closeCursor();
        return round($row['avgPerDay'] ?? 0, 2);
        
    }
}

