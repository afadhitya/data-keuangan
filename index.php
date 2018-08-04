<!DOCTYPE html>
<html>
<body>

  <a href="/data-keuangan/penyimpanan.php">Data Penyimpanan</a><br>
  <a href="/data-keuangan/hutang.php">Data Hutang</a><br>
  <a href="/data-keuangan/input-history-keuangan.php">Input History Keuangan</a><br>
  <a href="/data-keuangan/list-history-all.php">Show All History</a><br>
  <a href="/data-keuangan/switching-form.php">Switching</a><br><br>

  <form action="/data-keuangan/list-history-custom.php" method="post">
    SHOW HISTORY<br>
    Start: <input type="date" id="start" name="start" ><br>
    End: <input type="date" id="end" name="end" ><br>
    <input type="submit" value="Submit">
  </form>

  <?php
    include('connection.php');

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
  ?>

  <p>Total Kotor: Rp <?php $total = number_format($total2); echo $total;?></p>
  <p>Total Hutang: Rp <?php $total = number_format($total1); echo $total;?></p>
  <p>Total Bersih: Rp <?php $total = number_format($total2-$total1); echo $total;?></p>

  <?php $conn->close(); ?>
</body>
</html>
