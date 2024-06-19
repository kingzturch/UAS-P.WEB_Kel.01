<?php
session_start();
// Sertakan file koneksi.php
require_once "../koneksi.php";
if (!isset($_SESSION['role_id'])) {
    header("Location: ../akun/login2regist.php");
    exit;
  }

  // Set role_id from session
  $role_id = $_SESSION['role_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabel Account</title>
    <link rel="stylesheet" href="../css/style_daftarakun.css">
    <link rel="stylesheet" href="../css/style_navbar.css">
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
                <li><a href="daftar_akun.php">Daftar Akun</a></li>
            <?php } ?>
            <li><a href="logout.php">Log Out</a></li>
            <li>
            <?php if ($role_id == 1) {?>
                <a href="../home.php">
            <?php } ?>
            <?php if ($role_id != 1) {?>
                <a href="edit_akun.php?id=<?php echo $account_id; ?>">
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
<br>
<br>
<br>
<br>
<br>
<br>
<h2>Tabel Account</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    <?php

    // Query untuk mendapatkan data dari tabel account beserta nama role
    $sql = "SELECT account.id, account.name, account.username, account.password, role.role 
            FROM account 
            INNER JOIN role ON account.role_id = role.id";
    $result = mysqli_query($koneksi, $sql);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Tampilkan data dalam bentuk tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td class='actions'>
                    <a class='1' href='read_akun.php?id=" . $row['id'] . "'>Read</a> | 
                    <a class='2' href='edit_akun.php?id=" . $row['id'] . "'>Edit</a> | 
                    <a class='3' href='delete_akun.php?id=" . $row['id'] . "'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        // Bebaskan hasil query
        mysqli_free_result($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi (opsional karena koneksi akan ditutup secara otomatis saat skrip selesai dijalankan)
    mysqli_close($koneksi);
    ?>
</table>

<script src="../js/js_navbar.js"></script>
</body>
</html>