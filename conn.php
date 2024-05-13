<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer_db"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);
//echo "Connection successful!";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>