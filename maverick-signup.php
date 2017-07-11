<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
    header("location:maverick-user-profile");
}
if(isset($_POST['submit'])){
	// code for check server side validation
	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.		
	}else{// Captcha verification is Correct. Final Code Execute here!		
    $name=  mysql_real_escape_string($_POST['name']);
    $gender=  mysql_real_escape_string($_POST['gender']);
    $email=  mysql_real_escape_string($_POST['email']);
    $phone_number=  mysql_real_escape_string($_POST['phone_number']);
    $country_id=  mysql_real_escape_string($_POST['country_id']);
    $city_id="";
    if($_POST['city_id']=="")
    {
      $city_id=1;
    }
    else if($_POST['city_id']=='other')
     {
        $city_id  = mysql_real_escape_string($_POST['otherlocation']); 
        addNewCity($country_id,$city_id);
        $city_id=mysql_insert_id();
        $cities=getCityById($city_id);
        $city=  mysql_fetch_array($cities);
        $city_name=$city['city_name'];       
     }else
     {
         $city_id  = mysql_real_escape_string($_POST['city_id']); 
         $cities=getCityById($city_id);
         $city=  mysql_fetch_array($cities);
         $city_name=$city['city_name'];        
     }     
    $password=  mysql_real_escape_string(md5($_POST['password']));
    $user_name  =  mysql_real_escape_string($_POST['user_name']);
    $android_app='web_user';
    $month_name = mysql_real_escape_string($_POST['month_name']);
    $day_name = mysql_real_escape_string($_POST['day_name']);
    $year_name = mysql_real_escape_string($_POST['year_name']);    
    $birth_date=$year_name."-".$month_name."-".$day_name;
    $birth_date=  date("Y-m-d",strtotime($birth_date));
    $verificationcode=generateCode(1);
    $activation=md5($email.time());  
    $user_register=  getUserByEmail($email);     
    $user=  mysql_fetch_array($user_register);
    registerNewUser($name,$email,$user_name,$password,$gender,$birth_date,$city_name,$phone_number,$activation,$verificationcode,$android_app,$country_id,$city_id);    
    $last_users=getLastRegisterUser();
    $last_user=  mysql_fetch_array($last_users);
    $registration_points=5;
    createUserGameCoins($last_user['id'],$registration_points);    
    $base_url="https://www.maverickgame.com/activation.php?code=".$activation;
    $subject="Registration successful, please activate email at Maverick Game";
    $from = "info@maverickgame.com";
    $email_server="info@maverickgame.com"; 
    $to = $email;
    $mail_body="Dear $name,<br/><br/>You have embarked on a journey where your role will change along with the game you choose to play. From here onwards this portal is your abode and you are destined to achieve greatness. Greatness bigger than what you had fathomed this is your true calling. <br/> <br/> You are new here but remember you are the chosen one. Competition will be ruthless and the going will get difficult. You may win some and you may lose some. Your ranking is down low and reaching top will be difficult. It may take time for you to master the game but remember that greatness is achieved by perseverance and not just through talent.<br/><br/>So proceed to your first game and make your way to the top of leaderboard. Riches and glory await you, Chosen One.<br/><br/><a href=".$base_url.">.$base_url.'</a>' <br/><br/>Your game score gives you reward points, through which you can redeem real life products ranging from Mobile scratch card to a Mercedes Benz. Better you play more rewards you get !<br/></br><br/>Regards,<br/><br/>Team Maverick Game<br><br>For any queries please write to us : info@maverickgame.com";    
    $body = wordwrap($mail_body,2000);
    //$body_user = wordwrap($mail_body_user,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  	    $headers .= "From: " . $from ."\r\n";
            $headers .= 'Bcc:raheelaslam@golive.com.pk ,amohsin@golive.com.pk,info@maverickgame.com' . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";   
    //------------------------Thanks You Email-------------------------------------------------------------------        
    mail($to,$subject,$mail_body,$headers);      
    //mail($email_server,$subject,$mail_body,$headers);
    header("location:game-register-message");
    }    
    		
	}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Maverick Game | Sign Up</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
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
		<h2 class="hd-main">JOIN <span>MAVERICK GAME</span></h2>
          <p>Already have an account? <a href="maverick-game-user-login">Login</a></p>
          <?php
    if(isset($_REQUEST['register']))
    {
    ?>
          <div class="error"><strong>This Email ID already exist in our system, please use a different ID for new Signup</strong> </div>
          <?php
    }
    ?>
          <form  action="" method="post" id="signUpForm" name="signUpForm">
            <div class="contact-frm nopad">
            <h3>Create an account </h3>
            <hr>
            <div class="row">
                  <div class="col-md-2">
                    <label>Name *</label>
                  </div>
                  <div class="col-md-8">
                      <input class="form-control" type="text" id="name" name="name" value="<?php if(isset($name)) echo $name; ?>"/>
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="col-md-2">
                    <label for="email">Email *</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="email" value="<?php if(isset($email)) echo $email; ?>" id="email" autocomplete="off">
                  </div>
                </div>
            <span id="result_email"></span>
            <hr>
            <div class="row">
                  <div class="col-md-2">
                    <label for="username">Username *</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="user_name" value="<?php if(isset($user_name)) echo $user_name; ?>" id="user_name" autocomplete="off">
                  </div>
                <span id="result_user"></span> 
				<div class="clearfix"></div><br>
                  <div class="col-md-2">
                    <label>Phone Number *</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="phone_number" value="<?php if(isset($phone_number)) echo $phone_number; ?>" id="phone_number" autocomplete="off"/>
                  </div>
                <span id="result_phone_number"></span> 
            </div>
            <hr>
            <div class="row">

                  <div class="col-md-2">
                    <label>Password *</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="password" value="<?php if(isset($password)) echo $password; ?>" id="password" name="password"/>
                  </div>
<div class="clearfix"></div><br>
                  <div class="col-md-2">
                    <label>Confirm Password *</label>
                  </div>
                  <div class="col-md-8">
                    <input class="form-control" type="password" id="confirm_password" value="<?php if(isset($password)) echo $password; ?>" name="confirm_password"/>

              </div>
            </div>
            <div class="row">

                  <div class="col-md-2">
                    <label>Gender *</label>
                  </div>
                  <div class="col-md-8 nopad-right">
                    <select class="form-control" name="gender" id="gender" style="width:97.5%;">
                      <option value="">Select</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
<div class="clearfix"></div>
                  <div class="col-md-2">
                    <label>Birthday *</label>
                  </div>
                  <div class="col-md-8 nopad-right">
                    <select class="form-control month" name="month_name" id="month_name" style="float:left; width:30%;">
                    <option value="january">JAN</option>
                    <option value="february">FEB</option>
                    <option value="march">MARCH</option>
                    <option value="april">APRIL</option>
                    <option value="may">MAY</option>
                    <option value="june">JUNE</option>
                    <option value="july">JULY</option>
                    <option value="august">AUGUEST</option>
                    <option value="september">SEPTMBER</option>
                    <option value="october">OCTOBER</option>
                    <option value="novmber">NOVEMBER</option>
                    <option value="december">DECEMBER</option>
                    </select>
                    <select class="day form-control" name="day_name" id="day_name" style="float:left; width:30%; margin-right:3.5%; margin-left:3.5%;">
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                    <select class="year form-control" name="year_name" id="year_name" style="float:left; width:30.5%;">
                      <option value="1925">1925</option>
                      <option value="1926">1926</option>
                      <option value="1927">1927</option>
                      <option value="1928">1928</option>
                      <option value="1929">1929</option>
                      <option value="1930">1930</option>
                      <option value="1931">1931</option>
                      <option value="1932">1932</option>
                      <option value="1933">1933</option>
                      <option value="1934">1934</option>
                      <option value="1935">1935</option>
                      <option value="1936">1936</option>
                      <option value="1937">1937</option>
                      <option value="1938">1938</option>
                      <option value="1939">1939</option>
                      <option value="1940">1940</option>
                      <option value="1941">1941</option>
                      <option value="1942">1942</option>
                      <option value="1943">1943</option>
                      <option value="1944">1944</option>
                      <option value="1945">1945</option>
                      <option value="1946">1946</option>
                      <option value="1947">1947</option>
                      <option value="1948">1948</option>
                      <option value="1949">1949</option>
                      <option value="1950">1950</option>
                      <option value="1951">1951</option>
                      <option value="1952">1952</option>
                      <option value="1953">1953</option>
                      <option value="1954">1954</option>
                      <option value="1955">1955</option>
                      <option value="1956">1956</option>
                      <option value="1957">1957</option>
                      <option value="1958">1958</option>
                      <option value="1959">1959</option>
                      <option value="1960">1960</option>
                      <option value="1961">1961</option>
                      <option value="1962">1962</option>
                      <option value="1963">1963</option>
                      <option value="1964">1964</option>
                      <option value="1965">1965</option>
                      <option value="1966">1966</option>
                      <option value="1967">1967</option>
                      <option value="1968">1968</option>
                      <option value="1969">1969</option>
                      <option value="1970">1970</option>
                      <option value="1971">1971</option>
                      <option value="1972">1972</option>
                      <option value="1973">1973</option>
                      <option value="1974">1974</option>
                      <option value="1975">1975</option>
                      <option value="1976">1976</option>
                      <option value="1977">1977</option>
                      <option value="1978">1978</option>
                      <option value="1979">1979</option>
                      <option value="1980">1980</option>
                      <option value="1981">1981</option>
                      <option value="1982">1982</option>
                      <option value="1983">1983</option>
                      <option value="1984">1984</option>
                      <option value="1985">1985</option>
                      <option value="1986">1986</option>
                      <option value="1987">1987</option>
                      <option value="1988">1988</option>
                      <option value="1989">1989</option>
                      <option value="1990">1990</option>
                      <option value="1991">1991</option>
                      <option value="1992">1992</option>
                      <option value="1993">1993</option>
                      <option value="1994">1994</option>
                      <option value="1995">1995</option>
                      <option value="1996">1996</option>
                      <option value="1997">1997</option>
                      <option value="1998">1998</option>
                      <option value="1999">1999</option>
                      <option value="2000">2000</option>
                      <option value="2001">2001</option>
                      <option value="2002">2002</option>
                      <option value="2003">2003</option>
                      <option value="2004">2004</option>
                      <option value="2006">2006</option>
                      <option value="2006">2006</option>
                      <option value="2007">2007</option>
                      <option value="2008">2008</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
                      <option value="2014">2014</option>
                      <option value="2015">2015</option>
                    </select>
                  </div>
			</div>
             <hr>
            <div class="row">
                  <div class="col-md-2">
                    <label>Countries *</label>
                  </div>
                  <div class="col-md-8 nopad-right">
                    <select class="form-control" name="country_id" id="country_id" onchange="return getCities();" style="width:97.5%;">
                      <option value="">Select your country</option>
                      <?php 
                      $countries=  getAllCountries();
                      if($countries>0)
                      {
                          while($country=  mysql_fetch_array($countries))
                          {
                       ?>
                      <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                      <?php
                          }
                      }
                      ?>                      
                    </select>
                  </div>
                
                 
            </div> 
                      
             <div id="province_cities"></div>
             
            <div class="clearfix"></div><br>
            <table width="400" border="0" cellpadding="5" cellspacing="1" class="table" align="center">
            <?php if(isset($msg)){?>
            <tr>
              <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
            </tr>
            <?php } ?>
            <tr>
              <td><div class="row">
                  <div class="col-md-3">
                    <label>Validation code:</label>
                    <br>
                    <img style="margin:5px 0 0" src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
                    
                    </div>
                  <div class="col-md-6">
                    <label for='message'>Enter the code above here :</label>
                    <input id="captcha_code" class="form-control" style="width:150px;" name="captcha_code" type="text">
                    <label>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</label>
                  </div>
                  <div class="clearfix"></div>
                  <hr>
                  <div class="col-md-6">
                      <input id="agree" name="agree" type="checkbox">
                      <label for='message'> I have read and agree to the <a href="terms-conditions">Terms &amp; Conditions</a></label>
                    </div>
                    <div class="col-md-6">
                    <input type="submit" value="Submit" class="btnread" name="submit" />
                  </div>
                  </div>
                </td>
            </tr>
            </table>
            
            </div>
            </form>
            </div>
          </div>
<div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarpoints.php");
	  ?>
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
<script src="js/jquery.validate.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/usernamevalid.js"></script> 
<script type="text/javascript">
            $().ready(function() {
                $("#signUpForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        user_name: {
                            required: true,
                            minlength: 3
                        },
                        password: {
                            required: true
                        },                        
                        country_id: {
                            required: true
                        },
                        city_id: {
                            required: true
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#password"
                        },
                        phone_number: {
                            required: true,
                            digits: true,
                            minlength: 11
                        },
                        agree: "required"
                    },
                    messages: {
                        email: {
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
                        password: {
                            required: "Please enter a password"
                        },
                        country_id: {
                            required: "Please select your country"
                        },
                        city_id: {
                            required: "Please select your city"
                        },
                        confirm_password: {
                            required: "Please enter confirm password",
                            equalTo: "Password does not match"
                        },
                        phone_number: {
                            required: "Please enter your mobile number",
                            digits: "Mobile number must be in the format of 03212828275",
                            minlength: "Mobile number must only 11 digits"
                        },
                        agree: "Please accept our policy",

                    }
                });
                $("#password").focus(function() {
                    var password = $("#password").val();
                    var email = $("#email_check").val();
                    if (password && email && !this.value) {
                        this.value = password + "." + email;
                    }
                });
            });
        </script> 
        <script>
function getCities()
{
   var country_id=document.getElementById('country_id').value;  
   var optionValue =country_id;
   jQuery.ajax({
   	  type: "POST",
    	  url: "getcities.php",
    	  data: "country_id="+country_id,
    	  success: function(response){
	  jQuery("#province_cities").html(response);
  	   if(!optionValue)
  	   {
		jQuery("#province_cities").hide();                               
   	  }else
  	  {
		jQuery("#province_cities").show();                 
          }
	}
        });	
}
</script>

<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script> 

</body>
</html>