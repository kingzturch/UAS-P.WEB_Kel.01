<?php 
// Memeriksa apakah pengguna telah login dan memiliki session role_id
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Data Pemantauan</title>
    <link rel="stylesheet" href="../css/style_tambah.css">
</head>

<body>

<h2>Create Data Pemantauan</h2>

<form action="create_pemantauan_process.php" method="post">
    <div>
        <label>Nama Pegawai</label>
        <select name="pegawai_id">
            <?php
            // Sertakan file koneksi.php
            require_once "../koneksi.php";

            // Query untuk mendapatkan data nama pegawai yang berelasi dengan tabel account melalui tabel pegawai
            $sql_pegawai = "SELECT account.name AS nama_pegawai, pegawai.id AS id_pegawai 
                            FROM account 
                            INNER JOIN pegawai ON account.id = pegawai.account_id";
            $result_pegawai = mysqli_query($koneksi, $sql_pegawai);

            // Tampilkan data dalam bentuk dropdown option
            while ($pegawai = mysqli_fetch_assoc($result_pegawai)) {
                echo "<option value='" . $pegawai['id_pegawai'] . "'>" . $pegawai['nama_pegawai'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label>Kekeruhan</label>
        <input type="text" name="kekeruhan">
    </div>
    <div>
        <label>Dis O2</label>
        <input type="text" name="dis_o2">
    </div>
    <div>
        <label>pH</label>
        <input type="text" name="pH">
    </div>
    <div>
        <label>Suhu</label>
        <input type="text" name="suhu">
    </div>
    <div>
        <label>Tanggal Pemantauan</label>
        <input type="date" name="tgl_pantau">
    </div>
    <div>
        <label>Lokasi</label>
        <select name="lokasi_id">
            <?php
            // Query untuk mendapatkan data nama lokasi dari tabel lokasi
            $sql_lokasi = "SELECT id, lokasi FROM lokasi";
            $result_lokasi = mysqli_query($koneksi, $sql_lokasi);

            // Tampilkan data dalam bentuk dropdown option
            while ($lokasi = mysqli_fetch_assoc($result_lokasi)) {
                echo "<option value='" . $lokasi['id'] . "'>" . $lokasi['lokasi'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="button-container">
        <input type="submit" value="Create">
        <button type="button" class="cancel-button" onclick="window.location.href='hasil_pemantauan.php'">Batal</button>
    </div>
</form>

</body>
</html>
