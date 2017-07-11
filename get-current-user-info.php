<?php
session_start();
include("dbconnection.php");

if(isset($_SESSION['user_loged_id']))
{
  $user_id=$_SESSION['user_loged_id'];  
  $result= getUserById($user_id);
  $user=  mysql_fetch_array($result);
  $path="user_images/".$user['photo'];
  $user_data=array(
        'user_id'=>$user['id'],
        'name'=>$user['name'],        
        'email'=>$user['email'],
        'photo'=>$path,       
        'user_name'=>$user['user_name'],       
        'gender'=> $user['gender'],
      );
  echo json_encode($user_data);
}else
{
  echo json_encode("User not Login");
}
?>