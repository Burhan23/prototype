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
    <title>Document</title>
</head>
<body style="text-align:center;width:auto;height:auto; background-color:lightsalmon">
    <div style="padding-bottom: 5%; padding-top:20px">
        <h2>
            Tambahkan gambar 
        </h2>
    </div>
    <form action="proses.php?id_produk=<?php echo $_REQUEST['id_produk'] ?>&tanggal_mulai=<?php echo $_REQUEST['tanggal_mulai'] ?>&prediksi=<?php echo $_REQUEST['prediksi'] ?>&id_users=<?php echo $_REQUEST['id_users'] ?>&aksi=progres"  method="post" enctype="multipart/form-data" runat="server">
        <div>
            <img style="min-width:300px;min-height:300px; max-width:600px; max-height:400px; background-image: url('css/empty.jpg'); "id="gambar" src="#" alt=""/>
        </div>
        <br> 
        <div class="center" style="justify-content:center">
            <input accept="image/*" type='file' id="filegambar" name="progres" required />
            <input type="submit" class="btn btn-success" value="Mulai Progress">
        </div>
    </form>
    <form action="proses.php?id_produk=<?php echo $_REQUEST['id_produk'] ?>&tanggal_mulai=<?php echo $_REQUEST['tanggal_mulai'] ?>&prediksi=<?php echo $_REQUEST['prediksi'] ?>&id_users=<?php echo $_REQUEST['id_users'] ?>&aksi=progres"  method="post" enctype="multipart/form-data">
        <div></div>
        
    </form>
    <script src="js/image-upload.js"></script>
</body>
</html>