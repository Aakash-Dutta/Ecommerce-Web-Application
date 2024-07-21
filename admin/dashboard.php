<?php
include './../components/connect.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location:admin_login.php");
}

$admin_id = $_SESSION['admin_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap & FontAwesome -->
    <?php
    include ("./../components/bootstrap_caller.php");
    ?>
</head>

<body>
    <?php
    include ("./../components/admin_header.php");
    ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Welcome Admin -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Welcome!
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $sql = "SELECT * FROM admins where id='$admin_id'";
                                    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                    echo $result['userName'];
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-crown fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Total Pendings -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="./pending_orders.php" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Pendings</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.
                                        <?php
                                        $total_pendings = 0;
                                        $select_pending = "SELECT * FROM orders WHERE payment_status='pending'";
                                        $select_pending = mysqli_query($conn, $select_pending);
                                        if (mysqli_num_rows($select_pending) > 0) {
                                            while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                                                $total_pendings += $fetch_pendings['total_price'];
                                            }
                                        }
                                        echo $total_pendings;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Completed Orders -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="./completed_orders.php" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Completed Orders</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.
                                        <?php
                                        $total_completed = 0;
                                        $select_completed = "SELECT * FROM orders WHERE payment_status='completed'";
                                        $select_completed = mysqli_query($conn, $select_completed);
                                        if (mysqli_num_rows($select_completed) > 0) {
                                            while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                                                $total_completed += $fetch_completed['total_price'];
                                            }
                                        }
                                        echo $total_completed;
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Order placed -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="./pending_orders.php" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $sql = "SELECT * FROM orders WHERE payment_status='pending'";
                                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-truck-fast fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Products Added -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a class="text-decoration-none" href="./products.php">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Products Added</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $sql = "SELECT * FROM products";
                                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-store fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $sql = "SELECT * FROM user";
                                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Admins -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Admin Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php

                                        $sql = "SELECT * FROM admins";
                                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- New Messages -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="./messages.php" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        New Messages</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php
                                        $sql = "SELECT * FROM messages";
                                        echo mysqli_num_rows(mysqli_query($conn, $sql));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </a>
        </div>


    </div>

    <?php
    include ("./../components/bootstrap_js.php")
        ?>
</body>

</html>