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
    <title>Document</title>
    <!-- Bootstrap & FontAwesome -->
    <?php
    include ("./../components/bootstrap_caller.php");
    ?>
</head>

<body>
    <?php
    include ('./navbar.php');
    ?>
    <div class="container mt-3">
        <form method="post" action="">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <input type="text" placeholder="Search here..." name="search"
                        class="form-control form-control-lg shadow" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary" name="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>

    <section>
        <div class="container my-5">
            <div class="row">
                <?php
                if (isset($_POST['submit'])) {
                    $search = $_POST['search'];
                    $sql = "SELECT * FROM products WHERE name LIKE '%{$search}%' OR category LIKE '%{$search}%'";
                    $status = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($status) > 0) {
                        ?>
                        <p class="mb-2">Searched Value:<span class="text-success fw-bold">
                                <?= $search ?>
                            </span>
                        </p>
                        <p class="mb-2">Result Found:<span class="text-success fw-bold">
                                <?= mysqli_num_rows($status) ?>
                            </span>
                        </p>
                        <?php
                        while ($products = mysqli_fetch_assoc($status)) {
                            ?>

                            <div class="col-md-4">
                                <div class="card text-center" style="width: 18rem">
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
                        echo '<p>No products found!</p>';
                    }
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