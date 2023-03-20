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
    
    <main>
        <h1>Happy Shopping!</h1>        
    </main>
    
    <?php footer(); ?>

</body>
</html>