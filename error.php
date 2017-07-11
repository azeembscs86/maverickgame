<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game Error</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>

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
  <h2 class="hd-main">Error</h2>
  <?php
  if(isset($_REQUEST['login']))
  {
  ?>
  <p>You are not login please login for playing game</p>
 <?php
  }
  ?>  
  <?php
  if(isset($_REQUEST['active']))
  {
  ?>
  <p>Your email in not activate please check your email and activate for login</p>
 <?php
  }
  ?>  
  <?php
  if(isset($_REQUEST['msg']))
  {
  ?>
  <p>Invalid User Name or Password</p>
 <?php
  }
  ?>
   
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