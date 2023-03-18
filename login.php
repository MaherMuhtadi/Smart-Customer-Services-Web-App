<?php include "connect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <title>Smart Customer Services</title>

    <link rel="icon" href="images/icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize">
    <link rel="stylesheet" href="style.css">

    <style>
        form {
            width: 50%;
        }
        #login_forms {
            display: flex;
        }
    </style>
</head>

<body>
    
    <header>
        <img class="menu-item" src="images/logo.png" alt="logo">
    </header>

    <main>
        <h1>Sign In to an Account</h1>

        <div id="login_forms">
            <form method="post">
                <h2>New user? Register below</h2>

                <label for="login_id1">Username:</label>
                <input id="login_id1" name="login_id" type="text">

                <label for="password1">Password:</label>
                <input id="password1" name="password" type="password">
                
                <label for="first_name">First Name:</label>
                <input id="first_name" name="first_name" type="text">
                
                <label for="last_name">Last Name:</label>
                <input id="last_name" name="last_name" type="text">
                
                <label for="tel_no">Phone:</label>
                <input id="tel_no" name="tel_no" type="tel">
                
                <label for="email">Email:</label>
                <input id="email" name="email" type="email">

                <label for="address">Address:</label>
                <input id="address" name="address" type="text">

                <button name="signup" type="submit">Sign Up</button>
                <button type="reset">Clear</button>
            </form>

            <form method="post">
                <h2>Already have an account? Sign in below</h2>

                <label for="login_id2">Username:</label>
                <input id="login_id2" name="login_id" type="text">

                <label for="password2">Password:</label>
                <input id="password2" name="password" type="password">

                <button name="signin" type="submit">Sign In</button>
                <button type="reset">Clear</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="footer-item">
            Our Team:
            <ul>
                <li>Maher Muhtadi</li>
                <li>Edward Sword</li>
                <li>Arshpreet Singh</li>
                <li>James Tan</li>
            </ul>
        </div>
        
        <div class="footer-item">
            Contacts:
            <ul>
                <li>mmuhtadi@torontomu.ca</li>
                <li>edward.sword@torontomu.ca</li>
                <li>arshpreet.singh@torontomu.ca</li>
                <li>russelljames.tan@torontomu.ca</li>
            </ul>
        </div>
    </footer>

</body>

</html>