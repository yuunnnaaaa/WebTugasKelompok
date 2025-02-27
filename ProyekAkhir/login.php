<?php
require 'functions.php';

if ( isset($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");


    // cek username
    if( mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"])) {
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = true;

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Medical Center</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="container">
        <div class="login-box">
            <h2>Medical Center</h2>
            <?php if( isset($error) ) : ?>
                <p style="color: red; font-style: italic;">username / password salah</p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <label for="nama">Nama</label>
                <input type="text" id="username" name="username" placeholder="Masukkan nama" required>

                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>

                <a href="#" class="forgot-password">Lupa kata sandi?</a>

                <a href="dashboard.php"><button type="submit" class="login-btn">Login</button></a>

                <p class="register-text">Belum punya akun? <a href="register.php">Register di sini!</a></p>
            </form>
        </div>
    </div>

</body>
</html>