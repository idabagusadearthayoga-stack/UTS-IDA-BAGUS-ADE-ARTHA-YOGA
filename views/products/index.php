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
        <h2 style="margin: 0;">Data Produk Pakaian</h2>
        <a href="index.php?action=product_create" class="btn btn-green">+ Tambah Produk</a>
    </div>
    
    <div style="overflow-x: auto;">
        <!-- Tambahkan ID "tabelProduk" untuk DataTables -->
        <table id="tabelProduk" class="display" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align: left;">Nama Pakaian</th>
                    <th style="text-align: left;">Kategori</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: center;">Stok</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $prod): ?>
                <tr>
                    <td style="font-weight: bold;"><?= $prod['name'] ?></td>
                    <td><?= $prod['category_name'] ?></td>
                    <td style="text-align: right;">Rp <?= number_format($prod['price'], 0, ',', '.') ?></td>
                    <td style="text-align: center;"><?= $prod['stock'] ?> Pcs</td>
                    <td style="text-align: center;">
                        <a href="index.php?action=product_edit&id=<?= $prod['id'] ?>" class="btn btn-blue" style="margin-right: 5px; padding: 6px 12px; font-size: 0.8rem;">✎ Edit</a>
                        <a href="index.php?action=product_delete&id=<?= $prod['id'] ?>" class="btn btn-red" style="padding: 6px 12px; font-size: 0.8rem;" onclick="return confirm('Hapus produk ini?')">🗑 Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Memanggil jQuery dan JS DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelProduk').DataTable({
                "language": {
                    "search": "Cari Produk:",
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ produk",
                    "infoEmpty": "Tidak ada data produk",
                    "zeroRecords": "Produk tidak ditemukan",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Maju ➔",
                        "previous": "⬅ Mundur"
                    }
                }
            });
        });
    </script>
<?php include 'views/layouts/footer.php'; ?>