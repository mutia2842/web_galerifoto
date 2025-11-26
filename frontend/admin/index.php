<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    echo "<script>
        alert('Anda Belum Login!');
        location.href='../index.php';
    </script>";
    exit;
}
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Website Galeri Foto</title>
    <link href="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/icongaleri.png" rel="icon">
    <link href="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />

    <style type="text/css">
        body {
            background-image: url('../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/photo1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center sticky-top bg-white shadow-sm">
        <div class="container d-flex align-items-center">
            <div class="logo me-4">
                <h1 class="sitename m-0 text-dark">Website Galeri Foto</h1>
            </div>
            <nav class="nav d-flex align-items-center">
               
                <a href="album.php" class="nav-link">Album</a>
                <a href="foto.php" class="nav-link">Foto</a>
            </nav>
            <div class="ms-auto">
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger btn-sm ms-2">Keluar</a>
            </div>
        </div>
    </header>
 
    <br>
    <!-- Konten -->
    <div class="container mt-3">
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM foto 
                        INNER JOIN user ON foto.userid=user.userid 
                        INNER JOIN album ON foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($query)) {
                $fotoid = $data['fotoid'];
            ?>
                <div class="col-md-3">
                    <div class="card mb-2">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $fotoid; ?>">
                            <img src="../../assets/img/<?php echo htmlspecialchars($data['lokasifile']); ?>"
                                alt=""
                                class="card-img-top"
                                title="<?php echo htmlspecialchars($data['judulfoto']); ?>"
                                style="height: 12rem; object-fit:cover;">
                        </a>
                        <div class="card-footer text-center">
                            <?php
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            ?>
                            <a href="javascript:void(0)"
                                class="btn-like <?php echo (mysqli_num_rows($ceksuka) ? 'text-danger' : ''); ?>"
                                data-fotoid="<?php echo $fotoid; ?>">
                                <?php if (mysqli_num_rows($ceksuka)) { ?>
                                    <i class="fa fa-heart"></i>
                                <?php } else { ?>
                                    <i class="fa-regular fa-heart"></i>
                                <?php } ?>
                            </a>
                            <span id="like-count-<?php echo $fotoid; ?>">
                                <?php echo mysqli_num_rows($like); ?> Suka
                            </span>

                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $fotoid; ?>">
                                <i class="fa-regular fa-comment"></i>
                            </a>
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($jmlkomen) . ' Komentar';
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Modal Komentar -->
                <div class="modal fade" id="komentar<?php echo $fotoid; ?>" tabindex="-1"
                    aria-labelledby="komentarLabel<?php echo $fotoid; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Gambar -->
                                    <div class="col-md-8">
                                        <img src="../../assets/img/<?php echo htmlspecialchars($data['lokasifile']); ?>"
                                            alt=""
                                            class="card-img-top"
                                            title="<?php echo htmlspecialchars($data['judulfoto']); ?>">
                                    </div>
                                    <!-- Detail & Komentar -->
                                    <div class="col-md-4">
                                        <div class="m-2 overflow-auto" style="max-height:70vh;">
                                            <div class="sticky-top bg-white p-2">
                                                <strong><?php echo $data['judulfoto']; ?></strong><br>
                                                <span class="badge bg-secondary"><?php echo $data['namalengkap']; ?></span>
                                                <span class="badge bg-secondary"><?php echo $data['tanggalunggah']; ?></span>
                                                <span class="badge bg-primary"><?php echo $data['namaalbum']; ?></span>
                                            </div>
                                            <hr>
                                            <p align="left"><?php echo $data['deskripsifoto']; ?></p>
                                            <hr>
                                            <div id="komentar-list-<?php echo $fotoid; ?>">
                                                <?php
                                                $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto 
                                                                INNER JOIN user ON komentarfoto.userid=user.userid 
                                                                WHERE komentarfoto.fotoid='$fotoid'");
                                                while ($row = mysqli_fetch_array($komentar)) {
                                                    echo "<p align='left'><strong>{$row['namalengkap']}</strong> {$row['isikomentar']}</p>";
                                                }
                                                ?>
                                            </div>
                                            <hr>
                                            <!-- Form Komentar -->
                                            <div class="sticky-bottom">
                                                <form class="form-komentar" data-fotoid="<?php echo $fotoid; ?>">
                                                    <div class="input-group">
                                                        <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                        <button type="submit" class="btn btn-outline-primary">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Detail -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto bg-light text-dark border-top py-3">
        <div class="container text-center">
            <p class="mb-0">© <span>Copyright</span>
                <strong class="px-1 sitename">2025</strong> | <span>Galerifoto</span>
            </p>
        </div>
    </footer>

    <!-- JS -->
    <script src="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // LIKE AJAX
        document.querySelectorAll('.btn-like').forEach(btn => {
            btn.addEventListener('click', function() {
                let fotoid = this.dataset.fotoid;
                fetch('../config/proses_like.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'fotoid=' + fotoid
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'liked') {
                            this.innerHTML = '<i class="fa fa-heart"></i>';
                            this.classList.add('text-danger');
                        } else {
                            this.innerHTML = '<i class="fa-regular fa-heart"></i>';
                            this.classList.remove('text-danger');
                        }
                        document.getElementById('like-count-' + fotoid).innerText = data.jumlah + ' Suka';
                    });
            });
        });

        // KOMENTAR AJAX
        document.querySelectorAll('.form-komentar').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let fotoid = this.dataset.fotoid;
                let isikomentar = this.querySelector('input[name="isikomentar"]').value;

                fetch('../config/proses_komentar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'fotoid=' + fotoid + '&isikomentar=' + encodeURIComponent(isikomentar)
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            let komentarList = document.getElementById('komentar-list-' + fotoid);
                            let newKomen = document.createElement('p');
                            newKomen.innerHTML = "<strong>" + data.namalengkap + "</strong> " + data.isikomentar;
                            komentarList.appendChild(newKomen);
                            form.reset();
                        }
                    });
            });
        });
    </script>
</body>

</html>