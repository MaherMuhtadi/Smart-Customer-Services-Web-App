<?php
session_start();

include "admin/connect.php";
include "layout.php";

if (isset($_POST["claim"]) and isset($_SESSION["user"])) {
    unset($_POST["claim"]);
    
    $_SESSION["user"]["points"] -= 100;
    $_SESSION["user"]["free_delivery"] = 1;

    mysqli_query($connection, "UPDATE user SET points = ".$_SESSION["user"]["points"].", free_delivery = ".$_SESSION["user"]["free_delivery"]." WHERE user_id = ".$_SESSION["user"]["user_id"]);
}
?>

<html lang='en'>
<?php htmlHead(""); ?>

<style>
    .tiles {
        width: fit-content;
        position: absolute;
        right: 5%;
    }
    .info {
        width: 100%;
        border-radius: 1rem;
        display: flex;
        align-items: center;
    }
</style>

<body>

    <?php menuBar(); ?>
    
    <main>
        <?php
            if (isset($_SESSION["user"])) {
                $user = $_SESSION["user"];
                if (!$user["free_delivery"] and $user["points"] >= 100) {
                    echo 
                        "<form style='text-align:center' method='post'>
                            <button type='submit' name='claim' class='special-button'>Claim Free Delivery for Your Next Order</button>
                        </form>";
                }
            }
        ?>
        <div class='tiles'>
            <?php
                if (!isset($_SESSION["user"])) {
                    echo "<h1>Welcome Stranger!</h1>";
                }
                else {
                    $user = $_SESSION["user"];
                    if ($user["admin"]) {
                        echo "<div style='text-align:end'>Administrator</div>";
                    }
                    else {
                        echo "<div style='text-align:end'>User</div>";
                    }
                    echo "<h1>Welcome ".$user["login_id"]."#".$user["user_id"]."!</h1>";
                    echo "<p>Your current balance is ".$user["balance"]." CAD</p>";
                    echo "<p>You earned ".$user["points"]." Reward Points</p>";
                }
            ?>
        </div>

        <div class='info'>
            <img width="50%" src='images/home_art.png' alt='Online Shopping'>
            <div>
                <h1>Why SCS?</h1>
                <p>Smart Customer Services (SCS) is an online system that aims to plan for smart green
                trips inside the city and its neighborhood for online shopping and then delivery to destinations
                of your choice. Considering traffic as a serious threat to the quality of life, the world has been
                looking for various solutions to decrease the stress, frustration, delays and terrible air
                pollutions being caused through it. SCS attempts to provide a smart green solution on this
                regard by providing online shopping services and then delivery of the purchased items from the
                selected warehouses to your doorsteps.</p>
            </div>
        </div>

        <h2>Reward Points</h2>
        <p>SCS also has a rewards system in place for you! You can earn 1 Reward Point for every 
        dollar you spend with us! What can you do with your Reward Points? For just 100 Reward Points, 
        you can place your next order for no additional delivery charges! Make sure to claim you free
        delivery before your next purchase.</p>
    </main>

    <?php footer(); ?>

</body>
</html>