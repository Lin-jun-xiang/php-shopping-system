<?php
    require_once "../includes/dbh.inc.php";
    require_once "../includes/cart.inc.php";
?>
<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="robots" content="index, follow">
        <meta name="description" content="">
        <meta name="author" content="Jimmy Lin">
        <title>Cart Page</title>

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/cart.css">
        <script src="../js/cart.js"></script>
        <!-- ajax request - jquery -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                            <div class="col align-self-center text-right text-muted">
                                <?php
                                    $cart_results = get_cart_list($connect);
                                    echo count($cart_results);
                                    $cartItem_info = get_cartItem_info($connect, $cart_results);
                                    $sum_price = 0;
                                    for ($i = 0; $i < count($cart_results); $i++) {
                                        $sum_price += $cartItem_info["cartItems_price"][$i]*$cart_results[$i]["quantity"];
                                    }
                                ?>
                                items
                            </div>
                        </div>
                    </div>
                    <?php
                        $i = 0;
                        while ($i < count($cart_results)) {
                            $item_quantity[] = $cart_results[$i]["quantity"];
                            $item_id[] = $cart_results[$i]["item_id"];
                            if ($i % 2 == 0) {
                                echo '<div class="row border-top border-bottom">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-fluid" src=',$cartItem_info["cartItems_picture"][$i],'></div>
                                    <div class="col">
                                        <div class="row text-muted"></div>
                                        <div class="row">',$cartItem_info["cartItems_name"][$i],'</div>
                                    </div>
                                    <div class="col">
                                        <input id=item-',$item_id[$i],'_num value=',$item_quantity[$i],' style="width:30%; height:20%;" onblur="javascript:changeItemNum(',$item_id[$i],',this.value, ',$sum_price,');">
                                    </div>
                                    <div class="col">$ <span id="item-',$item_id[$i],'_price">',$cartItem_info["cartItems_price"][$i]*$item_quantity[$i],'</span><a href=javascript:removeItem(',$item_id[$i],')><span class="close">&#10005;</span></a></div>
                                </div>
                            </div>';
                            }
                            else {
                                echo '<div class="row">
                                <div class="row main align-items-center">
                                    <div class="col-2"><img class="img-fluid" src=',$cartItem_info["cartItems_picture"][$i],'></div>
                                    <div class="col">
                                        <div class="row text-muted"></div>
                                        <div class="row">',$cartItem_info["cartItems_name"][$i],'</div>
                                    </div>
                                    <div class="col">
                                        <input id=item-',$item_id[$i],'_num value=',$item_quantity[$i],' style="width:30%; height:20%;" onblur="javascript:changeItemNum(',$item_id[$i],',this.value, ',$sum_price,');">
                                    </div>
                                    <div class="col">$ <span id="item-',$item_id[$i],'_price">',$cartItem_info["cartItems_price"][$i]*$item_quantity[$i],'</span><a href=javascript:removeItem(',$item_id[$i],')><span class="close">&#10005;</span></a></div>
                                </div>
                            </div>';
                            }
                            $i = $i + 1;
                        }
                    ?> 
                    <div class="back-to-shop"><a href="shopPage.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
                </div>
                <div class="col-md-4 summary">
                    <div><h5><b>Summary</b></h5></div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:0;"></div>
                        <div class="col text-right">$ <span id="sum_price"><?php echo $sum_price ?></span></div>
                    </div>
                    <form>
                        <p>SHIPPING</p>
                        <select><option class="text-muted">Standard-Delivery- $ 5</option></select>
                        <p>GIVE CODE</p>
                        <input id="code" placeholder="Enter your code">
                    </form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right">$ <span id="total_price"><?php echo $sum_price+5 ?></span></div>
                    </div>
                    <button class="btn">CHECKOUT</button>
                </div>
            </div>
        </div>
    </body>
</html>
