<?php
session_start();
include "layout.php";

function main() {
    echo
        "<main class='info'>
            <h1>Need help?</h1>
            Our team is here to assist you! Contact us at:
            <ul>
                <li>mmuhtadi@torontomu.ca</li>
                <li>edward.sword@torontomu.ca</li>
                <li>arshpreet.singh@torontomu.ca</li>
                <li>russelljames.tan@torontomu.ca</li>
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