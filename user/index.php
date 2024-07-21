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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Hamro Store</title>
  <link rel="stylesheet" href="./css/contact.css">
  <link rel="stylesheet" href="./css/footer.css">

  <!-- Bootstrap & FontAwesome -->
  <?php
  include ("./../components/bootstrap_caller.php");
  ?>
</head>

<body>

  <?php
  include ("navbar.php");
  ?>


  <div class="slider">
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="../images/slider1.jpg" class="d-block w-100 object-fit-cover" alt="..." height="600">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-white">Your one stop store</h5>
            <p class="text-white">Get all your products in one webiste.</p>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="../images/slider2.png" class="d-block w-100 object-fit-cover" alt="..." height="600">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-white">Best products</h5>
            <p class="text-white">Number one e commerce platform.</p>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>

    <!-- OUR Category -->
    <section class="show_categories mb-4 mt-5">
      <div class="container">
        <h1>Shop by Category</h1>
        <div class="row text-center mt-4">
          <div class="col border shadow me-3 p-3">
            <a href="category.php?category=Camera" class="text-decoration-none text-black">
              <img src="./../images/camera.png" width="200">
              <h5 class="mt-2 text-secondary">Camera</h5>
            </a>
          </div>

          <div class="col border shadow me-3 p-3">
            <a href="category.php?category=Watches" class="text-decoration-none text-black">
              <img src="./../images/wristwatch.png" width="200">
              <h5 class="mt-2 text-secondary">Watches</h5>
            </a>
          </div>
          <div class="col border shadow p-3">
            <a href="category.php?category=Phone" class="text-decoration-none text-black">
              <img src="./../images/smartphone.png" width="200">
              <h5 class="mt-2 text-secondary">Phone</h5>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="show_products mb-4 mt-5">
      <div class="container">
        <h1>Latest Products</h1>

        <div class="row">
          <?php
          $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 6";
          $status = mysqli_query($conn, $sql);
          if (mysqli_num_rows($status) > 0) {
            while ($products = mysqli_fetch_assoc($status)) {
              ?>
              <div class="col-md-4">
                <div class="card text-center mt-4" style="width: 18rem">
                  <img src="./../uploaded_image/<?= $products['image_01'] ?>" class="object-fit-contain" height="200">

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
                            onkeypress="if(this.value.length ==2) return false;" value="1" class="form-control">
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
          }
          ?>
        </div>
      </div>

    </section>

    <?php
    include ("footer.php");
    ?>



    <?php
    include ("./../components/bootstrap_js.php");
    ?>



</body>

</html>