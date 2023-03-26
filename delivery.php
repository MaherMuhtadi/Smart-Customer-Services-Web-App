<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["shopping_cart"])){
    $_SESSION["shopping_cart"] = ["items"=>[],"total_cost" => 0];
}

$cart = $_SESSION["shopping_cart"];
include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>
    
<body>
    
    <?php menuBar(); ?>

    <main>
        <h1>Delivery Options</h1>

        <?php
            if (count($cart["items"]) == 0) {
                echo "<h2>You have nothing to be delivered</h2>";
            }
            else {
                echo "<h2>How would you like for your items to be delivered?</h2>";
            }
        ?>
    </main>

    <?php footer(); ?>
    
</body>
</html>