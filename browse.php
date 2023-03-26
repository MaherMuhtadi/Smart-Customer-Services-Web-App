<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION["shopping_cart"])){
    $_SESSION["shopping_cart"] = ["items"=>[],"total_cost" => 0];
}

include "admin/connect.php";
include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<style>
    .tiles {
        margin-top: 1rem;
    }
    .items {
        cursor: move;
    }
</style>

<body>

    <?php menuBar(); ?>
    
    <main>
        <h1>Happy Shopping!</h1>
        <h2>Drag and drop to add to cart</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Origin</th>
                <th>Department</th>
                <th>Store</th>
            </tr>
            <?php
            $result = mysqli_query($connection, "SELECT * FROM item");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                        "<tr id='".$row["item_id"]."' class='items' draggable=true><td>".$row["item_id"]."</td>"
                        ."<td><img src='".$row["img_path"]."' draggable=false></td>"
                        ."<td>".$row["item_name"]."</td>"
                        ."<td>".$row["price"]." CAD</td>"
                        ."<td>".$row["made_in"]."</td>"
                        ."<td>".$row["department"]."</td>"
                        ."<td>".$row["store_name"]."</td></tr>";
                }
            }
            ?>
        </table>

        <div class="tiles" ondrop="dropHandler(event)" ondragover="dragoverHandler(event)">
            <h2>Shopping Cart</h2>
            <div width="100%" id="shopping-cart" onclick="window.open('cart.php', '_self')"></div><br>
            <button class="negative-button" onclick="clearCart()">Clear</button>
        </div>
    </main>
    
    <?php footer(); ?>

</body>
</html>