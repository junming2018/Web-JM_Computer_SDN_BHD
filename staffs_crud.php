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
    try {
      $stmt = $conn->prepare("INSERT INTO tbl_staffs_a176607_pt2(fld_staff_id, fld_staff_name, fld_staff_phone, fld_staff_email, fld_position, fld_password) VALUES(:sid, :name, :phone, :email, :position, :upassword)");
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':position', $position, PDO::PARAM_STR);
      $stmt->bindParam(':upassword', $upassword, PDO::PARAM_STR);
      $sid = $_POST['sid'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $position = $_POST['position'];
      $upassword = $_POST['upassword'];
      $stmt->execute();
    } catch(PDOException $e) {
?>
      <div class='alert alert-danger alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Insert Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
      </div>
<?php
    }
  }
  if (isset($_POST['update'])) {
    try {
      $stmt = $conn->prepare("UPDATE tbl_staffs_a176607_pt2 SET fld_staff_id = :sid, fld_staff_name = :name, fld_staff_phone = :phone, fld_staff_email = :email, fld_position = :position, fld_password = :upassword WHERE fld_staff_id = :oldsid");
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':position', $position, PDO::PARAM_STR);
      $stmt->bindParam(':upassword', $upassword, PDO::PARAM_STR);
      $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
      $sid = $_POST['sid'];
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $position = $_POST['position'];
      $upassword = $_POST['upassword'];
      $oldsid = $_POST['oldsid']; 
      $stmt->execute();
      header("Location: staffs.php");
    } catch(PDOException $e) {
?>
      <div class='alert alert-danger alert-align' role='alert'>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Update Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
      </div>
<?php
    }
  }
  if (isset($_GET['delete'])) {
    try {
      $stmt = $conn->prepare("DELETE FROM tbl_staffs_a176607_pt2 where fld_staff_id = :sid");
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $sid = $_GET['delete'];
      $stmt->execute();
      header("Location: staffs.php");
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  if (isset($_GET['edit'])) {
    try {
      $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a176607_pt2 where fld_staff_id = :sid");
      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR); 
      $sid = $_GET['edit'];
      $stmt->execute();
      $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  $conn = null;
?>