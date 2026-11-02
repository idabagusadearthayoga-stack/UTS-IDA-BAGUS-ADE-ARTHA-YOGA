<?php include 'views/layouts/header.php'; ?>

<style>
    /* Styling Banner Atas */
    .dashboard-header {
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        flex-wrap: wrap; 
        gap: 20px;
    }
    .dashboard-header-text h1 { margin: 0 0 10px 0; font-size: 2.2rem; font-weight: 700; }
    .dashboard-header-text p { margin: 0; opacity: 0.9; font-size: 1.1rem; }

    /* Styling Kotak Filter Pencarian Bulan */
    .filter-box {
        display: flex; 
        gap: 10px; 
        align-items: center; 
        background: rgba(255, 255, 255, 0.2); 
        padding: 15px; 
        border-radius: 8px;
    }

    /* Styling Grid Kartu */
    .cards-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .card {
        background: white;
        flex: 1;
        min-width: 260px;
        padding: 25px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
        border: 1px solid #f3f4f6;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); 
    }
    
    /* Styling Ikon */
    .card-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }
    .icon-blue { background: #e0f2fe; color: #0284c7; }
    .icon-pink { background: #fce7f3; color: #db2777; }
    .icon-green { background: #dcfce7; color: #15803d; }

    /* Styling Teks Angka */
    .card-content h3 { margin: 0; color: #6b7280; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .card-content h2 { margin: 8px 0 0; color: #111827; font-size: 2rem; }
</style>

<div class="dashboard-header">
    <div class="dashboard-header-text">
        <h1>Selamat Datang di POS Butik Lusi & Pakan 👋</h1>
        <p>Berikut adalah ringkasan performa penjualan butik Anda.</p>
    </div>
    
    <!-- Formulir Filter Bulan -->
    <form action="index.php" method="GET" class="filter-box">
        <input type="hidden" name="action" value="home">
        <label for="filter_month" style="font-weight: bold; font-size: 0.95rem; color: white;">Cek Pendapatan:</label>
        
        <input type="month" name="filter_month" id="filter_month" 
               style="border: none; padding: 8px 12px; border-radius: 5px; color: #111827; font-family: inherit; font-weight: bold;" 
               value="<?= isset($_GET['filter_month']) ? $_GET['filter_month'] : date('Y-m') ?>" required>
        
        <button type="submit" style="background: #10b981; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; transition: 0.2s;">Cari</button>
    </form>
</div>

<div class="cards-container">
    <!-- Card Hari Ini -->
    <div class="card">
        <div class="card-icon icon-blue">📅</div>
        <div class="card-content">
            <h3>Penjualan Hari Ini</h3>
            <h2>Rp <?= number_format($stats['today'], 0, ',', '.') ?></h2>
        </div>
    </div>

    <!-- Card 7 Hari Terakhir -->
    <div class="card">
        <div class="card-icon icon-pink">📊</div>
        <div class="card-content">
            <h3>7 Hari Terakhir</h3>
            <h2>Rp <?= number_format($stats['week'], 0, ',', '.') ?></h2>
        </div>
    </div>

    <!-- Card Filter Bulan -->
    <div class="card">
        <div class="card-icon icon-green">💰</div>
        <div class="card-content">
            <h3><?= $stats['label_bulan'] ?></h3>
            <h2>Rp <?= number_format($stats['month'], 0, ',', '.') ?></h2>
        </div>
    </div>
</div>

<?php include 'views/layouts/footer.php'; ?>