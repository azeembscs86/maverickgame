<?php
if(isset($_REQUEST['email']))
{
include("dbconnection.php");
}else
{
    header("location:index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game|Reset Password</title>
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
<img src="assets/images/baninner/dothedive.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-sm-9">
      <div class="box-inner"> 
           <h2>Forgot <span>Password</span></h2>
           <?php
                if (isset($_REQUEST['reset'])) {
                    ?>    
                  <p class="success" align="center">Your Password has been changed Please Login with Your New Password</p>
                  <?php
                }
                ?>
                <?php
                $email=urldecode($_REQUEST['email']);
		$passkey=$_REQUEST['passkey'];
		$result=getUserByEmail($email);
		$user=mysql_fetch_array($result);
                ?>
           <div style="width:500px; margin:0 auto;">
             <form action="resetmaverickpassword.php" method="post" id="userLogin" name="userLogin">
                 <input type="hidden" class="form-control" name="userId" value="<?php echo $user['id']; ?>" />
                                <input type="hidden" class="form-control" name="email" value="<?php echo $user['email']; ?>" />
                                <input type="hidden" class="form-control" name="passkey" value="<?php echo $passkey; ?>" />
             <div class="contact-frm">
              <p> 
                <div class="leftBox">
                  <div class="row">
                  <div class="col-lg-12">
                  <label>New Password</label>
                  <input type="password" class="form-control" plzceholder="Enter your new password" value="" name="password" id="password"/>
                  </div>
                  </div>
                 </div>
              
              
              <div class="leftBox">
                <div class="row">
                  <div class="col-lg-12">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" plzceholder="Enter your confirm password" value="" name="confirm_password" id="confirm_password"/>
                  </div>
                </div>
                </div>
             </p>
             
             <input type="submit" value="Submit" class="btnread" name="submit" /> 
           
             </div> 
                 
           </form>
   </div>
   
            
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

<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
            $().ready(function() {
                $("#userLogin").validate({
                    rules: {
                        password: {
                            required: true
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {                        
                        password: {
                            required: "Please enter a password"
                        },
                        confirm_password: {
                            required: "Please enter confirm password",
                            equalTo: "Please enter the same password as above"
                        }
                        
                    }
                });
                $("#password").focus(function() {
                    var password = $("#password").val();
                    var email = $("#email").val();
                    if(password && email && !this.value) {
                        this.value = password + "." + email;
                    }
                });
            });
        </script>
        <style>
.error {
	color: #FF0000;
	font-size: 11px;
	font-weight: normal;
	padding-left: 29px;
}
.error1 {
	color: #FF0000;
	font-size: 14px;
	font-weight: bold;
	padding-left: 29px;
}
</style>



</body>
</html>