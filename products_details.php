<?php
  include_once 'database.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JM Computer SDN BHD : Product Details</title>
    <link rel="icon" type="image/x-icon" href="products/JM_Computer_SDN_BHD_Favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        background-image: url("products/Background2.gif");
      }
    </style>
  </head>
  <body>
    <?php include_once 'nav_bar.php'; ?>
    <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 WHERE fld_product_id = :pid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $pid = $_GET['pid'];
        $stmt->execute();
        $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
          <?php if ($readrow['fld_product_image'] == "" ) {
            echo "No Image";
          } else { ?>
            <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
          <?php } ?>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <strong>Product Details</strong>
            </div>
            <div class="panel-body">Below are the specifications of the product.</div>
            <table class="table">
              <tr>
                <td class="col-xs-4 col-sm-4 col-md-4">
                  <strong>Product ID</strong>
                </td>
                <td><?php echo $readrow['fld_product_id'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Name</strong>
                </td>
                <td><?php echo $readrow['fld_product_name'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Brand</strong>
                </td>
                <td><?php echo $readrow['fld_product_brand'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Series</strong>
                </td>
                <td><?php echo $readrow['fld_product_series'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Price</strong>
                </td>
                <td>$<?php echo $readrow['fld_product_price'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Quantity</strong>
                </td>
                <td><?php echo $readrow['fld_product_quantity'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Category</strong>
                </td>
                <td><?php echo $readrow['fld_product_category'] ?></td>
              </tr>
              <tr>
                <td>
                  <strong>Image</strong>
                </td>
                <td><?php echo $readrow['fld_product_image'] ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>