<?php
include "koneksi.php";
session_start();



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['isikomentar'])) {
        $fotoid = $_POST['fotoid'];
        $isikomentar = $_POST['isikomentar'];
        $tanggalkomentar = date("Y-m-d");
        $userid = $_SESSION['userid'];

        // Gunakan prepared statement untuk mencegah SQL injection
        $stmt = $conn->prepare("INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $fotoid, $userid, $isikomentar, $tanggalkomentar);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Komentar berhasil ditambahkan');
                    window.location.href = 'home.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menambahkan komentar');
                    window.location.href = 'home.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Form komentar tidak boleh kosong');
                window.location.href = 'home.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
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
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<div class="container shadow mt-5 mb-5 p-5">
    <a href="home.php" class="btn btn-dark shadow">Kembali</a>
    <h1 class="mt-3">Halaman Komentar</h1>
    <p style="font-size: 20px;" class="mb-3">Selamat datang <b><?=$_SESSION['namalengkap']?></b></p>

    <form action="" method="post">
        <?php
        include "koneksi.php";
        $fotoid=$_GET['fotoid'];
        $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
        while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
        <table class="table">
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judulfoto" class="form-control" value="<?=$data['judulfoto']?>" ></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto" class="form-control" value="<?=$data['deskripsifoto']?>" ></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td><img src="gambar/<?=$data['lokasifile']?>" class="rounded-3" style="width: 500px;" ></td>
            </tr>
            <tr>
                <td>Komentar</td>
                <td><textarea type="text" name="isikomentar" class="form-control"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" class="btn btn-dark" value="Tambah"></td>
            </tr>
        </table>
        <?php
        }
        ?>
    </form>

    <table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Komentar</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include "koneksi.php";
    $fotoid = $_GET['fotoid']; // Ambil fotoid dari URL
    $sql = mysqli_query($conn, "SELECT komentarfoto.*, user.namalengkap FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid = '$fotoid'");
    while ($data = mysqli_fetch_array($sql)) {
    ?>
    <tr>
        <td><?=$data['komentarid']?></td>
        <td><?=$data['namalengkap']?></td>
        <td><?=$data['isikomentar']?></td>
        <td><?=$data['tanggalkomentar']?></td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>