<?php
header("Location: /data-keuangan/list-history-all.php"); /* Redirect browser */
  include('connection.php');

  $ID_HISTORY = $_GET['idHistory'];
  $PENYIMPANAN = $_GET['penyimpanan'];
  $TIPE = $_GET['tipe'];
  $JUMLAH = $_GET['jumlah'];

  // Menghapus history
  $sql = "DELETE FROM HISTORY_KEUANGAN WHERE ID_HISTORY = '$ID_HISTORY';";
  if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . $conn->error;
  }

  // Edit jumlah penyimpanan
  $sql = "SELECT ID_PENYIMPANAN, JUMLAH FROM JENIS_PENYIMPANAN WHERE ID_PENYIMPANAN='$PENYIMPANAN'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Mengambil data uang yang akan diubah
    while($row = $result->fetch_assoc()) {
        $jumlahUang = $row["JUMLAH"];
    }

    if ($TIPE === 'Pemasukan'){
      $jumlahUang = $jumlahUang - $JUMLAH;
    }else{
      $jumlahUang = $jumlahUang + $JUMLAH;
    }

    // Update jumlah uang setelah dikurang atau ditambah
    $sql = "UPDATE JENIS_PENYIMPANAN SET JUMLAH='$jumlahUang' WHERE ID_PENYIMPANAN='$PENYIMPANAN'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

  } else {
      echo "0 results";
  }

  $conn->close();
  
 ?>
