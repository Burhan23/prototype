<?php
include 'db_conn.php';
$db = new database();
require 'function.php';

$select = new Select();
$date = new Date();

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
}
else{
  header("Location: login.php");
}

$detail = $select->selectProgresById($user['id']);
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
    <link rel="stylesheet" href="css/index.css">
    <style>a{min-width: 90px;} th{padding:10px;padding-top: 5px;padding-bottom: 5px;} td{padding: 10px;}</style>

    <title>Mr.Kayu:Home</title>
</head>
<?php include 'nav_pengrajin.php' ?>
<body style="background-image: url('css/11bg.jpg'); background-size:cover;">
    
    
    <div class="container">
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            Daftar Progres Produkmu
        </label>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;">
                        <th scope="col">ID</th>
                        <th scope="col">Foto Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Deskripsi Produk</th>
                        <th scope="col">Mulai Progres</th>
                        <th scope="col">Prediksi Selesai</th>
                        <th scope="col">Progres</th>
                        <th scope="col">Apakah Sudah Selesai</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id = 1;
                        foreach ($detail as $akun) {
                            $produk = $select->selectProductById($akun['id_produk']);
                            $sekarang = $date->tanggalIndonesia($akun['tanggal_mulai']);
                            $prediksi = $date->tanggalIndonesia($akun['tanggal_selesai']);
                    ?>
                        <tr style="border:1px solid green;">
                            <td><?php echo $id++; ?></td>
                            <td><img style="max-width:200px;max-height:100px" src="progres/<?php echo $akun['foto']; ?>"></td>
                            <td><?php echo $produk['nama_product']?></td>
                            <td><?php echo $produk['deskripsi']?></td>
                            <td><?php echo $sekarang ?></td>
                            <td><?php echo $prediksi ?></td>
                            <td>
                                <?php include 'progres-bar.php' ?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm" href="">Ya</a>
                                <a class="btn btn-secondary btn-sm" href="">Belum</a>
                            </td>
                        </tr>
                    

            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>