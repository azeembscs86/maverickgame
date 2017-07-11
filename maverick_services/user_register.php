<?php
header("Content-Type: application/json");
include("../dbconnection.php");
$name      = mysql_real_escape_string($_POST['name']);
$email     = mysql_real_escape_string($_POST['email']);
$user_name = mysql_real_escape_string($_POST['username']);
$password  = mysql_real_escape_string(md5($_POST['password']));
$phone_number     = mysql_real_escape_string($_POST['phone']);  
$gender    = mysql_real_escape_string($_POST['gender']);
$location  = mysql_real_escape_string($_POST['location']);
$birth_date  = mysql_real_escape_string($_POST['birthday']); 
$android_app  = mysql_real_escape_string($_POST['android_app']); 
$user_emails=  getUserByEmail($email);
$user=  mysql_fetch_array($user_emails);
if($email==$user['email'])
{
     $status=array('status'=>0,'error'=>'Email already exits');          
     echo json_encode($status);
}
$usernames=  getUserByUserName($user_name);
$user_result=  mysql_fetch_array($usernames);
if($user_name==$user_result['user_name'])
{
     $status=array('status'=>2,'error'=>'User name already exits');          
     echo json_encode($status);   
}else
{
    $birth_date=  date("Y-m-d",strtotime($birth_date));
    $verificationcode=generateCode(1);
    $activation=md5($email.time());  
   $result=registerNewUser($name,$email,$user_name,$password,$gender,$birth_date,$location,$phone_number,$activation,$verificationcode,$android_app);
   $status=array('status'=>1,'error'=>'User successfully added'); 
}




?>