<!DOCTYPE html>
<html>
<head>
    <title>Edit Akun</title>
    <style>
        form {
            width: 50%;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 5px;
            margin-top: 3px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 7px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Edit Akun</h2>

<?php
// Sertakan file koneksi.php
require_once "../koneksi.php";

// Definisikan variabel dan inisialisasi dengan nilai kosong
$name = $username = $password = "";
$name_err = $username_err = $password_err = "";

// Proses data formulir setelah pengguna mengirimkan formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input nama
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Masukkan nama.";
    } else {
        $name = $input_name;
    }

    // Validasi input username
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Masukkan username.";
    } else {
        $username = $input_username;
    }

    // Validasi input password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Masukkan password.";
    } else {
        $password = $input_password;
    }

    // Periksa apakah tidak ada kesalahan input sebelum memperbarui data di database
    if (empty($name_err) && empty($username_err) && empty($password_err)) {
        // Persiapkan pernyataan UPDATE
        $sql = "UPDATE account SET name=?, username=?, password=? WHERE id=?";

        if ($stmt = mysqli_prepare($koneksi, $sql)) {
            // Bind variabel ke pernyataan persiapan sebagai parameter
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_username, $param_password, $param_id);

            // Atur parameter
            $param_name = $name;
            $param_username = $username;
            $param_password = $password;
            $param_id = $_GET["id"];

            // Cobalah untuk mengeksekusi pernyataan persiapan
            if (mysqli_stmt_execute($stmt)) {
                // Data berhasil diperbarui, arahkan kembali ke halaman edit_profil
                header("location: edit_profil.php");
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
} else {
    // Peroleh data akun yang akan diedit dari URL
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Persiapkan pernyataan SELECT
        $sql = "SELECT * FROM account WHERE id = ?";
        if ($stmt = mysqli_prepare($koneksi, $sql)) {
            // Bind variabel ke pernyataan persiapan sebagai parameter
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Atur parameter
            $param_id = trim($_GET["id"]);

            // Cobalah untuk mengeksekusi pernyataan persiapan
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $username = $row["username"];
                    $password = $row["password"];
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

        // Tutup koneksi
        mysqli_close($koneksi);
    } else {
        // ID tidak ditemukan, arahkan kembali ke halaman error
        header("location: error.php");
        exit();
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $_GET["id"]); ?>" method="post">
    <div>
        <label>Nama</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span><?php echo $name_err; ?></span>
    </div>
    <div>
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span><?php echo $username_err; ?></span>
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <span><?php echo $password_err; ?></span>
    </div>
    <input type="submit" value="Lanjutkan">
    <a href="../home.php">Batal</a>
</form>

</body>
</html>
