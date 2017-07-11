<?php
session_start();
include("dbconnection.php");
$email=  mysql_real_escape_string($_REQUEST['user_email']);
$hostname="http://".$_SERVER['HTTP_HOST'];
$result= getUserByEmail($email);
$row=mysql_fetch_array($result);    
if(($row['email']==$email))
{  
    $confirm_code=$row['verificationcode'];
    $subject="Your Password Reset Link";
    $from = "info@maverickgame.com";
    $to = $email;
    $mail_body = "Hi ".$row['name']."<br/><br/> You have requested password for email: ".$email." <br/><br/>Please follow the link, you be will able to reset your password <a href='".$hostname."/maverick-game-reset-password?passkey=$confirm_code&email=$email'><b>Click Here</b></a><br /><br />Kind Regards,<br/><br/>The Maverick Game Team";
    $body = wordwrap($mail_body,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  	    $headers .= "From: " . $from ."\r\n";
            //$headers .= 'Bcc: raheelaslam@golive.com.pk, azeem.akram78@gmail.com' . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";   
    mail($to,$subject,$body,$headers);
    header("location:maverick-forgotpassword?success");         
}else
{
   header("location:maverick-forgotpassword?err");
}
?>