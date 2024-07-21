<?php
@include ("./../components/connect.php");
$err_message = '';
session_start();

if (isset ($_POST['submit'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $sql = "SELECT * FROM admins where userName='$username' && password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        # maintain session after successful login
        $_SESSION["admin_id"] = $admin["id"];
        header("location:dashboard.php");
    } else {
        $err_message = "User or Password doesn't match";
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php
    include ("./../components/bootstrap_caller.php");
    ?>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            Username: demo, Password: demo
                        </div>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="error">
                                <?php echo $err_message ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-2" name="submit">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Don't have an account? <a href="./admin_register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include ("./../components/bootstrap_js.php");
    ?>
</body>

</html>