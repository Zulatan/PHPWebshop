<?php
session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] == true) {
    require_once 'db_connection_test.php';

    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );

    # menu
    echo "<a href='products.php'>Home</a>";

    $products = array(
        "PC" => "product1.php",
        "Laptop" => "product_laptops.php",
        "Phone" => "product3.php",
    );

    function generateMenu($products) {
        echo '<ul>';
        foreach ($products as $productName => $productUrl) {

            echo '<li><a href="' . $productUrl . '">' . $productName . '</a></li>';
        }
        echo '</ul>';
    }

    generateMenu($products);

    echo "<h1>Laptops</h1>";

    #$getMainProducts = $conn->query("SELECT * FROM products where id = 3");
    #$getSubProducts = $conn->query("SELECT * FROM products where parent_id = 3");
    $getProducts = $conn->query("select * from products where parent_id = 3");

   /* Dont know if needed?
   if ($row = $getMainProducts->num_rows > 0) {
        // output data of each row
        while($row = $getMainProducts->fetch_assoc()) {
            echo $row["name"] . ":" . "<br>";
        }
    } else {
        echo "0 results";
    }

    if($row = $getSubProducts->num_rows > 0) {
        while($row = $getSubProducts->fetch_assoc()) {
            echo $row["name"] . "<br>";
        }
    }
   */
    if($row = $getProducts->num_rows > 0) {
        while($row = $getProducts->fetch_assoc()) {
            echo "Product number:" . " " . $row["id"] . "<br>" . $row["name"] . "<br>";
        }
    }


    $conn->close();



} else {
    # if user is not logged in
    echo "Please login to see our products!";
    echo '<a href="login2.php">Login now</a>';
}
