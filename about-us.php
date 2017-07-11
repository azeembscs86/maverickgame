<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>About Us | Maverick Game</title>
<meta content="maverick game, about us, about maaverick games" name="keywords" />
<meta content="About Maverick Games- Home to online action, adventure, educational and role playing games!"  name="description" />

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
      <div class="col-md-9">
<div class="box-inner">
	<h2 class="hd-main">About Us</h2>
    <hr>
      <p><strong>Pakistan's First Online Gaming Portal</strong> that rewards Real life products to it's users based on pure performance, gifts ranging from <strong>Mobile Scratch Cards</strong> to <strong>Laptops</strong> and even  <strong>Mercedes Benz.</strong></p>
      <p><strong>Maverick Games</strong> is the home of gamers. People Who believe in them selves and in their pasion to win. This Portal is based on pure merit, no luck, no Chance, no sweet stakes involved here. One can get only as much as he performs.</p>
      <hr>
<p>The Process to Participate is <a href="game-package-payment"><strong>buy coins online to play games</strong></a>, Earn Points by Giving Best Game Performance, <strong>Redeem</strong> To Get <strong>Rewards.</strong></p>
<p>Developed by the passionate and talented gamers of <strong>Silver Hat Studio</strong>, people who grew up playing games and wanted to create their own visions to share with the world, we hope you enjoy Playing them as much as we enjoyed creating them!</p>
<p><strong>Happy Winnings!</strong></p>
<p>Powered By <strong>GoLive.</strong></p>
</div>
      <?php
		include("includes/featuredbox.php");
	  ?>
      </div>
      <div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarpoints.php");
	  ?>
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