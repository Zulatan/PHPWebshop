<?php
session_start();



// Store the URL of the previous page in a session variable to be able to direct the user back to their previous page.
if (isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
}

// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if the add to cart form is submitted
if (isset($_POST['addToCart'])) {
    // Retrieve product details from the form
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $price = $_POST['hidden_price'];
    $name = $_POST['hidden_name'];

    // If product is already in the cart, update the quantity
    if (array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else { // Otherwise, add new product to the cart
        $_SESSION['cart'][$productId] = array(
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        );
    }

    // Redirect back to the product page or any other page you want
    header("Location: cart.php");
    exit();
}

// Provide a link or button to go back to the previous page
if (isset($_SESSION['previous_page'])) {
    echo "<a href='" . $_SESSION['previous_page'] . "'>Go back</a>";
}

// Display cart contents
echo "<h1>Shopping Cart</h1>";

if (!empty($_SESSION['cart'])) {
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>";

    foreach ($_SESSION['cart'] as $productId => $product) {
        $productName = $product['name'];
        $productPrice = $product['price'];
        $productQuantity = $product['quantity'];
        $totalPrice = $product['price'] * $product['quantity'];

        echo "<tr>
            <td>$productName</td>
            <td>$productPrice</td>
            <td>$productQuantity</td>
            <td>" . ($product['price'] * $product['quantity']) . "</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Your cart is empty.";
}




?>
