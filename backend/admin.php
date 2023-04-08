<?php


header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Max-Age: 3600');
 header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
include "connect.php";

// Processes user submission
if (isset($_POST["user_submitted"])) {
    unset($_POST["user_submitted"]);

    // creates a salted and secured password hash
    $salt = bin2hex(random_bytes(5)); // 10 chars
    $password_hash = md5($_POST["password"].$salt);

    $insert_user = 
        "INSERT INTO user (login_id, password_hash, salt, first_name, last_name, tel_no, email, address, admin)
            VALUES ('"
            .$_POST["login_id"]."', '"
            .$password_hash."', '"
            .$salt."', '"
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