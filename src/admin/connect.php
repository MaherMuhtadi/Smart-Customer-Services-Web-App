<?php
// credentials
$hostname = getenv("MYSQL_HOSTNAME");
$username = "root";
$password = getenv("MYSQL_PASSWORD");
$database = getenv("MYSQL_DATABASE");

// create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>