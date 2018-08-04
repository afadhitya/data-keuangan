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
<body>
  <?php
    include('connection.php');

    $sql = "SELECT ID_PENYIMPANAN, NAMA FROM JENIS_PENYIMPANAN";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql);
    $total = 0;

    if ($result->num_rows > 0) {
  ?>
	<!-- -------NAVBAR-------- -->
  <?php include 'navbar.php';?>
  <!-- -------------------- -->

  SWITCHING<br>
  <form action="/data-keuangan/switching.php" method="post">
    From: <select name="from">
      <?php while($row = $result->fetch_assoc()) { ?>
        <option value="<?php echo $row["ID_PENYIMPANAN"]?>"><?php echo $row["NAMA"]?></option>
      <?php } ?>
    </select><br>
    To: <select name="to">
      <?php while($row = $result2->fetch_assoc()) { ?>
        <option value="<?php echo $row["ID_PENYIMPANAN"]?>"><?php echo $row["NAMA"]?></option>
      <?php } ?>
    </select><br>
    Amount: <input type="text" id="jumlah" name="jumlah"><br>
    <input type="submit" value="Submit">
  </form>
<?php
} else {
    echo "0 results";
}

$conn->close();?>


</body>
</html>
