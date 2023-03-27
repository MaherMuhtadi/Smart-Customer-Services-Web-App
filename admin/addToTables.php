<?php
include "connect.php";
echo "Connected to database successfully.<br>";

// Processes item submission
if (isset($_POST["item_submitted"])) {
    unset($_POST["item_submitted"]);

    // Downloads file to the server if it is png or jpg
    $img = $_FILES["img"];
    $path = "../images/items/".$img["name"];
    $validExt = array("jpg", "png");
    $validMime = array("image/jpeg","image/png");
	$name_array = explode(".", $img["name"]);
    $extension = end($name_array);
	if (in_array($img["type"], $validMime) && in_array($extension, $validExt)) {
        move_uploaded_file($img['tmp_name'], $path);
        $insert_item = 
            "INSERT INTO item (img_path, item_name, price, made_in, department, store_name)
                VALUES ('"
                .substr($path, 3)."', '"
                .$_POST["item_name"]."', '"
                .$_POST["price"]."', '"
                .$_POST["made_in"]."', '"
                .$_POST["department"]."', '"
                .$_POST["store_name"]."')";
        if (mysqli_query($connection, $insert_item)) {
            echo $_POST["item_name"]." added successfully.<br>";
        }
        else {
            echo "Failed to add item.<br>";
        }
	}
	else {
		echo "Invalid file!<br>";
	}
}

// Processes truck submission
if (isset($_POST["truck_submitted"])) {
    unset($_POST["truck_submitted"]);

    if (mysqli_query($connection, "INSERT INTO truck (truck_code) VALUES ('".$_POST["truck_code"]."')")) {
        echo $_POST["truck_code"]." added successfully.<br>";
    }
    else {
        echo "Failed to add truck.<br>";
    }
}

// Processes warehouse submission
if (isset($_POST["warehouse_submitted"])) {
    unset($_POST["warehouse_submitted"]);

    if (mysqli_query($connection, "INSERT INTO warehouse (address) VALUES ('".$_POST["address"]."')")) {
        echo $_POST["address"]." added successfully.<br>";
    }
    else {
        echo "Failed to add warehouse.<br>";
    }
}
?>
<form enctype='multipart/form-data' method='post'>
    <p>Add an item to SCS Database:<p>

    <label for="img">Image:</label>
    <input id="img" name="img" type="file"><br>
    
    <label for="item_name">Name:</label>
    <input id="item_name" name="item_name" type="text"  maxlength="100"><br>
    
    <label for="price">Price:</label>
    <input id="price" name="price" type="number"><br>
    
    <label for="made_in">Made In:</label>
    <input id="made_in" name="made_in" type="text"  maxlength="50"><br>
    
    <label for="department">Department:</label>
    <input id="department" name="department" type="text"  maxlength="50"><br>
    
    <label for="store_name">Store:</label>
    <input id="store_name" name="store_name" type="text"  maxlength="50"><br>

    <button name="item_submitted" type="submit">Add Item</button>
    <button type="reset">Clear</button>
</form>

<form method="post">
    <p>Add a delivery truck to SCS Database:<p>
    
    <label for="truck_code">Truck Code:</label>
    <input id="truck_code" name="truck_code" maxlength="50">
    
    <button name="truck_submitted" type="submit">Add Truck</button>
    <button type="reset">Clear</button>
</form>

<form method="post">
    <p>Add a warehouse to SCS Database:<p>
    
    <label for="address">Warehouse address:</label>
    <input id="address" name="address" maxlength="200">
    
    <button name="warehouse_submitted" type="submit">Add warehouse</button>
    <button type="reset">Clear</button>
</form>