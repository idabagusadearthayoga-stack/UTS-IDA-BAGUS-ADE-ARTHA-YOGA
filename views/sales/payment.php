<?php include 'views/layouts/header.php'; ?>
    <div style="max-width: 600px; margin: auto; background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; margin-bottom: 0;">Penyelesaian Pembayaran</h2>
        <p style="text-align: center; color: #6b7280; margin-bottom: 2rem;">Total tagihan yang harus dibayar:</p>
        
        <div style="background: #1f2937; color: white; padding: 1.5rem; border-radius: 8px; text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 3rem; margin: 0; color: #10b981;">Rp <?= number_format($total_belanja, 0, ',', '.') ?></h1>
        </div>

        <form action="index.php?action=pos_process" method="POST">
            <!-- Pilihan Metode Pembayaran -->
            <label style="font-weight: bold; margin-bottom: 10px; display: block;">Pilih Metode Pembayaran</label>
            <div style="display: flex; gap: 15px; margin-bottom: 2rem;">
                <label style="flex: 1; border: 2px solid #e5e7eb; padding: 15px; border-radius: 8px; text-align: center; cursor: pointer; transition: 0.3s;" id="label-cash">
                    <input type="radio" name="payment_method" value="Cash" checked style="display: none;" onchange="selectMethod('cash')">
                    <div style="font-size: 2rem; margin-bottom: 5px;">💵</div>
                    <div style="font-weight: bold;">Uang Tunai</div>
                </label>
                <label style="flex: 1; border: 2px solid #e5e7eb; padding: 15px; border-radius: 8px; text-align: center; cursor: pointer; transition: 0.3s;" id="label-qris">
                    <input type="radio" name="payment_method" value="QRIS" style="display: none;" onchange="selectMethod('qris')">
                    <div style="font-size: 2rem; margin-bottom: 5px;">📱</div>
                    <div style="font-weight: bold;">QRIS / Transfer</div>
                </label>
            </div>

            <!-- Input Uang Pelanggan -->
            <div class="form-group">
                <label>Nominal Uang Pelanggan (Rp)</label>
                <input type="number" name="cash" id="inputCash" class="form-control" style="font-size: 1.5rem; font-weight: bold; padding: 15px;" required>
            </div>

            <!-- Kembalian -->
            <div class="form-group">
                <label>Kembalian (Rp)</label>
                <input type="text" id="outputChange" class="form-control" style="font-size: 1.5rem; font-weight: bold; padding: 15px; color: #ef4444; background-color: #fee2e2;" readonly value="0">
            </div>

            <button type="submit" class="btn btn-green" style="width: 100%; padding: 1rem; font-size: 1.2rem; margin-top: 1rem;">Cetak Struk Transaksi 🖨️</button>
            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="index.php?action=pos" style="color: #6b7280; text-decoration: none;">← Batal dan Kembali ke Kasir</a>
            </div>
        </form>
    </div>

    <!-- Script Kalkulator Otomatis -->
    <script>
        const totalBelanja = <?= $total_belanja ?>;
        const inputCash = document.getElementById('inputCash');
        const outputChange = document.getElementById('outputChange');
        const labelCash = document.getElementById('label-cash');
        const labelQris = document.getElementById('label-qris');

        // Fungsi Styling Radio Button
        function selectMethod(method) {
            labelCash.style.borderColor = method === 'cash' ? '#10b981' : '#e5e7eb';
            labelCash.style.backgroundColor = method === 'cash' ? '#ecfdf5' : 'white';
            labelQris.style.borderColor = method === 'qris' ? '#10b981' : '#e5e7eb';
            labelQris.style.backgroundColor = method === 'qris' ? '#ecfdf5' : 'white';
            
            // Jika QRIS, nominal otomatis sama dengan tagihan (tanpa kembalian)
            if(method === 'qris') {
                inputCash.value = totalBelanja;
                calculateChange();
            }
        }
        selectMethod('cash'); // Default saat dimuat

        // Fungsi Hitung Kembalian Real-time
        function calculateChange() {
            let cash = parseInt(inputCash.value) || 0;
            let change = cash - totalBelanja;
            // Format format Rupiah sederhana
            outputChange.value = change > 0 ? change.toLocaleString('id-ID') : '0';
        }
        inputCash.addEventListener('input', calculateChange);
    </script>
<?php include 'views/layouts/footer.php'; ?>