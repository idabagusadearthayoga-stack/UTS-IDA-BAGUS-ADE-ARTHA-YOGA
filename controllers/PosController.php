<?php
require_once 'models/ProductModel.php';
require_once 'models/SaleModel.php';

class PosController {
    private $productModel;
    private $saleModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db);
        $this->saleModel = new SaleModel($db);
        // Siapkan keranjang kosong jika belum ada
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Tampilkan Halaman Mesin Kasir
    public function index() {
        $products = $this->productModel->getAll();
        $cart = $_SESSION['cart'];
        
        $total_belanja = 0;
        foreach($cart as $item) {
            $total_belanja += ($item['price'] * $item['qty']);
        }
        
        require 'views/sales/pos.php';
    }

    // Tambah Barang ke Keranjang
    public function add() {
        $id = $_POST['product_id'];
        // Ambil data produk berdasarkan ID dari post (pecah string)
        list($prod_id, $name, $price) = explode('|', $id);
        $qty = $_POST['qty'];

        // Cek apakah barang sudah ada di keranjang, jika ya, tambah jumlahnya
        $exists = false;
        foreach($_SESSION['cart'] as &$item) {
            if($item['id'] == $prod_id) {
                $item['qty'] += $qty;
                $exists = true;
                break;
            }
        }
        // Jika belum ada, masukkan sebagai item baru
        if(!$exists) {
            $_SESSION['cart'][] = [
                'id' => $prod_id, 'name' => $name, 'price' => $price, 'qty' => $qty
            ];
        }
        header("Location: index.php?action=pos");
    }

    // Hapus Barang dari Keranjang
    public function remove() {
        $id = $_GET['id'];
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['id'] == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Susun ulang urutan array (Reindex)
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
        header("Location: index.php?action=pos");
    }

    // Proses Pembayaran (Checkout)
    // 1. Tampilkan Halaman Pembayaran
    public function payment() {
        if(empty($_SESSION['cart'])) {
            header("Location: index.php?action=pos");
            return;
        }
        $total_belanja = 0;
        foreach($_SESSION['cart'] as $item) {
            $total_belanja += ($item['price'] * $item['qty']);
        }
        require 'views/sales/payment.php';
    }

    // 2. Proses Simpan Transaksi & Kalkulasi
    public function process() {
        if(empty($_SESSION['cart'])) {
            header("Location: index.php?action=pos");
            return;
        }

        $total = 0;
        foreach($_SESSION['cart'] as $item) { $total += ($item['price'] * $item['qty']); }

        $user_id = 1; // Asumsi Kasir ID 1
        $method = $_POST['payment_method'];
        $cash = $_POST['cash'];
        $change = $cash - $total;

        // Simpan ke Database
        if($this->saleModel->insertSale($user_id, $total, $_SESSION['cart'], $method)) {
            // Simpan data untuk dicetak di struk
            $_SESSION['receipt'] = [
                'cart' => $_SESSION['cart'],
                'total' => $total,
                'cash' => $cash,
                'change' => $change,
                'method' => $method,
                'date' => date('Y-m-d H:i:s')
            ];
            
            $_SESSION['cart'] = []; // Kosongkan keranjang
            header("Location: index.php?action=pos_receipt");
        } else {
            die("Gagal memproses pembayaran.");
        }
    }

    // 3. Tampilkan Halaman Struk
    public function receipt() {
        if(empty($_SESSION['receipt'])) {
            header("Location: index.php?action=sales");
            return;
        }
        $receipt = $_SESSION['receipt'];
        require 'views/sales/receipt.php';
    }
}
?>