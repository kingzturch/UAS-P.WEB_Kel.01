<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once "../koneksi.php";

// Memulai session
session_start();

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $lokasi = trim($_POST["lokasi"]);

    // Query untuk menambahkan data ke tabel lokasi
    $sql = "INSERT INTO lokasi (lokasi) VALUES (?)";

    if ($stmt = $koneksi->prepare($sql)) {
        // Bind parameter ke pernyataan persiapan
        $stmt->bind_param("s", $param_lokasi);

        // Set parameter
        $param_lokasi = $lokasi;

        // Cobalah untuk mengeksekusi pernyataan persiapan
        if ($stmt->execute()) {
            // Redirect ke halaman lokasi.php setelah berhasil menambahkan data
            header("location: ../petunjuk.php");
        } else {
            echo "Terjadi kesalahan. Silakan coba lagi.";
        }

        // Tutup pernyataan
        $stmt->close();
    }
}

// Tutup koneksi
$koneksi->close();
?>
