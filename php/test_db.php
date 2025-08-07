<?php
$connection = mysqli_connect("localhost", "root", "", "shop_db");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
