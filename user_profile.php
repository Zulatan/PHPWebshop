<?php
// Start the session
session_start();

// Check if session is set
if (isset($_SESSION['status']) && $_SESSION['status'] == true) {
    // If the session is set, display welcome message and products
    require_once 'db_connection_test.php';

    # db conn
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );
    # menu
    echo "<a href='products.php'>Home</a>";
    # Welcome the user
    echo "<p>Welcome to your profile panel, $username</p>";

    # db query
    $getUserInfo = $conn->query("SELECT * FROM users");

    if ($getUserInfo->num_rows > 0) {
        // output data of each row
        while($row = $getUserInfo->fetch_assoc()) {
            echo "<h3 style='margin: 0 0; padding: 5px 5px'>Full name:</h3>" . $row['first_name'] . " " . $row['last_name'];
            echo "<h3 style='margin: 0 0'>Address:</h3>" . $row['address'];
            echo "<h3 style='margin: 0 0'>Phone number:</h3>" . $row['phone'];
            echo "<h3 style='margin: 0 0'>Email:</h3>" . $row['email'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();







    # html stuff


    // Logout form
    echo <<<logout
    <form id="logoutForm" action="logout.php" method="post">
        <h4 style="margin-bottom: 0 ">Want to sign out?</h4>
        <input type="submit" value="Logout">
    </form>
    logout;


    # Fetch data from database


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
    <title>Your profile</title>
</head>
<body>

</body>
</html>