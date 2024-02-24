<?php
include "koneksi.php";
session_start();

// Memeriksa apakah data telah dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $userid = $_SESSION['userid'];

    // Memeriksa apakah album dengan nama yang sama sudah ada untuk pengguna yang sama
    $check_duplicate = mysqli_query($conn, "SELECT * FROM album WHERE namaalbum = '$namaalbum' AND userid = '$userid' AND albumid != '$albumid'");
    if (mysqli_num_rows($check_duplicate) > 0) {
        // Album dengan nama yang sama sudah ada, beri peringatan kepada pengguna
        echo "<script> 
                alert('Album dengan nama yang sama sudah ada');
                location.href='album.php';
              </script>";
    } else {
        // Album dengan nama yang unik, lanjutkan dengan pembaruan
        $sql = mysqli_query($conn, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi' WHERE albumid='$albumid'");

        if ($sql) {
            // Data berhasil diubah
            echo "<script> 
                    alert('Ubah data berhasil');
                    location.href='album.php';
                  </script>";
        } else {
            // Gagal mengubah data
            echo "<script> 
                    alert('Ubah data tidak berhasil');
                    location.href='album.php';
                  </script>";
        }
    }
} else {
    // Jika tidak melalui metode POST, redirect pengguna ke halaman album.php
    header("location: album.php");
}
?>
