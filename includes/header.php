<?php
// Include the database connection settings
include('config/db_connect.php');

// Create Query
$query = 'SELECT * FROM users';

// Get results
$result = mysqli_query($conn,$query);

// Fetch Data
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

// Uncomment this line if you want to use var_dump() for debugging
// var_dump($users);

// Free results
mysqli_free_result($result);

// Close connection
mysqli_close($conn); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('includes/navbar.php'); ?>

	<div class ='container'>
	
	<style>
	<?php include('includes/css/main.css'); ?>
	</style>
		
	</div>
</body>
</html>



	

