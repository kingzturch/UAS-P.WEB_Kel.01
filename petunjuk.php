<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="css/style_navbar.css">
        <link rel="stylesheet" href="css/style_petunjuk.css">
        <link rel="stylesheet" href="css/style_modal.css">
    </head>
    <body>
    <?php
        session_start(); 
        require_once "koneksi.php";

        if (!isset($_SESSION['role_id'])) {
            header("Location: akun/login2regist.php");
            exit;
          }
        
          // Set role_id from session
          $role_id = $_SESSION['role_id'];
          $account_id = $_SESSION['id'];
    ?>
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
            <li><a href="home.php">Home</a></li>
            <li><a href="grafik/grafik.php">Grafik</a></li>
            <li><a href="pemantauan/hasil_pemantauan.php">Hasil Pemantauan</a></li>
            <li><a href="petunjuk.php">Petunjuk</a></li>
            <?php if ($role_id == 1) {?>
                <li><a href="akun/daftar_akun.php">Daftar Akun</a></li>
            <?php } ?>
            <li><a href="akun/logout.php">Log Out</a></li>
            <li>
            <?php if ($role_id == 1) {?>
                <a href="home.php">
            <?php } ?>
            <?php if ($role_id != 1) {?>
                <a href="/akun/edit_akun.php?id=<?php echo $account_id; ?>">
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
<br><br><br><br>
<main>
    <article>
        <h2>Water Quality Monitoring</h2>
        <p>"Water Quality Monitoring" adalah proses pengumpulan dan analisis data tentang kualitas air di berbagai sumber air seperti sungai, danau, sumur, dan saluran air lainnya. Tujuannya adalah untuk memastikan bahwa air tersebut memenuhi standar kualitas yang telah ditetapkan untuk penggunaan tertentu, seperti konsumsi manusia, irigasi, atau habitat bagi kehidupan akuatik. Proses ini melibatkan pengukuran berbagai parameter fisik, kimia, dan biologis yang dapat mempengaruhi kualitas air. Berikut adalah beberapa komponen utama dalam pemantauan kualitas air:</p>
        <h3>Parameter yang Dipantau</h3>
        <ol type="1">
            <li>Parameter Fisik</li>
            <ul>
                <li>Kekeruhan: Mengukur kejelasan air; kekeruhan yang tinggi bisa menandakan adanya partikel tersuspensi.</li>
                <li>Suhu: Suhu air yang terlalu tinggi atau rendah dapat mempengaruhi kehidupan akuatik dan proses kimia dalam air.</li>
            </ul>
            <li>Parameter Kimia</li>
            <ul>
                <li>pH: Menunjukkan keasaman atau alkalinitas air; pH yang ekstrem bisa berbahaya bagi kehidupan akuatik.</li>
                <li>Disolved Oxygen (Dis O2): Mengukur jumlah oksigen yang terlarut dalam air, penting untuk kehidupan ikan dan organisme air lainnya.</li>
            </ul>
        </ol>
        <h3>Metode Pemantauan</h3>
        <ol type="1">
            <li>Sampel Air Manual</li>
            <ul>
                <li>Mengambil sampel air secara langsung dari lokasi tertentu untuk dianalisis di laboratorium.</li>
            </ul>
            <li>Sensor dan Alat Pengukur Otomatis</li>
            <ul>
                <li>Penggunaan alat pengukur otomatis untuk mengumpulkan data secara real-time, seperti probe oksigen terlarut atau sensor pH.</li>
            </ul>
        </ol>
        <h3>Tabel Lokasi Pengamatan</h3>
        </div>
        <div>
            <?php if ($role_id == 1 || $role_id == 2) {?>
                <button id="myBtn" class="bubble-button">Tambah Data (+)</button>
            <?php } ?>
        </div>
        <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Lokasi</th>
            <?php if ($role_id == 1 || $role_id == 2) {?>   
            <th>Aksi</th>
            <?php } ?>
        </tr>
<?php

// Create a query to fetch all records from the `lokasi` table
$sql = "SELECT * FROM lokasi";

// Execute the query
$result = mysqli_query($koneksi, $sql);
$nomor = 1;

// Check if there are records in the result set
if (mysqli_num_rows($result) > 0) {


    // Fetch each record as an associative array
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $nomor . '</td>
                <td>' . $row['lokasi'] . '</td>';
            if ($role_id == 1 || $role_id == 2) {
                echo '<td> <a class="action-icon delete-btn" href="#" data-id=' . $row['id'] . '> Hapus 🗑️</a> </td>';
            }
        echo '</tr>';
        $nomor++;
    }

    // Close the table HTML
echo'</table>';

} else {
    echo "No records found.";
}

// Close the database connection
mysqli_close($koneksi);
?>
    </article>
</main>
  <script src="js/js_navbar.js"></script>
    </body>
</html>