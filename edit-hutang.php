<?php
ob_start();
session_start();
include('connection.php');

	if(!isset($_SESSION['user']))
	{
		echo "tidak ada akses";
		exit;
    }

$idHutang = $_GET['idHutang'];

$sql1 = "SELECT ID_HUTANG, KETERANGAN, JUMLAH_HUTANG FROM HUTANG WHERE ID_HUTANG ='$idHutang'";
    $result1 = $conn->query($sql1);
    $total1 = 0;

    if ($result1->num_rows > 0) {
      while($row = $result1->fetch_assoc()) {
        $keterangan = $row["KETERANGAN"];
        $jumlahHutang = $row["JUMLAH_HUTANG"];
      }
    }
    else {
      echo "0 results";
    }
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>

  <!-- -------NAVBAR-------- -->
  <?php include 'navbar.php';?>
  <!-- -------------------- -->
<div class="container">
<div class="col-sm-4">
    <form action="/data-keuangan/update-hutang.php" method="post">
    <input type="hidden" class="form-control" id="idHutang" name="idHutang" value="<?php echo $idHutang?>">
        <div class="form-group">
            <label for="keterangan">Hutang: </label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $keterangan?>">
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah Hutang: </label>
            <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlahHutang?>">
        </div>
        <input type="submit" value="Submit" class="btn btn-default">
    </form>
    </div>
</div>
</body>