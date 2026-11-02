<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Butik Lusi & Pakan</title>
    <!-- Import Font Keren dari Google -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #10b981;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.6;
        }
        /* Desain Navbar Elegan */
        .navbar {
            background-color: var(--primary);
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-links a {
            color: #d1d5db;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-links a:hover { color: #fff; }
        
        /* Desain Wadah (Container) */
        .container {
            max-width: 950px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            padding: 2.5rem;
        }
        
        /* Tipografi & Garis */
        h2 { color: var(--primary); margin-bottom: 1.5rem; font-weight: 700; }
        hr { border: none; height: 1px; background-color: #e5e7eb; margin: 1.5rem 0; }
        
        /* Tombol Modern */
        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-green { background-color: var(--secondary); color: #fff; }
        .btn-green:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2); }
        .btn-blue { background-color: #3b82f6; color: #fff; }
        .btn-blue:hover { background-color: #2563eb; transform: translateY(-2px); }
        .btn-red { background-color: #ef4444; color: #fff; }
        .btn-red:hover { background-color: #dc2626; transform: translateY(-2px); }
        
        /* Tabel Estetik */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        tr:hover td { background-color: #f8fafc; transition: 0.2s; }
        
        /* Form Modern */
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body>
    
    <nav class="navbar">
        <a href="index.php?action=home" class="navbar-brand">Lusi & Pakan POS</a>
        
        <div class="nav-links">
            <a href="index.php?action=home">Home</a>
            
            <!-- HANYA ADMIN YANG BISA MELIHAT MENU MASTER DATA -->
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="index.php?action=categories">Kategori</a>
                <a href="index.php?action=products">Data Produk</a>
            <?php endif; ?>
            
            <a href="index.php?action=sales">Data Transaksi</a>
            <a href="index.php?action=pos">POS</a>
            
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <a href="index.php?action=users">Data Kasir</a>
            <?php endif; ?>
            
            <a href="index.php?action=about">About</a>
            
            <!-- Tombol Logout yang warnanya diatur merah lembut agar rapi dan serasi -->
            <?php if(isset($_SESSION['user_name'])): ?>
                <a href="index.php?action=logout" style="color: #ff8080;" onclick="return confirm('Yakin ingin keluar dari aplikasi?')">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- HANYA MEMBUKA CONTAINER UTAMA, TIDAK MEMBUKA CARD KOSONG -->
    <div class="container">
