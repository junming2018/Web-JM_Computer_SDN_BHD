<?php
  include_once 'orders_crud.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JM Computer SDN BHD : Orders</title>
    <link rel="icon" type="image/x-icon" href="products/JM_Computer_SDN_BHD_Favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        background-image: url("products/Background2.gif");
      }
      th {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <?php include_once 'nav_bar.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header text-center">
            <h2>Create New Order</h2>
          </div>
          <form action="orders.php" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="orderid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="oid" type="text" class="form-control" id="orderid" placeholder="Auto Generated" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_id']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="orderdatel" class="col-sm-3 control-label">Order Date</label>
              <div class="col-sm-9">
                <input name="orerdate" type="text" class="form-control" id="orderdatel" placeholder="Auto Generated" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="staff" class="col-sm-3 control-label">Satff</label>
                <div class="col-sm-9">
                  <select name="sid" class="form-control" id="staff">
                    <?php
                      try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a176607_pt2");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                      } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      foreach($result as $staffrow) {
                    ?>
                    <?php
                      if((isset($_GET['edit'])) && ($editrow['fld_staff_id']==$staffrow['fld_staff_id'])) { 
                    ?>
                    <option value="<?php echo $staffrow['fld_staff_id']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
                    <?php } else { ?>
                    <option value="<?php echo $staffrow['fld_staff_id']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
                    <?php } ?>
                    <?php
                      }
                      $conn = null;
                    ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label for="customer" class="col-sm-3 control-label">Customer</label>
                <div class="col-sm-9">
                  <select name="cid" class="form-control" id="customer">
                    <?php
                      try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("SELECT * FROM tbl_customers_a176607_pt2");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                      } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                      }
                      foreach($result as $custrow) {
                    ?>
                    <?php
                      if((isset($_GET['edit'])) && ($editrow['fld_customer_id']==$custrow['fld_customer_id'])) {
                    ?>
                    <option value="<?php echo $custrow['fld_customer_id']; ?>" selected><?php echo $custrow['fld_customer_name'] ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $custrow['fld_customer_id']; ?>"><?php echo $custrow['fld_customer_name'] ?></option>
                    <?php } ?>
                    <?php
                      }
                      $conn = null;
                    ?> 
                  </select>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php if (isset($_GET['edit'])) { ?>
                  <button class="btn btn-default" type="submit" name="update">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update
                  </button>
                <?php } else { ?>
                  <button class="btn btn-default" type="submit" name="create">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create
                  </button>
                <?php } ?>
                <button class="btn btn-default" type="reset">
                  <span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="page-header">
            <h2>Order List</h2>
          </div>
          <table class="table table-striped table-bordered">
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Staff</th>
              <th>Customer</th>
              <th>Action</th>
            </tr>
            <?php
              $per_page = 5;
              if (isset($_GET["page"]))
                $page = $_GET["page"];
              else
                $page = 1;
              $start_from = ($page-1) * $per_page;
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM tbl_orders_a176607_pt2, tbl_staffs_a176607_pt2, tbl_customers_a176607_pt2 WHERE ";
                $sql = $sql."tbl_orders_a176607_pt2.fld_staff_id = tbl_staffs_a176607_pt2.fld_staff_id and ";
                $sql = $sql."tbl_orders_a176607_pt2.fld_customer_id = tbl_customers_a176607_pt2.fld_customer_id LIMIT ";
                $sql = $sql."$start_from, $per_page";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
              foreach($result as $orderrow) {
            ?>
            <tr>
              <td align="center"><?php echo $orderrow['fld_order_id']; ?></td>
              <td align="center"><?php echo $orderrow['fld_order_date']; ?></td>
              <td><?php echo $orderrow['fld_staff_name'] ?></td>
              <td><?php echo $orderrow['fld_customer_name'] ?></td>
              <td align="center">
                <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                <?php if ($_SESSION["user_level"] == "Admin") { ?>
                  <a href="orders.php?edit=<?php echo $orderrow['fld_order_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                  <a href="orders.php?delete=<?php echo $orderrow['fld_order_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                <?php } ?>
              </td>
            </tr>
            <?php
              }
              $conn = null;
            ?>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <nav>
            <ul class="pagination">
              <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "SELECT * FROM tbl_orders_a176607_pt2, tbl_staffs_a176607_pt2, tbl_customers_a176607_pt2 WHERE ";
                  $sql = $sql."tbl_orders_a176607_pt2.fld_staff_id = tbl_staffs_a176607_pt2.fld_staff_id and ";
                  $sql = $sql."tbl_orders_a176607_pt2.fld_customer_id = tbl_customers_a176607_pt2.fld_customer_id";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  $total_records = count($result);
                } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                }
                $total_pages = ceil($total_records / $per_page);
              ?>
              <?php if ($page==1) { ?>
                <li class="disabled">
                  <span aria-hidden="true">«</span>
                </li>
              <?php } else { ?>
                <li>
                  <a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                  </a>
                </li>
                <?php
              }
                for ($i=1; $i<=$total_pages; $i++)
                  if ($i == $page)
                    echo "<li class=\"active\"><a href=\"orders.php?page=$i\">$i</a></li>";
                  else
                    echo "<li><a href=\"orders.php?page=$i\">$i</a></li>";
                ?>
              <?php if ($page==$total_pages) { ?>
                <li class="disabled">
                  <span aria-hidden="true">»</span>
                </li>
              <?php } else { ?>
                <li>
                  <a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous">
                    <span aria-hidden="true">»</span>
                  </a>
                </li>
              <?php
                }
                $conn = null;
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>