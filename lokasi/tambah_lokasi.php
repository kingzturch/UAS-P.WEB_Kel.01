<?php 
// Memeriksa apakah pengguna telah login dan memiliki session role_id
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Lokasi</title>
    <link rel="stylesheet" href="../css/style_tambah.css">
</head>

<body>

<h2>Tambah Data Lokasi</h2>

<form action="create_lokasi.php" method="post">
    <div>
        <label>Nama Lokasi</label>
        <input type="text" name="lokasi" required>
    </div>
    <div class="button-container">
        <input type="submit" value="Tambahkan">
        <button type="button" class="cancel-button" onclick="window.location.href='../petunjuk.php'">Batal</button>
    </div>
</form>

</body>
</html>
