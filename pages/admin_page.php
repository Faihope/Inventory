<?php 
include('config/config.php');
include('includes/header.php');
session_start();

if(!isset($_SESSION['admin_name'])){
    header('Location:login_form.php');
}

?>

<H1>Welcome <?php echo $_SESSION['admin_name'] ?>  </H1>

<?php include('includes/footer.php'); ?>
