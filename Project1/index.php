<?php
require 'functions.php';
$username = query("SELECT * FROM user ORDER BY username LIMIT 20");

//ambil data dari query
//$result = mysqli_query($conn, "SELECT id, nim, nama FROM username ORDER BY nama LIMIT 10");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    
<h1>Daftar Pasien</h1>

<a href="tambah.php">Tambah data pasien</a>
<br><br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>NO</th>
        <th>NAMA</th>
        <th>PASSWORD</th>
        <th>DIAGNOSA</th>
        <th>CATATAN</th>
        <th>ACTION</th>
    </tr>

    <?php 
    $i = 1;
    foreach( $username as $row) :
    ?>

    

    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["username"] ?></td>
        <td><?= $row["password"] ?></td>
        <td><?= $row["diagnosa_penyakit"] ?></td>
        <td><?= $row["catatan"] ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>" >ubah</a>
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>


</table>


</body>
</html>