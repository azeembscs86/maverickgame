<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Purchase Coins | Maverick Game</title>
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
<img src="assets/images/baninner/draon-draft.jpg" width="1366" height="230" class="banpic" alt="">
</div>
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9">
        <div class="box-inner">
          <div class="col-md-12">
            <h3 style="font-size: 50px; padding-top: 100px; text-align:center">Coming Soon</h3>
          </div>
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