<?php
include ('./../components/connect.php');

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include ('./../components/wishlist_cart.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quick view</title>
    <!-- Bootstrap & FontAwesome -->
    <?php
    include ("./../components/bootstrap_caller.php");
    ?>


</head>

<body>
    <!-- Navigation-->

    <?php
    include ("navbar.php");
    ?>
    <?php
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM products where id='$pid'";
    $status = mysqli_query($conn, $sql);
    if (mysqli_num_rows($status) > 0) {
        while ($products = mysqli_fetch_assoc($status)) {
            ?>
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="main_image ">
                                                <img src="./../uploaded_image/<?= $products['image_01'] ?>"
                                                    class="object-fit-contain" height="200">
                                            </div>
                                            <div class="row sub_image">
                                                <img src="./../uploaded_image/<?= $products['image_01'] ?>"
                                                    class="object-fit-contain col-sm-2  border border-dark-subtle mx-auto">
                                                <img src="./../uploaded_image/<?= $products['image_02'] ?>"
                                                    class="object-fit-contain col-sm-2  border border-dark-subtle">
                                                <img src="./../uploaded_image/<?= $products['image_03'] ?>"
                                                    class="object-fit-contain col-sm-2  border border-dark-subtle mx-auto">
                                            </div>


                                        </div>
                                        <div class="col p-5">
                                            <form action="" method="post" class="">
                                                <input type="hidden" name="pid" value="<?= $products['id'] ?>">
                                                <input type="hidden" name="name" value="<?= $products['name'] ?>">
                                                <input type="hidden" name="name" value="<?= $products['description'] ?>">
                                                <input type="hidden" name="price" value="<?= $products['price'] ?>">
                                                <input type="hidden" name="image" value="<?= $products['image_01'] ?>">
                                                <h2 class="card-title">
                                                    <?= $products['name'] ?>
                                                </h2>
                                                <h4 class="card-discription text-secondary">
                                                    <?= $products['description'] ?>
                                                </h4>
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-auto">
                                                        <p class="card-text text-danger">Rs.
                                                            <?= $products['price'] ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-3">

                                                        <input type="number" name="qty" min="1" max="40"
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>
    <?php
    include ("footer.php");
    ?>


    <script>
        let mainImage = document.querySelector('.main_image img');
        let subImage = document.querySelectorAll('.sub_image img');

        subImage.forEach(images => {
            images.onclick = () => {
                src = images.getAttribute('src');
                mainImage.src = src;
            }
        });
    </script>
    <?php
    include ('./../components/bootstrap_js.php');
    ?>
</body>

</html>