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

    $sql = "SELECT ID_PENYIMPANAN, NAMA FROM JENIS_PENYIMPANAN ORDER BY JUMLAH DESC, ID_PENYIMPANAN ASC";
    $result = $conn->query($sql);
    $total = 0;

    if ($result->num_rows > 0) {

  ?>
	<!-- -------NAVBAR-------- -->
  <?php include 'navbar.php';?>
  <!-- -------------------- -->

<div class="container">
  <div class="col-sm-6">
  <form action="/data-keuangan/insert-history-keuangan.php" method="post">
    <div class="form-group">
      <label for="tanggal">Tanggal: </label>
      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
    </div>
    <div class="form-group">
      <label for="hari">Hari: </label>
    <select name="hari" id="hari" class="form-control">
      <option value="Senin"
      <?php
          if(date('l') === 'Monday'){
            echo 'selected="selected"';
          }
      ?>>Senin</option>
      <option value="Selasa"
      <?php
          if(date('l') === 'Tuesday'){
            echo 'selected="selected"';
          }
      ?>>Selasa</option>
      <option value="Rabu"
      <?php
          if(date('l') === 'Wednesday'){
            echo 'selected="selected"';
          }
      ?>>Rabu</option>
      <option value="Kamis"
      <?php
          if(date('l') === 'Thursday'){
            echo 'selected="selected"';
          }
      ?>>Kamis</option>
      <option value="Jumat"
      <?php
          if(date('l') === 'Friday'){
            echo 'selected="selected"';
          }
      ?>>Jumat</option>
      <option value="Sabtu"
      <?php
          if(date('l') === 'Saturday'){
            echo 'selected="selected"';
          }
      ?>>Sabtu</option>
      <option value="Minggu"
      <?php
          if(date('l') === 'Sunday'){
            echo 'selected="selected"';
          }
      ?>>Minggu</option>
    </select>
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan: </label>
      <input type="text" class="form-control" id="keterangan" name="keterangan" style="text-transform: capitalize;" required>
    </div>
    <div class="form-group">
      <label for="keluarAtauMasuk">Pengeluaran atau Pemasukan: </label>
      <select name="keluarAtauMasuk" id="keluarAtauMasuk" class="form-control">
      <option value="Pemasukan">Masuk</option>
      <option value="Pengeluaran">Keluar</option>
    </select>
  </div>
  <div class="form-group">
    <label for="penyimpanan">Sumber atau Tujuan Dana: </label>
    <select name="penyimpanan" id="penyimpanan" class="form-control">
      <?php while($row = $result->fetch_assoc()) { ?>
        <option value="<?php echo $row["ID_PENYIMPANAN"]?>"><?php echo $row["NAMA"]?></option>
      <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label for="jumlahHistory">Jumlah: </label>
    <input type="number" class="form-control" id="jumlahHistory" name="jumlahHistory" min="1" required>
  </div>
  <input type="submit" value="Submit" class="btn btn-default">
  </form>
<?php
} else {
    echo "0 results";
}

$conn->close();?>

  <p>Click submit untuk add penyimpanan baru ke database</p>
</div>
</div>

</body>
</html>
