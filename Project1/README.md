# Koneksi dengan DBMS MySQL
```php
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 
```
## Query data
Untuk query data, file dengan nama `functions.php`. 
```php
<?php 
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}
?>
```
# CRUD
## Create data dan implementasi RSA
Untuk create data, membuat fungsi register di file `functions.php`. 
```php
<?php 
function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $conf_password = mysqli_real_escape_string($conn,$data["conf_password"]);

    if ( $password !== $conf_password) {
        echo "<scrpit>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
?>
```
## Insert data
Untuk insert data, memanggil fungsi register dari file `functions.php` di file `register.php`.
```php
<?php
require 'functions.php';

if( isset($_POST["register"]) ) {
    if( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('user baru berhasil ditambahkan');
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>
```

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Halaman Daftar Akun</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username Lengkap: </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password">Konfirmasi password: </label>
                <input type="password" name="conf_password" id="conf_password">
            </li>
            <li>
                <button type="submit" name="register">Simpan</button>
            </li>
        </ul>
    </form>
</body>
</html>
struktur html ini untuk menyimpan inputan data ke database.

## Read Data
Untuk read data, memanggil fungsi query dari file `functions.php` di file `index.php`.
```php
<?php
require 'functions.php';
$username = mysqli_query($conn,"SELECT * FROM user ORDER BY username LIMIT 20");
?>
```
struktur html dibawah untuk memanggil data dari database untuk tampil di laman `index.php`.
<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>NO</th>
        <th>username</th>
        <th>PASSWORD</th>
    </tr>

    <?php 
    $i = 1;
    foreach( $username as $row) :
    ?>

    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["username"] ?></td>
        <td><?= $row["password"] ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>" >ubah</a>
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>

# Login.php
algoritma `login.php` 
```php
<?php
if ( isset($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"])) {
            header("Location: index.php");
            exit;
        }
    }
    $error = true;

}
?>
```
struktur html dibawah untuk memastikan bahwa untuk masuk ke `index.php` harus dengan akun yang sudah terdaftar di database

<h1>Halaman Login</h1>
```php
<?php if( isset($error) ) : ?>
    <p style="color: red; font-style: italic;">username / password salah</p>
<?php endif; ?>
?>
```

<form action="" method="post">

    <ul>
        <li>
            <label for="username">Name :</label>
            <input type="text" name="username" id="username">
        </li>

        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <br>
        <li>
            <button type="submit" name="login">Login</button>
        </li>

    </ul>

</form>

# username Kelompok
- Armyka Tita Silvi : registrasi.php, functions.php, index.php, login.php, dashboard.php
- Yunita Eka Salsabila : index.php, readme.md