<?php
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );

    $id = $_GET['id'];
    mysqli_query($conn,"delete from `products` where id='$id'");
    header('location:admin.php');

?>
