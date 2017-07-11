<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
if(isset($_REQUEST['user_id']))
{
$user_id=$_REQUEST['user_id'];
$result=  getUserById($user_id);
if($result>0)
{
    $user=  mysql_fetch_array($result);
    $path="user_images/".$user['photo'];
$user_data=array(
        'user_id'=>$user['id'],
        'user_image'=>$path,
        'user_name'=>$user['user_name'],         
        'status'=>1
      );
  echo json_encode($user_data);   
}else
{
    $user_data=array(
        'status'=>0,
        'err'=>'user not exits'
      );
    echo json_encode($user_data);
}
}else
{
    $user_data=array(
        'status'=>0,
        'err'=>'user not exits'
      );
    echo json_encode($user_data);
}