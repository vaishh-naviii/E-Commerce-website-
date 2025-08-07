<?php
header('Content-Type: application/json');
include 'config.php';

// Fetch products from the database
$sql = "SELECT id, name, price, image FROM products";
$result = mysqli_query($conn, $sql);

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
?>