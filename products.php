<?php
// Start the session
global $conn;
session_start();

// Check if session is set
if(isset($_SESSION['status']) && $_SESSION['status'] == true) {
    // If the session is set, display welcome message and products
    require_once 'db_connection_test.php';

    echo "<p>Welcome $username, to Lau Tech</p>" . "<br>" . "<h2>Browse our products</h2>";

    // Logout form
    echo '<form id="logoutForm" action="logout.php" method="post">';
    echo '<input type="submit" value="Logout">';
    echo '</form>';
} else {
    // If the session is not set, prompt the user to login
    echo "Please login to see our products!";
    echo '<a href="login2.php">Login</a>';
}
?>

<?php
require_once "db_connection_test.php";
    // Function to recursively fetch sub-categories
    function fetchSubcategories($parent_id, $conn) {
        $query = "SELECT * FROM categories WHERE parent_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $subcategories = array();
        while ($row = $result->fetch_assoc()) {
            $subcategories[] = $row;
        }
        $stmt->close();
        return $subcategories;
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
    <style>
        .submenu {
            display: none;
        }
        .parent:hover .submenu {
            display: block;
        }
    </style>
</head>
<body>
<!-- Your products page content goes here -->
<h1>Hej</h1>
<nav>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li class="parent"><?php echo $category['name']; ?>
                <?php if (!empty($category['subcategories'])): ?>
                    <ul class="submenu">
                        <?php foreach ($category['subcategories'] as $subcategory): ?>
                            <li><?php echo $subcategory['name']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
</body>
</html>
