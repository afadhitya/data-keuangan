<?php
header("Location: /data-keuangan/list-history-all.php"); /* Redirect browser */
include('connection.php');

$tanggal = $_POST['tanggal'];
$hari = $_POST['hari'];
$keterangan = $_POST['keterangan'];
$keluarAtauMasuk = $_POST['keluarAtauMasuk'];
$penyimpanan = $_POST['penyimpanan'];
$jumlahHistory = $_POST['jumlahHistory'];

$sql = "INSERT INTO HISTORY_KEUANGAN (ID_PENYIMPANAN, TANGGAL, HARI, KETERANGAN, JUMLAH_HISTORY, PENGELUARAN_ATAU_PEMASUKAN)
VALUES ('$penyimpanan', '$tanggal', '$hari', '$keterangan', '$jumlahHistory', '$keluarAtauMasuk')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//-------------------

$sql2 = "SELECT ID_PENYIMPANAN, JUMLAH FROM JENIS_PENYIMPANAN WHERE ID_PENYIMPANAN = '$penyimpanan'";
$result2 = $conn->query($sql2);
$uangSekarang = 0;

if ($result2->num_rows > 0) {
  while($row = $result2->fetch_assoc()){
    $uangSekarang = $row["JUMLAH"];
  }

  if($keluarAtauMasuk === "Pemasukan"){
    $uangSekarang = $uangSekarang + $jumlahHistory;
  }
  else{
    $uangSekarang = $uangSekarang - $jumlahHistory;
  }

  $sql3 = "UPDATE JENIS_PENYIMPANAN SET JUMLAH = '$uangSekarang' WHERE ID_PENYIMPANAN = '$penyimpanan';";
  if ($conn->query($sql3) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql3 . "<br>" . $conn->error;
  }

}else {
    echo "0 results";
}


$conn->close();


exit();
?>
