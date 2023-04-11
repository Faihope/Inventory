<?php 
include('config/config.php');
include('includes/header.php');

// Include the database connection settings
include('config/db_connect.php');

$search_title = "";
$search_date_added = "";
$search_category = "";

if (isset($_POST['submit'])) {
	$search_title = mysqli_real_escape_string($conn, $_POST['search_title']);
	$search_date_added = mysqli_real_escape_string($conn, $_POST['search_date_added']);
	$search_category = mysqli_real_escape_string($conn, $_POST['search_category']);
  
	$query = "SELECT * FROM item WHERE title LIKE '%$search_title%' AND date_added LIKE '%$search_date_added%' AND category_id LIKE '%$search_category%'";
  
} else {
	$query = 'SELECT * FROM item';
}
  

//Create Query
$result = mysqli_query($conn,$query);

//Fetch Data
$items = mysqli_fetch_all($result,MYSQLI_ASSOC);

//Free results
mysqli_free_result($result);

?>

<div class="container item mt-3">
	<button class="btn add-user mb-4 mt-4"> <a href='add_item.php'>Add Item<a></button>

	<form class="form-inline mb-3" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group mx-sm-3 mb-2">
			<label for="search_title" class="sr-only">Title</label>
			<input type="text" class="form-control" id="search_title" name="search_title" placeholder="Title" value="<?php echo htmlspecialchars($search_title); ?>">
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<label for="search_date_added" class="sr-only">Date added</label>
			<input type="text" class="form-control" id="search_date_added" name="search_date_added" placeholder="Date added" value="<?php echo htmlspecialchars($search_date_added); ?>">
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<label for="search_category" class="sr-only">Category</label>
			<input type="text" class="form-control" id="search_category" name="search_category" placeholder="Category" value="<?php echo htmlspecialchars($search_category); ?>">
		</div>
		<button type="submit" name="submit" class="btn add-user mb-2">Search</button>
	</form>

	<h2 class='text-center'>Items</h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Date added</th>
				<th>Serial Number</th>
				<th>Quantity</th>
				<th>Type</th>
				<th>Category</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($items as $itm) :?>
				<tr>
					<td><?php echo htmlspecialchars($itm['id']); ?></td>
					<td><?php echo htmlspecialchars($itm['title']); ?></td>
					<td><?php echo htmlspecialchars(date('Y-m-d', strtotime($itm['date_added']))); ?></td>
					<td><?php echo htmlspecialchars($itm['serial_number']); ?></td>
					<td><?php echo htmlspecialchars($itm['quantity']); ?></td>
					<td><?php echo htmlspecialchars($itm['type']); ?></td>
					<td><?php echo htmlspecialchars($itm['category_id']); ?></td>
						<td>
							<button class="btn add-user"> <a href="update_item.php?id=<?php echo $itm['id'];?>">Update</a></button>
							<button class="btn btn-danger">
							<a href="delete_item.php?id=<?php echo $itm['id'];?>">Delete</a>

							</button>

						</td>


					</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
