<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
     $user_payements=  getUserById($_SESSION['user_loged_id']);
     $user_payement=  mysql_fetch_array($user_payements);      
}else
{
    header("location:maverick-game-user-login");
}
?>
<?php if(isset($_REQUEST['amount'])) echo $_REQUEST['amount']; ?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game Payments</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<script src="//fortumo.com/javascripts/fortumopay.js" type="text/javascript"></script>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body>

<?php
	include("user-login-menus.php");
?>
<?php
	include("sidebarlinks.php");
?>
<div class="baninner">
<?php
	include("navigation.php");
?>
<div class="bgshadow"></div>
<img src="assets/images/baninner/crisis.jpg" width="1366" height="230" class="banpic" alt="">
</div>
	<div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
      <div class="box-inner"> 
      <h2 class="hd-main">Payment Method</h2>
      <hr>
<div role="alert" class="alert alert-warning"><strong>Note : </strong>Kindly press the confirm button to proceed the confirm your request</div>
<form action="http://202.69.8.50:9080/easypay/Confirm.jsf" method="POST" target="_blank">
<input name="auth_token" value="<?php if(isset($_REQUEST['auth_token'])) echo $_REQUEST['auth_token']; ?>" hidden = "true"/>
<input name="postBackURL" value="http://www.maverickgame.com/new-version/payment-success" hidden = "true"/>
<input value="confirm" class="btnread" type ="submit" name= "pay"/>
</form>
</div>
 </div>
 <div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarscore.php");
	  ?>
      </div>
      </div>
    </div>
    </div>


<?php
include("footer-toparea.php");
?>

<?php
include("footer.php");
?>


</body>
</html>