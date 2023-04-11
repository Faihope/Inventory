<?php 
include('config/config.php');
include('includes/header.php');
$error = '';

if(isset($_POST['update'])){
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $snumber = mysqli_real_escape_string($conn,$_POST['serial_number']);
    $custodian = mysqli_real_escape_string($conn,$_POST['current_custodian']);
    $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);

    $update = "UPDATE item SET title='$title', serial_number='$snumber', current_custodian='$custodian', quantity='$quantity', type='$type', category='$category' WHERE id='$id'";

    if(mysqli_query($conn,$update)){
        header('location: items.php');
    } else {
        $error = 'Failed to update item. Please try again.';
    }
}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $select = "SELECT * FROM item WHERE id='$id'";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($result);
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
<span>
<a href='items.php' class="btn btn add-user">Go Back</a>
</span>
          <h3 class="card-title text-center mb-4">Update Item Details</h3>
          <?php
          if($error != ''){
              echo '<div class="alert alert-danger">'.$error.'</div>';
          }
          ?>
          <form action="" method="post">
            <div class="mb-3">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <label for="title" class="form-label">Item Title</label>
              <input type="text" class="form-control" id="title" name="title" required placeholder="Enter item title" value="<?php echo $row['title']; ?>">
            </div>
            <div class="mb-3">
              <label for="serial-number" class="form-label">Serial Number</label>
              <input type="text" class="form-control" id="serial-number" name="serial_number" required placeholder="Enter serial number" value="<?php echo $row['serial_number']; ?>">
            </div>
            <div class="mb-3">
              <label for="custodian" class="form-label">Current Custodian</label>
              <input type="text" class="form-control" id="custodian" name="current_custodian" required placeholder="Enter current custodian" value="<?php echo $row['current_custodian']; ?>">
            </div>
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="text" class="form-control" id="quantity" name="quantity" required placeholder="Enter quantity" value="<?php echo $row['quantity']; ?>">
            </div>
            <div class="mb-3">
              <label for="type" class="form-label">Type</label>
              <input type="text" class="form-control" id="type" name="type" required placeholder="Enter type" value="<?php echo $row['type']; ?>">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <input type="text" class="form-control" id="category" name="category" required placeholder="Enter category" value="<?php echo $row['category']; ?>">
            </div>
            <div class="d-grid gap-2">
              <button type="submit" name="update" class="btn add-user">Update Item</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>
