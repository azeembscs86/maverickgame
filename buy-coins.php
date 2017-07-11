<?php 
	session_start(); 
	include( "dbconnection.php"); 
?>
<!DOCTYPE HTML>
<html>

<head>

    <title>Purchase Coins | Maverick Game</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <body>

        <?php 
			include( "user-login-menus.php"); 
		?>
        <?php 
			include( "sidebarlinks.php");
		?>
        <div class="baninner">
<?php
	include("navigation.php");
?>
<div class="bgshadow"></div>
<img src="assets/images/baninner/wordster.jpg" width="1366" height="230" class="banpic" alt="">
</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9 text-center">
                     <div class="box-inner">
						<h3 style="margin:14% 0 0; font-size:50px;">Coming Soon</h3>
                      </div>
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
			include( "footer-toparea.php"); 
		?>
        <?php 
			include( "footer.php"); 
		?>
    </body>
</html>