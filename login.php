<?php session_start();
  if(isset($_SESSION['login_user'])) {
    header('Location: index.php');
  }
  include_once 'database.php'
?>
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
        background-image: url("products/Background.gif");
      }
      .center {
        display: block;
        margin-left: auto;
        border-radius: 25px;
        border-image: 25px;
        margin-right: auto;
        width: 50%;
      }
      #uname {
        color: #333333;
        margin: auto;
        width: 270px;
        border-color: #DCDCDC;
        background-color: white;
        font-size: 15px;
        line-height: 1.5;
        height: 45px;
        border-radius: 15px;
        text-align: center;
        margin-top: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 10px 50px 0 rgba(0, 0, 0, 0.19);
       }
      #pw {
        color: #333333;
        margin: auto;
        width: 270px;
        border-color: #DCDCDC;
        background-color: white;
        font-size: 15px;
        line-height: 1.5;
        height: 45px;
        border-radius: 15px;
        text-align: center;
        margin-top: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 10px 50px 0 rgba(0, 0, 0, 0.19);
      }
      #login {
        color: white;
        font-weight: bold;
        margin: auto;
        border-radius: 10px;
        width: 275px;
        margin-top: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 10px 50px 0 rgba(0, 0, 0, 0.19);
      }
      #form {
        width: 350px;
        border: 5px solid #cccccc;
        padding: 30px;
        background: white;
        border-radius: 10px;
      }
      .container-fluid {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-65%, -55%);
        transform: translate(-65%, -55%);
      }
      .alert.alert-align {
        margin-bottom: 0;
        border-radius: 0;
      }
    </style>
  </head>
  <body id="body">
    <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST["login"])) {
          $query = "SELECT * FROM tbl_staffs_a176607_pt2 WHERE fld_staff_email = :uname AND fld_password = :pw";  
          $statement = $conn->prepare($query);
          $statement->execute(
            array(
              'uname' => $_POST["uname"],
              'pw' => $_POST["pw"]
            )
          );
          $result = $statement->fetchAll();
          $count = $statement->rowCount();
          if($count > 0) {
            $_SESSION["login_user"] = $_POST["uname"];
            foreach($result as $readrow) {
              $_SESSION["user_level"] = $readrow["fld_position"];
              $_SESSION["user_name"] = $readrow["fld_staff_name"];
            }
            header("location:index.php");
          } else {  
    ?>
            <div class='alert alert-danger alert-align' role='alert'>
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Login Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbspEmail or Password is invalid
            </div>
    <?php
          } 
        }
      } catch(PDOException $error) {
    ?>
        <div class='alert alert-danger alert-align' role='alert'>
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Login Failed!</strong>&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $e->getMessage();?>
        </div>
    <?php 
      }  
    ?>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-12 col-sm-offset-2 col-md-8 col-md-offset-2">
          <form action="login.php" method="post" name="frmlogin"class="form-horizontal" id="form">
            <div class="form-group">
              <img src="products/JM_Computer_SDN_BHD.png" class="img-responsive center" style="width: 225px">
            </div>
            <div class="form-group">
              <input name="uname" type="text" class="form-control" id="uname" placeholder="Email: a176352@siswa.ukm.edu.my" required>
            </div>
            <div class="form-group">
              <input name="pw" type="password" class="form-control" id="pw" placeholder="Password: Staff123"  required>
            </div>
            <div class="form-group">
              <button type="submit" id="login" name="login" class=" btn btn-primary btn-block">LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>