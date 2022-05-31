<?php
  include_once 'staffs_crud.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JM Computer SDN BHD : Staffs</title>
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
      <?php if ($_SESSION["user_level"] == "Admin") { ?>
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header text-center">
              <h2>Add New Staff</h2>
            </div>
            <form action="staffs.php" method="post" class="form-horizontal">
              <div class="form-group">
                <label for="staffid" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-9">
                  <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="namel" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input name="name" type="text" class="form-control" id="namel" placeholder="Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="phonenumber" class="col-sm-3 control-label">Phone Number</label>
                <div class="col-sm-9">
                  <input name="phone" type="text" class="form-control" id="phonenumber" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="emailaddress" class="col-sm-3 control-label">Email Address</label>
                <div class="col-sm-9">
                  <input name="email" type="text" class="form-control" id="emailaddress" placeholder="Email Address" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="userposition" class="col-sm-3 control-label">Position</label>
                  <div class="col-sm-9">
                    <div class="radio">
                      <label>
                        <input name="position" type="radio" id="userposition" value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_position']=="Admin") echo "checked"; ?> required> Admin
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input name="position" type="radio" id="userposition" value="Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_position']=="Staff") echo "checked"; ?>> Staff
                      </label>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="userpassword" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                  <input name="upassword" type="text" class="form-control" id="userpassword" placeholder="Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_password']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php if (isset($_GET['edit'])) { ?>
                    <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
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
      <?php } ?>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="page-header">
            <h2>Staff List</h2>
          </div>
          <table class="table table-striped table-bordered">
            <tr>
              <th>Staff ID</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Email Address</th>
              <th>Position</th>
              <?php if ($_SESSION["user_level"] == "Admin") { ?>
                <th>Password</th>
                <th>Action</th>
              <?php } ?>
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
                $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a176607_pt2 LIMIT $start_from, $per_page");
                $stmt->execute();
                $result = $stmt->fetchAll();
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
              foreach($result as $readrow) {
            ?>
            <tr>
              <td align="center"><?php echo $readrow['fld_staff_id']; ?></td>
              <td><?php echo $readrow['fld_staff_name']; ?></td>
              <td align="center"><?php echo $readrow['fld_staff_phone']; ?></td>
              <td align="center"><?php echo $readrow['fld_staff_email']; ?></td>
              <td align="center"><?php echo $readrow['fld_position']; ?></td>
              <?php if ($_SESSION["user_level"] == "Admin") { ?>
                <td><?php echo $readrow['fld_password']; ?></td>
                <td align="center">
                  <a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                  <a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                </td>
              <?php } ?>
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
                  $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a176607_pt2");
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
                  <a href="staffs.php?page=<?php echo $page-1 ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                  </a>
                </li>
                <?php
              }
                for ($i=1; $i<=$total_pages; $i++)
                  if ($i == $page)
                    echo "<li class=\"active\"><a href=\"staffs.php?page=$i\">$i</a></li>";
                  else
                    echo "<li><a href=\"staffs.php?page=$i\">$i</a></li>";
                ?>
              <?php if ($page==$total_pages) { ?>
                <li class="disabled">
                  <span aria-hidden="true">»</span>
                </li>
              <?php } else { ?>
                <li>
                  <a href="staffs.php?page=<?php echo $page+1 ?>" aria-label="Previous">
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