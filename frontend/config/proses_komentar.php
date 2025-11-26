<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'msg' => 'Belum login']);
    exit;
}

$userid = $_SESSION['userid'];
$fotoid = $_POST['fotoid'];
$isikomentar = $_POST['isikomentar'];
$tanggal = date("Y-m-d H:i:s");

mysqli_query($koneksi, "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) 
                        VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggal')");

// ambil nama user
$user = mysqli_fetch_array(mysqli_query($koneksi, "SELECT namalengkap FROM user WHERE userid='$userid'"));

echo json_encode([
    'success' => true,
    'isikomentar' => $isikomentar,
    'namalengkap' => $user['namalengkap']
]);
?>