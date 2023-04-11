<?php 
include('config/config.php');
include('includes/header.php');
// session_start();

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['username']);
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $role =$_POST['role'];

    $select = "SELECT * FROM users WHERE email='$email' && password='$pass' ";

    $result = mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'User already exist!';
    }else{
        if($pass != $cpass){
            $error[] = 'Passwords do not match!';
        }else{
            $insert = "INSERT INTO users(username,full_name, email, password,role) VALUES('$name','$full_name','$email','$pass','$role')";

            mysqli_query($conn,$insert);
            header('location:users.php');
        }
    }

}

?>
<div class="add_form-container">

    <form action="" method="post">
    <span><button class="btn goto-user"><a href='users.php'>Go Back</a></button></span>

        <h3>Add new User</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-message">'.$error.'</span>';

            }
        }
        ?>
        <input type="text" name="username" required placeholder="Enter Your username">
        <input type="text" name="full_name" required placeholder="Enter Your Full name">
        <input type="email" name="email" required placeholder="Enter Your email">
        <input type="password" name="password" required placeholder="Enter Your password">
        <input type="password" name="cpassword" required placeholder="Confirm Your password">
        <select name="role" id="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
        </select>
        
        <input type="submit" name="submit" value="Add User" class="form-btn">
    </form>
</div>


<?php include('includes/footer.php'); ?>
