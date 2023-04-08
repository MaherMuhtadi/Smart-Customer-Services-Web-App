<?php
session_start();
include "admin/connect.php";
include "layout.php";

// Sign the user out whenever the user comes to the login page and empty their cart
unset($_SESSION["user"]);
unset($_SESSION['shopping_cart']);

// If Sign Up button is clicked, add the user info to the database
if (isset($_POST["signup"])) {
    unset($_POST["signup"]);

    $user = ["login_id"=>$_POST["login_id_new"],
             "password"=>$_POST["password_new"],
             "first_name"=>$_POST["first_name"],
             "last_name"=>$_POST["last_name"],
             "tel_no"=>$_POST["tel_no"],
             "email"=>$_POST["email"],
             "address"=>$_POST["address"],
             "balance"=>0.00,
             "points"=>0,
             "free_delivery"=>0,
             "admin"=>0];
    
    // creates a salted and secured password hash
    $salt = bin2hex(random_bytes(5)); // 10 chars
    $password_hash = md5($_POST["password_new"].$salt);

    $insert_user = 
        "INSERT INTO user (login_id, password_hash, salt, first_name, last_name, tel_no, email, address)
            VALUES ('"
            .$user["login_id"]."', '"
            .$password_hash."', '"
            .$salt."', '"
            .$user["first_name"]."', '"
            .$user["last_name"]."', '"
            .$user["tel_no"]."', '"
            .$user["email"]."', '"
            .$user["address"]."')";
    mysqli_query($connection, $insert_user);

    $result = mysqli_query($connection, "SELECT user_id, email FROM user WHERE email = '".$user["email"]."'");
    
    if (mysqli_num_rows($result) > 0) {
        $user["user_id"] = mysqli_fetch_assoc($result)["user_id"];
        $_SESSION["user"] = $user;
        if ($_POST["previous_page"] != "") {
            header("Location: ".$_POST["previous_page"]);
            exit();
        }
        header("Location: home.php");
        exit();
    }
}

// If Sign In button is clicked, check if user info exists in the database
elseif (isset($_POST["signin"])) {
    unset($_POST["signin"]);
    
    // retrieve salt
    $salt_query = "SELECT salt, login_id FROM user WHERE login_id = '".$_POST["login_id"]."'";
    $salt_result = mysqli_query($connection, $salt_query);
    if (mysqli_num_rows($salt_result) > 0) {
        while ($salt_row = mysqli_fetch_assoc($salt_result)) {
            $password_hash = md5($_POST["password"].$salt_row["salt"]);

            $search_user = "SELECT * FROM user WHERE login_id = '".$_POST["login_id"]."' AND password_hash = '$password_hash'";
            $result = mysqli_query($connection, $search_user);
    
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $user = ["user_id"=>$row["user_id"],
                        "login_id"=>$row["login_id"],
                        "password"=>$_POST["password"],
                        "first_name"=>$row["first_name"],
                        "last_name"=>$row["last_name"],
                        "tel_no"=>$row["tel_no"],
                        "email"=>$row["email"],
                        "address"=>$row["address"],
                        "balance"=>$row["balance"],
                        "points"=>$row["points"],
                        "free_delivery"=>$row["free_delivery"],
                        "admin"=>$row["admin"]];
                $_SESSION["user"] = $user;
                if ($_POST["previous_page"] != "") {
                    header("Location: ".$_POST["previous_page"]);
                    exit();
                }
                header("Location: home.php");
                exit();
            }
        }
    }
}
?>

<html lang="en">
<?php htmlHead("Sign In"); ?>

<style>
    form {
        width: 40%;
        padding: 1rem;
        display: flex;
        flex-direction: column;
    }
    input {
        width: 60%;
    }
    #login_forms {
        display: flex;
        justify-content: space-between;
    }
    .input {
        display: flex;
        justify-content: space-between;
    }
</style>

<body>
    
    <header>
        <img style="width: 15%" src="images/logo.png" alt="logo">
        <div>
            <?php
                if (isset($_POST["previous_page"]) and $_POST["previous_page"] != "") {
                    echo "<button onclick=\"window.open('".$_POST["previous_page"]."', '_self')\">Back</button>";
                }
                elseif (isset($_SERVER['HTTP_REFERER']) and strpos($_SERVER['HTTP_REFERER'], "login.php") == false) {
                    echo "<button onclick=\"window.open('".$_SERVER['HTTP_REFERER']."', '_self')\">Back</button>";
                }
            ?>
            <button onclick="window.open('home.php', '_self')">Home</button>
        </div>
    </header>

    <main>
        <h1>Sign In to an Account</h1>

        <div id="login_forms">
            <form method="post">
                <h2>New user? Register below</h2>

                <div class="input">
                    <label for="login_id1">Username:</label>
                    <input id="login_id1" name="login_id_new" type="text" maxlength="50">
                </div>

                <div class="input">
                    <label for="password1">Password:</label>
                    <input id="password1" name="password_new" type="password" maxlength="50">
                </div>
                
                <div class="input">
                    <label for="first_name">First Name:</label>
                    <input id="first_name" name="first_name" type="text" maxlength="50">
                </div>
                
                <div class="input">
                    <label for="last_name">Last Name:</label>
                    <input id="last_name" name="last_name" type="text" maxlength="50">
                </div>
                
                <div class="input">
                    <label for="tel_no">Phone:</label>
                    <input id="tel_no" name="tel_no" type="tel" maxlength="12">
                </div>
                
                <div class="input">
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="email" maxlength="100">
                </div>

                <div class="input">
                    <label for="address">Address:</label>
                    <input id="address" name="address" type="text" maxlength="200">
                </div>

                <?php
                    if (isset($_POST["previous_page"])) {
                        echo "<input hidden name='previous_page' value='".$_POST["previous_page"]."'>";
                    }
                    else {
                        $previous = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
                        echo "<input hidden name='previous_page' value='".$previous."'>";
                    }
                ?>

                <div>
                    <button name="signup" type="submit">Sign Up</button>
                    <button class="negative-button" type="reset">Clear</button>
                </div>
            </form>

            <form method="post">
                <h2>Already have an account? Sign in below</h2>

                <div class="input">
                    <label for="login_id2">Username:</label>
                    <input id="login_id2" name="login_id" type="text" maxlength="50">
                </div>

                <div class="input">
                    <label for="password2">Password:</label>
                    <input id="password2" name="password" type="password" maxlength="50">
                </div>

                <?php
                    if (isset($_POST["previous_page"])) {
                        echo "<input hidden name='previous_page' value='".$_POST["previous_page"]."'>";
                    }
                    else {
                        $previous = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
                        echo "<input hidden name='previous_page' value='".$previous."'>";
                    }
                ?>

                <div>
                    <button name="signin" type="submit">Sign In</button>
                    <button class="negative-button" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </main>

    <?php footer(); ?>

</body>
</html>