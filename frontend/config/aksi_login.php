<?php
session_start();
include 'koneksi.php';

$email    = $_POST['email'];
$password = $_POST['password'];

//cegah QL Injection
$email = mysqli_real_escape_string($koneksi, $email);
$password = mysqli_real_escape_string($koneksi, $password);

// ambil data user berdasarkan email
$sql  = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");
$data = mysqli_fetch_assoc($sql);

if ($data) {
    // cek password dengan hash
    if (password_verify($password, $data['password'])) {
        $_SESSION['userid']   = $data['userid'];
        $_SESSION['email']    = $data['email'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['status']   = 'login';

        echo "<script>
            alert('Login berhasil');
            location.href='../admin/index.php';
        </script>";
    } else {
        echo "<script>
            alert('Password salah!');
            location.href='../login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Email tidak ditemukan!');
        location.href='../login.php';
    </script>";
}
?>
