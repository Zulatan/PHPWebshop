<?php

include "db_connection_test.php";

$productParentID = $_POST['productParentID'];
$productName = $_POST['productName'];
$productDesc = $_POST['productDesc'];
$productPrice = $_POST['productPrice'];
$productImagePath = $_POST['productImagePath'];

$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'PHPWebshop'
);

mysqli_query($conn, "insert into `products` (parent_id, name, description, price, image) values ('$productParentID','$productName', '$productDesc', '$productPrice', '$productImagePath')");
header('location:admin.php');

