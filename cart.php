<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['shopping_cart'])){
    $_SESSION['shopping_cart'] = ["items"=>[],"total_cost" => 0];
}
$items = $_SESSION['shopping_cart']['items'];

include "db/connect.php";
include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<body>
    
    <?php menuBar(); ?>
    
    <main>
        <h1>Shopping Cart</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Origin</th>
                <th>Department</th>
                <th>Store</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php
                $result = mysqli_query($connection, "SELECT * FROM item");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (in_array($row["item_name"], array_keys($items))){
                            echo
                                "<tr><td>".$row["item_id"]."</td>"
                                ."<td><img src='".$row["img_path"]."'draggable=false></td>"
                                ."<td>".$row["item_name"]."</td>"
                                ."<td>".$row["price"]." CAD</td>"
                                ."<td>".$row["made_in"]."</td>"
                                ."<td>".$row["department"]."</td>"
                                ."<td>".$row["store_name"]."</td>"
                                ."<td>".$items[$row["item_name"]]."</td>"
                                ."<td>".$items[$row["item_name"]] * (int)explode(" ",$row["price"])[0]." CAD</td></tr>";
                        }
                    }
                
                }
            ?>
        </table>

        <?php
            echo "<h2 style='text-align:right'>Total: ".$_SESSION['shopping_cart']['total_cost']." CAD</h2>";
        ?>
        <button onclick="window.open('delivery.php', '_self')">Checkout</button>
        <button class="negative-button" onclick="clearCart(); location.reload()">Clear</button>
    </main>
    
    <?php footer(); ?>

</body>
</html>