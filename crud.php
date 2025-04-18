<?php
require_once 'db.php';

class Crud {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Create a new patient
    public function create($first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $date_of_birth, $height, $weight, $photo) {
        $stmt = $this->conn->prepare("INSERT INTO patients (first_name, middle_name, last_name, age, sex, contact_number, address, blood_type, date_of_birth, height, weight, photo) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $date_of_birth, $height, $weight, $photo]);
    }
    

    // Read a patient by ID
    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Update a patient's details (Modified to accept all 12 fields)
    public function update($id, $first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $height, $weight, $date_of_birth) {
        $stmt = $this->conn->prepare("UPDATE patients SET 
                                      first_name = ?, 
                                      middle_name = ?, 
                                      last_name = ?, 
                                      age = ?, 
                                      sex = ?, 
                                      contact_number = ?, 
                                      address = ?, 
                                      blood_type = ?, 
                                      height = ?, 
                                      weight = ?, 
                                      date_of_birth = ?, 
                                      updated_at = CURRENT_TIMESTAMP 
                                      WHERE patient_id = ?");
        return $stmt->execute([$first_name, $middle_name, $last_name, $age, $sex, $contact, $address, $blood, $height, $weight, $date_of_birth, $id]);
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
