<?php
session_start();
require 'setup.php';
include("dbconnection.php");
include("googlelogin.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game About Us</title>
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

<div class="featured-area">
	<div class="container">
    <div class="row">
     <div class="col-md-10 col-sm-9">
      <div class="inner-cnt"> 
  <h2>Search  <span>Result</span></h2>
  
  <div class="row">
  <div class="col-md-4 col-sm-4 col-xs-12">
  
  <div class="search-box">
  <div class="border-line">
                                <img width="221" height="125" alt="" class="img-responsive" src="silverhat_games/game_image/dothedive.png">
                                </div>
  <h3>Game1</h3>
  <p>sssssd</p>
  
  
  
  </div>
  </div>
  
  <div class="col-md-4 col-sm-4 col-xs-12">
  
  <div class="search-box">
  <div class="border-line">
                                <img width="221" height="125" alt="" class="img-responsive" src="silverhat_games/game_image/dothedive.png">
                                </div>
  <h3>Game1</h3>
  <p>sssssd</p>
  
  
  
  </div>
  </div>
  
  <div class="col-md-4 col-sm-4 col-xs-12">
  
  <div class="search-box">
  <div class="border-line">
                                <img width="221" height="125" alt="" class="img-responsive" src="silverhat_games/game_image/dothedive.png">
                                </div>
  <h3>Game1</h3>
  <p>sssssd</p>
  
  
  
  </div>
  </div>
  

  
   </div>
   
</div>
     </div>
      <?php 
      include("rightadds.php");
      ?>
    </div>
    
    
    	<?php 
include("featured-games.php");
?>
    </div>
</div>



<?php
include("footer.php");
?>






</body>
</html>