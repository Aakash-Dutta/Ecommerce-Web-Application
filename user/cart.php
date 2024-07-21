<?php
include ('./../components/connect.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
}

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    $delete_item = "DELETE FROM cart WHERE id='$cart_id'";
    mysqli_query($conn, $delete_item);
}

if (isset($_GET['delete_all'])) {
    $delete_all_cart = "DELETE FROM cart WHERE user_id='$user_id'";
    mysqli_query($conn, $delete_all_cart);
    header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $update_query = "UPDATE cart SET quantity='$quantity' WHERE id='$cart_id'";
    mysqli_query($conn, $update_query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <?php
    include ('./../components/bootstrap_caller.php')
        ?>
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>
    <section class="cartitem mb-4 mt-5">
        <div class="container">
            <h1 class="mb-3">Shopping Cart</h1>
            <div class="row">
                <?php
                $grand_total = 0;
                $sql = "SELECT * FROM cart WHERE user_id='$user_id'";
                $status = mysqli_query($conn, $sql);
                if (mysqli_num_rows($status) > 0) {
                    while ($products = mysqli_fetch_assoc($status)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card text-center" style="width: 20rem">
                                <img src='./../uploaded_image/<?= $products["image"] ?>' class="object-fit-contain"
                                    height="200">

                                <div class="card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="cart_id" value="<?= $products['id'] ?>">

                                        <h5 class="card-title">
                                            <?= $products['name'] ?>
                                        </h5>
                                        <div class="row align-items-center mb-3">
                                            <div class="col">
                                                <p class="card-text text-danger">Rs.
                                                    <?= $products['price'] ?>
                                                </p>
                                            </div>
                                            <div class="col">

                                                <input type="number" name="quantity" min="1" max="99"
                                                    onkeypress="if(this.value.length ==2) return false;"
                                                    value="<?= $products['quantity'] ?>" class="form-control">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-warning" name="update_qty"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </div>
                                        <p class="card-text">Sub Total: <span class="text-danger">
                                                <?= $sub_total = ($products['price'] * $products['quantity']); ?>/-
                                            </span></p>
                                        <button type="submit" class="btn btn-danger" name="delete"
                                            onclick="return confirm('Delete this form cart?');">
                                            Delete Item
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <?php
                        $grand_total += $sub_total;
                    }
                } else {
                    echo '<p>Your cart is empty.</p>';
                }
                ?>
            </div>
            <div class="row mt-5">
                <div class="border shadow col-auto py-4">
                    <p>Grand Total: <span class="text-danger">Rs.
                            <?= $grand_total; ?>
                        </span></p>
                    <a href="./shop.php" class="btn btn-warning">Continue Shopping</a>
                    <a href="cart.php?delete_all" class="btn btn-danger <?= ($grand_total > 1) ? '' : 'disabled'; ?>"
                        onclick="return confirm('Delete all items form Cart?');">Delete all
                        Items</a>

                    <a href="./checkout.php" class="btn btn-primary <?= ($grand_total > 1) ? '' : 'disabled' ?>">Proceed
                        To
                        Checkout</a>
                </div>
            </div>
        </div>

    </section>

    <?php
    include ('./footer.php');
    ?>

    <?php
    include ('./../components/bootstrap_js.php');
    ?>
</body>

</html>