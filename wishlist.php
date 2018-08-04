<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body></body>

  <?php
    include('connection.php');

    $sql = "SELECT * FROM WISHLIST";
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
        <th>Nama Wishlist</th>
        <th>Harga</th>
        <th>Keterangan Wishlist</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td> <?php echo $row["NAMA_WISHLIST"]; ?></td>
          <td> Rp <?php $total1 = number_format($row["HARGA"]); echo $total1;?></td>
          <?php $total = $total + $row["HARGA"]; ?>
          <td> <?php echo $row["KETERANGAN_WISHLIST"]; ?></td>
          <td> <a href="/data-keuangan/delete-wishlist.php?idWishlist=<?php echo $row["ID_WISHLIST"]?>">Delete</a></td>
        </tr>
      <?php } ?>
        <tr>
          <td><b>Total Harga Wishlist</b></td>
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
  <form action="/data-keuangan/insert-wishlist.php" method="post">
    <div class="form-group">
      <label for="nama_wishlist">Nama Wishlist: </label>
      <input type="text" class="form-control" id="nama_wishlist" name="nama_wishlist" required>
    </div>
  <div class="form-group">
    <label for="harga">Harga Wishlist: </label>
    <input type="number" class="form-control" id="harga" name="harga" value="0" required>
  </div>
  <div class="form-group">
    <label for="keterangan_wishlist">Keterangan Wishlist: </label>
    <input type="text" class="form-control" id="keterangan_wishlist" name="keterangan_wishlist">
  </div>
  <input type="submit" value="Submit" class="btn btn-default">
  </form>

  <h4>Click submit untuk add wishlist baru ke database</h4>
</div>
</div>

</body>
</html>
