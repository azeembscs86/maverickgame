<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>404 error | Maverick Game</title>
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
<img src="assets/images/baninner/draon-draft.jpg" width="1366" height="230" class="banpic" alt="">
</div>
	<div class="container">
    <div class="row">
     <div class="col-md-9">
     <div class="box-inner">
<h2 class="hd-main">Whoops, our bad...</h2>
      <p>The page you requested was not found, and we have a fine guess why. If you typed the URL directly, please make sure the spelling is correct. If you clicked on a link to get here, the link is outdated.</p>
<hr>
<h3 class="hd-main">What can you do?</h3>
    <p>Have no fear, help is near! There are many ways you can get back on track with Website.</p>

        <p>Go back to the previous page.<br>
          Use the search bar at the top of the page to search for your products.<br>
          Follow these links to get you back on track!<br>
        <a href="index.php" class="btnread">Home</a> <a href="maverick-game-user-login" class="btnread">Login</a></p>
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