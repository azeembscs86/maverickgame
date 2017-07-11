<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
if(isset($_POST['user_id'])){
$user_id =  mysql_real_escape_string($_POST['user_id']);
$result=  getUserById($user_id);
$user=  mysql_fetch_array($result);
if($user['photo']!='')
{
$base64=base64_encode($user['photo']);
}else
{
$base64=null;
}
$user_data=array(
        'user_id'=>$user['id'],
        'name'=>$user['name'],        
        'email'=>$user['email'],
        'user_image'=>$base64,
        'user_name'=>$user['user_name'],         
        'phone_number'=> $user['mobile_number'],
        'status'=>1
      );
  echo json_encode($user_data);   
}else
{
    $user_data=array(
        'status'=>0        
      );
    echo json_encode($user_data);
}
?>