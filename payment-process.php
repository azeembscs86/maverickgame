<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
     $user_payements=  getUserById($_SESSION['user_loged_id']);
     $user_payement=  mysql_fetch_array($user_payements);    
     if(isset($_REQUEST['package_id'])){
     $package_id=$_REQUEST['package_id'];
     $user_id=$_SESSION['user_loged_id'];
     $rand = strtoupper(substr(uniqid(sha1(time())),0,6));
     $unique = $rand;
     addNewOrders($user_id,$package_id,$unique);     
     $view="select * from maverick_packages where package_id=$package_id";
     $show=mysql_query($view);
     $row=mysql_fetch_array($show);
     if( date('d') == 31 || (date('m') == 1 && date('d') > 28)){
    $date = strtotime('last day of next month');
    
} else {
    $date = strtotime('+1 months');
}
     }else
     {
        header("location:purchase-coins");  
     }
     
}
else
{
    header("location:maverick-game-user-login");
}

?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game Payments</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<script src="//fortumo.com/javascripts/fortumopay.js" type="text/javascript"></script>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body>
<?php
include("user-login-menus.php");
?>
<?php
include("sidebarlinks.php");
?>

<?php
$user_orders=getUserOrderByUser($user_id,$package_id);
$user_order=  mysql_fetch_array($user_orders);
?>
<div class="leader-area">
	<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
     <div class="col-md-9 col-sm-9">
      <div class="leader-wrap" style="min-height:300px;"> 
      <h2>Payment Method</h2>
 <div class="clearfix"></div><br>
<p class="white">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p><br>
<form action=" http://202.69.8.50:9080/easypay/Index.jsf " method="POST" target="_blank">
<input name="storeId" value="862" type="hidden" hidden = "true"/>
<div class="col-md-5"><h4 class="white nomargin">Number of Coins :  <?php echo $row['package_coins']; ?></h4></div>
<div class="clearfix"></div><br>
<div class="col-md-5"><div class="col-md-6 nopad-left"><p class="white nomargin">Amount You Pay :</p></div>
<div class="col-md-6"><input name="amount" class="form-control" value="<?php echo $row['package_price']; ?>.00" readonly /></div></div>
<div class="clearfix"></div><br>
<input name="orderRefNum" value="<?php echo  $user_order['order_number'];?> " hidden="true"/>
<input type="hidden" value="<?php echo $_SESSION['user_loged_id']; ?>" name="user_id" hidden="true">
<input type="hidden" name="package_id" value="<?php echo $package_id; ?>" hidden="true">
<input name="postBackURL" value="http://www.maverickgame.com/new-version/confirm-payment.php" hidden = "true">
<div class="col-md-3"><input type="submit" class="button large game" value="Proceed"></div>
</form>
  
  
  <div class="clearfix"></div>
   <br/><br/><br/><br/>
   
</div>
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