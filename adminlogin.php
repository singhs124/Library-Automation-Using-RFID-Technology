<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
} else{
    header('location:404.php');
}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Central Library | Admin Login</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLE  -->
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
    <!-- GOOGLE FONT -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="assets/css/login-style.css">
</head>
<body>
    <!------MENU SECTION START-->
<?php //include('includes/header.php');?>
<!-- MENU SECTION END-->
<div class="wrapper">  
<div class="form-container sign-in">
            <form method="post">
                <h2>Admin login</h2>
                <div class="form-group">
                <input class="form-control" type="text" name="username" autocomplete="off" required />
                <i class="fas fa-user"></i>
                <label for="">UserName</label>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" required>
                    <i class="fas fa-lock"></i>
                    <label for="">password</label>
                </div>
                <button type="submit" name="login" class="btn">login</button>
            </form>
        </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php //include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
    <!-- BOOTSTRAP SCRIPTS  -->
    <!-- <script src="assets/js/bootstrap.js"></script> -->
      <!-- CUSTOM SCRIPTS  -->
    <!-- <script src="assets/js/custom.js"></script> -->
    <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>

</body>
</html>


