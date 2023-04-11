<?php
require_once('config/db_connect.php');
include('config/config.php');
include('includes/header.php');

?>

<div class="container mt-5">
  <?php
  session_start();
  if (isset($_SESSION['email'])) {
    echo '<h6>Logged in as: ' . $_SESSION['email'] . '</h6>';
  }
  ?>

  <?php
  if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
    $userId = $_SESSION['id'];

    $sql = "SELECT ii.item_id, ii.date_issued, i.serial_number, i.title 
            FROM items_issued ii 
            INNER JOIN item i ON ii.item_id = i.id 
            WHERE ii.staff_id = $userId AND i.category_id = $categoryId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo '<h5 class="text-center">Items issued to you in this category.</h5>';
      echo '<table class="table table-bordered user-items">';
      echo '<thead class="thead-light">';
      echo '<tr>';
      echo '<th scope="col">Serial Number</th>';
      echo '<th scope="col">Item ID</th>';
      echo '<th scope="col">Item Name</th>';
      echo '<th scope="col">Date Issued</th>';
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
      echo '<p>No issued items found for you in the selected category.</p>';
    }
  } else {
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo '<h2 class="text-center"> Item Categories:</h2>';
      echo '<div class="row  category mb-1 mt-1">';
      while ($row = mysqli_fetch_assoc($result)) {
        $categoryId = $row['id'];
        $categoryName = $row['name'];
        echo '<div class="col-md-4 mb-4 mt-5">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<a href="?category_id=' . $categoryId . '"><h5 class="card-title categories">' . $categoryName . '</a></h5>';
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
