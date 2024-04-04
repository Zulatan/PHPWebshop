<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>
<body>
    <?php
        // define variables and set to empty values that the user eventually can store data into
        $name = $last_name = $email = $phone = $address = $password = "";
        $nameErr = $last_nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = "";

        //functions to trim unnecessary user input and to remove backslashes
        function user_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data); //function to include the "htmlspecialchars" method that prevents hackers from doing malicious stuff :))
            return $data;
        }

        //Checks to see if user has filled required steps
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = user_input($_POST["name"]);
                //Checks to see what the name the user inputted is containing letters only
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["lastname"])) {
                $last_nameErr = "Last name is required";
            } else {
                $last_name = user_input($_POST["lastname"]);
                //Checks to see what last name the user inputted is containing letters only
                if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
                    $last_nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = user_input($_POST["email"]);
                //Checks to see if user has inputted a valid email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = user_input($_POST["password"]);
            }
        }


        //Checks to see if user has filled the input fields
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = user_input($_POST["name"]);
            $last_name = user_input($_POST["lastname"]);
            $email = user_input($_POST["email"]);
            $phone = user_input($_POST["phone"]);
            $address = user_input($_POST["address"]);
            $password = user_input($_POST["password"]);

            // Assuming registration process is successful
            // You should perform database operations to store user data here

            // Redirect to products.php
            $_SESSION['status'] = true;
            header('location: products.php');
            exit; // Ensure script stops here after redirect
        }



    ?>
    <div>
        <h1>Register your account</h1>
        <p>Fill out the forms, then click continue.</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <p>Name: </p>
            <input type="text" name="first_name" value="<?php echo $name; ?>">
            <span style="color:red;">* <?php echo $nameErr;?></span>

            <p>Last Name: </p>
            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
            <span style="color:red;">* <?php echo $last_nameErr;?></span>

            <p>Email: </p>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span style="color:red;">* <?php echo $emailErr;?></span>

            <p>Phone: </p>
            <input type="text" name="phone" value="<?php echo $phone; ?>">

            <p>Address: </p>
            <input type="text" name="address" value="<?php echo $address; ?>">

            <p>Password: </p>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span style="color:red;">* <?php echo $passwordErr;?></span>
            <br>
            <input type="submit" name="submit" value="Continue">
        </form>

    </div>
</body>
</html>
