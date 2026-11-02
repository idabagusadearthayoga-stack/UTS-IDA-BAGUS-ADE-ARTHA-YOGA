<?php include 'views/layouts/header.php'; ?>
    <!-- Memanggil CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <style>
        .dataTables_wrapper { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-top: 1rem; }
        .dataTables_filter input { padding: 5px 10px; border: 1px solid #ccc; border-radius: 4px; margin-left: 10px; }
        .dataTables_length select { padding: 5px; border-radius: 4px; }
        table.dataTable tbody tr:hover { background-color: #f1f5f9; }
    </style>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h2 style="margin: 0;">Riwayat Transaksi Butik</h2>
        <a href="index.php?action=pos" class="btn btn-blue" style="white-space: nowrap; padding: 10px 20px; font-size: 1rem; display: inline-flex; align-items: center; gap: 8px;">
            🛒 Buka Mesin Kasir
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table id="tabelTransaksi" class="display" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align: left;">No. Struk</th>
                    <th style="text-align: left;">Tanggal</th>
                    <th style="text-align: left;">Kasir</th>
                    <th style="text-align: center;">Metode</th>
                    <th style="text-align: right;">Total Belanja</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($sales)): ?>
                    <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td style="font-weight: bold;">INV-<?= $sale['id'] ?></td>
                        <td><?= $sale['date'] ?></td>
                        <td><?= $sale['kasir_name'] ?></td>
                        
                        <td style="text-align: center;">
                            <?php if(($sale['payment_method'] ?? 'Cash') == 'QRIS'): ?>
                                <span style="background: #e0e7ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">📱 QRIS</span>
                            <?php else: ?>
                                <span style="background: #dcfce7; color: #15803d; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">💵 Cash</span>
                            <?php endif; ?>
                        </td>

                        <td style="font-weight: bold; color: #059669; text-align: right;">Rp <?= number_format($sale['total'], 0, ',', '.') ?></td>
                        
                        <!-- Kolom Aksi -->
                        <td style="text-align: center;">
                            <a href="index.php?action=sale_reprint&id=<?= $sale['id'] ?>" class="btn btn-blue" target="_blank" style="padding: 4px 8px; font-size: 0.8rem; margin-right: 5px;">🖨️ Cetak</a>
                            
                            <!-- HANYA ADMIN YANG BISA MELIHAT TOMBOL BATAL -->
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <a href="index.php?action=sale_delete&id=<?= $sale['id'] ?>" class="btn btn-red" style="padding: 4px 8px; font-size: 0.8rem;" onclick="return confirm('Batalkan transaksi ini? Stok barang akan dikembalikan secara otomatis.')">❌ Batal</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Memanggil jQuery dan JS DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelTransaksi').DataTable({
                "language": {
                    "search": "Cari Transaksi:",
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ transaksi",
                    "infoEmpty": "Tidak ada data transaksi",
                    "zeroRecords": "Data transaksi tidak ditemukan",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Maju ➔",
                        "previous": "⬅ Mundur"
                    }
                },
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
<?php include 'views/layouts/footer.php'; ?>