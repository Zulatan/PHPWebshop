<?php

// Connect to the database:
$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'PHPWebshop'
);
// Check connection
/*
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
*/


// SQL query to fetch the user from user table in DB
$sql = "SELECT user_id, first_name, last_name, phone, address, email FROM users";

//open connection to sql db and store in a variable
$result = $conn->query($sql);

//If statement that determines whether to show results depending on if number of rows is bigger than 0
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
       /* echo "Name: " . $row["name"]. "<br>";
        echo "Phone: " . $row["phone"]. "<br>";
        echo "Address: " . $row["address"]. "<br>";
        echo "Email: " . $row["email"]. "<br>"; */
        $username = $row["first_name"];
    }
} else {
    echo "0 results";
}
// Close connection after query
$conn->close();