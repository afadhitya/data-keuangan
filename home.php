<?php
ob_start();
session_start();
include('connection.php');

	if(!isset($_SESSION['user']))
	{
		echo "tidak ada akses";
		exit;
	}
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
<body>
	<!-- -------NAVBAR-------- -->
  <?php include 'navbar.php';?>
  <!-- -------------------- -->
    <div class="container">


  <!--<a href="/data-keuangan/penyimpanan.php">Data Penyimpanan</a><br>-->
  <!--<a href="/data-keuangan/hutang.php">Data Hutang</a><br>-->
  <!--<a href="/data-keuangan/input-history-keuangan.php">Input History Keuangan</a><br>-->
  <!--<a href="/data-keuangan/list-history-all.php">Show All History</a><br>-->
  <!--<a href="/data-keuangan/switching-form.php">Switching</a><br><br>-->

<?php
    // include('connection.php');

    $sql1 = "SELECT ID_HUTANG, JUMLAH_HUTANG FROM HUTANG";
    $result1 = $conn->query($sql1);
    $total1 = 0;

    if ($result1->num_rows > 0) {
      while($row = $result1->fetch_assoc()) {
        $total1 = $total1 + $row["JUMLAH_HUTANG"];
      }
    }
    else {
      echo "0 results";
    }

    $sql2 = "SELECT ID_PENYIMPANAN, JUMLAH FROM JENIS_PENYIMPANAN";
    $result2 = $conn->query($sql2);
    $total2 = 0;

    if ($result2->num_rows > 0) {
      while($row = $result2->fetch_assoc()) {
        $total2 = $total2 + $row["JUMLAH"];
      }
    }
    else {
      echo "0 results";
    }

		$sql3 = "SELECT * FROM WISHLIST";
    $result3 = $conn->query($sql3);
    $total3 = 0;

    if ($result3->num_rows > 0) {
      while($row = $result3->fetch_assoc()) {
        $total3 = $total3 + $row["HARGA"];
      }
    }
    else {
      echo "0 results";
    }

		$sql4 = "SELECT * FROM JENIS_PENYIMPANAN WHERE NAMA = 'Flexi Saver'";
    $result4 = $conn->query($sql4);
    $total4 = 0;

    if ($result4->num_rows > 0) {
      while($row = $result4->fetch_assoc()) {
        $total4 = $total4 + $row["JUMLAH"];
      }
    }
    else {
      echo "0 results";
    }

    $date = date('Y')."-".date('m')."-".date('d');

    $sql5 = "SELECT ID_HISTORY, TANGGAL, JUMLAH_HISTORY, PENGELUARAN_ATAU_PEMASUKAN FROM history_view WHERE TANGGAL BETWEEN '$date' AND  '$date' AND PENGELUARAN_ATAU_PEMASUKAN = 'Pengeluaran' AND KETERANGAN NOT LIKE '%tumbler%' ORDER BY TANGGAL DESC, ID_HISTORY DESC";
    $result5 = $conn->query($sql5);
    $total5 = 0;

    if ($result5->num_rows > 0) {
      while($row = $result5->fetch_assoc()) {
        $total5 = $total5 + $row["JUMLAH_HISTORY"];
      }
    }

    $sql6 = "SELECT ID_HISTORY, TANGGAL, JUMLAH_HISTORY, KETERANGAN, PENGELUARAN_ATAU_PEMASUKAN FROM history_view WHERE TANGGAL BETWEEN '$date' AND  '$date' AND PENGELUARAN_ATAU_PEMASUKAN = 'Pemasukan' AND KETERANGAN NOT LIKE '%tumbler%' ORDER BY TANGGAL DESC, ID_HISTORY DESC";
    $result6 = $conn->query($sql6);
    $total6 = 0;

    if ($result6->num_rows > 0) {
      while($row = $result6->fetch_assoc()) {
        $total6 = $total6 + $row["JUMLAH_HISTORY"];
      }
    }
  ?>
    <div class="col-sm-8">
  <h3>Total Kotor: Rp <?php $total = number_format($total2); echo $total;?></h3>
  <h3>Total Hutang: Rp <?php $total = number_format($total1); echo $total;?></h3>
  <h3>Total Bersih: Rp <?php $total = number_format($total2-$total1); echo $total;?></h3>
	<h3>Total Bersih Dikurangi Wishlist: Rp <?php $total = number_format($total2-$total1-$total3); echo $total;?></h3>
	<h3>Total Bersih Dikurangi Flexi Saver: Rp <?php $total = number_format($total2-$total1-$total4); echo $total;?></h3>
  <h3>Total Bersih Dikurangi Wishlist & Flexi: Rp <?php $total = number_format($total2-$total1-$total3-$total4); echo $total;?></h3>
  &nbsp;
  <h3>Statistik Hari Ini (<?php echo $date?>) </h>
  <h3>Pengeluaran : Rp <?php $total = number_format($total5); echo $total;?></h3>
  <h3>Pemasukan : Rp <?php $total = number_format($total6); echo $total;?></h3>

</div>

<div class="col-sm-4">
  <form action="/data-keuangan/list-history-custom.php" method="post">
    <h3>SHOW HISTORY</h3>
    <div class="form-group">
        <label for="start">Start: </label>
        <input type="date" class="form-control" id="start" name="start" >
      </div>
      <div class="form-group">
        <label for="end">End: </label>
        <input type="date" class="form-control" id="end" name="end" >
      </div>
    <input type="submit" value="Submit">
  </form>
  </div>

  <?php $conn->close(); ?>

  </div>
</body>
</html>
