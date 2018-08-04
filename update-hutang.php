<?php
header("Location: https://data-keuangan.000webhostapp.com/data-keuangan/hutang.php");
include('connection.php');

$KETERANGAN = $_POST['keterangan'];
$JUMLAH = $_POST['jumlah'];
$idHutang = $_POST['idHutang'];

echo $KETERANGAN;
echo $JUMLAH;
echo $idHutang;

$sql = "UPDATE HUTANG SET KETERANGAN='$KETERANGAN', JUMLAH_HUTANG ='$JUMLAH' WHERE ID_HUTANG='$idHutang'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();


exit();
?>
