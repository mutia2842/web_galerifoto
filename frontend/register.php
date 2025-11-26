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

    <!-- =======================================================
  * Template Name: PhotoFolio
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


    <style>
        /* Background efek gradasi disko */
        body {
            background: linear-gradient(270deg, #87d4e4ff);
            background-size: 1200% 1200%;
            animation: discoGradient 15s ease infinite;
        }

        @keyframes discoGradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Supaya card login tetap enak dibaca */
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
        }
    </style>

</head>

<body class="index-page">

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center sticky-top bg-light">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0 ">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/logo.png" alt=""> -->

                <h1 class="sitename text-dark">Website Galeri Foto</h1>
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
    <br>
    <!-- Main Content -->
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="text-center">
                            <h3 class="text-dark">Daftar Akun Baru</h3>
                        </div>
                        <form action="config/aksi_register.php" method="POST">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>

                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>

                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" required>

                            <div class="d-grid mt-3">
                                <button class="btn btn-primary" type="submit" name="kirim">DAFTAR</button>
                            </div>
                        </form>
                        <br>
                        <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 
    bg-light fixed-bottom">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">2025</strong> | <span>Galerifoto</span> </p>
            </div>
        </div>

    </footer>

    <!-- Vendor JS -->
    <script src="PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>