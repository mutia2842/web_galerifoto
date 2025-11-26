<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // ✅ wajib ada untuk membaca session

// cek apakah sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: ../login.php"); // arahkan ke halaman login
    exit();
}

include '../config/koneksi.php';
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

    <style>
        body {
            padding-bottom: 100px;
            /* biar tidak mepet footer */
        }
    </style>
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

            <!-- Form Tambah Foto -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Judul Foto</label>
                                <input type="text" class="form-control" name="judulfoto" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi Foto</label>
                                <textarea class="form-control" name="deskripsifoto" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Album</label>
                                <select name="albumid" class="form-control" required>
                                    <option value="">-- Pilih Album --</option>
                                    <?php
                                    $album = mysqli_query($koneksi, "SELECT * FROM album ORDER BY tanggaldibuat DESC");
                                    while ($rowAlbum = mysqli_fetch_assoc($album)) {
                                        echo "<option value='{$rowAlbum['albumid']}'>{$rowAlbum['namaalbum']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" class="form-control" name="lokasifile" required>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Data Foto -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">Data Foto</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto ORDER BY tanggalunggah DESC");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><img src="../../assets/img/<?= $data['lokasifile'] ?>" width="100"></td>
                                        <td><?= htmlspecialchars($data['judulfoto']) ?></td>
                                        <td><?= htmlspecialchars($data['deskripsifoto']) ?></td>
                                        <td><?= $data['tanggalunggah'] ?></td>

                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $data['fotoid'] ?>">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?= $data['fotoid'] ?>" tabindex="-1" aria-labelledby="editLabel<?= $data['fotoid'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editLabel<?= $data['fotoid'] ?>">Edit Foto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="fotoid" value="<?= $data['fotoid'] ?>">

                                                        <div class="mb-3">
                                                            <label class="form-label">Judul Foto</label>
                                                            <input type="text" name="judulfoto" class="form-control" value="<?= htmlspecialchars($data['judulfoto']) ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea name="deskripsifoto" class="form-control" required><?= htmlspecialchars($data['deskripsifoto']) ?></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Album</label>
                                                            <select name="albumid" class="form-control" required>
                                                                <option value="">-- Pilih Album --</option>
                                                                <?php
                                                                $album = mysqli_query($koneksi, "SELECT * FROM album ORDER BY tanggaldibuat DESC");
                                                                while ($rowAlbum = mysqli_fetch_assoc($album)) {
                                                                    $selected = ($rowAlbum['albumid'] == $data['albumid']) ? "selected" : "";
                                                                    echo "<option value='{$rowAlbum['albumid']}' $selected>{$rowAlbum['namaalbum']}</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Ganti Foto (Opsional)</label>
                                                            <input type="file" name="lokasifile" class="form-control">
                                                            <small>File saat ini: <?= $data['lokasifile'] ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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
                <p>© <span>Copyright</span> <strong class="px-1 sitename">2025</strong> | <span>Galerifoto</span> </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>