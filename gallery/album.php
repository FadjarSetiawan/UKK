<?php 
session_start();
$userid = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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
                   
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark shadow-lg mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tambah Album
        </button>
        <div class="card mt-2 shadow mb-5" style="border: none;">
            <div class="card-header text-bg-dark">Data Album</div>
            <div class="card-body">
                <table id="example" class="table table-striped border" style="width:100%">
                    <thead class="table table-striped border">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tanggal dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";
                        $userid = $_SESSION['userid'];
                        $no = 1;
                        $sql = mysqli_query($conn, "select * from album where userid='$userid'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['namaalbum'] ?></td>
                                <td><?= $data['deskripsi'] ?></td>
                                <td><?= $data['tanggaldibuat'] ?></td>
                                <td>
                                <a href="#" class="btn btn-outline-danger" onclick="confirmDelete(<?= $data['albumid'] ?>)">Hapus</a>                                    
                                <a href="#" class="btn btn-outline-dark mt-3" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>">Edit</a>
                                </td>
                            </tr>

                            <!-- Modal edit-->
                            <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit album</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="update_album.php" method="post">
                                            <input type="text" name="albumid" value="<?= $data['albumid'] ?>" hidden>
                                            <div class="modal-body">
                                                <label class="form-label">nama album</label>
                                                <input type="text" name="namaalbum" class="form-control" value="<?= $data['namaalbum'] ?>">
                                                <label class="form-label">deskripsi</label>
                                                <input type="text" name="deskripsi" class="form-control" value="<?= $data['deskripsi'] ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal tambah-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah album</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="tambah_album.php" method="post">
                    <div class="modal-body">
                        <label class="form-label">nama album</label>
                        <input type="text" name="namaalbum" class="form-control" required>
                        <label class="form-label">deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
function confirmDelete(albumid) {
    if (confirm('Apakah Anda yakin ingin menghapus album ini?')) {
        window.location.href = 'hapus_album.php?albumid=' + albumid;
    }
}
</script>
</body>

</html>