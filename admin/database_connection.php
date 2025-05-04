<?php
$host = 'localhost';  // or your host
$username = 'root';  // your DB username
$password = '';  // your DB password
$dbname = 'food_order';  // your DB name

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
