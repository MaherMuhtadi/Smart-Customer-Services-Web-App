<?php
session_start();
if (!isset($_SESSION["user"]) or !$_SESSION["user"]["admin"]) {
    echo "<h1>Access Denied!</h1>";
    exit();
}

include "connect.php";

function table($name) {
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM ${name}");
    if (mysqli_num_rows($result) > 0) {
        $header = true;
        echo "<table>";
        while ($row = mysqli_fetch_assoc($result)) {
            if ($header) {
                echo "<tr>";
                foreach ($row as $key=>$value) {
                    echo "<th>$key</th>";
                }
                echo "<th>Action</th>";
                echo "</tr>";
                $header = false;
            }
            echo "<tr>";
            foreach ($row as $key=>$value) {
                echo "<td>$value</td>";
            }
            $pkey = array_key_first($row);
            echo 
                "<td><form onsubmit=\"return confirm('Are you sure you want to change table: $name at id: ".$row[$pkey]."?')\" method='post' action='updateTables.php'>

                <input hidden type='text' name='table' value='$name'>
                <input hidden type='text' name='pkey' value='$pkey'>
                <input hidden type='text' name='value' value='".$row[$pkey]."'>

                <button type='submit' name='update'>Update</button>
                <button type='submit' name='delete'>Delete</button>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else {
        echo "No results";
    }
}
?>

<style>
    table {
        border: 2px solid;
        border-collapse: collapse;
        margin: auto;
    }

    th, td {
        text-align: center;
        border: 2px solid;
    }

    td > * {
        margin:auto;
    }
</style>

<h1>Edit data from SCS Database</h1>

<h2>Edit user accounts</h2>
<?php table("user"); ?>

<h2>Edit delivery trucks</h2>
<?php table("truck"); ?>

<h2>Edit delivery trips</h2>
<?php table("trip"); ?>

<h2>Edit confirmed order receipts</h2>
<?php table("receipt"); ?>

<h2>Edit purchasable items</h2>
<?php table("item"); ?>

<h2>Edit user reviews</h2>
<?php table("review"); ?>

<h2>Edit SCS warehouses</h2>
<?php table("warehouse"); ?>