<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["shopping_cart"])){
    $_SESSION["shopping_cart"] = ["items"=>[],"total_cost" => 0];
}

$KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI";
$user = $_SESSION["user"];
$cart = $_SESSION["shopping_cart"];
include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<style>
    #map {
	    width: 40vw;
        height: 40vw;
		margin: auto;
	}
    
    #map-form {
        width: 40%;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        row-gap: 0.5rem;
    }

    #map-input {
        display: flex;
        justify-content: space-between;
    }

    input, select {
        width: 70%;
    }
</style>

<body>
    
    <?php menuBar(); ?>

    <main>
        <h1>Delivery Options</h1>

        <?php
            if (count($cart["items"]) == 0) {
                echo "<h2>You have nothing to be delivered</h2></main>";
                footer(); 
                echo "</body></html>";
                exit();
            }
        ?>

        <h2>How would you like for your items to be delivered?</h2>

        <div id="map-form">
            <div id="map-input">
                <label for="destination">Deliver to:</label>
                <input id="destination" type="text" value="<?php echo $user["address"]; ?>" maxlength="200">
            </div>
            
            <div id="map-input">
                <label for="source">Warehouse:</label>
                <select id="source">
                    <option value="789 Salem Rd N, Ajax, ON L1Z 1G1">789 Salem Rd N, Ajax, ON L1Z 1G1</option>
                    <option value="150 Kingston Rd E, Ajax, ON L1Z 1E5">150 Kingston Rd E, Ajax, ON L1Z 1E5</option>
                </select>
            </div>
        </div>
        <button onclick="initMap()">Generate Map</button>
        
        <div id="map"></div>
    </main>

    <?php footer(); ?>
    
</body>

<script src='maps.js'></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $KEY; ?>&callback=initMap"></script>

</html>