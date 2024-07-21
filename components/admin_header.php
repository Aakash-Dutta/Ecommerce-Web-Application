<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand mt-2 mt-lg-0" href="./../admin/dashboard.php">
                    AdminPanel
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./placed_orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./messages.php">Messages</a>
                    </li>
                </ul>
            </div>



            <div class="align-items-center">
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuAvatar"
                        role="button" aria-expanded="false" data-bs-target="#navbarDropdownMenuAvatar"
                        data-bs-toggle="dropdown">
                        <img src="./../images/avatar_admin.jpg" class="rounded-circle" height="25" alt="Profile" />
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="./../components/admin_logout.php"
                                onclick="return confirm('Logout from the website?')">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>