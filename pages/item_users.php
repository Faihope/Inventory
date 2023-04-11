<?php
require_once('config/db_connect.php');
include('config/config.php');
include('includes/header.php');
?>

<div class="container mt-5">
  <h6>Logged in as:, <?php echo $_SESSION['email']; ?></h6>

  <?php
  // Check if a category is selected
  if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $userId = $_SESSION['id'];

    // Fetch items assigned to the logged-in user in the selected category
    $sql = "SELECT ii.item_id, ii.date_issued, i.serial_number, i.title 
            FROM items_issued ii 
            INNER JOIN item i ON ii.item_id = i.id 
            WHERE ii.staff_id = $userId AND i.category_id = $categoryId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo '<h2>Issued Items in Selected Category:</h2>';
      echo '<table class="table table-bordered">';
      echo '<thead class="thead-dark">';
      echo '<tr>';
      echo '<th scope="col">Serial Number</th>';
      echo '<th scope="col">Item ID</th>';
      echo '<th scope="col">Item Name</th>';
      echo '<th scope="col">Issue Date</th>';
      // Add additional table headers for other item details as needed
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      while ($row = mysqli_fetch_assoc($result)) {
        $itemId = $row['item_id'];
        $issueDate = $row['date_issued'];
        $itemTitle = $row['title'];
        $serialNumber = $row['serial_number']; 

        echo '<tr>';
        echo '<td>' . $serialNumber . '</td>'; 
        echo '<td>' . $itemId . '</td>';
        echo '<td>' . $itemTitle . '</td>';
        echo '<td>' . $issueDate . '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } else {
      echo '<p>No issued items found for this user in the selected category.</p>';
    }
  } else {
    // Fetch categories
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo '<h2>Categories:</h2>';
      echo '<div class="row">';
      while ($row = mysqli_fetch_assoc($result)) {
        $categoryId = $row['id'];
        $categoryName = $row['name'];
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $categoryName . '</h5>';
        echo '<a href="?category_id=' . $categoryId . '" class="btn add-user">View Items</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<p>No categories found.</p>';
    }
  }
  ?>

</div>

<?php include('includes/footer.php'); ?>
