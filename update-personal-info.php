<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id'];
 $user_detail=getUserById($_SESSION['user_loged_id']);
 $user=  mysql_fetch_array($user_detail);  
}
?> 

<form action="update-user-profile.php" method="post" class="new_personal_info dialog" data-remote="true" id="signUpForm" name="signUpForm">
  <div style="display:none">
    <input name="utf8" type="hidden" value="✓">
    <input name="_method" type="hidden" value="put">
  </div>
  <table class="loginform">
        <tr>
            <td colspan="2">
  <input type="hidden" class="form-control" name="user_id" value="<?php echo $user['id']; ?>">
  <div id="settings-general-error" class="login-error form-general-error">
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
    <input class="form-control" name="user_name" id="user_name" type="text" value="<?php if(isset($user['user_name'])) echo $user['user_name']; ?>">
    <span class="show-success"></span> <span class="show-error"></span>
  </fieldset>
  </div>
  </td>
    <td><div class="form-group">
  <fieldset class="settings-fieldset">
    <label for="personal_info_email">EMAIL</label>
    <input name="user_email" class="form-control" id="user_email" readonly="readonly" type="text" value="<?php if(isset($user['email'])) echo $user['email']; ?>">
    <span class="show-success"></span> <span class="show-error"></span>
    <?php 
  if($user['isActive']=='no')
  {
  ?>
    <div class="status"><img alt="Alert icon" src="assets/images/alert_icon.png" class="account-img"><span class="fail">Unverified</span></div>
    <?php
  }
  ?>
  </fieldset>
  </div>
  </td>
     </tr>
	
    <tr>
     <td><div class="form-group">
  <fieldset class="settings-fieldset">
    <label for="personal_info_first_name">FULL NAME</label>
    <input name="name" id="name" class="form-control" type="text" value="<?php if(isset($user['name'])) echo $user['name']; ?>">
    <span class="show-success"></span><span class="show-error"></span>
  </fieldset></div>
  </td>
    <td><div class="form-group">
  <fieldset class="settings-fieldset">
    <label for="personal_info_username">Phone Number</label>
    <input name="phone_number" class="form-control" id="phone_number" type="text" value="<?php if(isset($user['mobile_number'])) echo $user['mobile_number']; ?>">
    <span class="show-success"></span> <span class="show-error"></span>
  </fieldset>
  </div>
  </td>
     </tr>
	
    <tr>
     <td><div class="form-group">
  <fieldset class="settings-fieldset">
    <label for="personal_info_gender">GENDER</label>
    <select id="personal_info_gender" name="gender" id="gender" class="form-control">
    <option value="none">Select...</option>
    <option value="female" <?php if($user['gender']=='female'){?> selected="selected"<?php } ?>>Female</option>
    <option <?php if($user['gender']=='male'){?> selected="selected"<?php } ?> value="male">Male</option>
    </select>
  </fieldset>
   </div></td>
    <td></td>
     </tr>
    <tr>
     <td>
  <input style="" class="btnread" id="update-profile" name="submit" type="submit" value="Save">
  </td>
    <td></td>
     </tr>
    </table>
</form>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
<script src="js/jquery.validate.js" type="text/javascript"></script> 
<script type="text/javascript">
            $().ready(function() {
                $("#signUpForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength:3
                        },
                        user_email: {
                            required: true,   
                            email: true
                        },
                        user_name: {
                            required: true,   
                            minlength:3
                        },                        
                        phone_number: {
                            required: true,
                            digits:true,
                            minlength:11
                        }
                    },
                    messages: {
                        user_email: {
                            required: "Please enter email address",                           
                            email: "Email address must be in the format of name@domain.com"
                        },
                        name: {
                            required: "Please enter your name",                           
                            minlength: "Name must be atleast 3 letter"
                        },
                        user_name: {
                            required: "Please enter user name",
                            minlength: "user name must be atleast 3 letter"
                        },                        
                        phone_number: {
                            required: "Please enter your mobile number",
                            digits: "Mobile number must be in the format of 03212828275",
                            minlength: "Mobile number must only 11 digits"
                        }
                        
                    }
                });
                $("#user_name").focus(function() {
                    var user_name = $("#user_name").val();
                    var user_email = $("#user_email").val();
                    if(user_name && user_email && !this.value) {
                        this.value = user_name + "." + user_email;
                    }
                });
            });
        </script>