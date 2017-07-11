<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Rewards | Maverick Game</title>
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
<div class="rewards-area">
  <div class="container">
    <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="rewards-wrap" style="min-height:500px;">
          <h2>Overview</h2>
          <h3 class="heading4">Earn Points Just For Playing!</h3>
          <p class="white"> Maverick Rewards is a rewards program that allows you to earn points by playing your favorite games on maverickgame.com.* Dominate the competition by earning Kabam points and redeeming them for in-game currency!</p>
          <p class="white">Have feedback? We'd love to hear it so that we can continue to develop new features that you'll enjoy.</p>
          <p class="white">Participation is as easy as 1-2-3! </p>
          <br/>
          <br/>
          <br/>
          <div class="row">
            <div class="col-md-4" align="center"> <a href="javascript:;"><img src="assets/images/play.png" class="img-responsive"></a>
              <p class="line-height white">Build cities rich with resources, train troops and take up arms with allies to conquer new territories. </p>
            </div>
            <div class="col-md-4" align="center"> <a href="earn-points.php"><img src="assets/images/earn.png" class="img-responsive"></a>
              <p class="line-height white">Play every day and watch the points stack up. Want to earn bonus points? See our Earn Points page for more information! </p>
            </div>
            <div class="col-md-4" align="center"> <a href="redeem-points.php"><img src="assets/images/redeem.png" class="img-responsive"></a>
              <p class="line-height white">Redeem your points for valuable in-game currency, then wreak havoc on your enemies! </p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php
include("footer-toparea.php");
?>
<?php
include("footer.php");
?>
</body>
</html>