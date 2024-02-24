<?php
session_start();
include "koneksi.php";

// Pastikan pengguna telah login
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
}

$userid = $_SESSION['userid'];

// Ambil informasi pengguna dari database
$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `userid` = '$userid'");
$user = mysqli_fetch_assoc($query);

// Jika form edit dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_namalengkap = $_POST['namalengkap'];
    $new_jeniskelamin = $_POST['jeniskelamin'];
    $new_password = $_POST['password'];

    // Pastikan untuk menggunakan password_hash saat menyimpan password yang baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update informasi pengguna di database
    $update_query = "UPDATE `user` SET `username`='$new_username', `email`='$new_email', `namalengkap`='$new_namalengkap', `jeniskelamin`='$new_jeniskelamin', `password`='$hashed_password' WHERE `userid`='$userid'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "<script>alert('Informasi berhasil diperbarui');</script>";
        // Redirect untuk mencegah pengiriman ulang formulir saat diperbarui
        header("Location: profil.php");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui informasi');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gallery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <?php
                    if (!isset($_SESSION['userid'])) {
                    ?>
                        <a href="register.php" class="btn btn-outline-dark m-1">Register</a>
                        <a href="login.php" class="btn btn-outline-dark m-1">Login</a>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="album.php">Album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="foto.php">Foto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profil.php">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="userid" value="<?= $user['userid'] ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="namalengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="<?= $user['namalengkap'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jeniskelamin" name="jeniskelamin" required>
                                    <option value="laki-laki" <?= ($user['jeniskelamin'] == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="perempuan" <?= ($user['jeniskelamin'] == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password" value="<?= $user['password'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui Informasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
