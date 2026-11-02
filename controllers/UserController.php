<?php
require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }

    public function index() {
        $users = $this->model->getAll();
        require 'views/users/index.php';
    }

    public function create() {
        require 'views/users/create.php';
    }

    public function store() {
        // Menangkap semua data dari form registrasi
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // MENGGANTI $this->userModel MENJADI $this->model
        $this->model->insert($name, $email, $username, $password, $role);
        
        // Kembali ke halaman data kasir
        header("Location: index.php?action=users");
        exit;
    }

    public function edit() {
        $id = $_GET['id'];
        $user = $this->model->getById($id);
        require 'views/users/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        
        $this->model->update($id, $name, $email);
        header("Location: index.php?action=users");
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header("Location: index.php?action=users");
    }
}
?>