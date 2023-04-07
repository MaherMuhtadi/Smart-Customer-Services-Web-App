<?php
session_start();
if (!isset($_SESSION["user"]) or !$_SESSION["user"]["admin"]) {
    echo "<h1>Access Denied!</h1>";
    exit();
}

include "connect.php";
?>

<style>
    table {
        border: 2px solid;
        border-collapse: collapse;
    }

    th, td {
        text-align: center;
        border: 2px solid;
    }

    td > * {
        margin:auto;
    }

</style>

<h1>Select Data from SCS Database</h1>

<form method='post'>
    <h2>Pick a table and row to query:</h2>
    
    <input type="radio" id="user" value="user" name="table">
    <label for="user">User</label>

    <input type="radio" id="item" value="item" name="table">
    <label for="item">Item</label>

    <input type="radio" id="truck" value="truck" name="table">
    <label for="truck">Truck</label>

    <input type="radio" id="trip" value="trip" name="table">
    <label for="trip">Trip</label>

    <input type="radio" id="receipt" value="receipt" name="table">
    <label for="receipt">Receipt</label>

    <input type="radio" id="review" value="review" name="table">
    <label for="review">Review</label>

    <input type="radio" id="warehouse" value="warehouse" name="table">
    <label for="warehouse">Warehouse</label><br>

    <label for="id">ID:</label>
    <input type="number" id="id" name="id">

    <button type="submit" name="select">Select Row</button>
    <button type="clear">Reset</button>
</form>

<?php
if (isset($_POST["select"])) {
    unset($_POST["select"]);

    echo "<h2>".$_POST["table"]."</h2>";
    $result = mysqli_query($connection, "SELECT * FROM ".$_POST["table"]." WHERE ".$_POST["table"]."_id = ".$_POST["id"]);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        $row = mysqli_fetch_assoc($result);
        
        echo "<tr>";
        foreach ($row as $key=>$value) {
            echo "<th>$key</th>";
        }
        echo "</tr>";
            
        echo "<tr>";
        foreach ($row as $key=>$value) {
            echo "<td>$value</td>";
        }
        echo "</tr></table>";
    }
    else {
        echo "No result";
    }
}
else {
    foreach (["user", "item", "truck", "trip", "receipt", "review", "warehouse"] as $table) {
        
        echo "<h2>".$table."</h2>";
        $result = mysqli_query($connection, "SELECT * FROM ".$table);

        if (mysqli_num_rows($result) > 0) {
            $header = true;
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($header) {
                    echo "<tr>";
                    foreach ($row as $key=>$value) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";
                    $header = false;
                }
                    
                echo "<tr>";
                foreach ($row as $key=>$value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else {
            echo "No result";
        }
    }
}
?>