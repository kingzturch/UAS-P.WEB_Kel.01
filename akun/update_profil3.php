<?php
session_start();
require_once '../koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['role_id'])) {
    header("Location: login2regist.php");
    exit;
}

// Pastikan pengguna memiliki role_id yang sesuai
if ($_SESSION['role_id'] != 3) {
    echo "Akses Tidak Valid";
    exit;
}

// Ambil data dari formulir
$jk = $_POST['jk'];
$tmpt_lahir = $_POST['tmpt_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$account_id = $_SESSION['id']; // Sesuaikan dengan kolom yang menyimpan id pengguna

// Query untuk mengupdate data user
$query = "UPDATE user SET jk = ?, tmpt_lahir = ?, tgl_lahir = ? WHERE account_id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("sssi", $jk, $tmpt_lahir, $tgl_lahir, $account_id);
$stmt->execute();

// Redirect ke halaman home setelah berhasil update
header("Location: ../home.php");
exit;

$stmt->close();
$koneksi->close();
?>
