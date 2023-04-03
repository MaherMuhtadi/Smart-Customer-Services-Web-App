<?php
session_start();

include "layout.php";
?>
    
<html lang='en'>
<?php htmlHead("Contact Us"); ?>
    
<body>
    
    <?php menuBar(); ?>

    <main class='info'>
        <h1>Need help?</h1>
        Our team is here to assist you! Contact us at:
        <ul>
            <li>
                <h2>Maher Muhtadi</h2>
                <a href='mailto:mmuhtadi@torontomu.ca'>mmuhtadi@torontomu.ca</a>
            </li>
            <li>
                <h2>Edward Sword</h2>
                <a href='mailto:edward.sword@torontomu.ca'>edward.sword@torontomu.ca</a>
            </li>
            <li>
                <h2>Arshpreet Singh</h2>
                <a href='mailto:arshpreet.singh@torontomu.ca'>arshpreet.singh@torontomu.ca</a>
            </li>
            <li>
                <h2>James Tan</h2>
                <a href='mailto:russelljames.tan@torontomu.ca'>russelljames.tan@torontomu.ca</a>
            </li>
        </ul>
    </main>

    <?php footer(); ?>
    
</body>
</html>