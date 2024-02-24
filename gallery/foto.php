<?php
include "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto</title>
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
            <!-- Form pencarian -->
    
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
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark shadow mb-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tambah Foto
        </button>
        
        <div class="card mt-2 shadow mb-5" style="border: none;">
            <div class="card-header text-bg-dark">Data Gambar</div>
            <div class="card-body">
            <table id="pagination" class="table table-striped border" style="width:100%">
                    <thead class="table table-striped">
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
                    <tbody class="table table-striped">
                        <?php
                        include "koneksi.php";
                        $userid = $_SESSION['userid'];
                        $no = 1;// Proses input pencarian
                        if(isset($_GET['keyword'])) {
                            $keyword = $_GET['keyword'];
                            $sql = "SELECT * FROM foto WHERE userid='$userid' AND (judulfoto LIKE '%$keyword%' OR deskripsifoto LIKE '%$keyword%')";
                        } else {
                            // Ambil data foto berdasarkan album yang dipilih
                            if(isset($_GET['albumid'])) {
                                $albumid = $_GET['albumid'];
                                $sql = "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'";
                            } else {
                                $sql = "SELECT * FROM foto WHERE userid='$userid'";
                            }
                        }
                        $sql = mysqli_query($conn, "select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['judulfoto'] ?></td>
                                <td><?= $data['deskripsifoto'] ?></td>
                                <td><?= $data['tanggalunggah'] ?></td>
                                <td>
                                    <img src="gambar/<?= $data['lokasifile'] ?>" width="200px" style="border-radius: 15px;">
                                </td>
                                <td><?= $data['namaalbum'] ?></td>
                                <td>
                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                    echo mysqli_num_rows($sql2);
                                    ?>
                                </td>
                                <td>
    <a href="#" class="btn btn-outline-danger" onclick="confirmDelete(<?= $data['fotoid'] ?>)">Hapus</a>
    <a href="#" class="btn btn-outline-dark mt-2" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>">Edit</a>
</td>

                            </tr>

                            <!-- Modal edit-->
                            <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit foto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="update_foto.php" method="post" enctype="multipart/form-data">
                                            <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                                            <div class="modal-body">
                                                <label class="form-label">Judul Foto</label>
                                                <input type="text" name="judulfoto" class="form-control" value="<?= $data['judulfoto'] ?>">
                                                <label class="form-label">deskripsi</label>
                                                <input type="text" name="deskripsifoto" class="form-control" value="<?= $data['deskripsifoto'] ?>">
                                                <label class="form-label">gambar</label>
                                                <input type="file" name="lokasifile" class="form-control">
                                                <label class="form-label">album</label>
                                                <select name="albumid" class="form-select">
                                                    <?php
                                                    $userid = $_SESSION['userid'];
                                                    $sql2 = mysqli_query($conn, "select * from album where userid='$userid'");
                                                    while ($data2 = mysqli_fetch_array($sql2)) {
                                                    ?>
                                                        <option value="<?= $data2['albumid'] ?>" <?php if ($data2['albumid'] == $data['albumid']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= $data2['namaalbum'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
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
                <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label class="form-label">Judul foto</label>
                        <input type="text" name="judulfoto" class="form-control" required>
                        <label class="form-label">deskripsi foto</label>
                        <input type="text" name="deskripsifoto" class="form-control" required>
                        <label class="form-label">Gambar</label>
                        <input type="file" name="lokasifile" class="form-control" required>
                        <label class="form-label">Album</label>
                        <select name="albumid" class="form-select">
                            <?php
                            include "koneksi.php";
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($conn, "select * from album where userid='$userid'");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['albumid'] ?>"><?= $data['namaalbum'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    



    
    <script>
function confirmDelete(fotoid) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        window.location.href = 'hapus_foto.php?fotoid=' + fotoid;
    }
}

    $(document).ready(function() {
        $('#pagination').DataTable({
            "paging": true
            
        });
    });
</script>

</body>

</html>