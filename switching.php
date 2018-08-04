<?php
include('connection.php');

$idFrom = $_POST['from'];
$idTo = $_POST['to'];
$amountSwitch = $_POST['jumlah'];

$sqlFrom = "SELECT ID_PENYIMPANAN, NAMA, JUMLAH FROM JENIS_PENYIMPANAN WHERE ID_PENYIMPANAN='$idFrom'";
$result = $conn->query($sqlFrom);

// Proses pengurangan From
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $amountFrom = $row["JUMLAH"];
        $amountFrom = $amountFrom - $amountSwitch;
    }

    $sqlFromUpdate = "UPDATE JENIS_PENYIMPANAN SET JUMLAH='$amountFrom' WHERE ID_PENYIMPANAN='$idFrom'";
    if ($conn->query($sqlFromUpdate) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "0 results";
}

$sqlTo = "SELECT ID_PENYIMPANAN, NAMA, JUMLAH FROM JENIS_PENYIMPANAN WHERE ID_PENYIMPANAN='$idTo'";
$result = $conn->query($sqlTo);

//Proses penambahan To
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $amountTo = $row["JUMLAH"];
        $amountTo = $amountTo + $amountSwitch;
    }
    $sqlToUpdate = "UPDATE JENIS_PENYIMPANAN SET JUMLAH='$amountTo' WHERE ID_PENYIMPANAN='$idTo'";
    if ($conn->query($sqlToUpdate) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "0 results";
}

$conn->close();

header("Location: /data-keuangan/penyimpanan.php"); /* Redirect browser */
 ?>
