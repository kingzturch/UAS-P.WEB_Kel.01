<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once "../koneksi.php";

// Mulai session
session_start();

// Periksa apakah pengguna memiliki hak untuk menghapus akun (role_id 1)
if (!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != 1)) {
    header("Location: ../home.php");
    exit;
}

// Periksa apakah parameter id telah diterima
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Ambil id dari parameter URL
    $id = trim($_GET['id']);
    $error = false;
    $error_message = '';

    // Tampilkan dialog konfirmasi penghapusan
    echo "<script>
        var confirmation = confirm('Apakah Anda yakin ingin menghapus akun ini?');
        if (!confirmation) {
            window.location.href = 'daftar_akun.php';
        }
    </script>";

    // Query untuk menghapus data dari tabel pemantauan yang memiliki pegawai_id
    $sql_delete_pemantauan = "DELETE FROM pemantauan WHERE pegawai_id = ?";

    if ($stmt_delete_pemantauan = $koneksi->prepare($sql_delete_pemantauan)) {
        // Bind parameter ke pernyataan persiapan
        $stmt_delete_pemantauan->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Eksekusi pernyataan persiapan
        if (!$stmt_delete_pemantauan->execute()) {
            $error = true;
            $error_message = "Terjadi kesalahan saat menghapus data pemantauan.";
        }

        // Tutup pernyataan
        $stmt_delete_pemantauan->close();
    } else {
        $error = true;
        $error_message = "Persiapan query untuk menghapus data pemantauan gagal.";
    }

    // Query untuk menghapus data dari tabel user yang memiliki account_id
    $sql_delete_user = "DELETE FROM user WHERE account_id = ?";
    // Hapus data dari tabel user
    if ($stmt_delete_user = $koneksi->prepare($sql_delete_user)) {
        // Bind parameter ke pernyataan persiapan
        $stmt_delete_user->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Eksekusi pernyataan persiapan
        if (!$stmt_delete_user->execute()) {
            $error = true;
            $error_message = "Terjadi kesalahan saat menghapus data user.";
        }

        // Tutup pernyataan
        $stmt_delete_user->close();
    } else {
        $error = true;
        $error_message = "Persiapan query untuk menghapus data user gagal.";
    }

    // Query untuk menghapus data dari tabel pegawai yang memiliki account_id
    $sql_delete_pegawai = "DELETE FROM pegawai WHERE account_id = ?";
    // Hapus data dari tabel pegawai
    if ($stmt_delete_pegawai = $koneksi->prepare($sql_delete_pegawai)) {
        // Bind parameter ke pernyataan persiapan
        $stmt_delete_pegawai->bind_param("i", $param_id);

        // Set parameter
        $param_id = $id;

        // Eksekusi pernyataan persiapan
        if (!$stmt_delete_pegawai->execute()) {
            $error = true;
            $error_message = "Terjadi kesalahan saat menghapus data pegawai.";
        }

        // Tutup pernyataan
        $stmt_delete_pegawai->close();
    } else {
        $error = true;
        $error_message = "Persiapan query untuk menghapus data pegawai gagal.";
    }

    // Jika tidak ada kesalahan saat menghapus data dari tabel user atau pegawai
    if (!$error) {
        // Query untuk menghapus data dari tabel account
        $sql_delete_account = "DELETE FROM account WHERE id = ?";

        if ($stmt_delete_account = $koneksi->prepare($sql_delete_account)) {
            // Bind parameter ke pernyataan persiapan
            $stmt_delete_account->bind_param("i", $param_id);

            // Set parameter
            $param_id = $id;

            // Eksekusi pernyataan persiapan
            if ($stmt_delete_account->execute()) {
                // Redirect ke halaman daftar_akun.php setelah berhasil menghapus data
                header("Location: daftar_akun.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat menghapus data account: " . $stmt_delete_account->error;
            }

            // Tutup pernyataan
            $stmt_delete_account->close();
        } else {
            echo "Persiapan query untuk menghapus data account gagal.";
        }
    } else {
        echo $error_message;
    }

    // Tutup koneksi
    $koneksi->close();
} else {
    // Redirect ke halaman daftar_akun.php jika id tidak valid
    header("Location: daftar_akun.php");
    exit;
}
?>
