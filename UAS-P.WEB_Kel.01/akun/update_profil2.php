<?php
session_start();
require_once '../koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['role_id'])) {
    header("Location: login2regist.php");
    exit;
}

// Pastikan pengguna memiliki role_id yang sesuai
if ($_SESSION['role_id'] != 2) {
    echo "Akses Tidak Valid";
    exit;
}

// Ambil data dari formulir
$jk = $_POST['jk'];
$lokasi_id = $_POST['lokasi_id'];
$jabatan = $_POST['jabatan'];
$account_id = $_SESSION['id']; // Sesuaikan dengan kolom yang menyimpan id pengguna

// Query untuk mengupdate data pegawai
$query = "UPDATE pegawai SET jk = ?, lokasi_id = ?, jabatan = ? WHERE account_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("sisi", $jk, $lokasi_id, $jabatan, $account_id);
$stmt->execute();

// Redirect ke halaman home setelah berhasil update
header("Location: ../home.php");
exit;

$stmt->close();
$koneksi->close();
?>
