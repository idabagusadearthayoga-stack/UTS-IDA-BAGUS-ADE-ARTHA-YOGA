<?php
require_once 'models/SaleModel.php';
class SaleController {
    private $model;
    public function __construct($db) { $this->model = new SaleModel($db); }

    public function index() {
        $sales = $this->model->getAllSales();
        require 'views/sales/index.php';
    }
    // Fitur Batalkan Transaksi
    public function delete() {
        if(isset($_GET['id'])) {
            $this->model->deleteSale($_GET['id']);
        }
        header("Location: index.php?action=sales");
    }

    // Fitur Cetak Ulang Struk
    public function reprint() {
        $id = $_GET['id'];
        $sale = $this->model->getSaleById($id);
        $details = $this->model->getSaleDetails($id);
        
        // Panggil tampilan struk cetak ulang
        require 'views/sales/reprint.php';
    }
    // Tampilkan Halaman Home (Dashboard)
    public function dashboard() {
        // Cek apakah ada request pencarian bulan
        $selectedMonth = isset($_GET['filter_month']) ? $_GET['filter_month'] : null;
        
        $stats = $this->model->getDashboardStats($selectedMonth);
        require 'views/home.php';
    }
}
?>