<?php
$servername = "localhost";
$username = "dipole";
$password = "123";
$dbname = "mad";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
