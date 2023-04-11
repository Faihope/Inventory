<?php 
     include('config/config.php');
     include('includes/header.php'); 

     if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete = "DELETE FROM category WHERE id='$id'";
        $result = mysqli_query($conn, $delete);
        if($result){
            header('location: categories.php?msg=success');
            exit();
        } else {
            header('location: categories.php?msg=error');
            exit();
        }
     } else {
        header('location: index.php.php');
        exit();
    }
?>


<?php include('includes/footer.php'); ?>
