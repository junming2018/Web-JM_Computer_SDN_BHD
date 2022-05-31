<?php
  include_once 'products_crud.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JM Computer SDN BHD : Products</title>
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
              <h2>Add New Product</h2>
            </div>
            <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data" id="frm">
              <div class="form-group">
                <label for="productid" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-9">
                  <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="productname" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="productbrand" class="col-sm-3 control-label">Brand</label>
                  <div class="col-sm-9">
                    <select name="brand" class="form-control" id="productbrand" required>
                      <option value="">Please Select</option>
                      <option value="Fractal Design" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Fractal Design") echo "selected"; ?>>Fractal Design</option>
                      <option value="Cooler Master" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Cooler Master") echo "selected"; ?>>Cooler Master</option>
                      <option value="Corsair" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Corsair") echo "selected"; ?>>Corsair</option>
                      <option value="Phanteks" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Phanteks") echo "selected"; ?>>Phanteks</option>
                      <option value="NZXT" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="NZXT") echo "selected"; ?>>NZXT</option>
                      <option value="DIYPC" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="DIYPC") echo "selected"; ?>>DIYPC</option>
                      <option value="DEEPCOOL" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="DEEPCOOL") echo "selected"; ?>>DEEPCOOL</option>
                      <option value="EVGA" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="EVGA") echo "selected"; ?>>EVGA</option>
                      <option value="Thermaltake" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Thermaltake") echo "selected"; ?>>Thermaltake</option>
                      <option value="COUGAR" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="COUGAR") echo "selected"; ?>>COUGAR</option>
                      <option value="Montech" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Montech") echo "selected"; ?>>Montech</option>
                      <option value="Antec" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Antec") echo "selected"; ?>>Antec</option>
                    </select>
                  </div>
              </div>
              <div class="form-group">
                <label for="productseries" class="col-sm-3 control-label">Series</label>
                <div class="col-sm-9">
                  <input name="series" type="text" class="form-control" id="productseries" placeholder="Product Series" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_series']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="productprice" class="col-sm-3 control-label">Price($)</label>
                  <div class="col-sm-9">
                    <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" min="0.0" step="0.01" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="productq" class="col-sm-3 control-label">Quantity</label>
                  <div class="col-sm-9">
                    <input name="quantity" type="number" class="form-control" id="productq" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>"  min="0" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="productcate" class="col-sm-3 control-label">Category</label>
                  <div class="col-sm-9">
                    <div class="radio">
                      <label>
                        <input name="category" type="radio" id="productcate" value="Desktop PC Case" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Desktop PC Case") echo "checked"; ?> required> Desktop PC Case
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input name="category" type="radio" id="productcate" value="Desktop PC Power Supply" <?php if(isset($_GET['edit'])) if($editrow['fld_product_category']=="Desktop PC Power Supply") echo "checked"; ?>> Desktop PC Power Supply
                      </label>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label for="productimage" class="col-sm-3 control-label">Image</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <label class="form-control" id="filename"><?php if(isset($_GET['edit'])) echo $editrow['fld_product_image']; ?></label>
                    <input type="text" name="imgname" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_image']; ?>" hidden="">
                    <?php if (isset($_GET['edit'])) { ?>
                      <label class="input-group-btn">
                        <span class="btn btn-primary">
                          <input type="file" id="fileToUpload" name="fileToUpload" style="display: none;" onchange="$('#filename').text(this.files[0].name)"> Choose Image
                        </span>
                      </label>
                    <?php } else {?>
                      <label class="input-group-btn">
                          <span class="btn btn-primary">
                             <input type="file" id="fileToUpload" name="fileToUpload" style="display: none;" required="" onchange="$('#filename').text(this.files[0].name)"> Choose Image 
                          </span>
                      </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php if (isset($_GET['edit'])) { ?>
                    <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_id']; ?>">
                    <button class="btn btn-default" type="submit" name="update">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update
                    </button>
                  <?php } else { ?>
                    <button class="btn btn-default" type="submit" name="create" onclick="isEmpty()">
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
            <h2>Product List</h2>
          </div>
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
              $per_page = 5;
              if (isset($_GET["page"]))
                $page = $_GET["page"];
              else
                $page = 1;
              $start_from = ($page-1) * $per_page;
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 LIMIT $start_from, $per_page");
                $stmt->execute();
                $result = $stmt->fetchAll();
              } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
              foreach($result as $readrow) {
            ?>   
              <tr>
                <td align="center"><?php echo $readrow['fld_product_id']; ?></td>
                <td ><?php echo $readrow['fld_product_name']; ?></td>
                <td><?php echo $readrow['fld_product_brand']; ?></td>
                <td align="center"><?php echo $readrow['fld_product_price']; ?></td>
                <td><?php echo $readrow['fld_product_category']; ?></td>
                <td><?php echo $readrow['fld_product_image']; ?></td>
                <?php if(file_exists('products/'. $readrow['fld_product_image']) && isset($readrow['fld_product_image'])){
                        $img = 'products/'.$readrow['fld_product_image'];
                        echo '<td align="center"><img data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" width=150px; src="'.$img.'"></td>';
                      } else {
                        $img = 'products/Default_Image.jpg';
                        echo '<td align="center"><img width=150px%; data-toggle="modal" data-target="#'.$readrow['fld_product_id'].'" src="products/Default_Image.jpg"'.'></td>';
                      }
                ?>
                <div id="<?php echo $readrow['fld_product_id']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-body">
                    <img src="<?php echo $img ?>" class="img-responsive">
                  </div>
                </div>
                <td align="center">
                  <a href="products_details.php?pid=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                  <?php if ($_SESSION["user_level"] == "Admin") { ?>
                    <a href="products.php?edit=<?php echo $readrow['fld_product_id']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
                    <a href="products.php?delete=<?php echo $readrow['fld_product_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
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
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2");
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
                  <a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                  </a>
                </li>
                <?php
              }
                for ($i=1; $i<=$total_pages; $i++)
                  if ($i == $page)
                    echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
                  else
                    echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
                ?>
              <?php if ($page==$total_pages) { ?>
                <li class="disabled">
                  <span aria-hidden="true">»</span>
                </li>
              <?php } else { ?>
                <li>
                  <a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous">
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
    <script>
      function isEmpty() {
      var x = document.getElementById('fileToUpload').value;
      if (x == null || x == "") {
        alert("Please upload an image!");
        return false;
      }
        return true;
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>