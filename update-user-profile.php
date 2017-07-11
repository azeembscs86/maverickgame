<?php
session_start();
if(isset($_POST['submit']))
{
  include("dbconnection.php");  
  $user_id =  mysql_real_escape_string($_REQUEST['user_id']);  
  $user_name =  mysql_real_escape_string($_REQUEST['user_name']);  
  $email =  mysql_real_escape_string($_REQUEST['user_email']);  
  $gender =  mysql_real_escape_string($_REQUEST['gender']);  
  $name=  mysql_real_escape_string($_REQUEST['name']);  
  $phone_number=  mysql_real_escape_string($_REQUEST['phone_number']);
  $result=getUserByUserName($user_name);
  $name_user=  mysql_fetch_array($result);
  if($name_user && $user_id!=$name_user['id'])
  {     
     header("location:maverick-user-profile?user");  
  }else
  {    
  updateUser($user_id,$user_name,$email,$name,$gender,$phone_number);
  header("location:maverick-user-profile?profile");    
  }
}  else {
header("location:maverick-user-profile");    
}
?>