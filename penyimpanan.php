<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
<body>

  <?php
    include('connection.php');

    $sql = "SELECT ID_PENYIMPANAN, NAMA, JUMLAH FROM JENIS_PENYIMPANAN WHERE JUMLAH != 0 ORDER BY JUMLAH DESC, ID_PENYIMPANAN ASC";
    $result = $conn->query($sql);
    $total = 0;

    if ($result->num_rows > 0) {
  ?>

  <!-- -------NAVBAR-------- -->
  <?php include 'navbar.php';?>
  <!-- -------------------- -->
  
  <div class="container">
    <div class="col-sm-8">
  <table class="table table-bordered table-striped" border="1">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td> <?php echo $row["NAMA"]; ?></td>
          <td> Rp <?php $total1 = number_format($row["JUMLAH"]); echo $total1;?></td>
          <?php $total = $total + $row["JUMLAH"]; ?>
        </tr>
      <?php } ?>
        <tr>
          <td><b>Total Kotor</b></td>
          <td><b>Rp <?php $totalSemua = number_format($total); echo $totalSemua; ?></b></td>
        </tr>
    </tbody>
  </table>
</div>

  <?php
  } else {
        echo "0 results";
    }
    $conn->close();
  ?>

  <div class="col-sm-4">
  <form action="/data-keuangan/insert-penyimpanan.php" method="post">
    <div class="form-group">
    <label for="nama">Jenis Penyimpanan: </label>
    <input type="text" class="form-control" id="nama" name="nama">
  </div>
  <div class="form-group">
    <label for="nama">First Amount:  </label>
    <input type="text" class="form-control" id="jumlah" name="jumlah" value="0">
  </div>
  <!--Jenis Penyimpanan: <input type="text" id="nama" name="nama" ><br>-->
  <!--First Amount: <input type="text" id="jumlah" name="jumlah" value="0"><br>-->
  <input type="submit" value="Submit" class="btn btn-default">
  </form>
  <h4>Click submit untuk add penyimpanan baru ke database</h4>
</div>



</div>
</body>
</html>
