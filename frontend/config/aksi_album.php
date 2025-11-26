<?php
    session_start();
    include 'koneksi.php';

    if(isset($_POST['tambah'])) {
        $namaalbum = $_POST['namaalbum'];
        $deskripsi = $_POST['deskripsi'];
        $tanggaldibuat = date('Y-m-d');
       

        $sql = mysqli_query($koneksi, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat) 
                                    VALUES ('$namaalbum', '$deskripsi', '$tanggaldibuat')");
        echo "<script>
        alert('Data berhasil disimpan!');
        location.href = '../admin/album.php';
        </script>";
    }

if (isset($_POST['edit'])) {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggaldibuat = date('Y-m-d');


    $sql = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggaldibuat='$tanggaldibuat' WHERE albumid='$albumid'");

    
    echo "<script>
        alert('Data berhasil diperbarui!');
        location.href = '../admin/album.php';
        </script>";
}

?>