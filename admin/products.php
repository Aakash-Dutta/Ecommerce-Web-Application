<?php
include ('./../components/connect.php');
$err_message = '';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
}

if (isset($_POST['add_product'])) {
    $name = $_POST['product_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    #image handling
    $image_01 = $_FILES['image_01']['name'];
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = './../uploaded_image/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = './../uploaded_image/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = './../uploaded_image/' . $image_03;

    # insertion
    $sql = "SELECT * FROM products where name='$name'";
    if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
        $err_message = 'Product name already exist!';
    } else {
        $sql = "INSERT INTO products(name,description,price,image_01,image_02,image_03,category) VALUES
        ('$name','$description','$price','$image_01','$image_02','$image_03','$category')";
        if (mysqli_query($conn, $sql)) {
            if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
                $err_message = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                move_uploaded_file($image_tmp_name_02, $image_folder_02);
                move_uploaded_file($image_tmp_name_03, $image_folder_03);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <?php
    include ("./../components/bootstrap_caller.php")
        ?>
</head>

<body>
    <?php
    include ("./../components/admin_header.php");
    ?>
    <section class="add_prodcuts mb-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        required>
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
                                        rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" min="0" required>
                                </div>
                                <div class="error">
                                    <?php echo $err_message ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-2" name="add_product">Add
                                    Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="hr" />

    <section class="show_products mb-4">
        <div class="container">
            <?php
            $i = 0;
            $sql = "SELECT * FROM products";
            $status = mysqli_query($conn, $sql);
            if (mysqli_num_rows($status) > 0) {
                while ($products = mysqli_fetch_assoc($status)) {
                    if ($i % 4 == 0) {
                        echo '<div class="row">';
                    }
                    echo '<div class="col-md-3">';
                    echo '<div class="card shadow">';
                    echo '<img src="./../uploaded_image/' . $products["image_01"] . ' "class="card-img-top object-fit-contain" alt="..." height="200"> ';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $products["name"] . '</h5>';
                    echo '<p class="card-text text-truncate">' . $products["description"] . '</p>';
                    echo '<p class="card-text">Rs. ' . $products["price"] . '</p>';
                    echo '<a href="./update_product.php?update=' . $products['id'] . '" class="btn btn-warning me-3">Update</a>';
                    echo '<a href="./delete_product.php?delete=' . $products['id'] . '" class="btn btn-danger" onclick="return confirm(\'Delete this product?\')">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $i++;
                    if ($i % 4 == 0) {
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>

    </section>

    <?php
    include ("./../components/bootstrap_js.php");
    ?>
</body>

</html>