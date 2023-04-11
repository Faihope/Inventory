<?php
include('includes/header.php');
include('config/db_connect.php');

if(isset($_SESSION['user_id'])) {
  if(isset($_GET['page'])) {
    $page = $_GET['page'];
    if($page == 'dashboard') {
      include('pages/dashboard.php');
    } else if($page == 'items') {
      include('pages/items.php');
    } else if($page == 'categories') {
      include('pages/categories.php');
    } else if($page == 'users') {
      include('pages/users.php');
    } else if($page == 'assign_items') {
      include('pages/assign_items.php');
    } else if($page == 'login') {
        include('pages/login.php');
    } else if($page == 'logout') {
        include('pages/logout.php');
    } else {
      include('pages/dashboard.php');
    }
  }
} else {
  include('pages/login.php');
}
?>



<div id="navbar">
  <div class='container'>
    <nav class="navbar navbar-expand-lg navbar-default">
      <a class="navbar-brand" href="index.php?page=dashboard" > <img src="includes/images/logo.png" alt="My Logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=dashboard">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=items">Items</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=users">Users</a>
          </li>
        </ul>
        <ul class="my-2 my-lg-0 collapse navbar-collapse navbar-items">
          <li class="nav-item ">
            <?php
            session_start();
            if (isset($_SESSION['id'])) {
              echo '<a href="index.php?page=logout">Logout </a>';
            } else {
              echo '<a href="index.php?page=login">Login</a>';
            }
            ?>
            <?php if($_SESSION['id']): ?>
            <span  style='color:#fff;font-size:10px;float:left;'><?php echo $_SESSION['email']; ?></span>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>

<?php include('includes/footer.php');?>
