<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Forgot Password | Maverick Game</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
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
<img src="assets/images/baninner/furiousred.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-9">
<div class="box-inner"> 

<h2 class="hd-main">Forgot <span>Password</span></h2><br>
   <?php
  if (isset($_REQUEST['err'])) {
      ?>    
      <p class="text-danger">Email address not exists</p>
      <?php
  }
  ?>
  <?php
  if (isset($_REQUEST['success'])) {
      ?>    
      <p class="success">Check your email-we sent an email for you reset your password</p>
      <?php
  }
  ?>
      
      <?php
  if (isset($_REQUEST['verfify'])) {
      ?>    
      <p class="success">Check your email-we sent an email for you reset your password</p>
      <?php
  }
  ?>
  <hr>
<form action="userforgotpassword.php" method="post" id="userLogin" name="userLogin">
<div class="loginbox">  
<div class="leftBox">
<div class="row">
<div class="col-md-3">
<label>Enter your email address :</label>
</div>
<div class="col-md-7">
<input type="text" class="form-control" placeholder="Enter your email address" value="" name="user_email" id="user_email"/>
</div>
<div class="clearfix"></div><hr>
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="col-md-4 nopad-left"><input type="submit" value="Submit" name="" class="btnread" /> </div>
<div class="col-md-8"><span class="forgetpass"><a href="maverick-game-user-login"><span>Suddenly Remember?Login Here</span></a></span></div>
</div>
</div>
</div>
</div> 
</form>
</div>
</div>
<div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarpoints.php");
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