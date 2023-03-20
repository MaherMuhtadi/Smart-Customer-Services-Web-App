<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<body>

    <?php menuBar(); ?>

    <main class='info'>
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
    </main>

    <?php footer(); ?>

</body>
</html>