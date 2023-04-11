<?php 
include('config/config.php');
include('includes/header.php');

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            header('location: index.php');
            exit();
        } else {
            $error = 'Incorrect email or password.';
        }
    } else {
        $error = 'User not found.';
    }
}


?>



<div class="form-container">
    <form action="login.php" method="post">
        <h3>Login Now</h3>
        <?php if(isset($error)): ?>
            <ul class="error-message">
                <li><?= $error; ?></li>
            </ul>
        <?php endif; ?>
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="submit" name="submit" value="Login Now" class="form-btn">
        <p>Don't have an account? <a href="registration_form.php">Register Now</a></p>
    </form>
</div>

<?php include('includes/footer.php'); ?>
