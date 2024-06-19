<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once '../koneksi.php';

// Mulai session
session_start();

// Periksa apakah pengguna sudah login, jika iya, arahkan ke halaman home.php
if (isset($_SESSION['role_id'])) {
    header("Location: ../home.php");
    exit();
}

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$login_err = '';

// Periksa apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Tangkap data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mencari user berdasarkan username dan password
    $sql = "SELECT id, role_id FROM account WHERE username = ? AND password = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        // Bind variabel ke pernyataan persiapan sebagai parameter
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Atur parameter
        $param_username = $username;
        $param_password = $password;

        // Cobalah untuk mengeksekusi pernyataan persiapan
        if (mysqli_stmt_execute($stmt)) {
            // Simpan hasil eksekusi
            mysqli_stmt_store_result($stmt);

            // Periksa apakah username dan password ada dalam database
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind kolom hasil ke variabel
                mysqli_stmt_bind_result($stmt, $id, $role_id);

                if (mysqli_stmt_fetch($stmt)) {
                    // Jika sesuai, mulai session dan arahkan ke halaman home.php
                    session_start();

                    // Simpan data dalam session
                    $_SESSION["id"] = $id;
                    $_SESSION["role_id"] = $role_id;
                    $_SESSION["username"] = $username;

                    header("location: ../home.php");
                }
            } else {
                // Jika username atau password tidak cocok, tampilkan pesan kesalahan
                $login_err = "Username atau password salah.";
            }
        } else {
            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }
    }

    // Tutup pernyataan
    mysqli_stmt_close($stmt);

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login Here!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_login2regist.css">
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                    <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                    <label for="reg-log"></label>
                    <div class="card-3d-wrap mx-auto">
                        <div class="card-3d-wrapper">
                            <div class="card-front">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="error"><?php echo $login_err; ?></div>
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <div class="form-group">
                                                <input type="email" name="username" class="form-style" placeholder="Masukkan Email" required>
                                                <i class="input-icon uil uil-at"></i>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="password" name="password" class="form-style" placeholder="Masukkan Password" required>
                                                <i class="input-icon uil uil-lock-alt"></i>
                                            </div>
                                            <input type="submit" class="btn mt-4" name="login" value="Login">
                                            <a href="../index.php" class="btn btn-secondary mt-4">Kembali</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-back">
                                <div class="center-wrap">
                                    <div class="section text-center">
                                        <h4 class="mb-3 pb-3">Register</h4>
                                        <?php
                                        // Inisialisasi variabel
                                        $name = $username = $password = $role_id = "";
                                        $name_err = $username_err = $password_err = "";

                                        // Periksa apakah formulir telah disubmit
                                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
                                            // Periksa apakah input nama telah diisi
                                            if (empty(trim($_POST["name"]))) {
                                                $name_err = "Silakan masukkan nama.";
                                            } else {
                                                $name = trim($_POST["name"]);
                                            }

                                            // Periksa apakah input username telah diisi
                                            if (empty(trim($_POST["username"]))) {
                                                $username_err = "Silakan masukkan username.";
                                            } else {
                                                $username = trim($_POST["username"]);
                                            }

                                            // Periksa apakah input password telah diisi
                                            if (empty(trim($_POST["password"]))) {
                                                $password_err = "Silakan masukkan password.";
                                            } else {
                                                $password = trim($_POST["password"]);
                                            }

                                            // Set nilai role_id secara otomatis
                                            $role_id = 3;

                                            // Jalankan proses pendaftaran jika tidak ada kesalahan validasi
                                            if (empty($name_err) && empty($username_err) && empty($password_err)) {
                                                // Masukkan data ke dalam tabel account
                                                $sql = "INSERT INTO account (name, username, password, role_id) VALUES (?, ?, ?, ?)";

                                                if ($stmt = $koneksi->prepare($sql)) {
                                                    // Bind parameter ke pernyataan persiapan SQL sebagai string
                                                    $stmt->bind_param("sssi", $param_name, $param_username, $param_password, $param_role_id);

                                                    // Tetapkan nilai parameter
                                                    $param_name = $name;
                                                    $param_username = $username;
                                                    $param_password = $password;
                                                    $param_role_id = $role_id;

                                                    // Jalankan pernyataan persiapan SQL
                                                    if ($stmt->execute()) {
                                                        // Redirect ke halaman register2.php setelah pendaftaran berhasil
                                                        header("location: login2regist.php");
                                                        exit();
                                                    } else {
                                                        echo "Terjadi kesalahan. Silakan coba lagi.";
                                                    }
                                                }

                                                // Tutup pernyataan
                                                $stmt->close();
                                            }
                                        }
                                        ?>

                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="form-group">
                                                <label for="name">Nama:</label>
                                                <input type="text" id="name" name="name" class="form-style" placeholder="Nama Lengkap">
                                                <span><?php echo $name_err; ?></span>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="username">Username:</label>
                                                <input type="email" id="username" name="username" class="form-style" placeholder="Username/Email">
                                                <span><?php echo $username_err; ?></span>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="password">Password:</label>
                                                <input type="password" id="password" name="password" class="form-style" placeholder="Tuliskan Password">
                                                <span><?php echo $password_err; ?></span>
                                            </div>
                                            <input type="submit" class="btn mt-4" name="register" value="Daftar">
                                            <a href="../index.php" class="btn btn-secondary mt-4">Kembali</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
