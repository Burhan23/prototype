<?php
include 'function.php';
$list = new ListUser();
$select = new Select();
$detail = $list->investasiUser();

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
    <style>a{min-width: 130px;} th{padding:10px; padding-top: 2px; padding-bottom: 2px;} td{padding: 10px;} h2{font-size: 15px;}</style>

    <title>Mr.Kayu:Home</title>
</head>
<?php include 'nav.php' ?>
<body style="background-image: url('css/backgrond.jpeg'); background-size:cover;">
<div class="container">
<a href="logout.php">Logout</a>
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            List MOU User
        </label>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;">
                        <th scope="col">ID</th>
                        <th scope="col">Investor</th>
                        <th scope="col">Pengrajin</th>
                        <th scope="col">Jumlah Dana</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id = 1;
                        foreach ($detail as $akun) {
                             if($akun['status'] == '1' or $akun['status'] == '2'){
                        $pengrajin = $select->selectUsersById($akun['id_pengrajin']);
                        $investor = $select->selectUsersById($akun['id_investor']);
                    ?>
                    <td><?php echo $id++ ?></td>
                    <td><?php echo $investor['fname'] ?><h2>(NIK : <?php echo $investor['nik'] ?>)</h2></td>
                    <td><?php echo $pengrajin['fname'] ?><h2>(NIK : <?php echo $investor['nik'] ?>)</h2></td>
                    <td><?php echo $akun['jumlah_dana'] ?></td>
                    <td>
                        <a class="" style="padding-left: 10px; padding-right:10px;" onclick="JavaScript:window.location.href='download.php?file=SURAT_PERJANJIAN_INVESTASI.docx';">Download MOU</a>
                        <a class="btn btn-success">Kirim Mou</a>
                    </td>
                    <?php } } ?>
                </tbody>

</body>