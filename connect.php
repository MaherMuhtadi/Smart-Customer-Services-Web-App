<?php
// credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "SCS";

// create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>