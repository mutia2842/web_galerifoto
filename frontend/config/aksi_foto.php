<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include './koneksi.php';

// Pastikan user login
if (!isset($_SESSION['userid'])) {
    die("User belum login");
}
$userid = $_SESSION['userid'];

// Lokasi penyimpanan file
$lokasi = '../../assets/img/';
if (!is_dir($lokasi)) {
    mkdir($lokasi, 0777, true);
}

/* =======================
   TAMBAH DATA
   ======================= */
if (isset($_POST['tambah'])) {
    $judulfoto     = mysqli_real_escape_string($koneksi, $_POST['judulfoto']);
    $deskripsifoto = mysqli_real_escape_string($koneksi, $_POST['deskripsifoto']);
    $tanggalunggah = date('Y-m-d');
    if (empty($_POST['albumid'])) {
        echo "<script>alert('Album wajib dipilih!'); location.href='../admin/foto.php';</script>";
        exit;
    }
    $albumid = $_POST['albumid'];


    $foto     = $_FILES['lokasifile']['name'];
    $tmp      = $_FILES['lokasifile']['tmp_name'];
    $namafoto = rand() . '-' . $foto;

    if (!empty($foto)) {
        if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
            $sql = "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, albumid, userid, lokasifile) 
                    VALUES ('$judulfoto', '$deskripsifoto', '$tanggalunggah', '$albumid', '$userid', '$namafoto')";
            if (!mysqli_query($koneksi, $sql)) {
                die("Query Error: " . mysqli_error($koneksi));
            }
            echo "<script>alert('Data berhasil ditambahkan!'); location.href='../admin/foto.php';</script>";
        } else {
            echo "<script>alert('Upload foto gagal!'); location.href='../admin/foto.php';</script>";
        }
    } else {
        echo "<script>alert('Foto wajib diupload!'); location.href='../admin/foto.php';</script>";
    }
}

/* =======================
   EDIT DATA
   ======================= */
if (isset($_POST['edit'])) {
    $fotoid        = $_POST['fotoid'];
    $judulfoto     = mysqli_real_escape_string($koneksi, $_POST['judulfoto']);
    $deskripsifoto = mysqli_real_escape_string($koneksi, $_POST['deskripsifoto']);
    $tanggalunggah = date('Y-m-d');
    if (empty($_POST['albumid'])) {
        echo "<script>alert('Album wajib dipilih!'); location.href='../admin/foto.php';</script>";
        exit;
    }
    $albumid = $_POST['albumid'];


    $foto     = $_FILES['lokasifile']['name'];
    $tmp      = $_FILES['lokasifile']['tmp_name'];
    $namafoto = rand() . '-' . $foto;

    if (empty($foto)) {
        // Update tanpa ganti foto
        $sql = "UPDATE foto 
                SET judulfoto='$judulfoto',
                    deskripsifoto='$deskripsifoto',
                    tanggalunggah='$tanggalunggah',
                    albumid='$albumid'
                WHERE fotoid='$fotoid'";
        if (!mysqli_query($koneksi, $sql)) {
            die("Query Error: " . mysqli_error($koneksi));
        }
    } else {
        // Ambil data lama
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data  = mysqli_fetch_array($query);

        // Hapus file lama jika ada
        if (!empty($data['lokasifile']) && is_file($lokasi . $data['lokasifile'])) {
            unlink($lokasi . $data['lokasifile']);
        }

        // Upload file baru
        if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
            $sql = "UPDATE foto 
                    SET judulfoto='$judulfoto',
                        deskripsifoto='$deskripsifoto',
                        tanggalunggah='$tanggalunggah',
                        albumid='$albumid',
                        lokasifile='$namafoto'
                    WHERE fotoid='$fotoid'";
            if (!mysqli_query($koneksi, $sql)) {
                die("Query Error: " . mysqli_error($koneksi));
            }
        } else {
            echo "<script>alert('Upload foto baru gagal!'); location.href='../admin/foto.php';</script>";
            exit;
        }
    }

    echo "<script>alert('Data berhasil diperbarui!'); location.href='../admin/foto.php';</script>";
}
?>
