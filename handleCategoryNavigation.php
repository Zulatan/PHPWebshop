<?php
// Check if the ID parameter exists in the URL
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Determine which page to redirect to based on the category or sub-category ID
    switch ($categoryId) {
        case 1:
            // Redirect to the page for PC products
            header("Location: pcProduct.php");
            break;
        case 2:
            // Redirect to the page for Stationær products
            header("Location: stationaerProduct.php");
            break;
        case 3:
            // Redirect to the page for Laptop products
            header("Location: laptopProduct.php");
            break;
        case 4:
            // Redirect to the page for MacBook products
            header("Location: macbookProduct.php");
            break;
        case 5:
            // Redirect to the page for Windows products
            header("Location: windowsProduct.php");
            break;
        case 6:
            // Redirect to the page for iMac products
            header("Location: imacProduct.php");
            break;
        /*
         case 7:
            // Redirect to the page for Windows products
            header("Location: windowsProduct.php");
            break;
        */
        case 8:
            // Redirect to the page for Phone products
            header("Location: phoneProduct.php");
            break;
        case 9:
            // Redirect to the page for iPhone products
            header("Location: iphoneProduct.php");
            break;
        case 10:
            // Redirect to the page for Android products
            header("Location: androidProduct.php");
            break;
        case 11:
            // Redirect to the page for macbook subcategory products
            header("Location: macbookProduct.php");
            break;
        // Add more cases for other category or sub-category IDs as needed
        default:
            // Handle the case where the category or sub-category ID does not match any specific page
            echo "Invalid category or sub-category ID.";
            break;
    }
    exit;
} else {
    // Handle the case where the ID parameter is not provided
    echo "Category or sub-category ID not provided.";
}


?>

