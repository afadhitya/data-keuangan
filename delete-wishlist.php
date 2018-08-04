<?php
header("Location: /data-keuangan/wishlist.php"); /* Redirect browser */
include('connection.php');

$idWishlist = $_GET['idWishlist'];

$sql = "DELETE FROM WISHLIST WHERE ID_WISHLIST='$idWishlist'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();


 ?>
