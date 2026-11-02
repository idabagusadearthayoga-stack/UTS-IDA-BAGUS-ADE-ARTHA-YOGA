<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk - Lusi & Pakan</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background: #e5e7eb; padding: 2rem; color: #000; }
        .receipt-container { background: #fff; width: 350px; margin: 0 auto; padding: 20px; border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .center { text-align: center; }
        hr { border-top: 1px dashed #000; border-bottom: none; margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        td { padding: 4px 0; vertical-align: top; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        
        /* Hilangkan tombol cetak saat diprint beneran */
        @media print {
            body { background: #fff; padding: 0; }
            .receipt-container { box-shadow: none; width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="receipt-container">
        <div class="center">
            <h2 style="margin: 0;">LUSI & PAKAN BALI</h2>
            <p style="margin: 5px 0; font-size: 0.85rem;">Jl. Raya Butik POS No. 1, Bali</p>
            <p style="margin: 0; font-size: 0.85rem;">Telp: 0812-3456-7890</p>
        </div>
        
        <hr>
        
        <p style="font-size: 0.85rem; margin: 5px 0;">Tanggal : <?= $receipt['date'] ?></p>
        <p style="font-size: 0.85rem; margin: 5px 0;">Metode  : <?= $receipt['method'] ?></p>
        
        <hr>
        
        <table>
            <?php foreach($receipt['cart'] as $item): ?>
            <tr>
                <td colspan="2"><?= $item['name'] ?></td>
            </tr>
            <tr>
                <td><?= $item['qty'] ?>x @ <?= number_format($item['price'], 0, ',', '.') ?></td>
                <td class="right"><?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <hr>
        
        <table>
            <tr class="bold">
                <td>TOTAL</td>
                <td class="right">Rp <?= number_format($receipt['total'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>TUNAI/DIBAYAR</td>
                <td class="right">Rp <?= number_format($receipt['cash'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>KEMBALIAN</td>
                <td class="right">Rp <?= number_format($receipt['change'], 0, ',', '.') ?></td>
            </tr>
        </table>
        
        <hr>
        
        <div class="center">
            <p style="font-size: 0.9rem; margin-bottom: 5px;">Terima Kasih Atas Kunjungan Anda!</p>
            <p style="font-size: 0.7rem; color: #555;">Sistem POS MVC Native</p>
        </div>
    </div>

    <!-- Tombol Aksi di Bawah Struk -->
    <div class="center no-print" style="margin-top: 2rem; display: flex; justify-content: center; gap: 15px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem;">🖨️ Cetak Struk</button>
        
        <a href="index.php?action=pos" style="padding: 10px 20px; background: #10b981; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 1rem;">Mulai Transaksi Baru</a>
    </div>

</body>
</html>