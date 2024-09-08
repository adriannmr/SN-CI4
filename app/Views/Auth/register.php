<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        /* CSS styling here */
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrasi</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form action="/register" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <input type="password" name="password_confirm" id="password_confirm" required>
            </div>
            <button type="submit">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
    </div>
</body>
</html>
