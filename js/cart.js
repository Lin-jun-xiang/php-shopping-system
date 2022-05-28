function addCart(item_id) {
    let url = "../php/addCart.php";
    let data = {"item_id" : item_id};

    // ajax request php script for add data to cart
    // success/error function -> callback function
    $.ajax ({
        url: url,
        method: "POST",
        dataType: "json",
        data: data,
        success:function(response) {
            if (response['status']) {
                alert('Add successfully');
                window.location = 'shopPage.php';
            }
            else {
                alert('Login first');
                window.location = 'login.php';
            }
        },
        error:function(){alert('Add wrong when ajax request');},
    });
}

function changeItemNum(item_id, item_quantity, sum_price) {
    let url = "../php/changeItemNum.php";
    let data = {"item_id" : item_id, "item_quantity" : item_quantity};

    $.ajax ({
        url: url,
        method: "POST",
        dataType: "json",
        data: data,
        success:function(response) {
            // ajax update item_price according to numbers
            $('#item-'+item_id+'_price').html(response["price"]*$('#item-'+item_id+'_num').val());

            // ajax update sum_price
            sum_price += response["price"]*($('#item-'+item_id+'_num').val()-1);
            $('#sum_price').html(sum_price);

            $('#total_price').html(sum_price+5);
        },
        error:function(){alert('Change wrong when ajax request');},
    });
}

function removeItem(item_id) {
    let url = "../php/removeItem.php";
    let data = {"item_id" : item_id};

    $.ajax ({
        url: url,
        method: "POST",
        dataType: "json",
        data: data,
        success:function(response) {
            if (response['status']) {
                alert('Remove successfully');
                window.location = 'cart.php';
            }
            else {
                alert('Login first');
                window.location = 'login.php';
            }
        },
        error:function(){alert('Change wrong when ajax request');},
    })
}