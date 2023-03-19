<?php
include "connect.php";
echo "Connected to database successfully.<br>";
$commands = file_get_contents("tables.sql");
if (mysqli_multi_query($connection, $commands)) {
    echo "All tables were created successfully.<br>";
    echo "<a href='../home.php'>Homepage</a>";
}
?>