<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tech Shop</title>
</head>
<body>
    <?php
        require_once 'db_connection_test.php';
    ?>
    <div class="hero">
        <p>Welcome <?php echo $username; ?>, to Tech Shop</p>
        <h2>Browse our products</h2>
    </div>

</body>
</html>