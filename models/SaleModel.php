<?php
class SaleModel {
    private $conn;
    
    public function __construct($db) { 
        $this->conn = $db; 
    }
    
    public function getAllSales() {
        $query = "SELECT sales.*, users.name as kasir_name FROM sales LEFT JOIN users ON sales.user_id = users.id ORDER BY sales.id DESC";
        $result = $this->conn->query($query);
        $data = [];
        // Perbaikan kurung kurawal di sini:
        while ($row = $result->fetch_assoc()) { 
            $data[] = $row; 
        }
        return $data;
    }

    // Perbaikan penambahan $method di sini:
    public function insertSale($user_id, $total, $cart, $method) {
        $date = date('Y-m-d');
        
        // 1. Simpan ke tabel sales (Transaksi Utama) beserta Metode Pembayaran
        $stmt = $this->conn->prepare("INSERT INTO sales (date, total, user_id, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $date, $total, $user_id, $method);
        
        if($stmt->execute()){
            $sale_id = $this->conn->insert_id; 
            
            // 2. Simpan rincian ke tabel sale_details
            $stmt_detail = $this->conn->prepare("INSERT INTO sale_details (sale_id, product_id, qty, subtotal) VALUES (?, ?, ?, ?)");
            
            foreach($cart as $item) {
                $subtotal = $item['price'] * $item['qty'];
                $stmt_detail->bind_param("iiii", $sale_id, $item['id'], $item['qty'], $subtotal);
                $stmt_detail->execute();

                // 3. Otomatis kurangi stok
                $this->conn->query("UPDATE products SET stock = stock - {$item['qty']} WHERE id = {$item['id']}");
            }
            return true;
        }
        return false;
    }
    // Ambil data transaksi utama untuk dicetak ulang
    public function getSaleById($id) {
        $stmt = $this->conn->prepare("SELECT sales.*, users.name as kasir_name FROM sales LEFT JOIN users ON sales.user_id = users.id WHERE sales.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Ambil rincian barang untuk dicetak ulang
    public function getSaleDetails($sale_id) {
        $stmt = $this->conn->prepare("SELECT sale_details.*, products.name FROM sale_details LEFT JOIN products ON sale_details.product_id = products.id WHERE sale_details.sale_id = ?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        return $data;
    }

    // Hapus transaksi dan KEMBALIKAN STOK otomatis
    public function deleteSale($id) {
        // 1. Ambil data barang yang dibeli untuk dikembalikan stoknya
        $stmt = $this->conn->prepare("SELECT product_id, qty FROM sale_details WHERE sale_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while($row = $result->fetch_assoc()) {
            // Kembalikan stok ke tabel produk
            $this->conn->query("UPDATE products SET stock = stock + {$row['qty']} WHERE id = {$row['product_id']}");
        }
        
        // 2. Hapus rincian transaksi
        $this->conn->query("DELETE FROM sale_details WHERE sale_id = $id");
        
        // 3. Hapus transaksi utama
        $this->conn->query("DELETE FROM sales WHERE id = $id");
        return true;
    }
    // FUNGSI BARU UNTUK HOME DASHBOARD
        public function getDashboardStats($selectedMonth = null) {
        $stats = ['today' => 0, 'week' => 0, 'month' => 0, 'label_bulan' => '30 Hari Terakhir'];

        // 1. Total Penjualan Hari Ini
        $q1 = $this->conn->query("SELECT SUM(total) as total FROM sales WHERE DATE(date) = CURDATE()");
        if($row = $q1->fetch_assoc()) $stats['today'] = $row['total'] ?? 0;

        // 2. Total Penjualan 7 Hari Terakhir
        $q2 = $this->conn->query("SELECT SUM(total) as total FROM sales WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
        if($row = $q2->fetch_assoc()) $stats['week'] = $row['total'] ?? 0;

        // 3. Logika Filter Bulan
        if ($selectedMonth) {
            // Ambil Tahun dan Bulan dari input (Format YYYY-MM)
            $year = substr($selectedMonth, 0, 4);
            $month = substr($selectedMonth, 5, 2);
            
            // Nama bulan dalam bahasa Indonesia
            $bulan_indo = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
            $stats['label_bulan'] = 'Bulan ' . $bulan_indo[$month] . ' ' . $year;
            
            $stmt = $this->conn->prepare("SELECT SUM(total) as total FROM sales WHERE MONTH(date) = ? AND YEAR(date) = ?");
            $stmt->bind_param("ss", $month, $year);
            $stmt->execute();
            if($row = $stmt->get_result()->fetch_assoc()) $stats['month'] = $row['total'] ?? 0;
        } else {
            // Jika tidak ada bulan yang dicari, tampilkan 30 hari terakhir
            $q3 = $this->conn->query("SELECT SUM(total) as total FROM sales WHERE date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
            if($row = $q3->fetch_assoc()) $stats['month'] = $row['total'] ?? 0;
        }

        return $stats;
    }
    
}
?>