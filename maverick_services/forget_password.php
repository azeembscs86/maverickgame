<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
$hostname="http://".$_SERVER['HTTP_HOST'];
$email  =  mysql_real_escape_string($_POST['email']);
$result =  getUserByEmail($email);
$user =  mysql_fetch_array($result);
    if($user)
    {
    $confirm_code =$user['verificationcode'];
    $subject="Your Password Reset Link";
    $from = "info@maverickgame.com";
    $to = $email;
    $mail_body = "Hi ".$user['name']."<br/><br/> You have requested password for email: ".$email." <br/><br/>Please copy the code ".$confirm_code."<br/><br />Kind Regards,<br/><br/>The Maverick Game Team";
    $body = wordwrap($mail_body,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  	    $headers .= "From: " . $from ."\r\n";
            //$headers .= 'Bcc: raheelaslam@golive.com.pk, azeem.akram78@gmail.com' . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";   
    mail($to,$subject,$body,$headers);
    $status=array('status'=>1,'success'=>'email exists and send the code to email address.');
    echo json_encode($status);
}else
{
    $status=array('status'=>0,'error'=>'Email does not exists in our database');
    echo json_encode($status);
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */