<?php
include('connection.php');

$NAMA = $_POST['nama'];
$JUMLAH = $_POST['jumlah'];

$sql = "INSERT INTO JENIS_PENYIMPANAN (NAMA, JUMLAH)
VALUES ('$NAMA', '$JUMLAH')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: /data-keuangan/penyimpanan.php"); /* Redirect browser */
exit();
?>
