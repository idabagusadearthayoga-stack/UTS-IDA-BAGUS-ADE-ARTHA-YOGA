<?php include 'views/layouts/header.php'; ?>
    <div style="max-width: 500px; margin: auto;">
        <h2 style="text-align: center;">Edit Produk Pakaian</h2>
        <form action="index.php?action=product_update" method="POST">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            
            <div class="form-group">
                <label>Nama Pakaian</label>
                <input type="text" name="name" class="form-control" value="<?= $product['name'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Pilih Kategori</label>
                <select name="category_id" class="form-control" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
                            <?= $cat['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Harga Jual (Rp)</label>
                <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>
            
            <div class="form-group">
                <label>Stok Awal</label>
                <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
            </div>
            
            <button type="submit" class="btn btn-blue" style="width: 100%; margin-top: 10px;">Update Produk</button>
            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="index.php?action=products" style="color: #6b7280; text-decoration: none;">← Batal dan Kembali</a>
            </div>
        </form>
    </div>
<?php include 'views/layouts/footer.php'; ?>