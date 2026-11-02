<?php include 'views/layouts/header.php'; ?>

<div style="max-width: 500px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 25px;">
        <h2 style="color: #2c3e50; margin-bottom: 5px;">Edit Kategori</h2>
        <p style="color: #6b7280; font-size: 0.9rem;">Perbarui data kategori produk Butik Lusi & Pakan.</p>
    </div>

    <!-- Form mengarah ke action category_update -->
    <form action="index.php?action=category_update" method="POST">
        
        <!-- WAJIB: Input tersembunyi untuk mengirimkan ID Kategori ke Controller -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">

        <div class="form-group">
            <label>Nama Kategori</label>
            <!-- Menampilkan nama lama dari database langsung di dalam input -->
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($category['name']) ?>" placeholder="Masukkan nama kategori">
        </div>

        <button type="submit" class="btn btn-blue" style="width: 100%; padding: 12px; margin-top: 15px; font-size: 1rem;">Simpan Perubahan</button>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?action=categories" style="color: #6b7280; text-decoration: none; font-size: 0.9rem;">← Batal dan Kembali</a>
        </div>
    </form>
</div>

<?php 
if(file_exists('views/layouts/footer.php')) {
    include 'views/layouts/footer.php'; 
} else {
    echo '</div></div></body></html>';
}
?>