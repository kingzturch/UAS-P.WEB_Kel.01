<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once "../koneksi.php";

// Mulai session
session_start();

// Periksa apakah pengguna memiliki hak untuk menghapus data
if (!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3)) {
    header("Location: ../home.php");
    exit;
}

// Periksa apakah parameter id telah diterima
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Ambil id dari parameter URL
    $id = trim($_GET['id']);

    // Query untuk menghapus data dari tabel pemantauan yang terhubung dengan id lokasi
    $sql_delete_pemantauan = "DELETE FROM pemantauan WHERE lokasi_id = ?";

    if ($stmt_delete_pemantauan = $koneksi->prepare($sql_delete_pemantauan)) {
        // Bind parameter ke pernyataan persiapan
        $stmt_delete_pemantauan->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Eksekusi pernyataan persiapan
        if ($stmt_delete_pemantauan->execute()) {
            // Tutup pernyataan
            $stmt_delete_pemantauan->close();

            // Query untuk menghapus data dari tabel lokasi
            $sql_delete_lokasi = "DELETE FROM lokasi WHERE id = ?";

            if ($stmt_delete_lokasi = $koneksi->prepare($sql_delete_lokasi)) {
                // Bind parameter ke pernyataan persiapan
                $stmt_delete_lokasi->bind_param("i", $param_id);

                // Set parameter
                $param_id = $id;

                // Eksekusi pernyataan persiapan
                if ($stmt_delete_lokasi->execute()) {
                    // Redirect ke halaman lokasi.php setelah berhasil menghapus data
                    header("Location: ../petunjuk.php");
                    exit();
                } else {
                    echo "Terjadi kesalahan saat menghapus data lokasi.";
                }

                // Tutup pernyataan
                $stmt_delete_lokasi->close();
            }
        } else {
            echo "Terjadi kesalahan saat menghapus data pemantauan.";
        }
    }

    // Tutup koneksi
    $koneksi->close();
} else {
    // Redirect ke halaman lokasi.php jika id tidak valid
    header("Location: ../petunjuk.php");
    exit;
}
?>
