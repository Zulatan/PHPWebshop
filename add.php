<?php

include "db_connection_test.php";

$productParentID = $_POST['productParentID'];
$productName = $_POST['productName'];
$productDesc = $_POST['productDesc'];
$productPrice = $_POST['productPrice'];

$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'PHPWebshop'
);

mysqli_query($conn, "insert into `products` (id, name, description, price) values ('$productParentID','$productName', '$productDesc', '$productPrice')");
header('location:admin.php');

