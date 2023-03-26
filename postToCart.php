<?php
session_start();

if ($_POST['cart_action'] == 'add') {
    $item = $_POST['item_n'];
    $item_cost = $_POST['item_c'];
    if (isset($_SESSION['shopping_cart']['items'][$item])) {
        ++$_SESSION['shopping_cart']['items'][$item];
    }
    else {
        $_SESSION['shopping_cart']['items'][$item] = 1;
    }
    $_SESSION['shopping_cart']["total_cost"] = $_SESSION['shopping_cart']["total_cost"] + $item_cost;
}
    
elseif ($_POST['cart_action'] == 'clear') {
    $_SESSION['shopping_cart'] = ["items"=>[],"total_cost" => 0];
}

elseif ($_POST['cart_action'] == 'get_contents') {
    echo json_encode($_SESSION['shopping_cart']);
}
?>