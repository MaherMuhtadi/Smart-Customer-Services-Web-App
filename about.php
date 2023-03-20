<?php
session_start();
include "layout.php";

function main() {
    echo
        "<main class='info'>
            <h1>Behind SCS</h1>
            <ul>
                <li>
                    <h2>Maher Muhtadi</h2>
                    Tech Support
                </li>
                <li>
                    <h2>Edward Sword</h2>
                    Tech Support
                </li>
                <li>
                    <h2>Arshpreet Singh</h2>
                    Tech Support
                </li>
                <li>
                    <h2>James Tan</h2>
                    Tech Support
                </li>
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