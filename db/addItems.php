<?php
include "connect.php";
echo "Connected to database successfully.<br>";

// Processes item submission
if (isset($_POST["submitted"])) {
    unset($_POST["submitted"]);

    // Downloads file to the server if it is png or jpg
    $img = $_FILES["img"];
    $path = "../images/items/".$img["name"];
    $validExt = array("jpg", "png");
    $validMime = array("image/jpeg","image/png");
	$extension = end(explode(".", $img["name"]));
	if (in_array($img["type"], $validMime) && in_array($extension, $validExt)) {
        move_uploaded_file($img['tmp_name'], $path);
        $insert_item = 
            "INSERT INTO item (img_path, item_name, price, made_in, department, store_name)
                VALUES ('"
                .$path."', '"
                .$_POST["item_name"]."', '"
                .$_POST["price"]."', '"
                .$_POST["made_in"]."', '"
                .$_POST["department"]."', '"
                .$_POST["store_name"]."')";
        if (mysqli_query($connection, $insert_item)) {
            echo $_POST["item_name"]." added successfully.";
        }
        else {
            echo "Failed to add item.";
        }
	}
	else {
		echo "Invalid file!";
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

    <button name="submitted" type="submit">Add Item</button>
    <button type="reset">Clear</button>
</form>