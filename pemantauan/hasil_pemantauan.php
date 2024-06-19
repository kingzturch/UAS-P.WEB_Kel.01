<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Water Quality Monitoring</title>
  <link rel="stylesheet" href="../css/style_pemantauan.css">
  <link rel="stylesheet" href="../css/style_navbar.css">
  <link rel="stylesheet" href="../css/style_modal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- vagination dan fitur search (pokok untuk tampilan) -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> <!-- DataTables CSS -->

  <!-- membantu untuk download excel -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <!-- download PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <!-- download pdf (auto table) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

<!-- buat menampilkan modal hal. (buat tata letak) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- vagination untuk mepersingkay table yg terlalu panjang membaginya menjadi beberapa sesi -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> <!-- DataTables JS -->
</head>

<body>

<!-- memulai sesi -->
<?php 
  session_start();

  // koneksi ke data base
  require_once "../koneksi.php"; 
  // Redirect to login if not authenticated
  if (!isset($_SESSION['role_id'])) {
    header("Location: ../akun/login2regist.php");
    exit;
  }

  // Set role_id from session (mengatur tampilan user berdasarkan role)
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
            <li><a href="../home.php">Home</a></li>
            <li><a href="../grafik/grafik.php">Grafik</a></li>
            <li><a href="hasil_pemantauan.php">Hasil Pemantauan</a></li>
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
<br><br><br>

<div class="table-container">
  <h1>Water Quality Monitoring</h1>
  <div class="buttons">
  <?php if ($role_id == 1 || $role_id == 2) {?>
    <button id="myBtn" class="bubble-button">Tambah Data (+)</button>
  <?php } ?>
    <div class="download-buttons">
      <button class="download-button" onclick="downloadExcel()">Download Excel</button>
      <button class="download-button" onclick="downloadPDF()">Download PDF</button>
      <button class="download-button" onclick="downloadJPEG()">Download JPEG</button>
    </div>
  </div>
 <!-- The Modal Create -->
 <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="modal-body">
      <!-- Konten modal akan dimuat di sini melalui AJAX -->
      </div>
    </div>
  </div>

  <!-- Modal Delete -->
 <div id="deleteModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="delete-modal-body">
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <button id="confirmDelete" class="delete-button">Ya</button>
        <button id="cancelDelete" class="cancel-button">Tidak</button>
      </div>
    </div>
  </div>

  <table id="data-table" class="display">
    <thead>
    <tr>
        <th>No</th>
        <?php if ($role_id == 1 || $role_id == 2): ?>
          <th>Nama Pegawai</th>
        <?php endif; ?>
        <th>Kekeruhan</th>
        <th>Dis O2</th>
        <th>pH</th>
        <th>Suhu</th>
        <th>Lokasi</th>
        <th>Tanggal Pemantauan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Fetch and display the data from the database
    $sql = "SELECT pemantauan.id, account.name AS nama_pegawai, pemantauan.kekeruhan, pemantauan.dis_o2, pemantauan.pH, 
            pemantauan.suhu, lokasi.lokasi, pemantauan.tgl_pantau, pemantauan.status 
            FROM pemantauan 
            -- beda table agar dapat terpanggil karna id yg di butuhkan berada di beda tabble (berdasarkan db)
            INNER JOIN pegawai ON pemantauan.pegawai_id = pegawai.id 
            INNER JOIN account ON pegawai.account_id = account.id 
            INNER JOIN lokasi ON pemantauan.lokasi_id = lokasi.id";
            
    $result = mysqli_query($koneksi, $sql);

    $nomor = 1;

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $nomor . "</td>";
            if ($role_id == 1 || $role_id == 2) {
                echo "<td>" . $row['nama_pegawai'] . "</td>";
            }
            echo "<td>" . $row['kekeruhan'] . "</td>";
            echo "<td>" . $row['dis_o2'] . "</td>";
            echo "<td>" . $row['pH'] . "</td>";
            echo "<td>" . $row['suhu'] . "</td>";
            echo "<td>" . $row['lokasi'] . "</td>";
            echo "<td>" . $row['tgl_pantau'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td class='actions'>";
            if ($role_id == 1 || $role_id == 2) {
                echo "<a class='action-icon' href='read_pemantauan.php?id=" . $row['id'] . "'>Lihat 👁️</a> ";
                echo "<a class='action-icon edit-btn' href='#' data-id=" .$row['id']."'>Edit ✏️</a>";
                echo "<a class='action-icon delete-btn' href='#' data-id=" . $row['id'] . "'>Hapus 🗑️</a>";
            } if ($role_id == 3) {
                echo "<a class='action-icon' href='read_pemantauan.php?id=" . $row['id'] . "'>Lihat 👁️</a> ";
            }
            echo "</td>";
            echo "</tr>";
            $nomor++;
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
    ?>
    </tbody>
  </table>
</div>

<script src="../js/js_download.js"></script>
<script src="../js/modal_create.js"></script>
<script src="../js/cache_clear.js"></script>
<script src="../js/modal_edit.js"></script>
<script src="../js/modal_delete.js"></script>
<script src="../js/js_navbar.js"></script>
<script src="../js/datatables.js"></script>

</body>
</html>
