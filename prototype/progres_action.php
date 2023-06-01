<?php
include 'function.php';

$select = new Select();
$date = new Date();

$detail = $select->specifyProgresById($_REQUEST['id']);

if(!empty($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
}
else{
    header("Location: login.php");
}

$aksi = $_GET['aksi'];
if ($aksi == 'aksiselesai') {
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
            Selesaikan Progres
        </h1>
            <?php foreach ($detail as $progres) {
            $detail2 = $select->specifySelectProduct($progres['id_produk']);
            foreach ($detail2 as $produk) {
            $record = $date->ambilTanggalSekarang();
            $hariini = $date->tanggalIndonesia($record);
            $Sekarang = $date->tanggalIndonesia($progres['tanggal_mulai']);
            $Prediksi = $date->tanggalIndonesia($progres['tanggal_selesai']);
            ?>
            
            <form action="proses.php?id=<?php echo $_REQUEST['id'] ?>&id_produk=<?php echo $progres['id_produk'] ?>&id_users=<?php echo $progres['id_users'] ?>&record=<?php echo $record ?>&aksi=selesai" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Produk :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $produk['nama_product'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $produk['deskripsi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Tanggal Mulai :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $Sekarang ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Tanggal Selesai :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $hariini ?>" required>
            </div>
            <div class="mb-3">
                <div>
                <label for="deskripsi" class="form-label">Pilih Foto Produk Yang Sudah Jadi :</label>
                </div>
                <img style="min-width:300px;min-height:300px; max-width:600px; max-height:400px; "id="gambar" src="#" alt=" "/>
            </div>
            <div class="mb-3">
                <input style="color:white" accept="image/*" type='file' id="filegambar" name="selesai" required />
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Selesai
            </button>
            <a class="btn btn-warning" href="progres.php">Batal</a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                </div>
                <div class="modal-body">
                    <label style="color:black"for="gambar" class="form-label" >Apa anda yakin sudah selesai?</label>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Yakin">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Belum
                    </button>
                </div>
                </div>
            </div>
            </div>
        </form>


<!-- Modal -->

    </div>
    <?php }} ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/image-upload.js"></script>
</body>
</html>

<!------------------------------------------------ EDIT ----------------------------------------------------->
<?php } elseif ($aksi == 'aksiubah') { ?>

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
            Edit Progres
        </h1>
            <?php foreach ($detail as $progres) {
            $detail2 = $select->specifySelectProduct($progres['id_produk']);
            foreach ($detail2 as $produk) {
            $record = $date->ambilTanggalSekarang();
            $hariini = $date->tanggalIndonesia($record);
            $Sekarang = $date->tanggalIndonesia($progres['tanggal_mulai']);
            $Prediksi = $date->tanggalIndonesia($progres['tanggal_selesai']);
            ?>            
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Produk :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $produk['nama_product'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $produk['deskripsi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Tanggal Mulai :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $Sekarang ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Prediksi Selesai :</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" readonly value="<?php echo $Prediksi ?>" required>
            </div>
            <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleModal2" name="button2">
                Pilih yang ingin diubah
            </button>
            <a class="btn btn-primary" href="progres.php">Batal</a>
        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih yang ingin diubah</h5>
                </div>
                <div class="modal-body" style="text-align:center">
                <div>
                    <button style="width:200px;text-align:center" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal4" name="button3">
                        Perbarui tanggal mulai
                    </button>
                </div>
                <br>
                <div>
                    <button style="width:200px;text-align:center" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal5" name="button3">
                        Perpanjang prediksi selesai
                    </button>
                </div>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
            </div>
            <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                </div>
                <div class="modal-body">
                    <?php if ($progres['tanggal_selesai'] > $record) { ?>
                    <label style="color:black"for="gambar" class="form-label" >Tanggal mulai akan diubah ke hari ini</label>
                    <div style="color:white">↓</div>
                    <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="ubah_tanggal" name="ubah_tanggal" readonly value="<?php echo $hariini ?>" required>
                    <?php } else { ?>
                    <div style="color:white">↓</div>
                    <label style="color:black"for="gambar" class="form-label" >Harap Perpanjang Prediksi Selesai Terlebih dahulu</label>
                    <div style="color:white">↓</div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <a href="proses.php?id=<?php echo $progres['id'] ?>&tanggal_mulai=<?php echo $record ?>&aksi=ubahmulai" class="btn btn-warning">Ubah</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Batal
                    </button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                </div>
                <div class="modal-body">
                    <?php if ($progres['status'] == '0') { ?>
                    <label style="color:black"for="gambar" class="form-label" >Ingin memperpanjang prediksi selesai berapa hari?</label>
                    <label style="color:black"for="gambar" class="form-label" >(Perpanjangan hanya bisa dilakukan sekali)</label>
                    <form action="proses.php?id=<?php echo $progres['id'] ?>&status=<?php echo $progres['status']?>&tanggal_selesai=<?php echo $progres['tanggal_selesai'] ?>&aksi=ubahselesai"  method="post" enctype="multipart/form-data">
                    <div style="color:white">↓</div>
                    <select name="perpanjang">
                        <?php 
                        $tambahan = 1;
                        for ($jumlah_hari = 1; $jumlah_hari <= 30; $jumlah_hari++) {
                            $tanggal = $jumlah_hari
                        ?>
                        <option value="<?php echo $jumlah_hari ?>"><?php echo $tanggal ?> Hari</option>
                        <?php } ?>
                    </select>
                    <div style="color:white">↓</div>
                    <?php } else { ?>
                        <div style="color:white">↓</div>
                        <label style="color:black; text-align:center"for="gambar" class="form-label" >Anda sudah pernah memperpanjang prediksi selesai</label>
                        <div style="color:white">↓</div>
                        <div style="color:white">↓</div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <?php if ($progres['status'] == '0') { ?>
                    <input type="submit" class="btn btn-warning" value="Ubah">
                    <?php } ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Batal
                    </button>
                    </form>
                </div>
                </div>
            </div>
            </div>
    <?php }} ?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/image-upload.js"></script>
</body>
</html>
<?php /////////////////////////////////////////// ?>
            
<?php } ?>