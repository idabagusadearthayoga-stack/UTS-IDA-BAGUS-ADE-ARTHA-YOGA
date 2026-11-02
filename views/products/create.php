<?php include 'views/layouts/header.php'; ?>
    <div style="max-width: 500px; margin: auto;">
        <h2>Tambah Produk Pakaian</h2>
        <form action="index.php?action=product_store" method="POST">
            <div class="form-group">
                <label>Nama Pakaian</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Pilih Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Harga Jual (Rp)</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green" style="width: 100%;">Simpan Produk</button>
        </form>
    </div>
<?php include 'views/layouts/footer.php'; ?>