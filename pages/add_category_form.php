
<?php 
include('config/config.php');
include('includes/header.php');

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);


    $select = "SELECT * FROM category WHERE name='$name'";

    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'Category already exist!';
    }else{
       
            $insert = "INSERT INTO category(name) VALUES('$name')";

            mysqli_query($conn,$insert);
            header('location:index.php');
        
    }

}

?>

<div class="add_form-container mt-5">
    <form action="" method="post">
    <span><button class="btn goto-user"><a href='index.php'>Go Back</a></button></span>
        <h3>Add new Category</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-message">'.$error.'</span>';
            }
        }
        ?>
        <input type="text" name="name" required placeholder="Enter category name">
        
        <input type="submit" name="submit" value="Add Category" class="form-btn">
    </form>
</div>

<?php include('includes/footer.php'); ?>
