<?php
    require_once "../includes/dbh.inc.php";

    $item_id = $_POST["item_id"];

    session_start();
    if (!isset($_SESSION["id"])) {
        // Check login or not -> not login
        echo json_encode(array('status' => false));
        exit();
    }

    $user_id = $_SESSION["id"];

    $sql = "DELETE FROM shopping_cart WHERE (cart_id, item_id) = (?, ?);";
    $stmt = mysqli_stmt_init($connect);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $user_id, $item_id);
    mysqli_stmt_execute($stmt);    
    mysqli_stmt_close($stmt);

    echo json_encode(array('status' => true));
?>