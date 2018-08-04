<?php
header("Location: https://data-keuangan.000webhostapp.com/data-keuangan/hutang.php"); /* Redirect browser */
include('connection.php');

$KETERANGAN = $_POST['keterangan'];
$JUMLAH = $_POST['jumlah'];

$sql = "INSERT INTO HUTANG (KETERANGAN, JUMLAH_HUTANG)
VALUES ('$KETERANGAN', '$JUMLAH')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


exit();
?>
