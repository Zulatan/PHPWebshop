<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<?php
// define variables and set to empty values that the user eventually can store data into
$first_name = $last_name = $email = $phone = $address = $password = "";
$first_nameErr = $last_nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    // Your existing validation code goes here

    // If there are no errors, proceed with database insertion
    if ($first_nameErr == "" && $last_nameErr == "" && $emailErr == "" && $passwordErr == "") {
        // Perform database insertion
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', 'root', 'PHPWebshop');
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind the INSERT statement
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
        // Statement below is written to help prevent SQL Injection attack
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $address, $password);

        // Set parameters and execute
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

        $stmt->execute();

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to products.php after successful registration
        $_SESSION['status'] = true;
        header('location: login2.php');
        exit;
    }
}
?>

<div>
    <h1>Register your account</h1>
    <p>Fill out the forms, then click continue.</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <p>Name: </p>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" pattern="^[a-zA-Z\s]*$">
        <span style="color:red;">* <?php echo $first_nameErr;?></span>

        <p>Last Name: </p>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
        <span style="color:red;">* <?php echo $last_nameErr;?></span>

        <p>Email: </p>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span style="color:red;">* <?php echo $emailErr;?></span>

        <p>Phone: </p>
        <input type="text" name="phone" value="<?php echo $phone; ?>" pattern="[0-9]{8}">

        <p>Address: </p>
        <input type="text" name="address" value="<?php echo $address; ?>">

        <p>Password: </p>
        <input type="password" name="password" value="<?php echo $password; ?>" pattern=".{8,}">
        <span style="color:red;">* <?php echo $passwordErr;?></span>
        <br>
        <input type="submit" name="submit" value="Continue">
    </form>

</div>
</body>
</html>
