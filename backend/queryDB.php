<?php
 session_start();
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Max-Age: 3600');
 header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
include "connect.php";

//var_dump($_POST);
if (isset($_POST['is_logged_in'])){
    if (isset($_SESSION['user'])){
        echo json_encode(TRUE);
    } 
    else {
        echo json_encode(FALSE);

    }
}
elseif (isset($_POST['get_userData'])) {
    if (isset($_SESSION['user'])){
        echo json_encode($_SESSION['user']);

    }   
    else {
        echo FALSE;
    }
}
elseif (isset($_POST["signup"])) {
    unset($_POST["signup"]);

    $user = ["login_id"=>$_POST["login_id_new"],
             "password"=>$_POST["password_new"],
             "first_name"=>$_POST["first_name"],
             "last_name"=>$_POST["last_name"],
             "tel_no"=>$_POST["tel_no"],
             "email"=>$_POST["email"],
             "address"=>$_POST["address"],
             "balance"=>0.00];

    $insert_user = 
        "INSERT INTO user (login_id, password, first_name, last_name, tel_no, email, address)
            VALUES ('"
            .$user["login_id"]."', '"
            .$user["password"]."', '"
            .$user["first_name"]."', '"
            .$user["last_name"]."', '"
            .$user["tel_no"]."', '"
            .$user["email"]."', '"
            .$user["address"]."')";
    mysqli_query($connection, $insert_user);

    $result = mysqli_query($connection, "SELECT user_id, email FROM user WHERE email = '".$user["email"]."'");
    
    if (mysqli_num_rows($result) > 0) {
        $user["user_id"] = mysqli_fetch_assoc($result)["user_id"];
        $_SESSION["user"] = $user;
        echo json_encode($_SESSION['user']);
    }
}
elseif (isset($_POST["signin"])) {
    unset($_POST["signin"]);
    
    $search_user = "SELECT user_id, login_id, password, first_name, last_name, tel_no, email, address, balance
        FROM user WHERE login_id = '"
        .$_POST["login_id"]."'"
        ." AND password = "
        ."'".$_POST["password"]."'";
    $result = mysqli_query($connection, $search_user);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user = ["user_id"=>$row["user_id"],
                 "login_id"=>$row["login_id"],
                 "password"=>$row["password"],
                 "first_name"=>$row["first_name"],
                 "last_name"=>$row["last_name"],
                 "tel_no"=>$row["tel_no"],
                 "email"=>$row["email"],
                 "address"=>$row["address"],
                 "balance"=>$row["balance"]];
        $_SESSION["user"] = $user;
        echo json_encode($_SESSION["user"]);
    }
    else{
        echo json_encode(FALSE);
    }
}
elseif(isset($_POST['get_data'])){
    if ($_POST['get_data'] == 'items'){
        $result = mysqli_query($connection, "SELECT * FROM item");
        if (mysqli_num_rows($result)>0){
            echo json_encode(mysqli_fetch_all($result));
        }
    }
}

?>