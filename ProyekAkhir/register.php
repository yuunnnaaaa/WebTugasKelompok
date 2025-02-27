<?php
// Masukkan file functions.php untuk koneksi database dan fungsi registrasi
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Medical Center</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="container">
        <div class="register-box">
            <h2>Create Your Account</h2>

            <form action="proses.php" method="POST">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="username" placeholder="Masukkan nama lengkap" required>

                <label for="usia">Usia</label>
                <input type="number" id="usia" name="usia" placeholder="Masukkan usia" required>

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>

                <p class="login-text">Sudah punya akun? <a href="login.html">Login di sini!</a></p>

                <button type="submit" class="register-btn" name="register">Buat Akun</button>
            </form>
        </div>
    </div>

</body>
</html>
