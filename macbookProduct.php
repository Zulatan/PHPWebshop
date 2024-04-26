<?php
session_start();

$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'PHPWebshop'
);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MacBooks</title>

    <script src="https://kit.fontawesome.com/2f1765f590.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="menu.css">
    <script src="menu.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 40px 80px;
            margin: 0;
        }
        a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: rgba(255, 170, 0, 1);
            color: #333;
            border: none;
            border-radius: 2px; /* Adjust the border radius to make it more square or rounded */
            cursor: pointer;
            transition: background-color 0.1s; /* Add transition effect */
            font-size: 14px;
        }
        a:hover {
            background-color: rgba(255, 170, 0, .85);
        }
    </style>
</head>
<body>


<!-- The Menu -->
<div class="combined-menu">
    <ul class="product-menu">
        <?php
        require_once "db_connection_test.php";
        // Connect to the database:
        $conn = mysqli_connect(
            'localhost',
            'root',
            'root',
            'PHPWebshop'
        );
        // Fetch main product categories
        $queryMainProductCategory = "SELECT * FROM products WHERE id IN (1, 8, 11)";
        $getProductCategory = $conn->query($queryMainProductCategory);

        if ($getProductCategory->num_rows > 0) {
            while ($mainCategory = $getProductCategory->fetch_assoc()) {
                // Output main category
                echo "<li><a href='handleCategoryNavigation.php?id=" . $mainCategory['id'] . "'>" . $mainCategory['name'] . "</a>";

                // Fetch sub-categories for the current main category
                $querySubProductCategory = "SELECT * FROM products WHERE parent_id = " . $mainCategory['id'];
                $getSubProductCategory = $conn->query($querySubProductCategory);

                if ($getSubProductCategory->num_rows > 0) {
                    echo "<ul>";
                    while ($subCategory = $getSubProductCategory->fetch_assoc()) {
                        // Output sub-category
                        echo "<li><a href='handleCategoryNavigation.php?id=" . $subCategory['id'] . "'>" . $subCategory['name'] . "</a>";

                        // Fetch sub-sub-categories for the current sub category
                        $querySecondLevelSubCategory = "SELECT * FROM products WHERE parent_id = " . $subCategory['id'];
                        $getSecondLevelSubCategory = $conn->query($querySecondLevelSubCategory);

                        // Output second level of sub-categories
                        if ($getSecondLevelSubCategory->num_rows > 0) {
                            echo "<ul>";
                            while ($secondLevelSubCategory = $getSecondLevelSubCategory->fetch_assoc()) {
                                echo "<li><a href='handleCategoryNavigation.php?id=" . $secondLevelSubCategory['id'] . "'>" . $secondLevelSubCategory['name'] . "</a></li>";
                            }
                            echo "</ul>";
                        }

                        echo "</li>";
                    }
                    echo "</ul>";
                }

                echo "</li>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </ul>
    <div class="user-menu">
        <nav>  <!-- Nav to User, Cart -->
            <ul>
                <a href='products.php'> < Back</a>
                <li><a style=" color: #333333" href="user_profile.php"><i class='fa-solid fa-user'></i></a></li>
                <li><a style=" color: #333333 " href="cart.php"><i class='fa-solid fa-cart-shopping'></i></a></li>
            </ul>
        </nav>
    </div>
</div>



<?php
echo "<h1>Browse our MacBooks</h1>";

// Retrieve data for macbooks products from the database
$queryMacBooks = "SELECT * FROM products WHERE parent_id = 4";
$getMacBooks = $conn->query($queryMacBooks);

// Check if there are any iPhone products
if ($getMacBooks->num_rows > 0) {
    // Display iPhone products
    while ($row = $getMacBooks->fetch_assoc()) { ?>

        <!-- Display product details -->

            <h2> <?php echo $row['name']?></h2>
            <p> <?php echo $row['description']?></p>
            <p> <?php echo $row['price'] ?>,- DKK </p>
            <img style="width: 150px; height: auto;" src="/product_images/<?php echo $row['image'] ?>">
        </div>

        <!-- Add to Cart form -->
        <form method="POST" action="cart.php?action=add?id=<?php echo $row['id']; ?>">
            <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
            <input type="number" name="quantity" value="1" min="1">
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] == true) : ?>
            <input type="submit" name="addToCart" value="Add to Cart">
            <?php else : ?>
            <p>Login to add to cart!</p>
            <a href="login2.php">Login</a>
            <?php endif; ?>
            <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
        </form>
<?php
    }
} else {
    // If no iPhone products found
    echo "No iPhone products available.";
}

// Close database connection
$conn->close();

?>



</body>
</html>


