<?php
session_start();
include "db/connect.php";
include "layout.php";

// Sign the user out whenever the user comes to the login page
unset($_SESSION["user_id"]);

// If Sign Up button is clicked, add the user info to the database
if (isset($_POST["signup"])) {
    unset($_POST["signup"]);
    $insert_user = 
        "INSERT INTO user (login_id, password, first_name, last_name, tel_no, email, address)
            VALUES ('"
            .$_POST["login_id_new"]."', '"
            .$_POST["password_new"]."', '"
            .$_POST["first_name"]."', '"
            .$_POST["last_name"]."', '"
            .$_POST["tel_no"]."', '"
            .$_POST["email"]."', '"
            .$_POST["address"]."')";
    mysqli_query($connection, $insert_user);
    $result = mysqli_query($connection, "SELECT user_id, email FROM user WHERE email = '".$_POST["email"]."'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $row["user_id"];
        header("Location: home.php");
        exit();
    }
}

// If Sign In button is clicked, check if user info exists in the database
elseif (isset($_POST["signin"])) {
    unset($_POST["signin"]);
    $search_user = "SELECT user_id, login_id, password FROM user WHERE login_id = '"
        .$_POST["login_id"]."'"
        ." AND password = "
        ."'".$_POST["password"]."'";
    $result = mysqli_query($connection, $search_user);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $row["user_id"];
        header("Location: home.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php htmlHead(); ?>

<style>
    form {
        width: 40%;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        row-gap: 0.5rem;
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