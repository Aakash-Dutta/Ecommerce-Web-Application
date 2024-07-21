<?php
include ("./../components/connect.php");
$err_message = '';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
}
$admin_id = $_SESSION['admin_id'];


if (isset($_POST['update_product'])) {
    $pid = $_POST['pid'];
    $name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET name='$name', category='$category', price='$price', description='$description' where id='$pid'";
    mysqli_query($conn, $sql);

    $old_image_01 = $_POST['old_image_01'];
    $image_01 = $_FILES['image_01']['name'];
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = './../uploaded_image/' . $image_01;

    if (!empty($image_01)) {
        if ($image_size_01 > 2000000) {
            $err_message = 'Image 1 size is too large';
        } else {
            $sql = "UPDATE products SET image_01 ='$image_01' WHERE id=$pid";
            mysqli_query($conn, $sql);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            unlink('./../uploaded_image/' . $old_image_01);
        }
    }

    $old_image_02 = $_POST['old_image_02'];
    $image_02 = $_FILES['image_02']['name'];
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = './../uploaded_image/' . $image_02;

    if (!empty($image_02)) {
        if ($image_size_02 > 2000000) {
            $err_message = 'Image 2 size is too large';
        } else {
            $sql = "UPDATE products SET image_02 ='$image_02' WHERE id=$pid";
            mysqli_query($conn, $sql);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            unlink('./../uploaded_image/' . $old_image_02);
        }
    }

    $old_image_03 = $_POST['old_image_03'];
    $image_03 = $_FILES['image_03']['name'];
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = './../uploaded_image/' . $image_03;

    if (!empty($image_03)) {
        if ($image_size_03 > 2000000) {
            $err_message = 'Image 3 size is too large';
        } else {
            $sql = "UPDATE products SET image_03 ='$image_03' WHERE id=$pid";
            mysqli_query($conn, $sql);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            unlink('./../uploaded_image/' . $old_image_03);
        }
    }
    if ($err_message = '') {
        header("location:products.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <?php
    include ('./../components/bootstrap_caller.php');
    ?>
</head>

<body>
    <?php
    include ('./../components/admin_header.php');
    ?>

    <section class="update-product"></section>
    <?php
    $update_id = $_GET['update'];
    $sql = "SELECT * FROM products where id ='$update_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($product = mysqli_fetch_assoc($result)) {
            ?>

            <div class="container mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="container mb-3">
                                    <div class="row col-sm-3 main_image mx-auto" style="height: 15rem;">
                                        <img src="./../uploaded_image/<?= $product['image_01'] ?>" class="object-fit-contain">
                                    </div>
                                    <div class="row sub_image">
                                        <img src="./../uploaded_image/<?= $product['image_01'] ?>"
                                            class="object-fit-contain col-sm-2  border border-dark-subtle mx-auto">
                                        <img src="./../uploaded_image/<?= $product['image_02'] ?>"
                                            class="object-fit-contain col-sm-2  border border-dark-subtle">
                                        <img src="./../uploaded_image/<?= $product['image_03'] ?>"
                                            class="object-fit-contain col-sm-2  border border-dark-subtle mx-auto">
                                    </div>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="pid" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="old_image_01" value="<?= $product['image_01']; ?>">
                                    <input type="hidden" name="old_image_02" value="<?= $product['image_02']; ?>">
                                    <input type="hidden" name="old_image_03" value="<?= $product['image_03']; ?>">

                                    <div class="form-group">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="<?= $product['name'] ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-select" aria-label="Default select" name="category">
                                            <option selected>...</option>
                                            <option value="Phone">Phone</option>
                                            <option value="Camera">Camera</option>
                                            <option value="Watches">Watches</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_01">Image 1</label>
                                        <input class="form-control" type="file" name="image_01"
                                            accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_02">Image 2</label>
                                        <input class="form-control" type="file" name="image_02"
                                            accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_03">Image 3</label>
                                        <input class="form-control" type="file" name="image_03"
                                            accept="image/jpg, image/jpeg, image/png, image/webp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description"
                                            rows="3"><?php echo $product['description'] ?></textarea>
                                    </div>
                                    <div class=" form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="<?= $product['price'] ?>" min="0" required>
                                    </div>
                                    <div class="error">
                                        <?php
                                        echo $err_message;
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-2" name="update_product">Update
                                        Product</button>
                                    <a href="./products.php" class="btn btn-danger mt-2">Go Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
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