<?php
require_once 'db.php';

class Crud {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // // Create a new patient using the stored procedure
    public function create($first_name, $middle_name, $last_name, $age, $sex, $contact_number, $address, $blood_type, $date_of_birth, $height, $weight, $photo) {
        // Updated query to match the column names in the database
        $stmt = $this->conn->prepare("CALL AddPatient(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $middle_name, $last_name, $age, $sex, $contact_number, $address, $blood_type, $date_of_birth, $height, $weight, $photo]);
    }
    

    // Read a patient by ID using the stored procedure
    public function read($id) {
        $stmt = $this->conn->prepare("CALL GetPatient(?)");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update a patient's details using the stored procedure
    public function update($id, $first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $height, $weight, $date_of_birth, $photo) {
        $stmt = $this->conn->prepare("CALL UpdatePatient(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $id,
            $first_name,
            $middle_name,
            $last_name,
            $age,
            $sex,
            $contact,
            $address,
            $blood,
            $height,
            $weight,
            $date_of_birth,
            $photo
        ]);
    }
    

    // Delete a patient by ID using the stored procedure
    public function delete($id) {
        $stmt = $this->conn->prepare("CALL RemovePatient(?)");
        return $stmt->execute([$id]);
    }

    // Get all patients using the stored procedure
    public function getAll() {
        $stmt = $this->conn->prepare("CALL GetAllPatientss()");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
