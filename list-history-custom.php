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

  <?php
    include('connection.php');

    $start = $_POST['start'];
    $end = $_POST['end'];

    $sql = "SELECT ID_HISTORY, ID_PENYIMPANAN, SUMBER_ATAU_TUJUAN_DANA, TANGGAL, HARI, KETERANGAN, JUMLAH_HISTORY, PENGELUARAN_ATAU_PEMASUKAN FROM history_view WHERE TANGGAL BETWEEN '$start' AND  '$end' ORDER BY TANGGAL DESC, ID_HISTORY DESC";
    $result = $conn->query($sql);

    // $sql2 = "SELECT ID_PENYIMPANAN, NAMA FROM JENIS_PENYIMPANAN";
    // $result2 = $conn->query($sql2);

    if ($result->num_rows > 0) {
  ?>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
        <li><a href="/data-keuangan/home.php">Home</a></li>
      <li><a href="/data-keuangan/penyimpanan.php">Data Penyimpanan</a></li>
      <li><a href="/data-keuangan/hutang.php">Data Hutang</a></li>
      <li><a href="/data-keuangan/input-history-keuangan.php">Input History Keuangan</a></li>
      <li><a href="/data-keuangan/list-history-all.php">Show All History</a></li>
      <li><a href="/data-keuangan/switching-form.php">Switching</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <table class="table table-bordered table-striped" border="1">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Keterangan</th>
        <th>Pemasukan atau Pengeluaran</th>
        <th>Jumlah</th>
        <th>Sumber atau Tujuan Dana</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td> <?php echo $row["TANGGAL"]; ?></td>
          <td> <?php echo $row["HARI"]; ?></td>
          <td> <?php echo $row["KETERANGAN"]; ?></td>
          <td> <?php echo $row["PENGELUARAN_ATAU_PEMASUKAN"]; ?></td>
          <td> <?php echo number_format($row["JUMLAH_HISTORY"]); ?></td>
          <td> <?php echo $row["SUMBER_ATAU_TUJUAN_DANA"]; ?></td>
          <td> <a href="/data-keuangan/delete-history.php?idHistory=<?php echo $row["ID_HISTORY"]?>&jumlah=<?php echo $row["JUMLAH_HISTORY"]?>&penyimpanan=<?php echo $row["ID_PENYIMPANAN"]?>&tipe=<?php echo $row["PENGELUARAN_ATAU_PEMASUKAN"]?>">Delete</a></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

  <?php
  } else {
        echo "0 results";
    }
    $conn->close();
  ?>
</body>
</html>
