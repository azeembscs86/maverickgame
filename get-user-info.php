<?php
session_start();
include("dbconnection.php");
  $user_id=4;  
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
        'birth_date'=>$user['birth_date'],
        'status'=>'1' 
      );
  echo json_encode($user_data);
?>