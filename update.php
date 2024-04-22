<?php
    include('db_connection_test.php');
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );

    $id = $_GET['id'];

    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];

    mysqli_query($conn,"update `products` set name='$productName', description='$productDescription', price='$productPrice' where id='$id'");
    header('location:admin.php');

