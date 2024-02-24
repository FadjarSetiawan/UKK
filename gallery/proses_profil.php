<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

$userid = $_POST['userid'];
$new_username = $_POST['username'];
$new_email = $_POST['email'];
$new_namalengkap = $_POST['namalengkap'];
$new_jeniskelamin = $_POST['jeniskelamin'];
$new_password = $_POST['password'];

// Pastikan untuk menggunakan password_hash saat menyimpan password yang baru
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$update_query = "UPDATE `user` SET `username`='$new_username', `email`='$new_email', `namalengkap`='$new_namalengkap', `jeniskelamin`='$new_jeniskelamin', `password`='$hashed_password' WHERE `userid`='$userid'";
$result = mysqli_query($conn, $update_query);

if ($result) {
    echo "<script>alert('Informasi berhasil diperbarui');</script>";
    header("Location: profil.php");
    exit;
} else {
    echo "<script>alert('Gagal memperbarui informasi');</script>";
    header("Location: profil.php");
    exit;
}
?>
