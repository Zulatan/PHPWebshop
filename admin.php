<?php
require_once "db_connection_test.php";
$conn = mysqli_connect(
    'localhost',
    'root',
    'root',
    'PHPWebshop'
);

echo "<a href='products.php'> < Back</a>";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>

	<br>
	<div>
		<table>
			<thead>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Action</th>
			</thead>
			<tbody>
                <h3>List of Products, Categories and Sub-Categories with their IDs</h3>
				<?php
					$queryGetAllProducts = mysqli_query($conn,"select * from products");
					while($row = mysqli_fetch_array($queryGetAllProducts)){
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td>
								<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
								<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
    <div class="wrapper">
        <h2>Want to add product?</h2>
        <form method="POST" action="add.php">
            <label>Parent ID:</label><input type="text" name="productParentID">
            <label>Product name:</label><input type="text" name="productName">
            <label>Product description:</label><input type="text" name="productDesc">
            <label>Product price:</label><input type="text" name="productPrice">
            <label>Product img path:</label><input type="text" name="productImagePath">


            <input type="submit" name="add">
        </form>
    </div>
</body>
</html>