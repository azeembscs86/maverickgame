<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
    header("location:maverick-user-profile");
}
?>
<!DOCTYPE HTML>
<html>
<head>


<title>Maverick Game | Login</title>
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
<img src="assets/images/baninner/furiousred.jpg" width="1366" height="230" class="banpic" alt="">
</div>
    <div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
      <div class="box-inner"> 
             <h2 class="hd-main">LOG IN</h2><br>
			<p>New User SignUp? <a href="maverick-game-user-register">SignUp</a> </p>
            <hr>
             <?php
                if (isset($_REQUEST['reset'])) {
                    ?>    
                    <p class="success" align="center">Your Password has been changed Please Login with Your New Password</p>
                    <?php
                }
                ?>
             <form action="user_login.php" method="post" id="userLogin" name="userLogin" enctype="multipart/form-data">
                  <div class="loginbox">
                  <div class="row">
                  <div class="col-md-3">
                  <label>User name/Email</label>
                  </div>
                  <div class="col-md-8">
                  <input type="text" class="form-control" placeholder="Email Address" value="" name="user_email" id="user_email"/>
                  </div>
                  <div class="clearfix"></div><hr>
                  <div class="col-md-3">
                  <label>Password</label> 
                  </div>
                  <div class="col-md-8">
                 <input type="password" class="form-control" placeholder="Password" value="" id="password" name="user_password"/> 
                  </div>
<div class="clearfix"></div><hr>
             <div class="col-md-3"></div>
             <div class="col-md-5">
             <div class="col-md-4"><input type="submit" value="Login" name="" class="btnread" /> </div>
             <div class="col-md-7"><a href="maverick-game-user-register" class="btnread" style="text-decoration:none">Sign Up</a> </div>
             </div>
             <div class="col-md-4">
             <span class="forgetpass"><a href="maverick-forgotpassword" class="forget-popup">Forgot Password?</a></span></div>
             </div>
                  
            </div>  
           </form>

           

            
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

</body>
</html>