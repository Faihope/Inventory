<?php 
include('config/config.php');
include('includes/header.php');


session_start();
session_unset();
session_destroy();
echo '<script>self.location="login_form.php"</script>';
?>


<?php include('includes/footer.php'); ?>
