<?php
require_once 'db.php';

class CrudInventory {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addMedicine($name, $quantity, $expiration, $description, $dosage, $type) {
        $stmt = $this->conn->prepare("CALL add_medicine(?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $quantity, $expiration, $description, $dosage, $type]);
    }

    public function updateMedicine($id, $name, $quantity, $expiration, $description, $dosage, $type) {
        $stmt = $this->conn->prepare("CALL update_medicine(?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$id, $name, $quantity, $expiration, $description, $dosage, $type]);
    }

    public function deleteMedicine($id) {
        $stmt = $this->conn->prepare("CALL delete_medicine(?)");
        return $stmt->execute([$id]);
    }

    public function getAllMedicines() {
        $stmt = $this->conn->prepare("CALL get_all_medicines()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMedicine($id) {
        $stmt = $this->conn->prepare("CALL get_medicine(?)");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>