<?php
require_once 'models/UserModel.php';

class AuthController {
    private $userModel;
    
    public function __construct($db) { 
        $this->userModel = new UserModel($db); 
    }

    public function login() { 
        require 'views/login.php'; 
    }

    public function process() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $user = $this->userModel->checkLogin($username, $password);
        
        if($user) {
            // Simpan data dan hak akses (role) ke Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role']; 
            header("Location: index.php?action=home");
        } else {
            $error = "Username atau password salah!";
            require 'views/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
    }
}
?>