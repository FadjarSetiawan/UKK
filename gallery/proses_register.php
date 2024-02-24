<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$jeniskelamin = $_POST['jeniskelamin']; // Menangkap data jenis kelamin
$alamat = $_POST['alamat'];

$sql = mysqli_query($conn, "INSERT INTO `user` (`username`, `password`, `email`, `namalengkap`, `jeniskelamin`, `alamat`) VALUES ('$username', '$password', '$email', '$namalengkap', '$jeniskelamin', '$alamat')");

if ($sql) {
    echo "<script> 
        alert('Pendaftaran akun berhasil');
        location.href='login.php';
        </script>";
} else {
    echo "<script> 
        alert('Pendaftaran akun tidak berhasil');
        location.href='register.php';
        </script>";
}
?>
