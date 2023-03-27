<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI";
$receipt_id = $_GET["id"];
$user_id = $_SESSION["user"]["user_id"];
$user_name = $_SESSION["user"]["login_id"]."#".$user_id;
include "admin/connect.php";

$result = mysqli_query($connection, "SELECT * FROM receipt WHERE receipt_id = '".$receipt_id."'");
if (mysqli_num_rows($result) > 0) {
    $receipt = mysqli_fetch_assoc($result);
    
    if ($receipt["user_id"] != $user_id) {
        header("Location: home.php");
        exit();
    }
    
    $date_issued = $receipt["date_issued"];
    $date_delivered = $receipt["date_delivered"];
    $items = $receipt["items"];
    $total_price = $receipt["total_price"];
    $trip_id = $receipt["trip_id"];
    
    $len = strlen($receipt["payment"]) - 4;
    $payment = str_repeat("*",$len).substr($receipt["payment"],$len);

    $trip = [];
    $result = mysqli_query($connection, "SELECT * FROM trip WHERE trip_id = '".$trip_id."'");
    if (mysqli_num_rows($result) > 0) {
        $trip = mysqli_fetch_assoc($result);
    }

    $source = $trip["source"];
    $destination = $trip["destination"];
    $delivery_fee = $trip["price"];
    $subtotal = $total_price-$delivery_fee;
}
else {
    header("Location: home.php");
    exit();
}

include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<style>
    main {
        line-height: 3rem;
    }
    .entry {
        color: rgb(88,101,242);
    }
    #map {
	    width: 30vw;
        height: 30vw;
		margin: auto;
	}
</style>

<body>
    
    <header style="position:initial">
        <img style="width:15%" src="images/logo.png" alt="logo">
        <button style="position:absolute;right:3%" onclick="window.print()">Print</button>
    </header>

    <main class="info">
        <h1>Receipt<span class="entry">#<?php echo $receipt_id; ?></span></h1>
        <h2>Here is a summary of your purchase <span class="entry"><?php echo $user_name; ?></span></h2>

        <strong>Date Purchased:</strong> <span class="entry"><?php echo $date_issued; ?></span><br>
        <strong>Payment Account:</strong> <span class="entry"><?php echo $payment; ?></span><br>

        <strong>Items:</strong>
        <span class="entry"><?php echo $items; ?></span>

        <strong>Warehouse:</strong> <span class="entry"><?php echo $source; ?></span><br>
        <strong>Delivery Address:</strong> <span class="entry"><?php echo $destination; ?></span><br>
        <strong>Date Delivered:</strong> <span class="entry"><?php echo $date_delivered; ?></span><br>

        <input type="hidden" id="source" value="<?php echo $source; ?>">
        <input type="hidden" id="destination" value="<?php echo $destination; ?>">
        <div id="map"></div>

        <div style="text-align:end">
            <strong>Subtotal:</strong> <span class="entry"><?php echo $subtotal; ?> CAD</span><br>
            <strong>Delivery Fee:</strong> <span class="entry"><?php echo $delivery_fee; ?> CAD</span><br>
            
            <h2>Total: <span class="entry"><?php echo $total_price; ?> CAD</span></h2>
        </div>
    </main>

    <?php footer(); ?>

</body>

<script src='maps.js'></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $KEY; ?>&callback=initMap"></script>

</html>