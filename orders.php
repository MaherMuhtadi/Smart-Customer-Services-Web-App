<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];

include "layout.php";
include "admin/connect.php";
?>
    
<html lang='en'>
<?php htmlHead("Contact Us"); ?>

<style>
    form {
        display: flex;
        justify-content: end;
    }
</style>
    
<body>
    
    <?php menuBar(); ?>

    <main>
        <h1>My Order History</h1>
        <h2>Click to view receipt</h2>

        <form method="post">
            <div>
                <label for="receipt_id">Receipt ID:</label>
                <input type="number" id="receipt_id" name="receipt_id">

                <button type="submit" name="receipt_submitted">Search</button>
                <button class="negative-button" type="clear">Clear</button>
            </div>
        </form>

        <?php
            if (isset($_POST["receipt_submitted"])) {
                unset($_POST["receipt_submitted"]);

                $result = mysqli_query($connection, "SELECT * FROM receipt WHERE user_id = ".$user["user_id"]." AND receipt_id = ".$_POST["receipt_id"]);
                if (mysqli_num_rows($result) > 0) {
                    echo 
                        "<table><tr>
                        <th>Receipt ID</th>
                        <th>Date Issued</th>
                        <th>Status</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo
                            "<tr onclick=\"window.open('receipt.php?id=".$row["receipt_id"]."')\">
                            <td>".$row["receipt_id"]."</td>
                            <td>".$row["date_issued"]."</td>";
                        if ($row["date_delivered"] <= date("Y-m-d h:i:s")) {
                            echo "<td style='color:rgb(36,128,70)'>Delivered</td>";
                        }
                        else {
                            echo "<td style='color:rgb(218,55,60)'>Ongoing</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "No results";
                }
            }
            else {
                $result = mysqli_query($connection, "SELECT * FROM receipt WHERE user_id = ".$user["user_id"]);
                if (mysqli_num_rows($result) > 0) {
                    echo 
                        "<table><tr>
                        <th>Receipt ID</th>
                        <th>Date Issued</th>
                        <th>Status</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo
                            "<tr onclick=\"window.open('receipt.php?id=".$row["receipt_id"]."')\">
                            <td>".$row["receipt_id"]."</td>
                            <td>".$row["date_issued"]."</td>";
                        if ($row["date_delivered"] <= date("Y-m-d h:i:s")) {
                            echo "<td style='color:rgb(36,128,70)'>Delivered</td>";
                        }
                        else {
                            echo "<td style='color:rgb(218,55,60)'>Ongoing</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "No results";
                }
            }
        ?>
    </main>

    <?php footer(); ?>
    
</body>
</html>