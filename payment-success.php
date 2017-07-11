<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id']; 
}else
{
    header("location:maverick-game-user-login");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Maverick Game Payment Success</title>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
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
<img src="assets/images/baninner/crisis.jpg" width="1366" height="230" class="banpic" alt="">
</div>

<div class="container">
  <div class="row">
    <div class="col-md-9 col-sm-9">
      <div class="box-inner">
<h2 class="hd-main">Thank You</h2>
        <h3 class="text-center">
            <?php
            $session_id= $_SESSION['user_loged_id']; 
            $user_coins=getLogedUserCoins($session_id);
            $user_coin=  mysql_fetch_array($user_coins);
            if($user_coin['fortomo_coins']>0)
            {
            ?>            
            You have successfully purchase Coins, Proceed to games and win rewards points through your games score,<br>
			Best of Luck
           <?php
            }else
            {
           ?>
            You have not buy coins please try again.................
         	<?php   
            }
           ?>
        
        </h3>
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
<script> 
  $( document ).ready(function() { 
   var delay = 5000; //Your delay in milliseconds  
   var URL="game-package-payment";
   setTimeout(function(){ window.location = URL; }, delay);
});
 
  </script>
</body>
</html>

