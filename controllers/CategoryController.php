<?php
require_once 'models/CategoryModel.php';

class CategoryController {
    
    /** @var CategoryModel */
    private $model;

    public function __construct($db) { 
        $this->model = new CategoryModel($db); 
    }

    public function index() {
        $categories = $this->model->getAll();
        require 'views/categories/index.php';
    }
    
    public function edit($id) {
        $category = $this->model->getById($id);
        require 'views/categories/edit.php';
    }
    
    public function create() { 
        require 'views/categories/create.php'; 
    }
    
    public function store() {
        $this->model->insert($_POST['name']);
        header("Location: index.php?action=categories");
        exit;
    }
    
    public function delete() {
        $this->model->delete($_GET['id']);
        header("Location: index.php?action=categories");
        exit;
    }
    
    // Fungsi ini diperbaiki untuk menangkap POST dari form
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        
        $this->model->update($id, $name);
        header("Location: index.php?action=categories");
        exit;
    }
}
?>