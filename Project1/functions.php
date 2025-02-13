<?php
//koneksi database
$conn = mysqli_connect("localhost", "root", "", "weblanjutan");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}

// function tambah($data){
//     global $conn;

//     $nim = htmlspecialchars($data["nim"]);
//     $nama = htmlspecialchars($data["nama"]);



//     $query = "INSERT INTO mahasiswa (nim, nama)
//     VALUES ('$nim', '$nama')
//     ";
//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }

// function hapus($id) {
//     global $conn;
//     mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

//     return mysqli_affected_rows($conn);
// }


// function ubah($data){
//     global $conn;

//     $id = $data["id"];
//     $nim = htmlspecialchars($data["nim"]);
//     $nama = htmlspecialchars($data["nama"]);



//     $query = "UPDATE mahasiswa SET 
//                 nim = '$nim',
//                 nama = '$nama'
//                 WHERE id = $id
//     ";

//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek konfirmasi password
    if($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!'); 
            </script>";
        return false;

    }    

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '', '')");


    return mysqli_affected_rows($conn);


}



?>