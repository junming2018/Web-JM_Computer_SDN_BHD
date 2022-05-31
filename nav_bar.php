<?php
  session_start();
  if(!isset($_SESSION['login_user'])) {
    header('Location: login.php');
  }
?>
<style type="text/css">
  .resize {
    width: 35px;
    height: 35px;
  }
</style>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img alt="JM Computer SDN BHD Logo" src="products/JM_Computer_SDN_BHD_Logo.png" class="resize">
    </div>
    <div class="navbar-header">
      <p>&nbsp&nbsp</p>
    </div>
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">JM Computer</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <a href="products.php">Products</a>
        </li>
        <li>
          <a href="customers.php">Customers</a>
        </li>
        <li>
          <a href="staffs.php">Staffs</a>
        </li>
        <li>
          <a href="orders.php">Orders</a>
        </li>
      </ul>
      <form action="index.php" method="post" class="navbar-form navbar-left">
        <div class="input-group form-group">
          <input type="text" class="form-control" name="search" placeholder="Search Product" required>
          <label class="input-group-addon">
            <button class="glyphicon glyphicon-search" type="submit" name="submit"></button>
          </label>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <p class="navbar-text">Logged in as <?php echo $_SESSION["user_level"];?>, <?php echo $_SESSION["user_name"];?></p>
        <li>
          <a href="?logout=1" name="logout" class="glyphicon glyphicon-log-out"></a>
            <?php
              if(isset($_GET['logout'])) {
                if($_GET['logout'] == '1') {
                  session_start();
                  session_destroy();
                  header("Location: login.php");
                }
              }
            ?>
        </li>
      </ul>
    </div>
  </div>
</nav>