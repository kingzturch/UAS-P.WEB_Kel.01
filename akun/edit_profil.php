<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profil</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
require_once '../koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['role_id'])) {
    header("Location: login2regist.php");
    exit;
}

// Ambil role_id dari sesi
$role_id = $_SESSION['role_id'];

// Jika role_id adalah 2, arahkan untuk mengedit tabel pegawai
if ($role_id == 2) {
    // Query untuk mengambil data pegawai sesuai account_id dari tabel account
    $query = "SELECT * FROM pegawai WHERE account_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $_SESSION['id']); // Sesuaikan dengan kolom yang menyimpan id pengguna
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Tampilkan form edit profil pegawai
    ?>
    <div class="container">
        <h2>Edit Profil</h2>
        <form action="update_profil2.php" method="POST">
            <label for="jk">Jenis Kelamin:</label>
            <input type="text" id="jk" name="jk" value="<?php echo $row['jk']; ?>"><br><br>
            <label>Lokasi</label>
            <select name="lokasi_id">
                <?php
                $sql_lokasi = "SELECT id, lokasi FROM lokasi";
                $result_lokasi = mysqli_query($koneksi, $sql_lokasi);
                
                while ($lokasi = mysqli_fetch_assoc($result_lokasi)) {
                    $selected = ($lokasi['id'] == $lokasi_id) ? "selected" : "";
                    echo "<option value='" . $lokasi['id'] . "' $selected>" . $lokasi['lokasi'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="jabatan">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" value="<?php echo $row['jabatan']; ?>"><br><br>
            <button type="submit">Simpan Perubahan</button>
            <button type="button" class="cancel-button" value="Batal" onclick="window.location.href='../home.php'">Batal</button>
        </form>
    </div>
    <?php
    $stmt->close();
    $koneksi->close();
} elseif ($role_id == 3) {
    // Jika role_id adalah 3, arahkan untuk mengedit tabel user tanpa berpindah halaman
    // Query untuk mengambil data user sesuai account_id dari tabel account
    $query = "SELECT * FROM user WHERE account_id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $_SESSION['id']); // Sesuaikan dengan kolom yang menyimpan id pengguna
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Tampilkan form edit profil user
    ?>
    <div class="container">
        <h2>Edit Profil</h2>
        <form action="update_profil3.php" method="POST">
            <label for="jk">Jenis Kelamin:</label>
            <input type="text" id="jk" name="jk" value="<?php echo $row['jk']; ?>"><br><br>
            <label for="tmpt_lahir">Tempat Lahir:</label>
            <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $row['tmpt_lahir']; ?>"><br><br>
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?php echo $row['tgl_lahir']; ?>"><br><br>
            <button type="submit">Simpan Perubahan</button>
            <button type="button" class="cancel-button" value="Batal" onclick="window.location.href='../home.php'">Batal</button>
        </form>
    </div>
    <?php
    $stmt->close();
    $koneksi->close();
} else {
    // Jika role_id tidak valid, arahkan ke halaman lain atau tampilkan pesan error
    header("Location: ../home.php");
    exit;
}
?>
</body>
</html>
