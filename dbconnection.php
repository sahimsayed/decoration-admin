<?php
$host = "localhost";
$username = "root";
$password = "19732846@An";
$dbname = "decoration";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
