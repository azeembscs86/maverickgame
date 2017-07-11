<?php
session_start();
if(isset($_POST['submit']))
{
    include("dbconnection.php");
    $email =  mysql_real_escape_string($_REQUEST['email']);
    $password  =mysql_real_escape_string(md5($_REQUEST['password']));
    $gender = mysql_real_escape_string($_REQUEST['gender']);
    $month_name=  mysql_real_escape_string($_REQUEST['month_name']);
    $day_name =  mysql_real_escape_string($_REQUEST['day_name']);
    $year_name =  mysql_real_escape_string($_REQUEST['year_name']);
    $birthdate=$year_name."-".$month_name."-".$day_name;
    $birth_date=date("Y-m-d",  strtotime($birthdate));
    $location = mysql_real_escape_string($_REQUEST['location']);
    $verificationcode=generateCode(8);
    $activation=md5($email.time());    
    $users=  getUserByEmail($email);
    $user=  mysql_fetch_array($users);
   if($user['email']==$email)
    {    
         header("location:index.php");   
    }else{
      registerNewUser($email,$password,$birth_date,$activation,$verificationcode,$location);
    $base_url="http://maverickgame.com/activation.php?code=".$activation;
    $subject="Registration successful, please activate email at maverick game";
    $from = "maverickgame.com";
    $email_server="info@maverickgame.com"; 
    $to = $email;
    $mail_body="Dear $name,<br/><br/> Welcome to maverick game.<br/></br>Regards & Love<br/><br/>The Maverick Game Team";    
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
    header("location:thanks-register.php");
}
}else
{
   header("location:index.php");
}