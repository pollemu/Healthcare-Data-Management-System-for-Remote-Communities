<?php
require_once '../crud.php';

class DashboardFunctions {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Fetch total number of patients
    public function getTotalPatients() {
        $stmt = $this->conn->query("CALL GetAllPatients()");
        if (!$stmt) {
            die("Stored procedure failed");
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);  // fixed
        $stmt->closeCursor(); // important for PDO after CALL
        return $row['totalPatients'] ?? 0;
    }

    // Fetch average patients per day for the past 7 days
    public function getAveragePatientsPerDay() {
        $stmt = $this->conn->query("CALL get_average_patients_per_day()"); // Update to use stored procedure
        if (!$stmt) {
            die("Stored procedure failed");
        }

        // Assuming this returns daily averages for the past week or a specified period
        $patientsData = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Example structure: day (e.g., Mon, Tue, etc.) and patient count
            $patientsData[] = $row['avgPerDay']; // Adjust field as necessary
        }

        $stmt->closeCursor();
        return $patientsData; // Return an array of daily averages
    }
}
