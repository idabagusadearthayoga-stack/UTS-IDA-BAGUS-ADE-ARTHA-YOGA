<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - POS Lusi & Pakan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: linear-gradient(135deg, #1e3a8a, #3b82f6); height: 100vh; margin: 0; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #ffffff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 350px; text-align: center; }
        .login-card h2 { margin: 0 0 10px; color: #1e3a8a; font-size: 1.8rem; }
        .login-card p { margin: 0 0 25px; color: #6b7280; font-size: 0.9rem; }
        .form-group { text-align: left; margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #374151; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-size: 1rem; }
        .btn-login { width: 100%; background: #10b981; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 1rem; cursor: pointer; transition: 0.2s; margin-top: 10px; }
        .btn-login:hover { background: #059669; }
        .error-msg { background: #fee2e2; color: #ef4444; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-size: 0.85rem; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Butik Lusi & Pakan</h2>
        <p>Sistem Point of Sales MVC Native</p>

        <?php if(isset($error)): ?>
            <div class="error-msg"><?= $error ?></div>
        <?php endif; ?>

        <form action="index.php?action=login_process" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn-login">Masuk Aplikasi ➔</button>
        </form>
    </div>
</body>
</html>