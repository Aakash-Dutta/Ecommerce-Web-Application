<?php

if (isset($_POST['add_to_wishlist'])) {
    if ($user_id == '') {
        header('location:login.php');
    } else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];

        // Check if item already in wishlist
        $sql_query = "SELECT * FROM wishlist where name='$name' AND user_id='$user_id'";
        $sql_result = mysqli_query($conn, $sql_query);

        // Check if item alreay in cart
        $sql_cart_query = "SELECT * FROM cart where name='$name' AND user_id='$user_id'";
        $sql_cart_result = mysqli_query($conn, $sql_cart_query);

        if (mysqli_num_rows($sql_result) > 0) {
            $err_message = 'Already added to wishlist';

        } elseif (mysqli_num_rows($sql_cart_result) > 0) {
            $err_message = 'Already added to cart!';

        } else {
            $insert_query = "INSERT INTO wishlist(user_id,pid,name,price,image) 
                VALUES('$user_id','$pid','$name','$price','$image')";
            mysqli_query($conn, $insert_query);
        }
    }
}

if (isset($_POST['add_to_cart'])) {

    if ($user_id == '') {
        header('location:login.php');
    } else {
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $quantity = $_POST['qty'];

        // Check if item already in cart
        $sql_query = "SELECT * FROM cart where name='$name' AND user_id='$user_id'";
        $sql_result = mysqli_query($conn, $sql_query);

        if (mysqli_num_rows($sql_result) > 0) {
            $err_message = 'Already added to cart';
        } else {

            // if item in wishlist remove it and then only add item
            $check_wishlist = "SELECT * FROM wishlist where name='$name' AND user_id='$user_id'";
            $check_wishlist = mysqli_query($conn, $check_wishlist);
            if (mysqli_num_rows($check_wishlist) > 0) {
                $delete_wishlist = "DELETE FROM wishlist where name='$name' AND user_id='$user_id'";
                mysqli_query($conn, $delete_wishlist);
            }

            $insert_query = "INSERT INTO cart(user_id,pid,name,price,quantity,image) 
                VALUES('$user_id','$pid','$name','$price','$quantity','$image')";
            mysqli_query($conn, $insert_query);
        }
    }
}
?>