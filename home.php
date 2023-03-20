<?php
session_start();
include "layout.php";

function main() {
    $user = $_SESSION["user"];
    echo "<main>";
    echo "<h1>Welcome ".$user["login_id"]."#".$user["user_id"]."!</h1>";
    echo "Your current balance is ".$user["balance"];
    echo "</main>";
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
else {
    echo "<html lang='en'>";
    htmlHead();
    echo "<body>";
    menuBar();
    main();
    footer();
    echo "</body></html>";
}
?>