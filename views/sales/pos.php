<?php include 'views/layouts/header.php'; ?>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>🛒 Mesin Kasir Lusi & Pakan</h2>
        <a href="index.php?action=sales" class="btn btn-blue">Lihat Riwayat Transaksi</a>
    </div>

    <!-- FORM INPUT BARANG -->
    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; border: 1px solid #e5e7eb; margin-bottom: 2rem;">
        <form action="index.php?action=pos_add" method="POST" style="display: flex; gap: 10px; align-items: flex-end;">
            <div style="flex-grow: 1;">
                <label style="font-weight: bold; margin-bottom: 5px; display: block;">Pilih Produk</label>
                <select name="product_id" class="form-control" required>
                    <option value="">-- Cari dan Pilih Pakaian --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'].'|'.$p['name'].'|'.$p['price'] ?>">
                            <?= $p['name'] ?> - Rp <?= number_format($p['price'], 0, ',', '.') ?> (Stok: <?= $p['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="width: 100px;">
                <label style="font-weight: bold; margin-bottom: 5px; display: block;">Qty</label>
                <input type="number" name="qty" class="form-control" value="1" min="1" required>
            </div>
            <div>
                <button type="submit" class="btn btn-green" style="padding: 0.8rem 1.5rem; font-size: 1rem;">+ Tambah</button>
            </div>
        </form>
    </div>

    <!-- TABEL KERANJANG BELANJA -->
    <h3>Daftar Belanjaan Saat Ini</h3>
    <table style="margin-bottom: 2rem;">
        <thead>
            <tr>
                <th>Nama Pakaian</th>
                <th>Harga Satuan</th>
                <th style="text-align: center;">Qty</th>
                <th>Subtotal</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($cart)): ?>
                <tr><td colspan="5" style="text-align: center; color: #888;">Keranjang belanja masih kosong.</td></tr>
            <?php else: ?>
                <?php foreach ($cart as $item): ?>
                <tr>
                    <td style="font-weight: bold;"><?= $item['name'] ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td style="text-align: center;"><?= $item['qty'] ?></td>
                    <td style="font-weight: bold; color: #059669;">Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></td>
                    <td style="text-align: center;">
                        <a href="index.php?action=pos_remove&id=<?= $item['id'] ?>" style="color: #ef4444; text-decoration: none; font-weight: bold; font-size: 1.2rem;">✖</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- TOTAL & CHECKOUT -->
    <div style="background: #1f2937; color: white; padding: 2rem; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="font-size: 1.2rem; margin-bottom: 5px; color: #9ca3af;">Total Tagihan:</p>
            <h1 style="font-size: 2.5rem; margin: 0; color: #10b981;">Rp <?= number_format($total_belanja, 0, ',', '.') ?></h1>
        </div>
        <?php if(!empty($cart)): ?>
            <a href="index.php?action=pos_payment" class="btn btn-green" style="padding: 1rem 3rem; font-size: 1.3rem; border-radius: 50px;">PROSES PEMBAYARAN ➔</a>
        <?php endif; ?>
    </div>

<?php include 'views/layouts/footer.php'; ?>