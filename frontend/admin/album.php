<?php
session_start();
include '../config/koneksi.php';

// Cek apakah sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>

    <!-- Favicons -->
    <link href="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/icongaleri.png" rel="icon">
    <link href="../PhotoFolio-1.0.0/PhotoFolio-1.0.0/assets/img/icongaleri.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Website Galeri Foto</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="album.php" class="nav-link">Album</a></li>
                    <li class="nav-item"><a href="foto.php" class="nav-link">Foto</a></li>
                </ul>
                <a href="../config/aksi_logout.php" class="btn btn-outline-danger btn-sm ms-3">Keluar</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <div class="row g-4">

            <!-- Form Tambah Album -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">Tambah Album</div>
                    <div class="card-body">
                        <form action="../config/aksi_album.php" method="POST">
                            <div class="mb-3">
                                <label for="namaalbum" class="form-label">Nama Album</label>
                                <input type="text" class="form-control" id="namaalbum" name="namaalbum" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="tanggaldibuat" class="form-label">Tanggal Dibuat</label>
                                <input type="date" class="form-control" id="tanggaldibuat" name="tanggaldibuat" required>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Data Album -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">Data Album</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Album</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM album ORDER BY tanggaldibuat DESC");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($data['namaalbum']) ?></td>
                                        <td><?= htmlspecialchars($data['deskripsi']) ?></td>
                                        <td><?= $data['tanggaldibuat'] ?></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $data['albumid'] ?>">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edit<?= $data['albumid'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_album.php" method="post">
                                                                <input type="hidden" name="albumid" value="<?= $data['albumid'] ?>">

                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Album</label>
                                                                    <input type="text" class="form-control" name="namaalbum" value="<?= htmlspecialchars($data['namaalbum']) ?>" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Deskripsi</label>
                                                                    <textarea class="form-control" name="deskripsi" rows="3" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <div class="container">
            <div class="copyright text-center">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">2025</strong> | <span>Galerifoto</span></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>