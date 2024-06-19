<?php
// Sertakan file koneksi.php untuk koneksi ke database
require_once 'koneksi.php';

// Query untuk menghitung nilai rata-rata dari kolom pH, dis_O2, kekeruhan, dan suhu di tabel pemantauan
$sql = "SELECT AVG(pH) AS avg_pH, AVG(dis_o2) AS avg_dis_o2, AVG(kekeruhan) AS avg_kekeruhan, AVG(suhu) AS avg_suhu FROM pemantauan";

// Eksekusi query
$result = mysqli_query($koneksi, $sql);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil nilai rata-rata dari hasil query
    $row = mysqli_fetch_assoc($result);
    $avg_pH = $row['avg_pH'];
    $avg_dis_o2 = $row['avg_dis_o2'];
    $avg_kekeruhan = $row['avg_kekeruhan'];
    $avg_suhu = $row['avg_suhu'];

    // Buat baris kode HTML untuk progress bar berdasarkan nilai rata-rata
    ?>
    
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Title</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-Uv9jxBenhLL1+qzfUyxk5wrP+L5qvhwLTP60qjzTpL8=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


  <!-- Libraries CSS Files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/latest/css/all.min.css" integrity="sha512-Yi+QvDkqQrwCkWQ2jWkWIEoir+x6pzl54Z2p7z89cMj5LIusMVXLfm3ocN5CDeN39xTqgeJ7Ldbf/CWkWCoqGxw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

  <!-- Main Stylesheet File -->
  <link href="css/index.css" rel="stylesheet">

</head>

<body id="page-top">

    <!--/ Nav Star /-->
    <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll" href="#page-top">Kel.01</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
                    aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link js-scroll active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll" href="#service">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll" href="akun/login2regist.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--/ Nav End /-->
    <!--/ Intro Skew Star /-->
    <div id="home" class="intro route bg-image" style="background-image: url(https://alatuji.co.id/wp-content/uploads/2023/03/Pemantauan-Kualitas-Air-Dengan-Data-Logger.webp)">
        <div class="overlay-itro"></div>
        <div class="intro-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h1 class="intro-title mb-4">Pemantauan Kualitas air</h1>
                    
             
                </div>
            </div>
        </div>
    </div>
    <!--/ Intro Skew End /-->

    <section id="about" class="about-mf sect-pt4 route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-shadow-full">
                        <div class="row">
                           
                                <div class="row">
                                    <div class="col-sm-6 col-md-5">
                                        <div class="about-img">
                                            <img src="https://c3c8j8s9.rocketcdn.me/wp-content/uploads/2022/10/Pengolahan-Air-Laut-Feature.jpg" class="img-fluid rounded b-shadow-a" alt="">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                <p class="title-s">Progress Bar</p>
                <span class="pull-right">pH <?php echo $avg_pH; ?></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $avg_pH; ?>%;" aria-valuenow="<?php echo $avg_pH; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>Dis_O2</span> <span class="pull-right"><?php echo $avg_dis_o2; ?></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $avg_dis_o2; ?>%;" aria-valuenow="<?php echo $avg_dis_o2; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>Kekeruhan</span> <span class="pull-right"><?php echo $avg_kekeruhan; ?></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $avg_kekeruhan; ?>%;" aria-valuenow="<?php echo $avg_kekeruhan; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span>Suhu</span> <span class="pull-right"><?php echo $avg_suhu; ?></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $avg_suhu; ?>%;" aria-valuenow="<?php echo $avg_suhu; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <?php
} else {
    // Jika query tidak berhasil dieksekusi
    echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
                        
                            </div>
                            <div class="col-md-6">
                                <div class="about-me pt-4 pt-md-0">
                                    <div class="title-box-2">
                                        <h5 class="title-left">
                                            Tentang Kami
                                        </h5>
                                    </div>
                                    <p class="lead">
                                        Kami adalah platform terdepan yang berkomitmen untuk memberikan informasi real-time mengenai kualitas air bersih di berbagai wilayah. Dengan menggunakan teknologi canggih, kami memantau, menganalisis, dan menyediakan data yang dapat diakses oleh semua orang.
<br>
<br>
                                        <h5 class="title-left">Misi Kami </h5>
                                        <br>
                                        <br>
                                        <p class="lead">
                                            Kami bertekad untuk meningkatkan kesadaran dan aksi terhadap pentingnya air bersih dengan menyediakan data akurat dan terkini tentang kualitas air di seluruh negeri. Kami percaya bahwa dengan informasi yang tepat, masyarakat dan pemangku kepentingan dapat membuat keputusan yang lebih baik untuk menjaga dan meningkatkan kualitas air.
                                        </p>
                                    </p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Section Services Star /-->
    <section id="service" class="services-mf route">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title-box text-center">
                        <h3 class="title-a">
                            Services
                        </h3>
                        <div class="line-mf"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-box">
                        <div class="service-ico">
                            <span class="ico-circle"><i class="icon ion-md-stats"></i></span>
                        </div>
                        <div class="service-content">
                            <h2 class="s-title">Grafik</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box">
                        <div class="service-ico">
                            <span class="ico-circle"><i class="icon ion-md-compass"></i></span>
                        </div>
                        <div class="service-content">
                            <h2 class="s-title">Petunjuk</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-box">
                        <div class="service-ico">
                            <span class="ico-circle"><i class="icon ion-md-eye"></i></span>
                        </div>
                        <div class="service-content">
                            <h2 class="s-title">Pemantauan</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(img/Lap.jpg)">
        <div class="overlay-mf"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-mf">
                        <div id="contact" class="box-shadow-full">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title-box-2">
                                        <h5 class="title-left">
                                            Send me a message
                                        </h5>
                                    </div>
                                    <div>
                                        <form action="" id="cf" method="post" role="form">
                                            <div id="sendmessage">Your message has been sent. Thank you!</div>
                                            <div id="errormessage"></div>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <input class="form-control" name="message" rows="5" data-rule="required" placeholder="Message" />
                                                        <div class="validation"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" class="button button-a button-big button-rouded">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="title-box-2 pt-4 pt-md-0">
                                        <h5 class="title-left">
                                            Get in Touch
                                        </h5>
                                    </div>
                                    <div class="more-info">
                                        <p class="lead">
                                            For any inquiries, do not hesitate to contact me!
                                        </p>
                                        <ul class="list-ico">
                                            <li><span class="ion-ios-location"></span> Address</li>
                                            <li><span class="ion-ios-telephone"></span> +62 ***********</li>
                                            <li><span class="ion-email"></span> Kel.01@gmail.com</li>
                                        </ul>
                                    </div>
                                    <div class="socials">
                                        <ul>
                                            <li><a href='#'><span class="ico-circle"><i class="ion-social-linkedin"></i></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="copyright-box">
                            <p class="copyright">© Kelompok 01 Punya</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-Uv9jxBenhLL1+qzfUyxk5wrP+L5qvhwLTP60qjzTpL8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.1.min.js" integrity="sha256-KsRjqSIvQznv43EKdppYBn6tNtGKSQp7D4qU2P8N/uY=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-wHNqQXa6a5X6i67C4GvKNiiOUa7M7VYkPStStjqO5jWrGGIC8dQjNIlWZq8Aysu+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jY3zHTnfnHGOMHu1vUPEN8C9zFveqN+" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easing/3.0.0/easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" integrity="sha512-SJ2Kfkzp69PgNOUuhWh8lvzjohnnoPCNKnrOEoMaPtCL8z4HTtW/xPtOQSZKpFN0UFbU/DG2bm3s2zM8FFIlcA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/CounterUp/2.3.0/jquery.counterup.min.js" integrity="sha512-eZYtkXONaC9By3XGZ/PN4PNac4rN3tK8upQ9U9jR73HGjXup0YXF+r+r0CFhi2Dn24y8U8B8ZXaGQCv73yA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-hzTunOHHWha0HxhiiSXL4UWCBRa/TCZCrsc5xwKJqFsLf/GJ2zBV/ONuDX9WcusnYbE7AWem/qEtqDM7DjvwTlw==" crossorigin="anonymous"></script>

    <script type="text/javascript">
        if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="js/main.js"></script>

</body>
</html>
