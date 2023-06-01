<?php 

$select = new Select();
$beri = $select->cekPemberianNotification();
$bayar = $select->cekPembayaranNotification();
$upgrade = $select->cekUpgradeNotification();
$kembalikan = $select->cekPengembalianNotification();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Simple Navbar</title>
    <link href="css/navbar1.css" rel="stylesheet" type="text/css" />
    <style>a{font-size: smaller;}</style>
    <nav class="navbar" style="justify-content:center">
      <a href="index.php" class="nav-link"><i class="bi bi-person-lines-fill"></i> Data User</a>
      <a href="listproduk.php" class="nav-link"><i class="bi bi-collection-fill"></i> Cek Produk</a>
      <a href="list_rekapan.php" class="nav-link"><i class="bi bi-currency-exchange"></i> Cek Rekapan</a>
      <a href="list_mou.php" class="nav-link"><i class="bi bi-card-list"></i> Cek MOU<?php if($beri > 0){ ?><i class="bi bi-exclamation-lg" style="color:red">(<?php echo $beri ?>)</i><?php } ?></a>
      <a href="approval_bayar.php" class="nav-link"><i class="bi bi-box-arrow-up"></i> Cek Pemberian<?php if($bayar > 0){ ?><i class="bi bi-exclamation-lg" style="color:red">(<?php echo $bayar ?>)</i><?php } ?></a>
      <a href="approval_pengembalian.php" class="nav-link"><i class="bi bi-box-arrow-in-down"></i> Cek Pengembalian<?php if($kembalikan > 0){?><i class="bi bi-exclamation-lg" style="color:red">(<?php echo $kembalikan ?>)</i><?php } ?></a>
      <a href="approval_upgrade.php" class="nav-link"><i class="bi bi-person-check"></i> Cek Upgrade Akun<?php if($upgrade > 0){?><i class="bi bi-exclamation-lg" style="color:red">(<?php echo $upgrade ?>)</i><?php } ?></a>
    </nav>
    <script src="js/script.js"></script>
  </head>
  <body>
    
  </body>
</html>