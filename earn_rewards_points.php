<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Earn Points | Maverick Game</title>
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
<div class="leader-area">
  <div class="container">
    <div class="row">
    <div class="col-md-1 col-sm-1"></div>
      <div class="col-md-9 col-sm-9">
        <div class="leader-wrap">
        <h2>How to Earn Points </h2>
        <?php
include("points-navigation.php");?>
        <div class="clearfix"></div>
        <br/>
        <div class="row">

          <div class="col-md-4" align="center">
          <img class="img-responsive" src="assets/images/play-game.png">
          <p class="white">Earn 5 points for every day that you play on Kabam.com.* <br/>You can even earn bonus points! </p>
          </div>
          
          <div class="col-md-4" align="center">
          <img class="img-responsive" src="assets/images/login-bonus.png">
          <p class="white">Earn 50 bonus points for playing 7 days in a row! </p>
          </div>

          <div class="col-md-4" align="center">
          <img class="img-responsive" src="assets/images/surprise-bonuses.png">
          <p class="white">You never know when you'll get an extra bonus just for playing. Make sure to play every day and you could be the lucky winner! </p>
          </div>

          </div>

          <div class="currency-wrap"  align="center">
          <div class="row">
      
          
          <div class="col-md-12" align="center">
          
          <img src="assets/images/game-currency.png" class="img-responsive">

          <h3 class="heading4">Purchase In-Game Currency!</h3>
           

<p class="white">Earn 10 points for every $1 (US Dollar) you spend on a purchase of in-game currency at mavericgame.com. We'll even give you DOUBLE POINTS on your first purchase as a Rewards Program member and any purchase over $49.00!</p> 
          </div>
          </div>
          
          </div>
          
          
            <div class="row" align="center">
            <div class="col-lg-12">
            <p class="white">Don't waste time. Keep earning points to redeem for valuable in-game currency! </p>
            <a href="index.php" class="button large game" style="float:none;">PLAY NOW</a>
            <br/><br/>
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