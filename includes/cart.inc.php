<?php
    function get_cart_list($connect) {
        session_start();
        $user_id = $_SESSION["id"];
        $sql = "SELECT * FROM shopping_cart WHERE cart_id = ?;";
        $stmt = mysqli_stmt_init($connect);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
    
        $cart_results = [];
        while ($row = mysqli_fetch_assoc($resultData)) {
            // array push
            $cart_results[] = $row;
        }
    
        // debug
        // echo '<script>console.log(',json_encode($cart_results),');</script>';
        mysqli_stmt_close($stmt);

        return $cart_results;
    }

    function get_cartItem_info($connect, $cart_results) {
        // get item info and calculate total price
        $item_id = [];
        foreach ($cart_results as $cart_result) {
            $item_id[] = $cart_result["item_id"];
        }

        $sql = "SELECT * FROM item WHERE item_id = ?;";
        $stmt = mysqli_stmt_init($connect);
        mysqli_stmt_prepare($stmt, $sql);

        $cartItems_price = [];
        $cartItems_picture = [];
        $cartItems_name = [];
        foreach ($item_id as $id) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($resultData);
            $cartItems_price[] = $row["price"];
            $cartItems_picture[] = $row["picture"];
            $cartItems_name[] = $row["name"];
        }

        // echo '<script>console.log(',json_encode($cartItems_name),');</script>';
        mysqli_stmt_close($stmt);

        $res = array(
            "cartItems_name" => $cartItems_name,
            "cartItems_picture" => $cartItems_picture,
            "cartItems_price" => $cartItems_price
        );

        return $res;
    }
?>