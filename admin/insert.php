<?php
session_start();
if (!isset($_SESSION["user"]) or !$_SESSION["user"]["admin"]) {
    echo "<h1>Access Denied!</h1>";
    exit();
}

include "connect.php";

// Processes user submission
if (isset($_POST["user_submitted"])) {
    unset($_POST["user_submitted"]);

    $insert_user = 
        "INSERT INTO user (login_id, password, first_name, last_name, tel_no, email, address, admin)
            VALUES ('"
            .$_POST["login_id"]."', '"
            .$_POST["password"]."', '"
            .$_POST["first_name"]."', '"
            .$_POST["last_name"]."', '"
            .$_POST["tel_no"]."', '"
            .$_POST["email"]."', '"
            .$_POST["address"]."', "
            .$_POST["admin"].")";
    if (mysqli_query($connection, $insert_user)) {
        echo $_POST["first_name"]." ".$_POST["last_name"]." added successfully as ".($_POST["admin"]?"an admin":"a user").".<br>";
    }
    else {
        echo "Failed to add ".$_POST["first_name"]." ".$_POST["last_name"].".<br>";
    }
}

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

<h1>Insert new data to SCS Database</h1>

<form onsubmit="return confirm('Are you sure you want to add this user?')" method="post">
    <h2>Add a user:</h2>

    <label for="login_id">Username:</label>
    <input type="text" id="login_id" name="login_id" maxlength="50"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" maxlength="50"><br>

    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" maxlength="50"><br>

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" maxlength="50"><br>

    <label for="tel_no">Phone:</label>
    <input type="tel" id="tel_no" name="tel_no" maxlength="12"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" maxlength="100"><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" maxlength="200"><br>
    
    <label for="admin">Privilege:</label>
    <select id="admin" name="admin">
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select><br>

    <button name="user_submitted" type="submit">Add User</button>
    <button type="reset">Clear</button>
</form>

<form onsubmit="return confirm('Are you sure you want to add this item?')" enctype='multipart/form-data' method='post'>
    <h2>Add an item:</h2>

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

<form onsubmit="return confirm('Are you sure you want to add this truck?')" method="post">
    <h2>Add a delivery truck:</h2>
    
    <label for="truck_code">Truck Code:</label>
    <input id="truck_code" name="truck_code" maxlength="50">
    
    <button name="truck_submitted" type="submit">Add Truck</button>
    <button type="reset">Clear</button>
</form>

<form onsubmit="return confirm('Are you sure you want to add this warehouse?')" method="post">
    <h2>Add a warehouse:</h2>
    
    <label for="address">Warehouse address:</label>
    <input id="address" name="address" maxlength="200">
    
    <button name="warehouse_submitted" type="submit">Add warehouse</button>
    <button type="reset">Clear</button>
</form>