<?php
session_start();
 include("dbconnection.php");
 $name=  mysql_real_escape_string($_REQUEST['name']);
 $email=  mysql_real_escape_string($_REQUEST['email']);
 $phone_number=  mysql_real_escape_string($_REQUEST['phone_number']);
 $message=  mysql_real_escape_string($_REQUEST['message']);
 $subject="Contact us user details";
 $from = "info@maverickgame.com"; 
 $to = $email;
 $mail_body="Dear $name,<br/><br/> Thank you for contacting us, we have received your message and will revert back in 48 working hours.<br/></br><br/></br>Best Regards <br/><br/>Team Game ";    
 $body = wordwrap($mail_body,2000);
 $mail_user_body="$name,<br/><br/> has contact us with follwing details, <br /><br/>Name:".$name."<br/><br/>Email:".$email."<br/><br/>Phone Number:".$phone_number."<br/></br>Message:".$message."<br/><br/>Regards & Love,<br/><br/>The Maverick Game Team";    
 $body_user = wordwrap($mail_body,2000);
 //$body_user = wordwrap($mail_body_user,70);
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 $headers .= "From: " . $from ."\r\n";
 $headers .= 'Bcc:raheelaslam@golive.com.pk' . "\r\n";
 $headers .= "Reply-To: " . $email . "\r\n";   
 mail($to,$subject,$mail_body,$headers);
 mail($from,$subject,$mail_user_body,$headers);
 header("location:contact-us?thanks");
?>