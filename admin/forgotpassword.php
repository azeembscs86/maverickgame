<?php
session_start();
include("dbconnection.php");
$email  = clean($_REQUEST['email']);
$hostname="http://".$_SERVER['HTTP_HOST']."/beta";
$result=getUserByEmail($email);
$row=mysql_fetch_array($result);        
if(($row['email']==$email))
{  
    $confirm_code=$row['verificationcode'];
    $subject="Your Password Reset Link";
    $from = "admin@thefunkids.com";
    $to = $email;
    $mail_body = "Hi ".$row['fullname']."<br/><br/> You have requested password for email: ".$email." <br/><br/>Please follow the link you will able to reset your password <a href='".$hostname."/resetpassword.php?passkey=$confirm_code&email=$email'><b>Click Here</b></a><br /><br /> Thank You,<br /><br />The Fun Kids <br /><br />Kind Regards,";
    $body = wordwrap($mail_body,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  	    $headers .= "From: " . $from ."\r\n";
            $headers .= 'Bcc: raheelaslam@golive.com.pk, azeem.akram78@gmail.com' . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";   
    mail($to,$subject,$body,$headers);
   header("location:forgot_password.php?success");             
}else
{
   header("location:forgot_password.php?msg");
}
?>
