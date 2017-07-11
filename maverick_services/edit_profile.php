<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
$user_id        =  mysql_real_escape_string($_POST['user_id']);
$name           =  mysql_real_escape_string($_POST['name']);
$user_name      =  mysql_real_escape_string($_POST['user_name']);
$phone          =  mysql_real_escape_string($_POST['phone']);
$profile_image  =  mysql_real_escape_string($_POST['profile_image']);
updateAppUser($user_id,$name,$user_name,$phone,$profile_image);
$user_data=array(
        'status'=>1
      );
  echo json_encode($user_data); 