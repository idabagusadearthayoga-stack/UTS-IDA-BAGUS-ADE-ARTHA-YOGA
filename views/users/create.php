<?php include 'views/layouts/header.php'; ?>

<!-- Membatasi lebar form agar rapi di tengah kotak putih (card) -->
<div style="max-width: 500px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 25px;">
        <h2 style="color: #2c3e50; margin-bottom: 5px;">Registrasi Kasir Baru</h2>
        <p style="color: #6b7280; font-size: 0.9rem;">Tambahkan akun pegawai baru untuk akses ke sistem POS Butik Lusi & Pakan.</p>
    </div>

    <form action="index.php?action=user_store" method="POST">
        <div class="form-group">
            <label>Nama Lengkap Kasir</label>
            <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap">
        </div>

        <div class="form-group">
            <label>Email Akses Login</label>
            <input type="email" name="email" class="form-control" required placeholder="contoh: kasir.ayu@lusipakan.com">
        </div>

        <!-- Garis pembatas yang lebih rapi dan estetis -->
        <hr style="border: none; height: 1px; background-color: #e5e7eb; margin: 25px 0;">
        <h4 style="color: #1f2937; margin-top: 0; margin-bottom: 15px; text-align: center;">Detail Login Akun</h4>

        <div class="form-group">
            <label>Username (Untuk Login)</label>
            <input type="text" name="username" class="form-control" required placeholder="Contoh: kasir_ayu">
        </div>

        <div class="form-group">
            <label>Password / Sandi</label>
            <input type="text" name="password" class="form-control" required placeholder="Buat sandi untuk kasir">
        </div>

        <div class="form-group">
            <label>Hak Akses (Role)</label>
            <select name="role" class="form-control" required>
                <option value="kasir">Kasir (Akses Terbatas)</option>
                <option value="admin">Admin (Akses Penuh)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-green" style="width: 100%; padding: 12px; margin-top: 15px; font-size: 1rem;">Simpan Data Kasir</button>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?action=users" style="color: #6b7280; text-decoration: none; font-size: 0.9rem;">← Batal dan Kembali</a>
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