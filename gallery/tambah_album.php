<?php
include "koneksi.php";
session_start();

// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggaldibuat = date("Y-m-d");
    $userid = $_SESSION['userid'];

    // Memeriksa apakah album dengan nama yang sama sudah ada dalam database
    $check_duplicate = mysqli_query($conn, "SELECT * FROM album WHERE namaalbum = '$namaalbum' AND userid = '$userid'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        // Album dengan nama yang sama sudah ada, beri peringatan kepada pengguna
        echo "<script> 
                alert('Album nya sudah ada cuy!');
                location.href='album.php';
              </script>";
    } else {
        // Album dengan nama yang unik, tambahkan ke database
        $sql = mysqli_query($conn, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid) VALUES ('$namaalbum', '$deskripsi', '$tanggaldibuat', '$userid')");

        if ($sql) {
            // Data berhasil ditambahkan
            echo "<script> 
                    alert('Tambah data berhasil');
                    location.href='album.php';
                  </script>";
        } else {
            // Gagal menambahkan data
            echo "<script> 
                    alert('Tambah data tidak berhasil');
                    location.href='album.php';
                  </script>";
        }
    }
} else {
    // Jika tidak melalui metode POST, redirect pengguna ke halaman album.php
    header("location: album.php");
}
?>
