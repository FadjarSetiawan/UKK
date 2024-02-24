<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="index.php">website gallery foto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <?php
                session_start();
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

<div class="container mt-3">
    <div class="card mt-2">
        <div class="card-header text-bg-dark">Data Gambar</div>
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>NO</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Unggah</th>
                    <th>Gambar</th>
                    <th>Album</th>
                    <th>Disukai</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include "koneksi.php";
                $userid = $_SESSION['userid'];
                $no = 1;
                $sql = mysqli_query($conn, "SELECT * FROM foto, album WHERE foto.userid='$userid' AND foto.albumid=album.albumid");
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['judulfoto'] ?></td>
                        <td><?= $data['deskripsifoto'] ?></td>
                        <td><?= $data['tanggalunggah'] ?></td>
                        <td>
                            <img src="gambar/<?= $data['lokasifile'] ?>" width="100px" alt="<?= $data['judulfoto'] ?>">
                        </td>
                        <td><?= $data['namaalbum'] ?></td>
                        <td>
                            <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                            ?>
                        </td>
                        <td>
                            <!-- Tombol Detail -->
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?= $no ?>">Detail</button>
                            <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>" class="btn btn-danger">Hapus</a>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>">Edit</a>
                        </td>
                    </tr>

                    <!-- Modal Detail Foto -->
                    <div class="modal fade" id="detailModal<?= $no ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $no ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel<?= $no ?>">Detail Foto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Judul: <?= $data['judulfoto'] ?></h6>
                                    <p>Deskripsi: <?= $data['deskripsifoto'] ?></p>
                                    <p>Album: <?= $data['namaalbum'] ?></p>
                                    <img src="gambar/<?= $data['lokasifile'] ?>" class="img-fluid" alt="<?= $data['judulfoto'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>
</html>
