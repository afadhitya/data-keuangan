<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body></body>

  <?php
    include('connection.php');

    $sql = "SELECT ID_HUTANG, KETERANGAN, JUMLAH_HUTANG FROM HUTANG";
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
        <th>Keterangan</th>
        <th>Jumlah Hutang</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td> <?php echo $row["KETERANGAN"]; ?></td>
          <td> Rp <?php $total1 = number_format($row["JUMLAH_HUTANG"]); echo $total1;?></td>
          <?php $total = $total + $row["JUMLAH_HUTANG"]; ?>
          <td> <a href="/data-keuangan/delete-hutang.php?idHutang=<?php echo $row["ID_HUTANG"]?>">Delete</a>
                <a href="/data-keuangan/edit-hutang.php?idHutang=<?php echo $row["ID_HUTANG"]?>">Edit</a></td>
        </tr>
      <?php } ?>
        <tr>
          <td><b>Total Hutang</b></td>
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
  <form action="/data-keuangan/insert-hutang.php" method="post">
    <div class="form-group">
    <label for="keterangan">Hutang: </label>
    <input type="text" class="form-control" id="keterangan" name="keterangan">
  </div>
  <div class="form-group">
  <label for="jumlah">Jumlah Hutang: </label>
  <input type="text" class="form-control" id="jumlah" name="jumlah" value="0">
</div>
  <input type="submit" value="Submit" class="btn btn-default">
  </form>

  <h4>Click submit untuk add hutang baru ke database</h4>
</div>
</div>

</body>
</html>
