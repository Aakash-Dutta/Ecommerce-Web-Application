<?php
include ('./../components/connect.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
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
    include ('./navbar.php');
    ?>

    <section>
        <div class="container mt-5 mb-4">
            <h2 class="mb-4">Placed Orders</h2>
            <div class="row">
                <?php
                $select_order = "SELECT * FROM orders ORDER BY id DESC";
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
                                        <p class="card-text">Payment status:
                                            <span <?php if ($fetch_order['payment_status'] == 'pending'): ?>
                                                    class="text-danger fw-semibold" <?php else: ?> class="text-success fw-semibold"
                                                <?php endif; ?>>
                                                <?= $fetch_order['payment_status']; ?>
                                            </span>
                                        </p>



                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>No orders placed yet!</p>';
                }
                ?>

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