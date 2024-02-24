<?php
include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    

                </div>

            </div>
        </div>
    </nav>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-6">
            <h1>WEBSITE GALLERY</h1>
            <p style="font-size:30px;">Platform web galeri yang mudah digunakan untuk menyimpan dan membagikan foto-foto Anda. Baik Anda ingin memamerkan karya fotografi Anda atau hanya ingin mengelola foto pribadi dengan mudah, Galeri Foto Impian adalah solusi yang tepat.</p>
            <a style="font-size: 25px;" class="btn btn-dark shadow mt-3" href="register.php">Daftar</a>

        </div>
        <div class="col-md-6">
            <img width="500px" class="rounded shadow" src="elon-musk-ai-mars.png" alt="">
        </div>
    </div>

<div class="row" style="margin-top: 200px;">
        <div class="col-md-6">
        <img width="500px" class="rounded shadow" src="harry-potter-ai-hp.png" alt="">


        </div>
        <div class="col-md-6">
        <h1 >GALERI UNTUK SEMUA FOTO</h1>
        <p style="font-size:30px;">Galeri foto menyediakan ruang penyimpanan untuk foto Anda, sehingga Anda tidak perlu khawatir kehabisan ruang penyimpanan di perangkat Anda.</p>
        <a style="font-size: 25px;" class="btn btn-dark shadow mt-3" href="album.php">Kunjungi Album</a>
        </div>
    </div>
</div>
</div>
    <div class="container-fluid mt-5 bg-dark p-5 rounded-top-5">
        <div class="row">
            <h1 class="text-white text-center">Semua Gambar</h1>
            <?php
            $sql = mysqli_query($conn, "SELECT * from foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="col-md-3">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card shadow" style="border:none;">
                            <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top rounded-top" title="<?php echo $data['judulfoto'] ?>" alt="">
                            <div class="card-footer text-center">
                                <?php
                                $fotoid = $data['fotoid'];
                                $like = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                echo '<a><i class="fa-regular fa-heart" style="color: red;" readonly></i></a>';
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment" style="color:grey;"></i></a>
                                <?php
                                $jmlkomentar = mysqli_query($conn, "select * from komentarfoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($jmlkomentar) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </a>

                    <!-- modal komentar -->
                    <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="gambar/<?= $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-2">
                                                <div class="overflow-auto">
                                                    <div class="sticky-top">
                                                        <strong><?php echo $data['judulfoto'] ?></strong><br>
                                                        <p>Pengunggah Gambar : <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span></p>
                                                        <p>Tanggal Unggah : <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span></p>
                                                        <p>Nama Album : <span class="badge bg-dark"><?php echo $data['namaalbum'] ?></span>
                                                    </div>
                                                    <hr>
                                                    <p align="left">
                                                        <strong>Deskripsi Gambar</strong><br>
                                                        <?php echo $data['deskripsifoto'] ?>
                                                    </p>
                                                    <hr>
                                                    <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                    while ($row = mysqli_fetch_array($komentar)) {
                                                    ?>
                                                        <p align="left">
                                                            <strong><?= $row['namalengkap'] ?></strong>
                                                            <?= $row['isikomentar'] ?>
                                                        </p>
                                                    <?php } ?>
                                                    <hr>
                                                    <div class="sticky-bottom">
                                                        <form action="komentar.php" method="post">
                                                            <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                                                            <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                                            <div class="input-group">
                                                                <button type="submit" class="btn btn-dark mt-3">Kirim</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="container bg-gradient">

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>