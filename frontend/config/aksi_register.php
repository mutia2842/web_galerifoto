<?php
include 'koneksi.php';

$username    = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email       = $_POST['email'];


$cekusername = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
if (mysqli_num_rows($cekusername) > 0) {
    echo "<script>
    alert('Username sudah terdaftar, Silahkan pilih username lain');
    location.href='../register.php';
    </script>";
}else{
    $sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email) 
VALUES ('$username', '$password', '$email')");

    if ($sql) {
        echo "<script>
    alert('Pendaftaran akun berhasil');
    location.href='../login.php';
    </script>";
    }
}


?>