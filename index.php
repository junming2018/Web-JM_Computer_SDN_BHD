<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JM Computer SDN BHD</title>
    <link rel="icon" type="image/x-icon" href="products/JM_Computer_SDN_BHD_Favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        background-image: url("products/Background2.gif");
      }
      .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
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
          <div class="page-header">
            <img src="products/JM_Computer_SDN_BHD.png" alt="JM Computer SDN BHD" class="center">
          </div>
          <form action="index.php" method="post" class="form-horizontal">
            <div class="input-group input-group-lg form-group">
              <label class="input-group-addon">
                <i class="glyphicon glyphicon-search"></i>
              </label>
              <input type="text" class="form-control" name="search" placeholder="Product ID / Product Brand / Product Category - Ex. PB EVGA Power" autofocus required>
            </div>
            <div class="form-group">
              <button class="btn btn-default btn-lg center" type="submit" name="submit">Search Product</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <?php
            include_once 'database.php';
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_POST['submit'])) {
              $field = ['fld_product_id', 'fld_product_brand' , 'fld_product_category'];
              $search = $_POST['search'];
              $data = explode(" ", $search);
              $id = (isset($data[0]) ? $data[0] : '');
              $brand = (isset($data[1]) ? $data[1] : '');
              $category = (isset($data[2]) ? $data[2] : '');
              try {
                if(count($data) == 1) {
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 WHERE {$field[0]} LIKE ?");
                  $stmt->setFetchMode(PDO::FETCH_OBJ);
                  $stmt->execute(["%{$id}%"]);
                } elseif(count($data) == 2) {
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 WHERE {$field[0]} LIKE ? AND {$field[1]} LIKE ?");
                  $stmt->setFetchMode(PDO::FETCH_OBJ);
                  $stmt->execute(["%{$id}%","%{$brand}%"]);
                } elseif(count($data) ==3 ) {
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 WHERE {$field[0]} LIKE ? AND {$field[1]} LIKE ? AND {$field[2]} LIKE ?");
                  $stmt->setFetchMode(PDO::FETCH_OBJ);
                  $stmt->execute(["%{$id}%","%{$brand}%", "%{$category}%"]);
                }
          ?>
                <div class="page-header">
                  <h2>Search Result</h2>
                </div>
          <?php
                if ($stmt->fetch() != null) {
          ?>
                  <table class="table table-striped table-bordered">
                    <tr>
                      <th>Product ID</th>
                      <th>Name</th>
                      <th>Brand</th>
                      <th>Price($)</th>
                      <th>Category</th>
                      <th>I.Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
          <?php
                  while($readrow = $stmt->fetch()) {
          ?>
                      <tr>
                        <td align="center"><?php echo $readrow->fld_product_id; ?></td>
                        <td ><?php echo $readrow->fld_product_name; ?></td>
                        <td><?php echo $readrow->fld_product_brand; ?></td>
                        <td align="center"><?php echo $readrow->fld_product_price; ?></td>
                        <td><?php echo $readrow->fld_product_category; ?></td>
                        <td><?php echo $readrow->fld_product_image; ?></td>
                        <?php if(file_exists('products/'. $readrow->fld_product_image) && isset($readrow->fld_product_image)){
                                $img = 'products/'.$readrow->fld_product_image;
                                echo '<td align="center"><img data-toggle="modal" data-target="#'.$readrow->fld_product_id.'" width=150px; src="'.$img.'"></td>';
                              } else {
                                $img = 'products/Default_Image.jpg';
                                echo '<td align="center"><img width=150px%; data-toggle="modal" data-target="#'.$readrow->fld_product_id.'" src="products/Default_Image.jpg"'.'></td>';
                              }
                        ?>
                        <div id="<?php echo $readrow->fld_product_id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-body">
                            <img src="<?php echo $img ?>" class="img-responsive">
                          </div>
                        </div>
                        <td align="center">
                          <a href="products_details.php?pid=<?php echo $readrow->fld_product_id; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                          <?php if ($_SESSION["user_level"] == "Admin") { ?>
                            <a href="products.php?edit=<?php echo $readrow->fld_product_id; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                            <a href="products.php?delete=<?php echo $readrow->fld_product_id; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                          <?php } ?>
                        </td>
                      </tr>
          <?php
                  }
          ?>
                  </table>
          <?php
                } else {
                  echo "<div class='alert alert-danger margin-top-40' role='alert'>No record!</div>";
                }
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
            }
            $conn = null;
          ?>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>