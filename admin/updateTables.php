<?php
session_start();
if (!isset($_SESSION["user"]) or !$_SESSION["user"]["admin"]) {
    echo "<h1>Access Denied!</h1>";
    exit();
}

include "connect.php";
include "../layout.php";
?>

<?php htmlHead("Admin - Update", ".."); ?>

<style>
    form {
        line-height: 2.5rem;
    }
</style>

<body><main>
<?php
// Processing update request
if (isset($_POST["update"])) {
    unset($_POST["update"]);
    
    $table = $_POST["table"];
    $pkey = $_POST["pkey"];
    $value = $_POST["value"];
    
    $result = mysqli_query($connection, "SELECT * FROM $table WHERE $pkey='$value'");
    
    echo "<form onsubmit=\"return confirm('Are you sure you want to update this data?')\" method='post'>";
    echo "<h1>Updating '$table' data</h1>";
    foreach (mysqli_fetch_assoc($result) as $k=>$v) {
        if ($k == $pkey) {
            echo "<h2>$k: $v</h2>";
        }
        else {
            echo "<label for='$k'>$k: </label>";
            echo "<input type='text' id='$k' name='$k' value='$v'><br>";
        }
    }
    echo 
        "<input hidden type='text' name='table' value='$table'>
        <input hidden type='text' name='pkey' value='$pkey'>
        <input hidden type='text' name='value' value='$value'>

        <button type='submit' name='submit_update'>Update</button>";
    echo "</form";
}

// Processing delete request
if (isset($_POST["delete"])) {
    unset($_POST["delete"]);
    
    $table = $_POST["table"];
    $pkey = $_POST["pkey"];
    $value = $_POST["value"];
    
    mysqli_query($connection, "DELETE FROM $table WHERE $pkey='$value'");
    header("Location: edit.php");
    exit();
}

if (isset($_POST["submit_update"])) {
    unset($_POST["submit_update"]);

    $table = $_POST["table"];
    $pkey = $_POST["pkey"];
    $value = $_POST["value"];
    unset($_POST["table"]);
    unset($_POST["pkey"]);
    unset($_POST["value"]);

    $set = "";
    foreach($_POST as $k=>$v) {
        $set .= "$k = '$v', ";
    }
    $set = substr($set, 0, strlen($set)-2);

    mysqli_query($connection, "UPDATE $table SET $set WHERE $pkey = $value");
    header("Location: edit.php");
    exit();
}
?>
</main></body>