<?php 
     include('config/config.php');
     include('includes/header.php'); 

     if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete = "DELETE FROM item WHERE id='$id'";
        $result = mysqli_query($conn, $delete);
        if($result){
            echo '<script>self.location="items.php?msg=success"</script>';

            exit();
        } else {
            echo '<script>self.location="items.php?msg=error"</script>';

            exit();
        }
     } else {
        echo '<script>self.location="items.php?msg=success"</script>';
        exit();
    }
?>


<?php include('includes/footer.php'); ?>
