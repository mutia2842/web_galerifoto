<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['userid'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$userid = $_SESSION['userid'];
$fotoid = $_POST['fotoid'] ?? null;

if (!$fotoid) {
    echo json_encode(['status' => 'error', 'message' => 'Foto ID tidak valid']);
    exit;
}

// cek apakah sudah like
$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

if (mysqli_num_rows($ceksuka) > 0) {
    // sudah like → batal
    mysqli_query($koneksi, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
    $status = 'unliked';
} else {
    // belum like → tambah
    mysqli_query($koneksi, "INSERT INTO likefoto (fotoid, userid) VALUES ('$fotoid', '$userid')");
    $status = 'liked';
}

// hitung ulang jumlah like
$like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
$jumlah = mysqli_num_rows($like);

echo json_encode([
    'status' => $status,
    'jumlah' => $jumlah
]);
?>