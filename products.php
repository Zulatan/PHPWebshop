<?php
// Start the session
session_start();

// Check if session "is set = "isset"" hvis ja - tillad connection til db og til info på website
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2f1765f590.js" crossorigin="anonymous"></script>
    <script src="menu.js" crossorigin="anonymous"></script>
    <style>
        body {
            padding: 40px 80px;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>


<div class="combined-menu">
    <?php
    echo "<p>Hi $username! 👋</p>";
    ?>
    <div class="user-menu">
        <nav>  <!-- Nav to User, Cart -->
            <ul>

                <li><a style=" color: #333333" href="user_profile.php"><i class='fa-solid fa-user'></i></a></li>
                <li><a style=" color: #333333" href="cart.php"><i class='fa-solid fa-cart-shopping'></i></a></li>
            </ul>
        </nav>
    </div>
</div>

<?php
echo "<h1>Browse our products</h1>"
?>
<ul class="product-menu">
    <?php
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



</body>
</html>
