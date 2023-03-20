<?php
session_start();
include "layout.php";

function main() {
    $user = $_SESSION["user"];

    echo
        "<style>
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
            #info {
                width: 92%;
                border-radius: 1rem;
                margin-left: 8%;
                display: flex;
                align-items: center;
                font-size: 1.5rem;
            }
        </style>";
    echo "<main>";
    echo "<div id='idcard'><h1>Welcome ".$user["login_id"]."#".$user["user_id"]."!</h1>";
    echo "Your current balance is ".$user["balance"].".</div>";
    
    echo "<div id='info'><img src='https://www.scamwatch.gov.au/sites/www.scamwatch.gov.au/files/type-of-scam-images/online-shopping.png' alt='Online Shopping'>";
    echo "<div><h2>Why SCS?</h2>
            <p>Smart Customer Services (SCS) is an online system that aims to plan for smart green
            trips inside the city and its neighborhood for online shopping and then delivery to destinations
            of your choice. Considering traffic as a serious threat to the quality of life, the world has been
            looking for various solutions to decrease the stress, frustration, delays and terrible air
            pollutions being caused through it. SCS attempts to provide a smart green solution on this
            regard by providing online shopping services and then delivery of the purchased items from the
            selected warehouses to your doorsteps.</p></div></div>";
    echo "</main>";
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
else {
    echo "<html lang='en'>";
    htmlHead();
    echo "<body>";
    menuBar();
    main();
    footer();
    echo "</body></html>";
}
?>