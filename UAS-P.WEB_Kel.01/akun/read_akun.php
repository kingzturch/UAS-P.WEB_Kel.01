<?php 
  // Memeriksa apakah pengguna telah login dan memiliki session role_id
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Akun</title>
</head>
<body>

<h2>Detail Akun</h2>
<br>
<a href="daftar_akun.php" class="btn-back">Kembali ke Halaman Pemantauan</a>

<?php
// Sertakan file koneksi.php
require_once "../koneksi.php";

// Periksa apakah parameter id dikirimkan melalui URL
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Persiapkan pernyataan SELECT
    $sql = "SELECT a.*, r.role FROM account a JOIN role r ON a.role_id = r.id WHERE a.id = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        // Bind variabel ke pernyataan persiapan sebagai parameter
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Atur parameter
        $param_id = trim($_GET["id"]);

        // Cobalah untuk mengeksekusi pernyataan persiapan
        if (mysqli_stmt_execute($stmt)) {
            // Simpan hasil
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // Ambil baris hasil sebagai array asosiatif
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Tampilkan detail akun
                echo "<table>";
                echo "<tr><th>ID</th><td>" . $row["id"] . "</td></tr>";
                echo "<tr><th>Nama</th><td>" . $row["name"] . "</td></tr>";
                echo "<tr><th>Username</th><td>" . $row["username"] . "</td></tr>";
                echo "<tr><th>Password</th><td>" . $row["password"] . "</td></tr>";
                echo "<tr><th>Role</th><td>" . $row["role"] . "</td></tr>";
                

                // Periksa role_id
                if ($row["role_id"] == 2) {
                    // Jika role_id = 2 (pegawai), tampilkan data dari tabel pegawai
                    $sql_data = "SELECT * FROM pegawai WHERE account_id = ?";
                } elseif ($row["role_id"] == 3) {
                    // Jika role_id = 3 (user), tampilkan data dari tabel user
                    $sql_data = "SELECT * FROM user WHERE account_id = ?";
                }

                // Persiapkan dan jalankan pernyataan SELECT tergantung pada role_id
                if (isset($sql_data)) {
                    if ($stmt_data = mysqli_prepare($koneksi, $sql_data)) {
                        mysqli_stmt_bind_param($stmt_data, "i", $param_id);
                        if (mysqli_stmt_execute($stmt_data)) {
                            $result_data = mysqli_stmt_get_result($stmt_data);
                            if (mysqli_num_rows($result_data) > 0) {
                               
                                while ($row_data = mysqli_fetch_array($result_data, MYSQLI_ASSOC)) {      
                                    // Periksa role_id
                                    if ($row["role_id"] == 2) {
                                        // Tampilkan data terkait dalam tabel
                                        echo "<tr><th>Jenis Kelamin</th><td>" . $row_data["jk"] . "</td></tr>";
                                        $lokasi_id = $row_data["lokasi_id"];
                                        $lokasi_query = mysqli_query($koneksi, "SELECT lokasi FROM lokasi WHERE id = $lokasi_id");
                                        $lokasi_data = mysqli_fetch_assoc($lokasi_query);
                                        echo "<tr><th>Lokasi Tugas</th><td>" . $lokasi_data["lokasi"] . "</td></tr>";
                                        echo "<tr><th>Jabatan</th><td>" . $row_data["jabatan"] . "</td></tr>";
                                    } elseif ($row["role_id"] == 3) {
                                       // Tampilkan data terkait dalam tabel
                                       echo "<tr><th>Jenis Kelamin</th><td>" . $row_data["jk"] . "</td></tr>";
                                       echo "<tr><th>Tempat Lahir</th><td>" . $row_data["tmpt_lahir"] . "</td></tr>";
                                       echo "<tr><th>Tanggal Lahir</th><td>" . $row_data["tgl_lahir"] . "</td></tr>";
                                    }
                                }
                                echo "</table>";
                            } else {
                                echo "<p>Tidak ada data terkait.</p>";
                            }
                        } else {
                            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
                        }
                        mysqli_stmt_close($stmt_data);
                    }
                }

            } else {
                // ID tidak valid, arahkan kembali ke halaman error
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }
    }

    // Tutup pernyataan
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
</body>
</html>
