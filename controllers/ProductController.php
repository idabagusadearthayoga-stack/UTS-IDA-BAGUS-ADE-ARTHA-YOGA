<?php
require_once 'models/ProductModel.php';
require_once 'models/CategoryModel.php'; 

class ProductController {
    private $model;
    private $categoryModel;
    
    public function __construct($db) { 
        $this->model = new ProductModel($db); 
        $this->categoryModel = new CategoryModel($db);
    }

    public function index() {
        $products = $this->model->getAll();
        require 'views/products/index.php';
    }
    public function create() { 
        $categories = $this->categoryModel->getAll(); 
        require 'views/products/create.php'; 
    }
    public function store() {
        $this->model->insert($_POST['name'], $_POST['price'], $_POST['stock'], $_POST['category_id']);
        header("Location: index.php?action=products");
    }

    // Fitur Tampilkan halaman edit
    public function edit() {
        $id = $_GET['id'];
        $product = $this->model->getById($id);
        $categories = $this->categoryModel->getAll(); // Ambil list kategori untuk dropdown
        require 'views/products/edit.php';
    }

    // Fitur Proses update data
    public function update() {
        $this->model->update($_POST['id'], $_POST['name'], $_POST['price'], $_POST['stock'], $_POST['category_id']);
        header("Location: index.php?action=products");
    }

    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?action=products");
    }
}
?>