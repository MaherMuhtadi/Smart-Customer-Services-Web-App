<?php
include "connect.php";
echo "Connected to database successfully.<br>";

// Dropping existing instances of the tables
try {
    mysqli_query($connection, "DROP TABLE receipt");
    mysqli_query($connection, "DROP TABLE trip");
    mysqli_query($connection, "DROP TABLE user");
    mysqli_query($connection, "DROP TABLE truck");
    mysqli_query($connection, "DROP TABLE item");
    echo "All old tables were dropped successfully.<br>";
}
catch (Exception $e) {
    echo "No old tables to drop.<br>";
}

// Creating new tables
$create_commands = file_get_contents("tables.sql");
try {
    mysqli_multi_query($connection, $create_commands);
    echo "All new tables were created successfully.<br>";
    echo "<a href='../home.php'>Homepage</a>";
}
catch (Exception $e) {
    echo "No tables created.";
}
?>