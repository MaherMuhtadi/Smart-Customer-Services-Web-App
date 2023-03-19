<?php
include "connect.php";
$commands = file_get_contents("tables.sql");
mysqli_multi_query($connection, $commands);
?>