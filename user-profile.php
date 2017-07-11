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
     <h2 class="hd-main">ACCOUNT SETTINGS</h2>
  
<div class="score-tabs">
  <ul>
    <li><a class="active" href="maverick-user-profile">Personal Information</a></li>
    <li><a href="update-password">Update Password</a></li>
    <li><a href="user-games-point">User Points</a></li>
    <li><a href="user-game-score">User Score</a></li> 
    <!--<li><a href="user-rewards">User Rewards</a></li>-->
    <li><a href="user-profile-picture.php">Upload Image</a></li>
  </ul>
<div class="clearfix"></div><br>
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
<?php
if(isset($_REQUEST['profile']))
{
?>
   <div class="btn btn-success" align="center">Your profile has been update successfully. </div>   
<?php
}
?>
   <?php
if(isset($_REQUEST['user']))
{
?>
   <div class="error1" align="center">User Name already exit please enter different user name. </div>   
<?php
}
?>
    <?php
if(isset($_REQUEST['upload']))
{
?>
   <div class="success" align="center">Your image has been uploaded successfuly. </div>   
<?php
}
?>   
  <div id="tabs-1">
  
  <div class="con-div">

  <div class="row">
  <div class="col-md-2">
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
  
   <div class="col-md-9">
   <div class="display-con">
   
    <h3>Personal Information</h3>
 <?php 
    if(!isset($user['user_name']))
    {
    ?>
    <p>Please note username is necessary to play our games.Please enter your username in tab below.</p>
    <?php
    }
    ?>
 
    <div id="user-personal-info" class="new_personal_info dialog" data-remote="true">
    
    <table class="loginform">
        <tr>
            <td colspan="2"><input class="form-control" type="hidden" name="user_id" value="<?php echo $user['id']; ?>"><div id="settings-general-error" class="login-error form-general-error">
      <fieldset class="settings-fieldset">
        <div id="personal_info_general"></div>
        <span class="show-error"></span>
      </fieldset>
    </div></td>
            
        </tr>
   	 <tr>
     <td><div class="form-group">
    <fieldset class="settings-fieldset">
  <label for="personal_info_username">USERNAME</label>
  <input class="form-control" id="personal_info_username" name="user_name" readonly type="text" value="<?php if(isset($user['user_name'])) echo $user['user_name']; ?>">
  <span class="show-success"></span>
  <span class="show-error"></span>
</fieldset>
    </div></td>
    <td><div class="form-group">
    <fieldset class="settings-fieldset">
  <label for="personal_info_email">EMAIL</label>
  <?php
  if(!isset($user['email']))
    {
  ?>
  <input class="form-control" id="personal_info_email" name="user_email"   type="text" value="<?php if(isset($user['email'])) echo $user['email']; ?>">
  <?php
  }else
  {
  ?>
<input class="form-control" id="personal_info_email" name="user_email" readonly type="text" value="<?php if(isset($user['email'])) echo $user['email']; ?>">
  <?php
  }
  ?>
  <span class="show-success"></span>
  <span class="show-error"></span>
  <?php 
  if($user['isActive']=='no')
  {
  ?>  
  <div class="status"><img alt="Alert icon" src="assets/images/alert_icon.png" class="account-img"><span class="fail">Unverified</span></div>
  <?php
  }
  ?>
    </fieldset>
    </div></td>
     </tr>
	
    <tr>
     <td><div class="form-group">
    <fieldset class="settings-fieldset">
  <label for="personal_info_first_name">FULL NAME</label>
  <input class="form-control" id="personal_info_first_name" name="name" readonly type="text" value="<?php if(isset($user['name'])) echo $user['name']; ?>">
  <span class="show-success"></span
  ><span class="show-error"></span>
</fieldset>
</div></td>
    <td><div class="form-group">
<fieldset class="settings-fieldset">
  <label for="personal_info_username">Phone Number</label>
  <input class="form-control" id="personal_info_username" name="phone_number" readonly  type="text" value="<?php if(isset($user['mobile_number'])) echo $user['mobile_number']; ?>">
  <span class="show-success"></span>
  <span class="show-error"></span>
</fieldset>
    </div></td>
     </tr>
	
    <tr>
     <td><div class="form-group">
    <fieldset class="settings-fieldset">
      <label for="personal_info_gender">GENDER</label>
      <select class="form-control" id="personal_info_gender" name="gender"><option value="none">Select...</option>
          <option value="female" <?php if($user['gender']=='female'){?> selected="selected" disabled="disabled"<?php } ?>>Female</option>
<option value="male" <?php if($user['gender']=='male'){?>   disabled="disabled" selected="selected"<?php } ?> >Male</option></select>
    </fieldset>
    </div></td>
    <td></td>
     </tr>
    <tr>
     <td colspan="2"><button class="btnread" id="update-profile" onclick="return updateUserProfile();">Edit</button>
    <a href="index.php" style="margin:0 0 0 10px; display:inline-block;"><button class="btnread">Home</button></a></td>
     </tr>
    </table>

   
    </div>
    
    <div id="user-display-personal-info" style="display:none;"></div>
    </div> 
   </div>
   </div>

    </div> 
  </div>

  
  <div class="clearfix"></div>
  <br/>
</div>
      
     
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
<script type="text/javascript" src="js/usernamevalid.js"></script>
<script>
        function updateUserProfile()
        {  
            var product_gender=1;
    	jQuery.ajax({
			type: "POST",
			url: "update-personal-info.php",
			data: "product_gender="+product_gender,
			success: function(response){
					jQuery("#user-display-personal-info").html(response);
					if(!product_gender)
					{
					jQuery("#user-personal-info").show();
                                        jQuery("#user-display-personal-info").hide();
                                       
			 	}else{
					jQuery("#user-personal-info").hide();
                                        jQuery("#user-display-personal-info").show();
					}
				}
			});
        }
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