<?php
require 'functions.php'; // Koneksi database dan fungsi

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["status" => "error", "message" => "Data tidak valid"]);
        exit;
    }

    // Ambil data dari request
    $username = $data["username"];
    $usia = $data["usia"];
    $password = $data["password"];
    

    // Panggil fungsi registrasi
    $result = registrasi($username, $usia, $password);

    if ($result > 0) {
        echo json_encode(["status" => "success", "message" => "User berhasil didaftarkan!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registrasi gagal! Username mungkin sudah ada."]);
    }
}

// Fungsi registrasi (dipindahkan ke sini)
function registrasi($username, $usia, $password) {
    global $conn;

    $username = strtolower(stripslashes($username));
    $usia = intval($usia);
    $password = mysqli_real_escape_string($conn, $password);
    

    // Cek apakah username sudah terdaftar
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        return 0;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        return 0;
    }

    // Enkripsi password sebelum disimpan
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan ke database
    mysqli_query($conn, "INSERT INTO users (username, usia, password) VALUES ('$username', '$usia', '$password')");

    return mysqli_affected_rows($conn);
}
?>
