<?php
session_start();
if (!isset($_SESSION["shopping_cart"])){
    $_SESSION["shopping_cart"] = ["items"=>[],"total_cost" => 0];
}

$KEY = "AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI";
$user = $_SESSION["user"];
$cart = $_SESSION["shopping_cart"];

include "layout.php";
include "admin/connect.php"
?>

<html lang='en'>
<?php htmlHead("Delivery"); ?>

<style>
    #map-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    #map {
	    width: 30vw;
        height: 30vw;
		margin: auto;
	}

    #info {
        text-align: end;
    }

    input[type=text], select {
        width: 70%;
    }

    #generate-button {
        width: fit-content;
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

        <div id="map-container">
            <div id="map-form">
                <div id="map-input">
                    <label for="destination">Deliver to:</label>
                    <input id="destination" type="text" value="<?php if ($user) {echo $user["address"];} ?>" maxlength="200">
                </div>
                
                <div id="map-input">
                    <label for="source">Warehouse:</label>
                    <select id="source">
                        <?php
                            $result = mysqli_query($connection, "SELECT * FROM warehouse");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row["address"]."'>".$row["address"]."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>

                <button id="generate-button" onclick="initMap()">Generate Map</button>

                <div id="map-input">
                    <label for="date">Delivery date:</label>
                    <div style="width:70%">
                        <?php
                            $min_date = date('Y-m-d', strtotime(date('Y-m-d').' + 3 days'));
                            echo "<input id='date' type='date' value='$min_date' min='$min_date'>";
                        ?>
                    </div>
                </div>
                
                <div id="info" class="info"></div>
                <button onclick="payRedirect()">Proceed to Pay</button>
            </div>
            
            <div id="map"></div>
        </div>
    </main>

    <?php footer(); ?>
    
</body>

<script src='maps.js'></script>
<script type="text/Javascript">
    function payRedirect() {
        let src = document.getElementById("source").value;
        let dst = document.getElementById("destination").value;
        let date = document.getElementById("date").value;
        let url = `payment.php?src=${src}&dst=${dst}&distance=${distance}&date=${date}&fee=${fee}`;
        window.open(url, "_self");
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $KEY; ?>&callback=initMap"></script>

</html>