<?php
session_start();
include("dbconnection.php");
$errors = '';
$name = '';
$email = '';
$phone_number = '';
$message = '';
if(isset($_POST['submit']))
{	
 $name=  mysql_real_escape_string($_REQUEST['name']);
 $email=  mysql_real_escape_string($_REQUEST['email']);
 $phone_number=  mysql_real_escape_string($_REQUEST['phone_number']);
 $message=  mysql_real_escape_string($_REQUEST['message']);
	///------------Do Validations-------------
	if(empty($name)||empty($email))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $email;
 $subject="Contact us user details";
 $from = "support@maverickgame.com"; 
 $mail_body="Dear $name,<br/><br/> Thank you for contacting us, we have received your message and will revert back in 48 working hours.<br/></br><br/></br>Best Regards <br/><br/>Team Game ";    
 $body = wordwrap($mail_body,2000);
 $mail_user_body="$name,<br/><br/> has contact us with follwing details, <br /><br/>Name:".$name."<br/><br/>Email:".$email."<br/><br/>Phone Number:".$phone_number."<br/></br>Message:".$message."<br/><br/>Regards & Love,<br/><br/>Team Maverick Game";    
 $body_user = wordwrap($mail_body,2000);
 $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';		
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 $headers .= "From: " . $from ."\r\n";
 $headers .= 'Bcc:raheelaslam@golive.com.pk' . "\r\n";
 $headers .= "Reply-To: " . $email . "\r\n";   
 mail($to,$subject,$mail_body,$headers);
 mail($from,$subject,$mail_user_body,$headers);
 header("location:contact-us?thanks");
}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>

<!DOCTYPE HTML>
<html>
<head>


<title>Maverick Game | Contact Us</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<style type="text/css">
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
  <h2 class="hd-main">Contact Us</h2>
   <?php
                if (isset($_REQUEST['thanks'])) {
                    ?>    
                   <p class="mrg-lft-100"> Thank you for contacting us. Our team will get back to you very soon</p>
                    <?php
                }
                ?>   
 <div class="row">
 
 <div class="col-md-8">
   <form class="contact-frm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="contactForm" id="contactForm">
       <input class="form-control" type="text" placeholder="Enter your name"  name="name" id="name" value="<?php echo htmlentities($name) ?>"/>
       <input class="form-control" type="text" placeholder="Enter your email"  name="email" id="email" value="<?php echo htmlentities($email) ?>"/>
       <input class="form-control" type="text" placeholder="Enter your contact number"  name="phone_number" id="phone_number" value="<?php echo htmlentities($phone_number) ?>"/>
       <textarea class="form-control" rows="10" name="message" id="message" placeholder="Enter your message"><?php echo htmlentities($message) ?></textarea>
   <p>
<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
<label for='message'>Enter the code above here :</label><br>
<input id="6_letters_code" name="6_letters_code" type="text"><br>
<div id='contact_form_errorloc' class='err'></div> 
<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
</p>
<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>
       <input type="submit" name="submit" id="submit" value="Send" class="btnread" />
   </form>
   </div>
   
   <div class="col-md-4">
   
   <div>
<h3>Address :</h3>
<p> Office Address: 2nd Floor, Building # 129C, 
9th Commercial Street,Defence Phase IV, Karachi.</p>
<hr>
<p><strong>Phone : </strong>+92 3322136181 / +92 3458505713<br />
<strong>Email :</strong> <a href="mailto:info@maverickgame.com">info@maverickgame.com</a> </p>
<ul class="social-icons pull-right">
        <li class="first"><a href="https://www.facebook.com/game.maverick" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
        <li><a href="https://plus.google.com/b/108438942958324909410/108438942958324909410/about" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
        <li><a href="https://twitter.com/GameMaverick" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
        <li class="last"><a href="https://www.pinterest.com/maverickgame/" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
      </ul>
 
   </div>
   </div>
   
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
<script src="js/jquery.validate.js" type="text/javascript"></script>	
 <script type="text/javascript" src="js/usernamevalid.js"></script>      
                <script type="text/javascript">
            $().ready(function() {
                $("#contactForm").validate({
                    rules: {
                        email: {
                            required: true,   
                            email: true
                        },
                        name: {
                            required: true                            
                        },
                        message: {
                            required: true
                        },
                        phone_number: {
                            required: true                       
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter email address",                           
                            email: "Email address must be in the format of name@domain.com"
                        },
                        name: {
                            required: "Please enter your name",
                        },
                        message: {
                            required: "Please enter your message"
                        },
                        phone_number: {
                            required: "Please enter your contact number"                          
                        }
                        
                    }
                });
                $("#email").focus(function() {
                    var name = $("#name").val();
                    var email = $("#email").val();
                    if(name && email && !this.value) {
                        this.value = name + "." + email;
                    }
                });
            });
        </script>
        <script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
 var img = document.images['captchaimg'];
 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</body>
</html>