<?php
// Masukkan file functions.php untuk koneksi database dan fungsi registrasi
require 'functions.php';

// Cek apakah tombol register ditekan
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                window.location = 'login.php'; // Redirect ke halaman login
              </script>";
    } else {
        echo "<script>
                alert('Registrasi gagal! Username mungkin sudah ada.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Medical Center</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="container">
        <div class="register-box">
            <h2>Create Your Account</h2>

            <form action="login.html" method="post">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>

                <label for="usia">Usia</label>
                <input type="number" id="usia" name="usia" placeholder="Masukkan usia" required>

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>

                <p class="login-text">Sudah punya akun? <a href="login.html">Login di sini!</a></p>

                <button type="submit" class="register-btn" name="register" href="login.html">Buat Akun</button>
            </form>
        </div>
    </div>

</body>
</html>
