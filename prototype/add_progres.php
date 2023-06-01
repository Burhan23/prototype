<?php
include 'db_conn.php';
$db = new database();

require 'function.php';

$select = new Select();
$date = new Date();
$detail = $select->specifySelectProduct($_REQUEST['id_produk']);

if (isset($_POST['waktu'])) {
    $hari = $_POST['waktu'];
}
else {
    $hari = 7;
}
$interval = 'P'.$hari.'D';

$now = $date->ambilTanggalSekarang();
$Sekarang = $date->tanggalIndonesia($now);
$future = $date->ambilTanggalPrediksi($interval);
$Prediksi = $date->tanggalIndonesia($future);

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
}
else{
  header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/add.css">
    <title>Add akun</title>
</head>
<body style="background-color:darkslategrey; background-size:cover;" runat="server">
    <div class="container">
        <h1>
            Tambahkan Progres
        </h1>
            <?php foreach ($detail as $produk) { ?>
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Produk</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $produk['nama_product'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" preadonly value="<?php echo $produk['deskripsi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Tanggal Mulai</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" preadonly value="<?php echo $Sekarang ?>" required>
            </div>
            <form method="post">
            <label for="deskripsi" class="form-label">Durasi Pengerjaan : </label>
            <select name="waktu"  onChange="this.form.submit();">
                <option value="<?php echo $hari ?>"><?php echo $hari ?> Hari</option>
                <?php 
                $tambahan = 1;
                for ($jumlah_hari = 1; $jumlah_hari <= 365; $jumlah_hari++) {
                    $tanggal = $jumlah_hari
                ?>
                <option value="<?php echo $jumlah_hari ?>"><?php echo $tanggal ?> Hari</option>
                <?php } ?>
            </select>
            </form>
            <br>
            <form action="proses.php?id_produk=<?php echo $produk['id'] ?>&tanggal_mulai=<?php echo $now ?>&prediksi=<?php echo $future ?>&id_users=<?php echo $user['id'] ?>&aksi=progres" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Prediksi Selesai</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" preadonly value="<?php echo $Prediksi ?>" required>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Mulai Progres
            </button>
            <a class="btn btn-warning" href="index_pengrajin.php">Batal</a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label style="color:black"for="gambar" class="form-label" >Ingin menambahkan foto progres awal?</label>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" value="Tidak">
                    <a class="btn btn-primary" href="add_img_progres.php?id_produk=<?php echo $produk['id'] ?>&tanggal_mulai=<?php echo $now ?>&prediksi=<?php echo $future ?>&id_users=<?php echo $user['id'] ?>">Iya</a>
                </div>
                </div>
            </div>
            </div>
        </form>


<!-- Modal -->

    </div>
    <?php } ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/image-upload.js"></script>
</body>
</html>