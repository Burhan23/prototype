<?php
include "function.php";
$select = new Select();
$specify = new Specify();
$detail = $specify->dataInvest($_REQUEST['id_invest']);
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
    <title>Document</title>
</head>
<body style="text-align:center;width:auto;height:auto; background-color:lightsalmon">
    <div style="padding-bottom: 5%; padding-top:20px">
    <a class="btn btn-primary" href="approval_bayar.php"><- Back</a>
    <?php foreach ($detail as $mou) { 
        $pengrajin = $select->selectUsersById($mou['id_pengrajin']);
        $investor = $select->selectUsersById($mou['id_investor']);
        ?>
        <div></div>
        <label>Perhatian Dalam mengirim MOU</label>
        <h2>Nama Investor : <?php echo $investor['fname'] ?></h2>
        <h2>NIK Investor : <?php echo $investor['nik'] ?></h2>
        <h2>Nama Pengrajin : <?php echo $pengrajin['fname'] ?></h2>
        <h2>NIK Pengrajin : <?php echo $pengrajin['nik']?></h2>
        <h2>Nominal Pemberian : Rp,-<?php echo $mou['jumlah_dana'] ?></h2>
        <label>Jika belum memiliki format MOU <a class="" style="padding-left: 10px; padding-right:10px;" onclick="JavaScript:window.location.href='download.php?file=SURAT_PERJANJIAN_INVESTASI.docx';">Download Disini</a></label>
        <form action="proses.php?id=<?php echo $mou['id'] ?>&investor=<?php echo $investor['username'] ?>&aksi=mou" enctype="multipart/form-data" method="post">
        <label>Upload MOU yang telah disiapkan</label>
        <input type="file" id="mou" name="mou" accept="docs,docx">
        <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
    <?php } ?>
    </div>
</body>

</html>