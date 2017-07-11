<?php
session_start();
if(isset($_POST['updatepassword']))
{
    include("dbconnection.php");
    $user_loged_id=  mysql_real_escape_string($_REQUEST['user_loged_id']);
    $old_password=  mysql_real_escape_string(md5($_REQUEST['old_password']));
    $new_password=  mysql_real_escape_string(md5($_REQUEST['new_password']));
    $result=  getUserById($user_loged_id);
    $user=  mysql_fetch_array($result);    
    if($user['password']==$old_password)
    {
       changeUserPassword($user_loged_id,$new_password); 
       header("location:update-password?change");
    }  else {
        header("location:update-password?msg");
    }
}else
{
    header("location:update-password");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

