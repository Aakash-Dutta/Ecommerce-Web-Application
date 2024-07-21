<?php
include ('./../components/connect.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
include './../components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
            <h1>
                <?= $_GET['category'] ?>
            </h1>
            <div class="text-end">
                Shop By Category:
                <a href="shop.php" class="text-decoration-none text-info-emphasis">All <i
                        class="fa-solid fa-reply-all"></i></a>
                <a href="category.php?category=Camera" class="text-decoration-none text-info-emphasis">Camera <i
                        class="fa-solid fa-camera"></i></a>
                <div class="vr"></div>
                <a href="category.php?category=Phone" class="text-decoration-none text-info-emphasis">Phone <i
                        class="fa-solid fa-mobile"></i></a>
                <div class="vr"></div>
                <a href="category.php?category=Watches" class="text-decoration-none text-info-emphasis">Watches <i
                        class="fa-solid fa-clock"></i>
                </a>
            </div>

            <div class="row">
                <?php
                $category = $_GET['category'];
                $sql = "SELECT * FROM products WHERE category='$category'";
                $status = mysqli_query($conn, $sql);
                if (mysqli_num_rows($status) > 0) {
                    while ($products = mysqli_fetch_assoc($status)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card text-center mt-4" style="width: 18rem">
                                <img src="./../uploaded_image/<?= $products['image_01'] ?>" class="object-fit-contain"
                                    height="200">

                                <div class="card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="pid" value="<?= $products['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $products['name'] ?>">
                                        <input type="hidden" name="price" value="<?= $products['price'] ?>">
                                        <input type="hidden" name="image" value="<?= $products['image_01'] ?>">

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
                                        <a href="./quickView.php?pid=<?= $products['id']; ?>" class="btn btn-danger"><i
                                                class="fa-solid fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary" name="add_to_cart"><i
                                                class="fa-solid fa-cart-shopping"></i> </button>
                                        <button type="submit" class="btn btn-warning" name="add_to_wishlist"><i
                                                class="fa-solid fa-heart"></i></button>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo '<p>No products found</p>';
                }
                ?>
            </div>
        </div>

    </section>

    <?php
    include ('./footer.php');
    ?>

    <?php
    include ('./../components/bootstrap_js.php')
        ?>
</body>

</html>