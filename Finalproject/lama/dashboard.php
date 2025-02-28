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
    <title>Halaman User</title>
</head>
<body>
    
<!-- <h1>Halo,<?= $row[""] ?></h1> -->

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>NO</th>
        <th>DIAGNOSA</th>
        <th>CATATAN</th>
    </tr>

    <?php 
    $i = 1;
    foreach( $username as $row) :
    ?>

    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["diagnosa_penyakit"] ?></td>
        <td><?= $row["catatan"] ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>

</body>
</html>