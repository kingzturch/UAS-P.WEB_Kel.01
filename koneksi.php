<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Host database
$user = 'root'; // Nama pengguna database
$password = ''; // Kata sandi database
$database = 'db_app'; // Nama database

// Membuat koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// echo "Koneksi berhasil";

?>
