<?php
 
require_once('config/db_connect.php'); 
include('config/config.php');
include('includes/header.php');

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(empty($email) || empty($password)){
        $error = "Email and password fields are required";
    } else {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        
        
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $hash_password = $row['password'];
            $encrypted_password=md5($password);
         
            
           // if(password_verify($password, $hash_password)){
            if($hash_password == $encrypted_password){
                
                // session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                
                echo '<script>self.location="index.php"</script>';
                exit();
            } else {
                print_r(2);
                exit();
                $error = "Incorrect password. Please try again.";
            }
        } else {
            $error = "Invalid email or password. Please try again.";
        }
        
        mysqli_free_result($result);
        mysqli_close($conn);
    }
}

?>

<div class="form-container">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3 class="mb-3 font-weight-normal">Login Now</h3>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control mb-3" placeholder="Enter your email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control mb-3" placeholder="Enter your password" required>
        <button class="btn btn-lg add-user btn-block" type="submit" name="submit">Login Now</button>
        <p class="mt-3">Forgot password? <a href="registration_form.php">Click to Reset</a></p>
    </form>
</div>

