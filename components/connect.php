<?php

# connection - using 
$conn = mysqli_connect('localhost', 'root', '', 'shop_db');

if (!$conn) {
    die ("Connection Failed: " . mysqli_connect_errno());
}

?>