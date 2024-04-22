<?php
    include('db_connection_test.php');
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );
    $id=$_GET['id'];
    $query=mysqli_query($conn,"select * from `products` where id='$id'");
    $row=mysqli_fetch_array($query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <h2>Edit product with id: <?php echo $id ?></h2>
    <form method="POST" action="update.php?id=<?php echo $id; ?>">
        <label>New product name:</label><input type="text" value="<?php echo $row['name']; ?>" name="productName">
        <label>New product description:</label><input type="text" value="<?php echo $row['description']; ?>" name="productDescription">
        <label>New product price:</label><input type="text" value="<?php echo $row['price']; ?>" name="productPrice">
        <input type="submit" name="submit">
        <a href="products.php">Back</a>
    </form>
</body>
</html>