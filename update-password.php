<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id'];
 $user_detail=getUserById($_SESSION['user_loged_id']);
 $user=  mysql_fetch_array($user_detail);  
}else
{
    header("location:maverick-game-user-login");
}
?>
    
<!DOCTYPE HTML>
<html>
<head>

<title><?php echo $_SESSION['loged_fullname']; ?>'s Profile</title>
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
<img src="assets/images/baninner/master-cook.jpg" width="1366" height="230" class="banpic" alt="">
</div>
	<div class="container">
    <div class="row">
     <div class="col-md-9">
     <div class="box-inner">
     
     <h2 class="hd-main">Update Password</h2>

   
<div class="score-tabs">
  <ul>
    <li><a href="maverick-user-profile">Personal Information</a></li>
    <li><a class="active" href="update-password">Update Password</a></li>
    <li><a href="user-games-point">User Points</a></li>
    <li><a href="user-game-score">User Score</a></li> 
    <!--<li><a href="user-rewards">User Rewards</a></li>-->
    <li><a href="user-profile-picture.php">Upload Image</a></li>  
  </ul>
<div class="clearfix"></div>
  <?php
if(isset($_REQUEST['change']))
{
?>
     <div class="success" align="center">Your password has successfully changed,Please Logout and Login with your new password. </div>   
<?php
}
?>
<?php
if(isset($_REQUEST['msg']))
{
?>
     <div class="error1" align="center">Your old password does not match please enter correct old password. </div>   
<?php
}
?>

   
  <div id="tabs-2">
  
  <div class="con-div">
  <div class="row">
  <div class="col-md-2 col-md-3">  
  <div class="display-img">
  <?php 
			if($user['photo']=="")
			{
                            if($user['gender']=='male')
      {
  ?>
   <img src="user_images/male.jpg">
   <?php
      }if($user['gender']=='female')
      {
 ?>
   <img src="user_images/female.jpg">
<?php   
      }
			?>
              
              <?php 
			}else{
			?>
             <img src="user_images/<?php echo $user['photo']; ?>">
              <?php
			}
			?>
  </div>
   </div>
   <div class="col-md-9 col-sm-3">
   <div class="display-con">
    <h3>Update Password</h3>
    <table class="updatepass">
    <form action="update-user-password.php"  id="resetPasswordform" name="resetPasswordform" method="post" class="dialog">
    <tbody>
    <tr>
        <td><input type="hidden" name="user_loged_id" value="<?php echo $user['id'];  ?>"></td>
        </tr>
        <tr>
    <td><fieldset id="fieldset-old-password" style="display: block; ">
      <label for="reset-old-password">Current Password</label>
      <input class="form-control" id="old_password" type="password" name="old_password"  tabindex="10">
      <div class="show-error"></div>
    </fieldset></td>
     </tr>
    <tr>
    <td><fieldset id="fieldset-new-password">
      <label for="reset-new-password">
        New Password
      </label>
      <input id="new_password" type="password" name="new_password" tabindex="20" class=" form-control kabam-form-error">
      <div class="show-error"></div>
    </fieldset></td>
     </tr>
    <tr>
    <td><fieldset id="fieldset-confirm-password">
      <label for="reset-confirm-password">
        Confirm Password
      </label>
      <input class="form-control" id="confirm_password" type="password" name="confirm_password" tabindex="30">
      <div class="show-error"></div>
    </fieldset></td> 
     </tr>
    <tr>   
    <td>
    <input class="btnread" style="line-height:20px;" id="reset-form-submit" name="updatepassword" tabindex="40" type="submit" value="Change Password"><a href="index.php" style="margin:0 0 0 10px; display:inline-block;"><button class="btnread">Home</button></a></td>
     </tr>
    </tbody>
</form>
 </table>   
    </div>
      </div>
      </div>
       </div>
      
    </div>
    
    
  
  <div class="clearfix"></div>
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

<script src="assets/js/jquery.validate.js" type="text/javascript"></script>	
       
                <script type="text/javascript">
            $().ready(function() {
                $("#resetPasswordform").validate({
                    rules: {   
                        old_password: {
                            required: true
                        },
                        new_password: {
                            required: true
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#new_password"
                        }
                    },
                    messages: {                       
                        old_password: {
                            required: "Please enter your old password"
                        },
                        new_password: {
                            required: "Please enter your new password"
                        },
                        confirm_password: {
                            required: "Please enter confirm password",
                            equalTo: "Please enter the same password as above"
                        }
                        
                    }
                });
                $("#old_password").focus(function() {
                    var old_password = $("#old_password").val();
                    var new_password = $("#new_password").val();
                    if(old_password && new_password && !this.value) {
                        this.value = old_password + "." + new_password;
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