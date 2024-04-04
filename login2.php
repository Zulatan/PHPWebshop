<?php

require_once "db_connection_test.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', 'root', 'PHPWebshop');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query using prepared statements
    $query = "SELECT * FROM users WHERE email = ?";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and set status
            session_start();
            $_SESSION['status'] = true;
            header("Location: products.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password.";
        }
    } else {
        // No user found with the given email
        echo "No user with this email found.";
    }

    // Close statement
    $stmt->close();

    // Close connection
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>Email: </p>
        <label for="email">
            <input type="text" name="email" placeholder="Your Email" required>
        </label>
        <span style="color:red;">* <?php echo ""; ?></span>

        <p>Password: </p>
        <label for="password">
            <input type="password" name="password" placeholder="Your Password" required>
        </label>
        <span style="color:red;">* <?php echo ""; ?></span>
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
    <p>Not a user yet?</p>
    <a href="register2.php">Register here</a>
</div>
</body>
</html>

