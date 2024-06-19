<?php
require_once "../koneksi.php";

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $sql = "SELECT * FROM pemantauan WHERE id = ?";
    
    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET['id']);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $pegawai_id, $kekeruhan, $dis_o2, $pH, $suhu, $tgl_pantau, $lokasi_id, $status);
                mysqli_stmt_fetch($stmt);
            } else {
                echo "No records found.";
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            exit();
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="../css/style_editpemantauan.css">
</head>
<body>
<h2>Edit Data Pemantauan</h2>
<form action="update_pemantauan_process.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
        <label>Nama Pegawai</label>
        <select name="pegawai_id">
            <?php
            $sql_pegawai = "SELECT account.name AS nama_pegawai, pegawai.id AS id_pegawai 
                            FROM account 
                            INNER JOIN pegawai ON account.id = pegawai.account_id";
            $result_pegawai = mysqli_query($koneksi, $sql_pegawai);
            
            while ($pegawai = mysqli_fetch_assoc($result_pegawai)) {
                $selected = ($pegawai['id_pegawai'] == $pegawai_id) ? "selected" : "";
                echo "<option value='" . $pegawai['id_pegawai'] . "' $selected>" . $pegawai['nama_pegawai'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label>Kekeruhan</label>
        <input type="text" name="kekeruhan" value="<?php echo $kekeruhan; ?>">
    </div>
    <div>
        <label>Dis O2</label>
        <input type="text" name="dis_o2" value="<?php echo $dis_o2; ?>">
    </div>
    <div>
        <label>pH</label>
        <input type="text" name="pH" value="<?php echo $pH; ?>">
    </div>
    <div>
        <label>Suhu</label>
        <input type="text" name="suhu" value="<?php echo $suhu; ?>">
    </div>
    <div>
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
        </select>
    </div>
    <div>
        <label>Tanggal Pemantauan</label>
        <input type="date" name="tgl_pantau" value="<?php echo $tgl_pantau; ?>">
    </div>
    <div class="button-container">
        <input type="submit" value="Update">
        <button type="button" class="cancel-button" onclick="window.location.href='hasil_pemantauan.php'">Batal</button>
    </div>
</form>
</body>
</html>