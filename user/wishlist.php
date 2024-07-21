<?php
include ('./../components/connect.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
}

include ('./../components/wishlist_cart.php');

// remove instance of item from wishlist
if (isset($_POST['delete'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $delete_item = "DELETE FROM wishlist where id='$wishlist_id' ";
    mysqli_query($conn, $delete_item);
}

// remove all instances associated with user
if (isset($_POST['delete_all'])) {
    $delete_item = "DELETE FROM wishlist where user_id='$user_id' ";
    mysqli_query($conn, $delete_item);
    header('location:wishlist.php');
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <?php
    include ('./../components/bootstrap_caller.php')
        ?>
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>

    <section class="show_products mb-4 mt-5">
        <div class="container">
            <h1 class="mt-5 mb-4">Your Wishlist</h1>

            <div class="row">
                <?php
                $grand_total = 0;
                $sql = "SELECT * FROM wishlist WHERE user_id='$user_id'";
                $status = mysqli_query($conn, $sql);
                if (mysqli_num_rows($status) > 0) {
                    while ($products = mysqli_fetch_assoc($status)) {
                        $grand_total += $products['price'];
                        ?>
                        <div class="col-md-4">
                            <div class="card text-center shadow" style="width: 18rem">
                                <img src="./../uploaded_image/<?= $products['image'] ?>" class="object-fit-contain"
                                    height="200">

                                <div class="card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="pid" value="<?= $products['pid'] ?>">
                                        <input type="hidden" name="wishlist_id" value="<?= $products['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $products['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $products['price'] ?>">
                                        <input type="hidden" name="image" value="<?= $products['image'] ?>">

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

                                                <input type="number" name="qty" min="1" max="99"
                                                    onkeypress="if(this.value.length ==2) return false;" value="1"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <a class="btn btn-info" href="#"><i class="fa-solid fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary" name="add_to_cart">
                                            <i class="fa-solid fa-shopping-cart"></i>
                                        </button>
                                        <button type="submit" class="btn btn-danger" name="delete"
                                            onclick="return confirm('Delete this form wishlist?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo '<p>Your wishlist is empty</p>';
                }
                ?>
            </div>

            <div class="row mt-5">
                <div class="border shadow col-auto py-4">
                    <p>Grand Total: <span class="text-danger">Rs.
                            <?= $grand_total; ?>
                        </span></p>
                    <a href="./shop.php" class="btn btn-warning">Continue Shopping</a>
                    <a href="wishlist.php?delete_all"
                        class="btn btn-danger <?= ($grand_total > 1) ? '' : 'disabled'; ?>"
                        onclick="return confirm('Delete all items form Wishlist?');">Delete all
                        Items</a>
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