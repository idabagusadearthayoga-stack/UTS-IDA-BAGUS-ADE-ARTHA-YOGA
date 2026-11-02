<?php
class CategoryModel {
    private $conn;
    public function __construct($db) { $this->conn = $db; }
    
    public function getAll() {
        $result = $this->conn->query("SELECT * FROM categories");
        $data = [];
        while ($row = $result->fetch_assoc()) { $data[] = $row; }
        return $data;
    }
    
    // Fungsi ini dipindah ke sini (Model)
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function insert($name) {
        $stmt = $this->conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    public function update($id, $name) {
        $stmt = $this->conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }
}
?>