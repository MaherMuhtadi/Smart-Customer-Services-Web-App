<?php
session_start();
include "layout.php";

function main() {
    echo
        "<main class='info'>
            <h1>Behind SCS</h1>
            <ul>
                <li>Maher Muhtadi</li>
                <li>Edward Sword</li>
                <li>Arshpreet Singh</li>
                <li>James Tan</li>
            </ul>
        </main>";
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