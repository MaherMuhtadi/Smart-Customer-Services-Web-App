<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include "layout.php";
$user = $_SESSION["user"];
?>

<html lang='en'>
<?php htmlHead(); ?>

<style>
    #idcard {
        position: absolute;
        z-index: 1;
        width: 30%;
        padding: 2rem;
        border: 1px solid rgb(63,65,71);
        border-radius: 1rem;
        background-color: rgb(43,45,49);
        transition: all 200ms;
    }
    #idcard:hover {
        transform: scale(1.1);
    }
    .info {
        width: 92%;
        border-radius: 1rem;
        margin-left: 8%;
        display: flex;
        align-items: center;
    }
</style>

<body>

    <?php menuBar(); ?>
    
    <main>
        <div id='idcard'>
            <h1>Welcome <?php echo $user["login_id"]."#".$user["user_id"]; ?>!</h1>
            Your current balance is <?php echo $user["balance"]; ?>
        </div>

        <div class='info'>
            <img src='https://www.scamwatch.gov.au/sites/www.scamwatch.gov.au/files/type-of-scam-images/online-shopping.png' alt='Online Shopping'>
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
    </main>

    <?php footer(); ?>

</body>
</html>