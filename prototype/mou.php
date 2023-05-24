<?php
include "function.php";
$select = new Select();
$specify = new Specify();
$invest = new Invest();
$detail = $invest->getIDFromThisRow($_REQUEST['id']);
if(!empty($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
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
    <title>Document</title>
</head>
<body style="text-align:center;width:auto;height:auto; background-color:lightsalmon">
    <div style="padding-bottom: 5%; padding-top:20px">
    <a class="btn btn-primary" href="approval_bayar.php"><- Back</a>
    <?php foreach ($detail as $mou) { 
        $pengrajin = $select->selectUserById($mou['id_pengrajin']);
        $investor = $select->selectUserById($mou['id_investor']);
        ?>
        <div></div>
        <label>Perhatian Dalam mengirim MOU</label>
        <label>Surat Perjanjian MOU <a class="" style="padding-left: 10px; padding-right:10px;" onclick="JavaScript:window.location.href='download.php?file=<?php echo $mou['mou'] ?>';">Download Disini</a></label>
        <form action="proses.php?id=<?php echo $mou['id'] ?>&investor=<?php echo $investor['username'] ?>&pengrajin=<?php echo $pengrajin['username'] ?>&role=<?php echo $user['role'] ?>&aksi=mou" enctype="multipart/form-data" method="post">
        <?php if ($user['id'] == $mou['id_pengrajin']) { ?>
        <h2>Nama Investor : <?php echo $investor['fname'] ?></h2>
        <h3>Harap isi pada bagian pihak kedua</h3>
        <h3>Harap tanda tangan pada pihak kedua(bagian akhir dokumen)</h3>
        <?php } elseif($user['id'] == $mou['id_investor']) { ?>
        <h2>Nama Pengrajin : <?php echo $pengrajin['fname'] ?></h2>
        <h3>Harap isi pada bagian pihak pertama</h3>
        <h3>Harap tanda tangan pada pihak pertama(bagian akhir dokumen)</h3>
        <?php } ?>
        <label>Upload MOU yang telah disiapkan</label>
        <input type="file" id="mou" name="mou" accept="docs,docx">
        <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
    <?php } ?>
    </div>
</body>

</html>