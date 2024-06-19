<?php
session_start();
// Sertakan file koneksi.php
require_once "../koneksi.php";

// Periksa apakah metode yang digunakan adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $pegawai_id = $_POST["pegawai_id"];
    $kekeruhan = $_POST["kekeruhan"];
    $dis_o2 = $_POST["dis_o2"];
    $pH = $_POST["pH"];
    $suhu = $_POST["suhu"];
    
    // Ubah format tanggal menjadi Y-m-d
    $tgl_pantau = date('Y-m-d', strtotime($_POST["tgl_pantau"]));

    $lokasi_id = $_POST["lokasi_id"];

       // Tentukan status berdasarkan nilai kolom
       function getStatus($pH, $dis_o2, $kekeruhan, $suhu) {
        if (($pH >= 6.9 && $pH <= 7.5) && ($dis_o2 >= 8 && $dis_o2 <= 10) && ($kekeruhan >= 0 && $kekeruhan <= 0.6) && ($suhu >= 25 && $suhu <= 29)) {
            return "Jernih";
        } elseif ((($pH >= 6.7 && $pH < 6.9) || ($pH > 7.5 && $pH <= 8)) && ($dis_o2 >= 6.5 && $dis_o2 <= 8) && ($kekeruhan >= 0.6 && $kekeruhan <= 1.5) && ($suhu >= 22 && $suhu <= 31)) {
            return "Standar";
        } elseif ((($pH >= 6.3 && $pH < 6.7) || ($pH > 8 && $pH <= 8.2)) && ($dis_o2 >= 4 && $dis_o2 <= 6.5) && ($kekeruhan >= 1.5 && $kekeruhan <= 2) && ($suhu >= 30 && $suhu <= 34)) {
            return "Keruh";
        } elseif (($pH >= 5 && $pH < 6.3) && ($dis_o2 >= 0 && $dis_o2 <= 4) && ($kekeruhan >= 2 && $kekeruhan <= 3) && ($suhu >= 34 && $suhu <= 39)) {
            return "Sangat Keruh";
        } else {
            return "Tidak Diketahui";
        }
    }

    // Dapatkan status berdasarkan nilai kolom
    $status = getStatus($pH, $dis_o2, $kekeruhan, $suhu);

    // Persiapkan pernyataan INSERT
    $sql = "INSERT INTO pemantauan (pegawai_id, kekeruhan, dis_o2, pH, suhu, tgl_pantau, lokasi_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        // Bind variabel ke pernyataan persiapan sebagai parameter
        mysqli_stmt_bind_param($stmt, "iddddsis", $param_pegawai_id, $param_kekeruhan, $param_dis_o2, $param_pH, $param_suhu, $param_tgl_pantau, $param_lokasi_id, $param_status);

        // Atur parameter
        $param_pegawai_id = $pegawai_id;
        $param_kekeruhan = $kekeruhan;
        $param_dis_o2 = $dis_o2;
        $param_pH = $pH;
        $param_suhu = $suhu;
        $param_tgl_pantau = $tgl_pantau;
        $param_lokasi_id = $lokasi_id;
        $param_status = $status;

        // Cobalah untuk mengeksekusi pernyataan persiapan
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'hasil_pemantauan.php';</script>";

            // Jika berhasil, arahkan ke halaman hasil_pemantauan.php
            header("location: hasil_pemantauan.php");
            exit();
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

