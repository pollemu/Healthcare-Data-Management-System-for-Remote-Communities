<?php
require_once 'db.php';

class Crud {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Create a new patient
    public function create($first_name, $last_name, $age, $sex, $contact, $address, $blood) {
        $stmt = $this->conn->prepare("INSERT INTO patients (first_name, last_name, age, sex, contact_number, address, blood_type) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $age, $sex, $contact, $address, $blood]);
    }

    // Read a patient by ID
    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update a patient's details
    public function update($id, $first_name, $last_name, $age, $sex, $contact, $address, $blood) {
        $stmt = $this->conn->prepare("UPDATE patients SET first_name = ?, last_name = ?, age = ?, sex = ?, 
                                      contact_number = ?, address = ?, blood_type = ?, updated_at = CURRENT_TIMESTAMP 
                                      WHERE patient_id = ?");
        return $stmt->execute([$first_name, $last_name, $age, $sex, $contact, $address, $blood, $id]);
    }

    // Delete a patient by ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM patients WHERE patient_id = ?");
        return $stmt->execute([$id]);
    }

    // Get all patients
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM patients");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
