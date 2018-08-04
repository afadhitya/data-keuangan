<?php
$servername = "localhost";
$username = "id5729641_root";
$password = "password";
$dbname = "id5729641_data_keuangan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
