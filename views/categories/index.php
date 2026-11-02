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
        <h2 style="margin: 0;">Kategori Produk</h2>
        <a href="index.php?action=category_create" class="btn btn-green">+ Tambah Kategori</a>
    </div>
    
    <div style="overflow-x: auto;">
        <table id="tabelKategori" class="display" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="text-align: left;">ID Kategori</th>
                    <th style="text-align: left;">Nama Kategori</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td>KTG-00<?= $cat['id'] ?></td>
                    <td style="font-weight: bold;"><?= $cat['name'] ?></td>
                    <td style="text-align: center;">
                        <a href="index.php?action=category_edit&id=<?= $cat['id'] ?>" class="btn btn-blue" style="margin-right: 5px; padding: 6px 12px; font-size: 0.8rem;">✎ Edit</a>
                        <a href="index.php?action=category_delete&id=<?= $cat['id'] ?>" class="btn btn-red" style="padding: 6px 12px; font-size: 0.8rem;" onclick="return confirm('Hapus kategori ini?')">🗑 Hapus</a>
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
            $('#tabelKategori').DataTable({
                "language": {
                    "search": "Cari Kategori:",
                    "lengthMenu": "Tampilkan _MENU_ baris",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ kategori",
                    "infoEmpty": "Tidak ada data kategori",
                    "zeroRecords": "Kategori tidak ditemukan",
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