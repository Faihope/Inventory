<?php 
include('config/config.php');
include('includes/header.php');
require_once('config/db_connect.php'); 

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['username']);
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Invalid email format';
    } elseif (!preg_match("/^[a-zA-Z]+\.[a-zA-Z]+@zetech\.ac\.ke$/", $email)) {
        $error[] = 'Email address must be in the format firstname.lastname@zetech.ac.ke';
    } else {
        $select = "SELECT * FROM users WHERE email='$email' && password='$pass' ";
        $result = mysqli_query($conn,$select);

        if(mysqli_num_rows($result) > 0){
            $error[] = 'User already exists';
        } else {
            if($pass != $cpass){
                $error[] = 'Passwords do not match';
            } else {
                $insert = "INSERT INTO users(username, full_name, email, password) VALUES('$name', '$full_name', '$email', '$pass')";
                mysqli_query($conn, $insert);
                echo '<script>self.location="login_form.php"</script>';

                // header('Location: http://localhost/inventory/login_form.php');
                exit();
            }
        }
    }
}

?>

<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register Now</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<div class="alert alert-danger">'.$error.'</div>';
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" required placeholder="Enter Your username">
                        </div>
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" name="full_name" required placeholder="Enter Your Full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter Your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required placeholder="Enter Your password">
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" required placeholder="Confirm Your password">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Register Now" class="btn add-user btn-block">
                        </div>
                        <div class="form-group text-center">
                            Already have an account? <a href="login_form.php">Login Now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>
