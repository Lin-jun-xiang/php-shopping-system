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
    $user_email = $_SESSION["email"];

    # Check the item whether or exist in user cart
    $sql = "SELECT * FROM shopping_cart WHERE (item_id, cart_id) = (?, ?);";
    $stmt = mysqli_stmt_init($connect);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $item_id, $user_id);
    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    mysqli_stmt_close($stmt);

    # If the item not exist, then add into cart
    if (!$row) {
        $sql = "INSERT INTO shopping_cart (cart_id, item_id, email, quantity) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connect);
        mysqli_stmt_prepare($stmt, $sql);
        $quantity = "1";
        mysqli_stmt_bind_param($stmt, "ssss", $user_id, $item_id, $user_email, $quantity);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // return response
    echo json_encode(array('status' => true));
?>