<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand mt-2 mt-lg-0" href="./index.php">
                    HamroStore
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./../user/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./aboutus.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../user/orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../user/shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../user/contact.php">Contact</a>
                    </li>
                </ul>
            </div>


            <?php
            //count cart items 
            $cart_item = "SELECT * FROM cart";
            $cart_count = mysqli_num_rows(mysqli_query($conn, $cart_item));


            //count wishlist items 
            $wishlist_item = "SELECT * FROM wishlist";
            $wishlist_count = mysqli_num_rows(mysqli_query($conn, $wishlist_item));
            ?>

            <div class="align-items-center">
                <a href="./search.php" class="text-reset m-2"> <i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="./cart.php" class="text-decoration-none text-black"><i class="fa-solid fa-cart-shopping"></i>
                    Cart</a>
                <span class="badge bg-dark text-white ms-1 rounded-pill m-2">
                    <?= $cart_count ?>
                </span>
                <a href="./wishlist.php" class="text-decoration-none text-black"><i class="fa-solid fa-heart"></i>
                    Wishlist</a>
                <span class="badge bg-dark text-white ms-1 rounded-pill m-2">
                    <?= $wishlist_count ?>
                </span>

                <a href="login.php" class="text-reset m-2"><i class="fa-solid fa-right-to-bracket"></i></a>


            </div>
        </div>
    </nav>
</header>