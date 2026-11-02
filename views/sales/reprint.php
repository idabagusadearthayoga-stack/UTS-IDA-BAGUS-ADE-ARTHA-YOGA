<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Ulang Struk - INV-<?= $sale['id'] ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background: #e5e7eb; padding: 2rem; color: #000; }
        .receipt-container { background: #fff; width: 350px; margin: 0 auto; padding: 20px; border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .center { text-align: center; }
        hr { border-top: 1px dashed #000; border-bottom: none; margin: 15px 0; }
        table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        td { padding: 4px 0; vertical-align: top; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        
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
            <p style="margin: 5px 0; font-size: 0.85rem;">(Cetak Ulang Struk)</p>
            <p style="margin: 0; font-size: 0.85rem;">Telp: 0812-3456-7890</p>
        </div>
        
        <hr>
        
        <p style="font-size: 0.85rem; margin: 5px 0;">No. Struk : INV-<?= $sale['id'] ?></p>
        <p style="font-size: 0.85rem; margin: 5px 0;">Tanggal   : <?= $sale['date'] ?></p>
        <p style="font-size: 0.85rem; margin: 5px 0;">Kasir     : <?= $sale['kasir_name'] ?></p>
        <p style="font-size: 0.85rem; margin: 5px 0;">Metode    : <?= $sale['payment_method'] ?? 'Cash' ?></p>
        
        <hr>
        
        <table>
            <?php foreach($details as $item): ?>
            <tr>
                <td colspan="2"><?= $item['name'] ?></td>
            </tr>
            <tr>
                <!-- Harga satuan didapat dari subtotal dibagi qty -->
                <td><?= $item['qty'] ?>x @ <?= number_format($item['subtotal'] / $item['qty'], 0, ',', '.') ?></td>
                <td class="right"><?= number_format($item['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <hr>
        
        <table>
            <tr class="bold">
                <td>TOTAL</td>
                <td class="right">Rp <?= number_format($sale['total'], 0, ',', '.') ?></td>
            </tr>
        </table>
        
        <hr>
        
        <div class="center">
            <p style="font-size: 0.9rem; margin-bottom: 5px;">Terima Kasih Atas Kunjungan Anda!</p>
        </div>
    </div>

    <!-- Tombol Aksi di Bawah Struk -->
    <div class="center no-print" style="margin-top: 2rem; display: flex; justify-content: center; gap: 15px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem;">🖨️ Print Struk</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #ef4444; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem;">Tutup Jendela</button>
    </div>

</body>
</html>