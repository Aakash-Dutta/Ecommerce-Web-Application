<?php

include './../components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header("location:./login.php");
}
;

if (isset($_POST['order'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address = $_POST['address'];
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = "SELECT * FROM `cart` WHERE user_id = '$user_id'";

    if (mysqli_num_rows(mysqli_query($conn, $check_cart)) > 0) {


        $insert_order = "INSERT INTO `orders`(user_id, name, phone, email, method, address, total_products, total_price) 
            VALUES('$user_id', '$name', '$phone', '$email', '$method', '$address', '$total_products', '$total_price')";
        mysqli_query($conn, $insert_order);

        $delete_cart = "DELETE FROM `cart` WHERE user_id = '$user_id'";
        mysqli_query($conn, $delete_cart);

        $message[] = 'order placed successfully!';
    } else {
        $message[] = 'your cart is empty';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout form</title>
    <!-- Bootstrap & FontAwesome -->
    <?php
    include ("./../components/bootstrap_caller.php");
    ?>
</head>

<body>
    <?php
    include ("navbar.php");
    ?>


    <div class="container mt-5 mb-4 justify-content-center align-items-center">

        <div class="card col-md-6 mx-auto">
            <div class="card-header">
                <h3>Place your order</h3>
                <h4 class="text-secondary">Please make sure you fill your form carefully.</h4>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="display-orders align-items-center">
                        <p>Your cart items:</p>
                        <?php
                        $grand_total = 0;
                        $cart_items[] = '';
                        $select_cart = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
                        $result = mysqli_query($conn, $select_cart);
                        if (mysqli_num_rows($result) > 0) {
                            while ($fetch_cart = mysqli_fetch_assoc($result)) {
                                $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                                $total_products = implode($cart_items);
                                $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                                ?>
                                <p class="text-secondary ms-3">
                                    <?= $fetch_cart['name']; ?> <span>(
                                        <?= '$' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quantity']; ?>)
                                    </span>
                                </p>
                                <?php
                            }
                        } else {
                            echo '<p class="empty">your cart is empty!</p>';
                        }
                        ?>
                        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                        <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
                        <div class="grand-total">Grand Total : <span class="text-success">Rs.
                                <?= $grand_total; ?>/-
                            </span></div>
                    </div>
                    <hr>


                    <div data-mdb-input-init class="form-outline">
                        <label class="form-label" for="form6Example1"> Name</label>
                        <input type="text" id="name" name="name" class="form-control" />

                    </div>


                    <!-- Text input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form6Example4">Address</label>
                        <input type="text" id="address" name="address" class="form-control" />

                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form6Example5">Email</label>
                        <input type="email" id="email" name="email" class="form-control" />

                    </div>

                    <!-- Number input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form6Example6">Phone</label>
                        <input type="number" id="phone" name="phone" class="form-control" />

                    </div>

                    <!-- select option -->
                    <div class="form-outline mb-4 form-lebel">
                        <div class="row align-items-center">
                            <div class="col-auto">

                                <label for="inlineFormSelectPref">Payment method: </label>
                            </div>
                            <div class="col-md-5">

                                <select data-mdb-select-init name="method" class="form-select">
                                    <option value="cash on delivery">Cash on delivery</option>
                                    <option value="credit card">Credit card</option>
                                    <option value="fonpay">Fonpay</option>
                                    <option value="eSewa">ESewa</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Submit button -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Submit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">You sure?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Your aacount will be debited after you click yes..
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary" name="order">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php
    include ("footer.php");
    ?>

    <?php
    include ("./../components/bootstrap_js.php");
    ?>

</body>

</html>