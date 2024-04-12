
<?php

require_once "db_connection_test.php";
// require "register.php"

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $username = $_POST["user_name"];
    $password = $_POST["password"];

    // Connect to the database:
    $conn = mysqli_connect(
        'localhost',
        'root',
        'root',
        'PHPWebshop'
    );

    // Check connection

    /*if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    print_r($conn);
    */


    // Validate login auth
    $query = "SELECT * FROM Users WHERE user_name = $username AND password = $password";

    $result = $conn->query($query);


    if($result->num_rows == 2) {
        header("Location: products.php");
    } else {
        echo "Failed to log you in.";
    }

    $conn->close();

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Log into your account.</h1>
        <p>Fill out the forms, then click login.</p>
        <form method="post" action=".php">
            <p>Email: </p>
            <label for="email">
                <input type="text" name="email" placeholder="Your Email" value="<?php echo "" ?>" required>
            </label>
            <span style="color:red;">* <?php echo ""?></span>

            <p>Password: </p>
            <label for="password">
                <input type="password" name="password" placeholder="Your Password" value="<?php echo "" ?>" required>
            </label>
            <span style="color:red;">* <?php echo ""?></span>
            <br>
            <input type="submit" name="submit" value="Login">
        </form>
        <p>Not a user yet?</p>
        <a href="register.php">Register here</a>
    </div>
</body>
</html>