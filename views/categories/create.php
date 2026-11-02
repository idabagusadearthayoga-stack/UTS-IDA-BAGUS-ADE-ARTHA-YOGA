<?php include 'views/layouts/header.php'; ?>
    <div style="max-width: 500px; margin: auto;">
        <h2>Tambah Kategori Baru</h2>
        <form action="index.php?action=category_store" method="POST">
            <div class="form-group">
                <label>Nama Kategori (Contoh: Gaun, Kemeja)</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green" style="width: 100%;">Simpan Kategori</button>
        </form>
    </div>
<?php include 'views/layouts/footer.php'; ?>