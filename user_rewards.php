<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Rewards | Maverick Game </title>
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
    <div class="col-md-1 col-sm-1"></div>
     <div class="col-md-9 col-sm-9">
      <div class="rewards-wrap" style="min-height:500px;"> 
  <h2>Overview</h2>
     
<?php
include("points-navigation.php");?>
  <h3 class="heading4">Earn Rewards By Playing Games:</h3>
  
  <p class="white"> Maverick Rewards are real products that you can earn by playing Maverick Games and earning points on your game score. </p>

  <p class="white">It's a three step process <strong>Play</strong> <strong>Earn</strong> <strong>Redeem</strong> based purely on your performance. </p>

  <p class="white">Better you please more rewards you get. For more information please contact us at <strong>info@maverickgame.com</strong>  </p>
  <br/><br/><br/>

<div class="row">
<div class="col-md-12" align="center">
<img src="assets/images/ban-rewards.png" class="img-responsive">
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