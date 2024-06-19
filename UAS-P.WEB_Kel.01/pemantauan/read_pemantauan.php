<!DOCTYPE html>
<html>
<head>
    <title>Detail Pemantauan</title>
    <link rel="stylesheet" href="../css/style_readpemantauan.css">
</head>
<body>


<?php
require_once "../koneksi.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $sql = "SELECT pemantauan.*, account.name AS nama_pegawai, lokasi.lokasi
            FROM pemantauan
            INNER JOIN pegawai ON pemantauan.pegawai_id = pegawai.id
            INNER JOIN account ON pegawai.account_id = account.id
            INNER JOIN lokasi ON pemantauan.lokasi_id = lokasi.id
            WHERE pemantauan.id = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <form>
                <div>
                    <h2>Detail Pemantauan</h2>
                </div>
                    <div>
                        <label>ID Pemantauan</label>
                        <input type="text" value="<?php echo $row['id']; ?>" readonly>
                    </div>
                    <div>
                        <label>Nama Pegawai</label>
                        <input type="text" value="<?php echo $row['nama_pegawai']; ?>" readonly>
                    </div>
                    <div>
                        <label>Kekeruhan</label>
                        <input type="text" value="<?php echo $row['kekeruhan']; ?>" readonly>
                    </div>
                    <div>
                        <label>Dis O2</label>
                        <input type="text" value="<?php echo $row['dis_o2']; ?>" readonly>
                    </div>
                    <div>
                        <label>pH</label>
                        <input type="text" value="<?php echo $row['pH']; ?>" readonly>
                    </div>
                    <div>
                        <label>Suhu</label>
                        <input type="text" value="<?php echo $row['suhu']; ?>" readonly>
                    </div>
                    <div>
                        <label>Lokasi</label>
                        <input type="text" value="<?php echo $row['lokasi']; ?>" readonly>
                    </div>
                    <div>
                        <label>Tanggal Pemantauan</label>
                        <input type="date" value="<?php echo $row['tgl_pantau']; ?>" readonly>
                    </div>
                    <div>
                        <label>Status</label>
                        <input type="text" value="<?php echo $row['status']; ?>" readonly>
                    </div>
                    <div class="button-container">
                        <button type="button" onclick="window.location.href='hasil_pemantauan.php'">Kembali</button>
                    </div>
                </form>
                <?php
            } else {
                header("location: hasil_pemantauan.php");
                exit();
            }
        } else {
            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    header("location: hasil_pemantauan.php");
    exit();
}
?>

</body>
</html>
