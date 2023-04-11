
<?php 
include('config/config.php');
include('includes/header.php');

// Include the database connection settings
include('config/db_connect.php');

//Create Query
$query = 'SELECT * FROM category';

//Get results
$result = mysqli_query($conn,$query);

//Fetch Data
$categories = mysqli_fetch_all($result,MYSQLI_ASSOC);

//free results
mysqli_free_result($result);

//close connection
mysqli_close($conn); 

?>

<div class="container mt-3 category">
<button class="btn add-user mb-4 mt-4"> <a href='add_category_form.php'>Add Categories<a></button>

		<h2>Categories</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>name</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
            <?php foreach ($categories as $category) :?>					
				<tr>
						<td><?php echo $category['id']; ?></td>
						<td><?php echo $category['name']; ?></td>
						<td>
							<button class="btn add-user">Update</button>
							<button class="btn btn-danger">Delete</button>

						</td>


					</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
