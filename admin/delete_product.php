<?php
include ('./../components/connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $sql = "SELECT * FROM products WHERE id='$delete_id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    unlink("./../uploaded_image/" . $result['image_01']);
    unlink("./../uploaded_image/" . $result['image_02']);
    unlink("./../uploaded_image/" . $result['image_03']);

    //Delete form product list
    $delete = "DELETE FROM products WHERE id ='$delete_id'";
    mysqli_query($conn, $delete);

    // Delete from cart
    $delete = "DELETE FROM cart WHERE pid ='$delete_id'";
    mysqli_query($conn, $delete);

    // Delete from wishlist
    $delete = "DELETE FROM wishlist WHERE pid ='$delete_id'";
    mysqli_query($conn, $delete);

    header('location:products.php');
}
?>