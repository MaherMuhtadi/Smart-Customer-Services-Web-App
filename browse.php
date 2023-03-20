<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include "db/connect.php";
include "layout.php";
?>

<html lang='en'>
<?php htmlHead(); ?>

<body>

    <?php menuBar(); ?>
    
    <main>
        <h1>Happy Shopping!</h1>
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
                        "<tr><td>".$row["item_id"]."</td>"
                        ."<td><img src='".$row["img_path"]."'></td>"
                        ."<td>".$row["item_name"]."</td>"
                        ."<td>".$row["price"]." CAD</td>"
                        ."<td>".$row["made_in"]."</td>"
                        ."<td>".$row["department"]."</td>"
                        ."<td>".$row["store_name"]."</td></tr>";
                }
            }
            ?>
        </table>
    </main>
    
    <?php footer(); ?>

</body>
</html>