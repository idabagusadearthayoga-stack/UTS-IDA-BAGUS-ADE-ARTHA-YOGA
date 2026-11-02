<?php
session_start();

require_once 'config/database.php';

// Panggil semua Controller
require_once 'controllers/AuthController.php'; // Tambahan untuk Login
require_once 'controllers/UserController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/SaleController.php';
require_once 'controllers/PosController.php'; 

// Inisialisasi semua Controller
$authController = new AuthController($conn); // Tambahan untuk Login
$userController = new UserController($conn);
$categoryController = new CategoryController($conn);
$productController = new ProductController($conn);
$saleController = new SaleController($conn);
$posController = new PosController($conn); 

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// ==========================================
// 1. CEK LOGIN (Jika belum login, lempar ke form login)
if (!isset($_SESSION['user_id']) && $action != 'login' && $action != 'login_process') {
    header("Location: index.php?action=login");
    exit;
}

// 2. CEK HAK AKSES KASIR (Blokir akses ke halaman terlarang)
$forbidden_for_kasir = [
    'categories', 'category_create', 'category_store', 'category_edit', 'category_update', 'category_delete',
    'products', 'product_create', 'product_store', 'product_edit', 'product_update', 'product_delete',
    'users', 'user_create', 'user_store', 'user_edit', 'user_update', 'user_delete',
    'sale_delete' // Kasir tidak boleh menghapus/membatalkan transaksi
];

if (isset($_SESSION['role']) && $_SESSION['role'] == 'kasir' && in_array($action, $forbidden_for_kasir)) {
    echo "<script>alert('AKSES DITOLAK! Anda login sebagai Kasir dan tidak berhak mengakses halaman ini.'); window.location.href='index.php?action=home';</script>";
    exit;
}
// ==========================================

switch ($action) {
    // Rute Login & Logout
    case 'login': $authController->login(); break;
    case 'login_process': $authController->process(); break;
    case 'logout': $authController->logout(); break;

    // Rute Halaman Utama
    case 'home': $saleController->dashboard(); break;
    case 'about': require 'views/about.php'; break;
    
    // Rute Users
    case 'users': $userController->index(); break;
    case 'user_create': $userController->create(); break;
    case 'user_store': $userController->store(); break;
    case 'user_edit': $userController->edit(); break;
    case 'user_update': $userController->update(); break;
    case 'user_delete': $userController->delete(); break;

    // Rute Categories
    case 'categories': $categoryController->index(); break;
    case 'category_create': $categoryController->create(); break;
    case 'category_store': $categoryController->store(); break;
    case 'category_edit': $id = $_GET['id']; $categoryController->edit($id); break;
    case 'category_update': $categoryController->update(); break;
    case 'category_delete': $categoryController->delete(); break;

    // Rute Products
    case 'products': $productController->index(); break;
    case 'product_create': $productController->create(); break;
    case 'product_store': $productController->store(); break;
    case 'product_edit': $productController->edit(); break;
    case 'product_update': $productController->update(); break;
    case 'product_delete': $productController->delete(); break;

    // Rute MESIN KASIR (POS)
    case 'pos': $posController->index(); break;
    case 'pos_add': $posController->add(); break;
    case 'pos_remove': $posController->remove(); break;
    case 'pos_payment': $posController->payment(); break;
    case 'pos_process': $posController->process(); break;
    case 'pos_receipt': $posController->receipt(); break;

    // Rute Data Transaksi
    case 'sales': $saleController->index(); break;
    case 'sale_delete': $saleController->delete(); break;
    case 'sale_reprint': $saleController->reprint(); break; 

    default: 
        $saleController->dashboard(); 
        break;
}
?>