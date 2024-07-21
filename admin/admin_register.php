<?php
include ("./../components/connect.php");

$err_message = '';

if (isset ($_POST['submit'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $email = $_POST['email'];
    $confirmPassword = sha1($_POST['confirm_password']);

    $check = "SELECT * FROM admins where userName='$username'";
    if (mysqli_num_rows(mysqli_query($conn, $check)) > 0) {
        $err_message = "USER ALREADY EXIST";
    } else {
        if ($password != $confirmPassword) {
            $err_message = "Confirm password not matched!";
        } else {

            $sql = "INSERT INTO admins(userName,email,password) VALUES
        ('$username','$email','$password')";
            mysqli_query($conn, $sql);
            header("location:./dashboard.php");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>

    <?php
    include ("./../components/bootstrap_caller.php");
    ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand " href="#">
                AdminPanel
            </a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" required>
                            </div>
                            <div class="error">
                                <?php echo $err_message ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Register</button>
                        </form>
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