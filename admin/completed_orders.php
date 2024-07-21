<?php
include ('./../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header("location:admin_login.php");
}

if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    $update_payment = "UPDATE orders SET payment_status='$payment_status' WHERE id='$order_id'";
    mysqli_query($conn, $update_payment);
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = "DELETE FROM orders WHERE id='$delete_id'";
    mysqli_query($conn, $delete_order);
    header('location:placed_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>
    <?php
    include ('./../components/bootstrap_caller.php')
        ?>
</head>

<body>
    <?php
    include ('./../components/admin_header.php');
    ?>

    <section>
        <div class="container mt-5">
            <h2 class="mb-4">Completed Orders</h2>
            <div class="row">
                <?php
                $select_order = "SELECT * FROM orders WHERE payment_status='completed' ORDER BY id DESC";

                $result = mysqli_query($conn, $select_order);
                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_order = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-header">
                                    Placed On:
                                    <?= $fetch_order['placed_on'] ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Name: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['name'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Email: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['email'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Phone Number: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['phone'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Address: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['address'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Total Products: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['total_products'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Total Price: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['total_price'] ?>/-
                                        </span>
                                    </p>
                                    <p class="card-text">Method: <span class="text-primary fw-semibold">
                                            <?= $fetch_order['method'] ?>
                                        </span>
                                    </p>
                                    <form action="" method="post">
                                        <input type="hidden" name="order_id" value="<?= $fetch_order['id'] ?>">
                                        <select class="form-select mb-2" name="payment_status">
                                            <option selected disabled>
                                                <?= $fetch_order['payment_status'] ?>
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>No orders completed.</p>';
                }
                ?>

            </div>
        </div>
    </section>

    <?php
    include ('./../components/bootstrap_js.php');
    ?>
</body>

</html>