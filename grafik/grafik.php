<?php

// Memeriksa apakah pengguna telah login dan memiliki session role_id
session_start();

// Panggil file koneksi.php
require_once "../koneksi.php";
if (!isset($_SESSION['role_id'])) {
    header("Location: ../akun/login2regist.php");
    exit;
}

// Set role_id from session
$role_id = $_SESSION['role_id'];
$account_id = $_SESSION['id'];

// Ambil data lokasi dari tabel lokasi
function getLocations() {
    global $koneksi;

    $locations = array();
    $sql = "SELECT id, lokasi FROM lokasi";
    
    $result = $koneksi->query($sql);

    while ($row = $result->fetch_assoc()) {
        $locations[$row['id']] = $row['lokasi'];
    }

    return $locations;
}

// Ambil data dari database berdasarkan lokasi_id dan rentang tanggal
function getDataByLokasiAndDateRange($lokasi_id, $start_date, $end_date) {
    global $koneksi;
    $data = array(
        'ph' => array(),
        'suhu' => array(),
        'dis_o2' => array(),
        'kekeruhan' => array()
    );

    $sql = "SELECT tgl_pantau, pH, suhu, dis_o2, kekeruhan FROM pemantauan WHERE lokasi_id = ? AND tgl_pantau BETWEEN ? AND ?";
    
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $lokasi_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data['ph'][$row['tgl_pantau']] = $row['pH'];
        $data['suhu'][$row['tgl_pantau']] = $row['suhu'];
        $data['dis_o2'][$row['tgl_pantau']] = $row['dis_o2'];
        $data['kekeruhan'][$row['tgl_pantau']] = $row['kekeruhan'];
    }

    return $data;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grafik Pemantauan</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style_grafik.css">
    <link rel="stylesheet" href="../css/style_navbar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    
<header>
    <nav>
        <div class="logo" style="display: flex;align-items: center;">
         <span style="color:#01939c; font-size:26px; font-weight:bold; letter-spacing: 1px;margin-left: 20px;">WATER</span>
        </div>
        <div class="hamburger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <ul class="nav-links">
            <li><a href="../home.php">Home</a></li>
            <li><a href="../grafik/grafik.php">Grafik</a></li>
            <li><a href="../pemantauan/hasil_pemantauan.php">Hasil Pemantauan</a></li>
            <li><a href="../petunjuk.php">Petunjuk</a></li>
            <?php if ($role_id == 1) {?>
                <li><a href="../akun/daftar_akun.php">Daftar Akun</a></li>
            <?php } ?>
            <li><a href="../akun/logout.php">Log Out</a></li>
            <li>
            <?php if ($role_id == 1) {?>
                <a href="../home.php">
            <?php } ?>
            <?php if ($role_id != 1) {?>
                <a href="../akun/edit_akun.php?id=<?php echo $account_id; ?>">
            <?php } ?>
                    <div class="card">
                        <div class="icon">
                            <i class="fas fa-circle-user"></i>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</header>
<br><br><br><br><br><br>

<h2>Grafik Pemantauan</h2>

<!-- Form untuk memilih lokasi_id dan rentang tanggal -->
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="lokasi_id"> Pilih Lokasi: </label>
    <select name="lokasi_id" id="lokasi_id">
    <?php
        // Ambil daftar lokasi dari database
        $locations = getLocations();

        // Tampilkan opsi untuk setiap lokasi
        foreach ($locations as $id => $lokasi) {
            echo "<option value=\"$id\">$lokasi</option>";
        }
    ?>
    </select>

    </select>
    
    <label for="start_date"> Tanggal Mulai: </label>
    <select id="start_date" name="start_date" required>
        <?php
            $sql = "SELECT DISTINCT tgl_pantau FROM pemantauan ORDER BY tgl_pantau ASC";
            $result = $koneksi->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"".$row['tgl_pantau']."\">".$row['tgl_pantau']."</option>";
            }
        ?>
    </select>
    
    <label for="end_date"> Tanggal Akhir: </label>
    <select id="end_date" name="end_date" required>
        <?php
            $sql = "SELECT DISTINCT tgl_pantau FROM pemantauan ORDER BY tgl_pantau DESC";
            $result = $koneksi->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"".$row['tgl_pantau']."\">".$row['tgl_pantau']."</option>";
            }
        ?>
    </select>
    <label for="">       </label>
    <input type="submit" value="Tampilkan Grafik">
    <div class="download-buttons">
        <button class="download-button" onclick="downloadPDF()">Download PDF</button>
        <button class="download-button" onclick="downloadJPEG()">Download JPEG</button>
    </div>
</form>


<div class="chart-container">
    <!-- Tampilkan grafik pH -->
    <canvas id="chartPH" width="600" height="100"></canvas>

    <!-- Tampilkan grafik Suhu -->
    <canvas id="chartSuhu" width="600" height="100"></canvas>

    <!-- Tampilkan grafik Dissolved Oxygen -->
    <canvas id="chartDis_O2" width="600" height="100"></canvas>

    <!-- Tampilkan grafik Kekeruhan -->
    <canvas id="chartKekeruhan" width="600" height="100"></canvas>
</div>

<?php
// Jika lokasi_id dan rentang tanggal telah dipilih
if (isset($_GET['lokasi_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $lokasi_id = $_GET['lokasi_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    
    // Ambil data untuk grafik berdasarkan lokasi_id dan rentang tanggal
    $data = getDataByLokasiAndDateRange($lokasi_id, $start_date, $end_date);

    // Convert data ke format JSON untuk digunakan dalam grafik
    $dataPH_json = json_encode($data['ph']);
    $dataSuhu_json = json_encode($data['suhu']);
    $dataDis_O2_json = json_encode($data['dis_o2']);
    $dataKekeruhan_json = json_encode($data['kekeruhan']);
?>

<script>
    var dataPH = <?php echo $dataPH_json; ?>;
    var dataSuhu = <?php echo $dataSuhu_json; ?>;
    var dataDis_O2 = <?php echo $dataDis_O2_json; ?>;
    var dataKekeruhan = <?php echo $dataKekeruhan_json; ?>;
</script>
<script src="../js/js_grafik.js"></script>
<script src="../js/js_download-grafik.js"></script>
<script src="../js/js_navbar.js"></script>

<?php
}
?>

</body>
</html>
