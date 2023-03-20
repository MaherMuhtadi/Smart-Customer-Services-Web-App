<?php
function htmlHead() {
    /**
     * Echoes the HTML head element of the website
     */
    echo
        "<head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
            <meta charset='UTF-8'>
            <title>Smart Customer Services</title>

            <link rel='icon' href='images/icon.png'>
            <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Electrolize'>
            <link rel='stylesheet' href='style.css'>
        </head>";
}

function menuBar() {
    /**
     * Echoes the header element of the webpage
     */
    echo
        "<header>
            <img style='width: 15%' src='images/logo.png' alt='logo'>

            <button class='menu-item' onclick=\"window.open('home.php', '_self')\">Home</button>
            <button class='menu-item' onclick=\"window.open('about.php', '_self')\">About us</button>
            <button class='menu-item' onclick=\"window.open('contact.php', '_self')\">Contact us</button>
            <button class='menu-item' onclick=\"window.open('reviews.php', '_self')\">Reviews</button>
            <button class='menu-item' onclick=\"window.open('services.php', '_self')\">Types of Services</button>
            <button class='menu-item' onclick=\"window.open('cart.php', '_self')\">Shopping Cart</button>
            <button class='menu-item negative-button' onclick=\"window.open('login.php', '_self')\">Sign Out</button>
        </header>";
}

function footer() {
    /**
     * Echoes the footer element of the webpage
     */
    echo
        "<footer>
            <div class='footer-item'>
                Our Team:
                <ul>
                    <li>Maher Muhtadi</li>
                    <li>Edward Sword</li>
                    <li>Arshpreet Singh</li>
                    <li>James Tan</li>
                </ul>
            </div>
            
            <div class='footer-item'>
                Contacts:
                <ul>
                    <li>mmuhtadi@torontomu.ca</li>
                    <li>edward.sword@torontomu.ca</li>
                    <li>arshpreet.singh@torontomu.ca</li>
                    <li>russelljames.tan@torontomu.ca</li>
                </ul>
            </div>
        </footer>";
}
?>