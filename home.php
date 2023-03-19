<?php
session_start();
include "layout.php";

function tempText() {
    echo "<main>";
    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt interdum mauris a ultrices. Integer ultricies mauris vel efficitur lobortis. Morbi sit amet commodo nunc. Vestibulum id mi id purus gravida vestibulum. Nunc rhoncus id neque eget egestas. Nullam rutrum ante turpis, vel tempor urna pellentesque vel. Aliquam erat volutpat.</p>";
    echo "<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce scelerisque purus interdum nulla auctor, in euismod ante hendrerit. Fusce in posuere nibh, nec euismod nisl. Nunc eget eleifend turpis, a mollis felis. Donec lorem urna, consectetur at lacinia congue, ultricies ac nisl. Integer eget volutpat ligula. Aenean dignissim sapien in metus fringilla, nec iaculis ex porttitor.</p>";
    echo "<p>Suspendisse sit amet metus quis justo aliquam dignissim. Duis eleifend blandit rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris augue orci, cursus lobortis malesuada ut, ultricies vitae erat. Donec pretium turpis felis, vel aliquam nulla euismod ut. Maecenas arcu est, mollis quis cursus ac, elementum non felis. Pellentesque neque est, aliquam non ex id, bibendum pellentesque quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Curabitur a lectus mauris. Ut ac justo lacus. Maecenas posuere sem libero, sit amet tempus lacus vestibulum vitae.</p>";
    echo "<p>Suspendisse potenti. Nam ultrices efficitur odio, eu euismod lorem cursus in. Donec pellentesque viverra justo ut congue. Pellentesque egestas eros ut elit convallis, sed varius purus vestibulum. Duis luctus maximus nisi eget ullamcorper. Aliquam erat volutpat. Duis nisl nulla, venenatis a tristique eget, pretium non metus. Mauris scelerisque justo et semper elementum. Integer quis auctor felis. Aenean molestie, diam in porttitor fringilla, metus sem congue nibh, pellentesque blandit velit est eu odio. Aliquam turpis risus, consequat a nisi non, mattis elementum risus. Vestibulum eget purus vitae libero sagittis euismod. Sed a libero vitae nulla varius semper. Praesent feugiat odio quis eros semper, vel bibendum libero venenatis.</p>";
    echo "<p>Phasellus nunc quam, pulvinar facilisis lectus tempus, dictum rhoncus dolor. Mauris egestas metus ac sapien eleifend, et porttitor est ullamcorper. Suspendisse suscipit mauris ut mollis dictum. Phasellus auctor massa ac lectus bibendum, pretium facilisis purus imperdiet. Vestibulum imperdiet mauris quam, nec venenatis libero tempus in. Fusce interdum tempus orci, sed sollicitudin ex pellentesque non. Sed cursus tortor a elit vestibulum consectetur. Nunc eu mauris vestibulum orci mollis ultrices. Donec sit amet erat nec velit faucibus vestibulum vitae sed sapien. Curabitur vehicula orci non turpis mattis malesuada. Morbi ornare erat in lacus accumsan, vitae porta urna facilisis. Nullam suscipit maximus turpis, ut posuere velit mollis vel. Phasellus accumsan vel justo nec consectetur. Donec mauris justo, dapibus ac tortor sed, tincidunt malesuada diam. Curabitur vitae aliquet magna. Vestibulum sed elit sapien.</p>";
    echo "</main>";
}

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
else {
    echo "<html lang='en'>";
    htmlHead();
    echo "<body>";
    menuBar();
    tempText();
    footer();
    echo "</body></html>";
}
?>