<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$database = "pms_db"; 

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Failed to connect to database:" . $conn->connect_error);
}

echo"Connection to database successful!";
?>
