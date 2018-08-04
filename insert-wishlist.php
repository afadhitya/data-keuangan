<?php
header("Location: https://data-keuangan.000webhostapp.com/data-keuangan/wishlist.php"); /* Redirect browser */
include('connection.php');

$NAMA = $_POST['nama_wishlist'];
$HARGA = $_POST['harga'];
$KETERANGAN = $_POST['keterangan_wishlist'];

$sql = "INSERT INTO WISHLIST (NAMA_WISHLIST, HARGA, KETERANGAN_WISHLIST)
VALUES ('$NAMA', '$HARGA', '$KETERANGAN')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


exit();
?>
