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
        <a class="btn btn-primary" href="approval_bayar.php"><- Back</a>
            Bukti MOU
        <a class="" style="padding-left: 10px; padding-right:10px;" onclick="JavaScript:window.location.href='download.php?file=<?php echo $_REQUEST['mou'] ?>';"> Download Disini</a>
        </h2>
    </div>
</body>
</html>