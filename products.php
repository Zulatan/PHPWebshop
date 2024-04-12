<?php
// Start the session
session_start();

// Check if session is set
if(isset($_SESSION['status']) && $_SESSION['status'] == true) {
    // If the session is set, display welcome message and products
    require_once 'db_connection_test.php';

    # db conn
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );





    /*$getProductCategory = $conn->query("SELECT name, parent_id FROM products WHERE parent_id = NULL");
    if ($getProductCategory->num_rows > 0) {
        // output data of each row
        while($row = $getProductCategory->fetch_assoc()) {
            echo "<h3 style='margin: 0 0; padding: 5px 5px'>Product name:</h3>" . $row['name'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    */

    /*
     echo '<h1>Browse our products</h1>';


    $products = array(
        "Computers" => "product_computers",
        "PC" => "product1.php",
        "Laptop" => "product_laptops.php",
        "Phone" => "product3.php"
    );

    function generateMenu($products) {
        echo '<ul>';
        foreach ($products as $productName => $productUrl) {

            echo '<li><a href="' . $productUrl . '">' . $productName . '</a></li>';
        }
        echo '</ul>';
    }

    generateMenu($products);
     */

} else {
    // If the session is not set, prompt the user to login
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
    <title>Our products</title>
    <link rel="stylesheet" href="menu.css">
    <script src="https://kit.fontawesome.com/2f1765f590.js" crossorigin="anonymous"></script>
    <script src="menu.js" crossorigin="anonymous"></script>
</head>
<body>
<?php

echo "<p>Hi $username!</p>";


# Query for grabbing product categories
$queryMainProductCategory = "SELECT * FROM products WHERE id in (1,8)";
$querySubProductCategory = "Select * from products where parent_id = 1";
$getProductCategory = $conn->query($queryMainProductCategory);

echo "<ul>";
if ($getProductCategory->num_rows > 0) {
    // Output data of each row
    while($row = $getProductCategory->fetch_assoc()) {
        #echo "<li>" . $row['name'] . "</li>" ;
        echo "<div class='menu-container' style='display: flex; justify-content: space-between;'>";
        echo    "<nav>";
        echo        "<li class='dropdown' style='list-style-type: none'>";
                        # The head product Category
        echo            "<a href='product_pcs.php' style='text-decoration: none; color: #333; '>" . $row['name'] . "</a>";
        echo                "<ul>";
        echo                    "<li><a href='product_laptops.php'></a></li>";
        echo                    "<li><a href='product_stationary.php'></a></li>";
        echo                "</ul>";
        echo        "</li>";
        echo    "</nav>";
        echo "</div>";


    }
} else {
    echo "0 results";
}

echo "</ul>";

?>
    <div class="menu-container" style="display: flex; justify-content: space-between;">
        <nav> <!-- Navigation for buying stuff -->
            <ul id="nav1">
                <li class="dropdown">
                    <a href="#">Computer</a>
                    <ul class="dropdown-menu">
                        <li><a href="product_laptops.php"></a></li>
                        <li><a href="product_pcs.php">PC</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Phone</a>
                    <ul class="dropdown-menu">
                        <li><a href="product_laptops.php">iPhone</a></li>
                        <li><a href="product_pcs.php">Android</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <nav> <!-- Navigation for user stuff -->
            <ul id="nav2">
                <li><a href="user_profile.php"><i class='fa-solid fa-user'></i></a></li>
                <li><a href="user_cart.php"><i class='fa-solid fa-cart-shopping'></i></a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
