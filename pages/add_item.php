
<?php 
include('config/config.php');
include('includes/header.php');

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if(isset($_POST['submit'])){
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $snumber = mysqli_real_escape_string($conn,$_POST['serial_number']);
    $quantity = mysqli_real_escape_string($conn,$_POST['quantity']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $category_name = mysqli_real_escape_string($conn,$_POST['category_id']);

    // Get the id of the selected category from the category table
    $select_category = "SELECT id FROM category WHERE name='$category_name'";
    $result_category = mysqli_query($conn,$select_category);

    if(mysqli_num_rows($result_category) == 0){
        $error[] = 'Invalid category selected!';
    }else{
        $category = mysqli_fetch_assoc($result_category);
        $category_id = $category['id'];

        // Check if the item already exists
        $select_item = "SELECT * FROM item WHERE title='$title' AND serial_number='$snumber' AND quantity='$quantity' AND type='$type' AND category_id='$category_id'";
        $result_item = mysqli_query($conn,$select_item);

        if(mysqli_num_rows($result_item) > 0){
            $error[] = 'Item already exists!';
        }else{
            // Insert the new item into the item table
            $insert_item = "INSERT INTO item(title,serial_number,quantity,type,category_id) VALUES('$title','$snumber','$quantity','$type','$category_id')";
            mysqli_query($conn,$insert_item);
            echo '<script>self.location="items.php"</script>';
        }
    }
}
?>


<div class="add_form-container mt-5">
    <form action="" method="post">
    <span><button class="btn goto-user"><a href='items.php'>Go Back</a></button></span>
        <h3>Add new Item</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-message">'.$error.'</span>';
            }
        }
        ?>
        <input type="text" name="title" required placeholder="Enter item title">
        <input type="text" name="serial_number" required placeholder="Enter serial number">
        <input type="text" name="quantity" required placeholder="Enter quantity">
        <input type="text" name="type" required placeholder="Enter type">

        <select name="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="Add Item" class="btn goto-user">
    </form>
</div>

<?php include('includes/footer.php'); ?>
