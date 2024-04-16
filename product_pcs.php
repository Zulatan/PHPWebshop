<?php
session_start();

// Check if session "is set = "isset"" hvis ja - tillad connection til db og til info på website
if(isset($_SESSION['status']) && $_SESSION['status'] == true) {
    require_once 'db_connection_test.php';

    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );

} else {
    echo "Please login to see our products!";
    echo '<a href="login2.php">Login</a>';
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC - Products</title>
</head>
<body>

<?php
# query for sub product category under PCs
$querySubProductCategory = "Select * from products where parent_id = 1";
$querySubProductCategory = $conn->query($querySubProductCategory);

if($querySubProductCategory-> num_rows > 0) {
    while ($row = $querySubProductCategory->fetch_assoc()) {
        echo $row['name'];
    }
} else {
    echo "0 results";
}
?>

</body>
</html>