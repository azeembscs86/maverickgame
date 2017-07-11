<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Maverick Game Payments</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){

   $(".top-left-btn a").on("click", function(){
	 
	$(".top-left-btn a").toggleClass("active");
	 $(".hide-dropdown").slideToggle();
	 
	});
	
	});
</script>
<script src="//fortumo.com/javascripts/fortumopay.js" type="text/javascript"></script>

<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
    <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<!--[if IE 8]>
    <script type="text/javascript" src="/assets/js/html5.js"></script>
    <html lang="en" class="ie ie8">
<![endif]-->

<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body class="home">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=481352955356475";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 
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
<img src="assets/images/baninner/wordster.jpg" width="1366" height="230" class="banpic" alt="">
</div>
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9">
        <div class="box-inner">
          <div class="col-md-12">
          <h2 class="hd-main">Payment Method</h2>
          <div class="alert alert-info" role="alert">Coins are required to play Games and earn reward points. Choose the payment method that is most convenient to you. <br><strong>1 Coin is for Rs.5.</strong></div>
          </div>
          <div class="clearfix"></div>
          <?php
          if(isset($_SESSION['user_loged_id']))
          {
           ?>
           <div class="col-md-8">
           <h3>Through Mobile Balance</h3>
            <p>Pay through Mobile Balance. Telenor customers can purchase coins by their mobile balance, <a id="fmp-button" href="#" rel="478545efd0303c4f7e0d662b26995304?cuid=<?php echo  $_SESSION['user_loged_id']; ?>">clickhere.</a></p>
           </div>
          <div class="col-md-4"> 
          <a id="fmp-button" href="#" rel="478545efd0303c4f7e0d662b26995304?cuid=<?php echo  $_SESSION['user_loged_id']; ?>"><img src="assets/images/fortumo.png" class="img-responsive" alt="Mobile Payments by Fortumo" border="0" /> </a>
          </div>
          <?php
          }else
          {
              ?>
           <div class="col-md-8">
           <h3 class="hd-main">Through Mobile Balance</h3>
            <p>Pay through Mobile Balance. Telenor customers can purchase coins by their mobile balance, <a href="maverick-game-user-login" rel="">clickhere.</a></p>
           </div> 
          <div class="col-md-4"> <a href="maverick-game-user-login" rel=""><img src="assets/images/fortumo.png" class="img-responsive" alt="Mobile Payments by Fortumo" border="0" /> </a>
          </div>
          <?php
          }
          ?>
          <div class="clearfix"></div><br>
          <hr><br>
          <div class="col-md-4">
			<a href="purchase-coins"><img src="assets/images/easypaisa.png" class="img-responsive" alt="" /></a>
          </div>
          <div class="col-md-8">
          <h3 class="hd-main">Through Debit / Credit Card</h3>
            <p>Pay easily via debit/credit card or pay through money transfer. Click above and follow simple instruction. ( Coming Soon) </p>
          </div>
          <div class="clearfix"></div><br>
          <hr><br>
          <div class="col-md-8">
           <h3 class="hd-main">Through Scratch Card</h3>
            <p> Scratch cards are available only at selected outlets, click above to enter scratch card number <a href="scratch-card-payment">clickhere.</a></p>
          </div>
          <div class="col-md-4"><a href="scratch-card-payment"><img src="assets/images/scratch-card.jpg" class="img-responsive" alt="" /></a>
          </div>
          <div class="clearfix"></div>
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
include("footer-main.php");
updateFortomoCoins();
?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58113944-9', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>