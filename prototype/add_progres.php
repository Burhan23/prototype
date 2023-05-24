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
<body style="background-color:darkslategrey; background-size:cover;">
    <div class="container">
        <h1>
            Upload Produk
        </h1>
        <form action="proses.php?id_users=<?php echo $user['id'] ?>&aksi=tambah" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Produk</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $_REQUEST['nama_produk'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                <input style="background-color:darkcyan; color:white" type="text" class="form-control" id="deskripsi" name="deskripsi" preadonly value="<?php echo $_REQUEST['deskripsi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Deskripsi Produk</label>

            </div>
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a class="btn btn-warning" href="index_pengrajin.php">Batal</a>
        </form>

    </div>
</body>
</html>