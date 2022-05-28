<?php
    require_once "../includes/dbh.inc.php";

    $item_id = $_POST["item_id"];
    $item_quantity = $_POST["item_quantity"];


    session_start();
    if (!isset($_SESSION["id"])) {
        // Check login or not -> not login
        echo json_encode(array('status' => false));
        exit();
    }

    $user_id = $_SESSION["id"];

    $sql = "UPDATE shopping_cart SET quantity = ?  WHERE (item_id, cart_id) = (?, ?);";
    $stmt = mysqli_stmt_init($connect);
    
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $item_quantity, $item_id, $user_id);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);

    $sql = "SELECT price FROM item WHERE item_id = ?;";
    $stmt = mysqli_stmt_init($connect);
    
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $item_id);
    mysqli_stmt_execute($stmt);

    echo json_encode(mysqli_fetch_assoc(mysqli_stmt_get_result($stmt)));

?>