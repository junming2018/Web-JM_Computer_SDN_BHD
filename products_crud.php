<style type="text/css">
  .alert.alert-align {
    margin-bottom: 0;
    border-radius: 0;
  }
</style>
<?php
  include_once 'database.php';
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST['create'])) {
    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (file_exists($target_file)) {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe image name is already exists!
      </div>
<?php 
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe image is too large! (>10MB)
      </div>
<?php
      $uploadOk = 0;
    }
    if($imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspOnly JPG, JPEG, PNG or GIF image is accepted!
      </div>
<?php
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
?>
      <div class='alert alert-danger alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Insert Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe product is not recorded!
      </div>
<?php
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        try {
          $stmt = $conn->prepare("INSERT INTO tbl_products_a176607_pt2(fld_product_id, fld_product_name, fld_product_brand, fld_product_series, fld_product_price, fld_product_quantity, fld_product_category, fld_product_image) VALUES(:pid, :name, :brand, :series, :price, :quantity, :category, :picture)");
          $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
          $stmt->bindParam(':name', $name, PDO::PARAM_STR);
          $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
          $stmt->bindParam(':series', $series, PDO::PARAM_STR);
          $stmt->bindParam(':price', $price, PDO::PARAM_INT);
          $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
          $stmt->bindParam(':category', $category, PDO::PARAM_STR);
          $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
          $pid = $_POST['pid'];
          $name = $_POST['name'];
          $brand = $_POST['brand'];
          $series =  $_POST['series'];
          $price = $_POST['price'];
          $quantity = $_POST['quantity'];
          $category = $_POST['category'];
          $picture = $_FILES["fileToUpload"]["name"];
          $stmt->execute();
        } catch(PDOException $e) {
?>
          <div class='alert alert-danger alert-align' role='alert'>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Insert Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
          </div>
<?php
        }
      } else {
?>
          <div class='alert alert-danger alert-align' role='alert'>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Insert Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
          </div>
<?php
      }
    }
  }
  if (isset($_POST['update'])) {
    if (empty($_FILES["fileToUpload"]["name"])) {
      try {
        $stmt = $conn->prepare("UPDATE tbl_products_a176607_pt2 SET fld_product_id = :pid, fld_product_name = :name, fld_product_brand = :brand, fld_product_series = :series, fld_product_price = :price, fld_product_quantity = :quantity, fld_product_category = :category WHERE fld_product_id = :oldpid");
        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':series', $series, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $series =  $_POST['series'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $oldpid = $_POST['oldpid'];
        $stmt->execute();
        header("Location: products.php");
      } catch(PDOException $e) {
?>
        <div class='alert alert-danger alert-align' role='alert'>
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Update Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
        </div>
<?php
      }
    } else {
      $target_dir = "products/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $oldimg = $target_dir.($_POST["imgname"]);
      if (file_exists($oldimg)) {
        $uploadOk = 1;
      }
      if (file_exists($target_file)) {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe image name is already exists!
      </div>
<?php 
      $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe image is too large! (>10MB)
      </div>
<?php
      $uploadOk = 0;
    }
    if($imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
?>
      <div class='alert alert-warning alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Image Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspOnly JPG, JPEG, PNG or GIF image is accepted!
      </div>
<?php
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
?>
      <div class='alert alert-danger alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Update Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspThe product is not updated!
      </div>
<?php
    } else {
        unlink($oldimg); 
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          try {
            $stmt = $conn->prepare("UPDATE tbl_products_a176607_pt2 SET fld_product_id = :pid, fld_product_name = :name, fld_product_brand = :brand, fld_product_series = :series, fld_product_price = :price, fld_product_quantity = :quantity, fld_product_category = :category, fld_product_image = :picture WHERE fld_product_id = :oldpid");
            $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
            $stmt->bindParam(':series', $series, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
            $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
            $pid = $_POST['pid'];
            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $series =  $_POST['series'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $picture = $_FILES["fileToUpload"]["name"];
            $oldpid = $_POST['oldpid'];
            $stmt->execute();
            header("Location: products.php");
          } catch(PDOException $e) {
?>
          <div class='alert alert-danger alert-align' role='alert'>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Update Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
          </div>
<?php
          }
        } else {
?>
          <div class='alert alert-danger alert-align' role='alert'>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Update Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
          </div>
<?php
        }
      }
    }
  }
  if (isset($_GET['delete'])) {
    try {
      $stmt = $conn->prepare("DELETE FROM tbl_products_a176607_pt2 WHERE fld_product_id = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['delete'];
      $stmt->execute();
      header("Location: products.php");
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  if (isset($_GET['edit'])) {
    try {
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a176607_pt2 WHERE fld_product_id = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['edit'];
      $stmt->execute();
      $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  $conn = null;
?>