<?php 
include('config/config.php');
include('includes/header.php');

?>
	<div class="container users mt-3">
		<!-- <button class="btn add-user mb-4 mt-4"> <a href='user_page.php'>Add User<a></button> -->
		<h2>Users Table</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Date Created</th>
					

				</tr>
			</thead>
			<tbody>
            
            <?php foreach ($users as $user) :?>	
                	<tr>
						<td><?php echo $user['id']; ?></td>
						<td><?php echo $user['username']; ?></td>
						<td><?php echo $user['full_name']; ?></td>
						<td><?php echo $user['email']; ?></td>
						<td><?php echo $user['created_on']; ?></td>
						<!-- <td>
						<button class='btn add-user'>
						<a href='update.php'>Update</a>
						</button>
						<button class='btn btn-danger'>
						<a href="delete.php?id=<?php echo $user['id'];?>">Delete</a>
						</button>

						</td> -->

					</tr>
                    <?php endforeach; ?>
			</tbody>
		</table>
	</div>
    <?php include('includes/footer.php'); ?>
