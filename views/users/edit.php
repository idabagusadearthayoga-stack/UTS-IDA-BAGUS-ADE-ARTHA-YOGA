<?php include 'views/layouts/header.php'; ?>
    <div style="max-width: 500px; margin: auto;">
        <h2 style="text-align: center;">Edit Data Kasir</h2>
        <p style="color: #6b7280; margin-bottom: 2rem; text-align: center;">Perbarui informasi akun pegawai Butik Lusi & Pakan Bali.</p>
        
        <form action="index.php?action=user_update" method="POST">
            <!-- Input hidden untuk mengirim ID -->
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            
            <div class="form-group">
                <label>Nama Lengkap Kasir</label>
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email Akses Login</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>
            
            <div style="margin-top: 2.5rem;">
                <button type="submit" class="btn btn-blue" style="width: 100%; padding: 0.9rem; font-size: 1rem;">Update Data Kasir</button>
            </div>
            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="index.php?action=users" style="color: #6b7280; text-decoration: none; font-size: 0.9rem; font-weight: 500;">← Batal dan Kembali</a>
            </div>
        </form>
    </div>
<?php include 'views/layouts/footer.php'; ?>