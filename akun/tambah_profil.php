<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once '../koneksi.php';

// Inisialisasi variabel
$jk = $tmpt_lahir = $tgl_lahir = "";
$jk_err = $tmpt_lahir_err = $tgl_lahir_err = "";

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan ambil data dari form
    if (empty(trim($_POST["jk"]))) {
        $jk_err = "Silakan masukkan jenis kelamin.";
    } else {
        $jk = trim($_POST["jk"]);
    }

    if (empty(trim($_POST["tmpt_lahir"]))) {
        $tmpt_lahir_err = "Silakan masukkan tempat lahir.";
    } else {
        $tmpt_lahir = trim($_POST["tmpt_lahir"]);
    }

    if (empty(trim($_POST["tgl_lahir"]))) {
        $tgl_lahir_err = "Silakan masukkan tanggal lahir.";
    } else {
        $tgl_lahir = trim($_POST["tgl_lahir"]);
    }

    // Jika tidak ada kesalahan, perbarui data di database
    if (empty($jk_err) && empty($tmpt_lahir_err) && empty($tgl_lahir_err)) {
        $query = "UPDATE user SET jk = ?, tmpt_lahir = ?, tgl_lahir = ? WHERE account_id = ?";
        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("sssi", $jk, $tmpt_lahir, $tgl_lahir, $_SESSION['id']);

            if ($stmt->execute()) {
                echo "Profil berhasil ditambahkan.";
            } else {
                echo "Terjadi kesalahan. Silakan coba lagi.";
            }
            $stmt->close();
        }
    }
}

// Query untuk mengambil data user sesuai account_id dari tabel account
$query = "SELECT * FROM user WHERE account_id = ?";
if ($stmt = $koneksi->prepare($query)) {
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Edit Profil</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="jk">Jenis Kelamin:</label>
            <input type="text" id="jk" name="jk" class="form-control" value="<?php echo $row['jk']; ?>">
            <span class="error"><?php echo $jk_err; ?></span>
        </div>
        <div class="form-group">
            <label for="tmpt_lahir">Tempat Lahir:</label>
            <input type="text" id="tmpt_lahir" name="tmpt_lahir" class="form-control" value="<?php echo $row['tmpt_lahir']; ?>">
            <span class="error"><?php echo $tmpt_lahir_err; ?></span>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo $row['tgl_lahir']; ?>">
            <span class="error"><?php echo $tgl_lahir_err; ?></span>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='login2regist.php'">Batal</button>
    </form>
</div>
</body>
</html>
