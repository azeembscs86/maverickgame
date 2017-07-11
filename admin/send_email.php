<?php
 session_start();
 include("dbconnection.php");
 $name  =$_REQUEST['name'];
 $email  =$_REQUEST['email'];
 $subject=$_REQUEST['subject'];
 $body = $_REQUEST['message'];
 $from = "info@maverickgame.com";
 $to = $email;
 $mail_body = "Hi ".$name."<br/><br/>".$body."<br/><br />Kind Regards,<br/><br/>The Maverick Game Team";
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
 $headers .= "From: " . $from ."\r\n";
 //$headers .= 'Bcc: raheelaslam@golive.com.pk, info@maverickgame.com' . "\r\n";
 $headers .= "Reply-To: " . $email . "\r\n";   
 mail($to,$subject,$mail_body,$headers);
 header("location:register-users.php?msg=success"); 
?>