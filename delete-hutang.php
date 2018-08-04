<?php
header("Location: /data-keuangan/hutang.php"); /* Redirect browser */
include('connection.php');

$idHutang = $_GET['idHutang'];

$sql = "DELETE FROM HUTANG WHERE ID_HUTANG='$idHutang'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();


 ?>
