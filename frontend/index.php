<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Website Galeri Foto</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="./PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/icongaleri.png" rel="icon">
    <link href="./PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/icongaleri.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Cardo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/css/main.css" rel="stylesheet">

    <style type="text/css">
        body {
            background-image: url('./PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/photo1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top bg-light">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0 ">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/logo.png" alt=""> -->

                <h2 class="sitename text-dark">Website Galeri Foto</h2>
            </a>

            <nav id="navmenu" class="navmenu">

                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

        <div class="d-flex justify-content-end me-4">
            <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
            <a href="login.php" class="btn btn-outline-success m-1">Masuk</a>
        </div>

    </header>
    

    <div class="container mt-3">
        <div class="row">
            <?php
            include 'config/koneksi.php';
            $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN album ON foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($query)) {
                $fotoid = $data['fotoid'];
            ?>
                <div class="col-md-3">
                    <!-- Card Foto -->
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $fotoid; ?>">
                        <div class="card mb-2">
                            <img src="../assets/img/<?php echo htmlspecialchars($data['lokasifile']); ?>"
                                alt=""
                                class="card-img-top"
                                title="<?php echo htmlspecialchars($data['judulfoto']); ?>"
                                style="height: 12rem; object-fit:cover;">
                            <div class="card-footer text-center">
                           
                                <?php
                                echo htmlspecialchars($data['judulfoto']);
                                echo "<hr>";
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' ");
                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $fotoid; ?>" name="batalsuka">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                <?php } else { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $fotoid; ?>" name="suka">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                <?php }
                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $fotoid; ?>">
                                    <i class="fa-regular fa-comment"></i></a>
                                <?php
                                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows(result: $jmlkomen) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </a>

                    <!-- Modal Komentar -->
                    <div class="modal fade" id="komentar<?php echo $fotoid; ?>" tabindex="-1"
                        aria-labelledby="komentarLabel<?php echo $fotoid; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <!-- Gambar -->
                                        <div class="col-md-8">
                                            <img src="../assets/img/<?php echo htmlspecialchars($data['lokasifile']); ?>"
                                                alt=""
                                                class="card-img-top"
                                                title="<?php echo htmlspecialchars($data['judulfoto']); ?>">
                                        </div>
                                        <!-- Detail & Komentar -->
                                        <div class="col-md-4">
                                            <div class="m-2 overflow-auto">
                                                <div class="sticky-top bg-white p-2">
                                                    <strong><?php echo $data['judulfoto']; ?></strong><br>
                                                    <span class="badge bg-secondary"><?php echo $data['tanggalunggah']; ?></span>
                                                    <span class="badge bg-primary"><?php echo $data['namaalbum']; ?></span>
                                                </div>
                                                <hr>
                                                <p align="left">
                                                    <?php echo $data['deskripsifoto']; ?>
                                                </p>
                                                <hr>
                                                <?php
                                                $fotoid = $data['fotoid'];
                                                $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user 
                                                ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                while ($row = mysqli_fetch_array($komentar)) {
                                                ?>
                                                    <p align="left">
                                                        <strong><?php echo $row['namalengkap']; ?></strong>
                                                        <?php echo $row['isikomentar']; ?>
                                                    </p>
                                                <?php } ?>
                                                <hr>
                                                <!-- Form Komentar -->

                                            </div>
                                        </div>
                                        <!-- End Detail -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            <?php } ?>
        </div>
    </div>



    <footer class="d-flex justify-content-center border-top mt-3 
    bg-light fixed-bottom">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">2025</strong> | <span>Galerifoto</span></p>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="line"></div>
    </div>

    <!-- Vendor JS Files -->
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/php-email-form/validate.js"></script>
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/aos/aos.js"></script>
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/js/main.js"></script>

</body>

</html>