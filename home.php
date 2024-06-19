<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="x-icon" href="images/Logo.jpg">
    <title>Reda Dev</title>
    <!-- Google Tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N26NW1ZG1M"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-N26NW1ZG1M');
    </script>
</head>
<body>

<section class="cards" id="services">
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
    <div class="content">
        <a href="grafik/grafik.php">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="info">
                    <h3>Grafik</h3>
                </div>
            </div>
        </a>   
        <a href="pemantauan/hasil_pemantauan.php">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="info">
                    <h3>Pemantauan</h3>   
                </div>
            </div>
        </a>
        <a href="petunjuk.php">
            <div class="card">
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="info">
                    <h3>Petunjuk</h3>
                </div>
            </div>
        </a>
        <?php
        // Periksa apakah pengguna telah login dan memiliki session role_id
        session_start();
        if (isset($_SESSION["role_id"]) && $_SESSION["role_id"] == 1) {
            echo '<a href="akun/daftar_akun.php">
                <div class="card">
                    <div class="icon">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <div class="info">
                        <h3>Daftar Akun</h3>  
                    </div>
                </div>
            </a>';
        }
        ?>
        <a href="akun/logout.php">
            <div class="card">
                <div class="icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <div class="info">
                    <h3>Log Out</h3>
                </div>
            </div>
        </a>
    </div>
</section>

</body>
</html>
