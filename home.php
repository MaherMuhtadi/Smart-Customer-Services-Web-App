<?php
session_start();
include "db/connect.php";

if (!isset($_SESSION["user_id"])) {
    include "login.php";
}
else {
    include "menu.html";
}
?>