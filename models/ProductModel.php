<?php
class ProductModel {
    private $conn;
    public function __construct($db) { $this->conn = $db; }
    
    public function getAll() {
        $query = "SELECT products.*, categories.name as category_name FROM products LEFT JOIN categories ON products.category_id = categories.id";
        $result = $this->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) { $data[] = $row; }
        return $data;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function insert($name, $price, $stock, $category_id) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, stock, category_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $name, $price, $stock, $category_id);
        return $stmt->execute();
    }

    public function update($id, $name, $price, $stock, $category_id) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, price=?, stock=?, category_id=? WHERE id=?");
        $stmt->bind_param("siiii", $name, $price, $stock, $category_id, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>