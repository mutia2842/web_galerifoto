<?php
$hostname = 'localhost';
$userdb   = 'root';
$passdb   = '';
$namedb   = 'web_galerifoto';

$koneksi = mysqli_connect($hostname, $userdb, $passdb, $namedb);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
