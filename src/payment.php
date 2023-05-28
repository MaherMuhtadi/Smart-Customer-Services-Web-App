<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
elseif (count($_GET) == 0 or !isset($_SESSION["shopping_cart"])) {
    header("Location: index.php");
    exit();
}

$KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI";
$cart = $_SESSION["shopping_cart"];

include "layout.php";
include "admin/connect.php";
?>

<html lang='en'>
<?php htmlHead("Payment"); ?>

<style>
    #container {
        display: flex;
        justify-content: space-evenly;
    }
    #map {
	    width: 20vw;
        height: 20vw;
		margin: auto;
	}
    form {
        width: 40%;
        display: flex;
        flex-direction: column;
        align-items: space-between;
    }
    form > div {
        display: flex;
        justify-content: space-between;
    }
</style>

<body>

    <?php menuBar(); ?>

    <main>
        <?php
            if (isset($_POST["payed"])) {
                unset($_POST["payed"]);
            
                $result = mysqli_query($connection, "SELECT truck_id, availability_code FROM truck WHERE availability_code > 0");
                if (mysqli_num_rows($result) > 0) {
                    $truck_id = mysqli_fetch_assoc($result)["truck_id"];
                    mysqli_query($connection, "UPDATE truck SET availability_code = 0 WHERE truck_id = '".$truck_id."'");

                    $insert_trip = 
                        "INSERT INTO trip (source, destination, distance, truck_id, price)
                            VALUES ('"
                            .$_GET["src"]."', '"
                            .$_GET["dst"]."', '"
                            .$_GET["distance"]."', '"
                            .$truck_id."', '"
                            .$_GET["fee"]."')";
                    mysqli_query($connection, $insert_trip);

                    $items = "<ul>";
                    foreach ($cart["items"] as $item => $qty) {
                        $result = mysqli_query($connection, "SELECT price, item_name FROM item WHERE item_name = '".$item."'");
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $items = $items."<li>{".$item."} ".$row["price"]."CAD x".$qty."</li>";
                        }
                    }
                    $items = $items."</ul>";

                    $trip_id = "";
                    $result = mysqli_query($connection, "SELECT trip_id, truck_id FROM trip WHERE truck_id = '".$truck_id."'");
                    if (mysqli_num_rows($result) > 0) {
                        $trip_id = mysqli_fetch_assoc($result)["trip_id"];
                    }
                    
                    // Encrypting the credit card number with password digest before storing
                    error_reporting(E_ALL ^ E_WARNING);
                    $key =  md5($_SESSION["user"]["password"]);
                    $encrypted_credit_card = openssl_encrypt($_POST["credit_card"], "aes-256-cbc", $encryption_key=$key);

                    $insert_receipt =
                        "INSERT INTO receipt (date_issued, date_delivered, items, total_price, payment, user_id, trip_id)
                            VALUES ('"
                                .date("Y-m-d h:i:s")."', '"
                                .$_GET["date"]."', '"
                                .$items."', '"
                                .$cart["total_cost"]+$_GET["fee"]."', '"
                                .$encrypted_credit_card."', '"
                                .$_SESSION["user"]["user_id"]."', '"
                                .$trip_id."')";
                    mysqli_query($connection, $insert_receipt);

                    $_SESSION["user"]["points"] += intval($cart["total_cost"]);
                    $_SESSION["user"]["free_delivery"] = 0;
                    $user = $_SESSION["user"];
                    mysqli_query($connection, "UPDATE user SET points = ".$user["points"].", free_delivery = ".$user["free_delivery"]." WHERE user_id = '".$user["user_id"]."'");

                    $receipt_id = "";
                    $result = mysqli_query($connection, "SELECT receipt_id, trip_id FROM receipt WHERE trip_id = '".$trip_id."'");
                    if (mysqli_num_rows($result) > 0) {
                        $receipt_id = mysqli_fetch_assoc($result)["receipt_id"];
                    }

                    unset($_SESSION["shopping_cart"]);
                    
                    echo "<h1>Thank You for Shopping!</h1>";
                    echo "<h2>Confirmation#".$receipt_id."</h2>";
                    echo "<button onclick='window.open(\"receipt.php?id=$receipt_id\")'>View Receipt</button>";
                    echo "</main>";
                    footer();
                    echo "</body></html>";
                    exit();
                }
                else {
                    echo "<h2 style='color:rgb(218,55,60)'>Due to high volume of orders, we cannot process your request at the moment. Please try again later.</h2>";
                }
            }
        ?>

        <h1 style="text-align:center">Final Step!</h1>

        <div id="container">
            <div class="tiles" onclick="window.open('delivery.php', '_SELF')">
            <h2>Summary</h2>
            <?php
                echo "<strong>Items:</strong><ul>";
                foreach ($cart["items"] as $item => $qty) {
                    $result = mysqli_query($connection, "SELECT price, item_name FROM item WHERE item_name = '".$item."'");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<li>".$item." ".$row["price"]."CAD x".$qty."</li>";
                    }
                }
                echo "</ul>";
                echo "<strong>Subotal:</strong> ".$cart["total_cost"]."CAD<hr>";
                echo "<strong>From:</strong><br>".$_GET["src"]."<br>";
                echo "<strong>To:</strong><br>".$_GET["dst"]."<br><br>";
                echo "<input type='hidden' id='source' value='".$_GET["src"]."'>";
                echo "<input type='hidden' id='destination' value='".$_GET["dst"]."'>";
                echo "<div id='map'></div><br>";
                echo "<strong>Shipping Fee:</strong> ".$_GET["fee"]."CAD";
                echo "<h2>Total: ".$cart["total_cost"]+$_GET["fee"]." CAD</h2>";
            ?>
            </div>
            
            <!-- This is a dummy form -->
            <form method="post">
                <h2>Payment details</h2>
                
                <div>
                    <label>First name:</label>
                    <input type="text">
                </div>
                    
                <div>
                    <label>Last name:</label>
                    <input type="text">
                </div>

                <div>
                    <label for="credit_card">Credit card:</label>
                    <input id="credit_card" name="credit_card" type="text" minlength="16" maxlength="19">
                </div>

                <div>
                    <label>Billing address:</label>
                    <input type="text">
                </div>

            
                <div>
                    <label>Valid thru:</label>
                    <input type="month">
                </div>

                <div>
                    <label>CVC:</label>
                    <input type="text">
                </div>

                <button style="width:25%" name="payed" type="submit">Pay</button>
            </form>
        </div>
    </main>

    <?php footer(); ?>

</body>

<script src='maps.js'></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $KEY; ?>&callback=initMap"></script>

</html>