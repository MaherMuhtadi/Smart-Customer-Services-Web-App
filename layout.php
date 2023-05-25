<?php
function htmlHead($page, $dir=".") {
    /**
     * Echoes the HTML head element of the website
     */
    $title = "Smart Customer Services";
    if ($page != "") {
        $title = "SCS | ".$page;
    }

    echo
        "<head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
            <meta charset='UTF-8'>
            <title>$title</title>

            <link rel='icon' href='$dir/images/icon.png'>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Electrolize'>
            <link rel='stylesheet' href='$dir/style.css'>
            <script src='https://code.jquery.com/jquery-3.6.4.min.js' integrity='sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=' crossorigin='anonymous'></script>
            <script src='$dir/shopCart.js'></script>
        </head>";
}

function menuBar() {
    /**
     * Echoes the header element of the webpage
     */
    $display = "style='display:none'";
    $class = "menu-item";
    $text = "Sign In";
    
    if (isset($_SESSION["user"])) {
        $class = "menu-item negative-button";
        $text = "Sign Out";
        if ($_SESSION["user"]["admin"]) {
            $display = "";
        }
    }

    echo
        "<header>
            <img style='width: 15%' src='images/logo.png' alt='logo'>

            <div id='menu-row'>
                <button class='menu-item' onclick=\"window.open('home.php', '_self')\">Home</button>
                <button class='menu-item' onclick=\"window.open('orders.php', '_self')\">My Orders</button>
                <button class='menu-item' onclick=\"window.open('reviews.php', '_self')\">Reviews</button>
                
                <div class='menu-item'>
                    <div id='dropdown'>
                        <button style='text-decoration:underline'>Shop</button>
                        <div id='dropdown-menu'>
                            <button style='border-radius:0' onclick=\"window.open('browse.php', '_self')\">Browse</button>
                            <button style='border-radius:0' onclick=\"window.open('cart.php', '_self')\">Cart</button>
                            <button style='border-top-right-radius:0;border-top-left-radius:0' onclick=\"window.open('delivery.php', '_self')\">Delivery</button>
                        </div>
                    </div>
                </div>

                <div $display class='menu-item'>
                    <div id='admin-dropdown'>
                        <button style='text-decoration:underline'>Maintain</button>
                        <div id='admin-dropdown-menu'>
                            <button style='border-radius:0' class='special-button' onclick=\"window.open('admin/insert.php')\">Insert</button>
                            <button style='border-radius:0' class='special-button' onclick=\"window.open('admin/search.php')\">Search</button>
                            <button style='border-radius:0' class='special-button' onclick=\"window.open('admin/edit.php')\">Edit</button>
                            <button style='border-top-right-radius:0;border-top-left-radius:0' class='negative-button' onclick=\"if (confirm('WARNING: You are about to reset the SCS database!')) {window.open('admin/reset.php')}\">Reset</button>
                        </div>
                    </div>
                </div>
                
                <button class='$class' onclick=\"window.open('login.php', '_self')\">$text</button>
            </div>
        </header>";
}

function footer() {
    /**
     * Echoes the footer element of the webpage
     */
    echo
        "<footer>
            Source code on <a href='https://github.com/MaherMuhtadi/Smart-Customer-Services-Web-App' target='_blank'>GitHub</a><br>
            &#169 <script>document.write((new Date).getFullYear())</script> Maher Muhtadi &amp; James Tan
        </footer>";
}
?>