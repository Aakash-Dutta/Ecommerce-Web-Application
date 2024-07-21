<?php
include ('./../components/connect.php');

session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_msg = "DELETE FROM messages WHERE id='$delete_id'";
    mysqli_query($conn, $delete_msg);
    header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <?php
    include ('./../components/bootstrap_caller.php')
        ?>
</head>

<body>
    <?php
    include ('./../components/admin_header.php');
    ?>

    <section>
        <div class="container mt-5">
            <h2 class="mb-4">Messages</h2>
            <div class="row">
                <?php
                $select_message = "SELECT * FROM messages ORDER BY id DESC";
                $result = mysqli_query($conn, $select_message);
                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_message = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-header">
                                    User ID:
                                    <?= $fetch_message['user_id'] ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Name: <span class="text-primary">
                                            <?= $fetch_message['fullname'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Email: <span class="">
                                            <?= $fetch_message['email'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Phone Number: <span class="">
                                            <?= $fetch_message['number'] ?>
                                        </span>
                                    </p>
                                    <p class="card-text">Message: <span class="">
                                            <?= $fetch_message['message'] ?>
                                        </span>
                                    </p>
                                    <a href="messages.php?delete=<?= $fetch_message['id'] ?>" class="btn btn-danger"
                                        onclick="return confirm('Delete this message?');">Delete</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>You have no messages</p>';
                }
                ?>

            </div>
        </div>
    </section>

    <?php
    include ('./../components/bootstrap_js.php');
    ?>
</body>

</html>