<?php
session_start();
include "db/connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
else {
    include "menu.html";
}
?>