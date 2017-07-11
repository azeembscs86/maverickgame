<?php
session_start();
include("dbconnection.php");
if(isset($_REQUEST['id']))
{
    $user_id =  mysql_real_escape_string($_REQUEST['id']);
    deleteUser($user_id);
    header("location:register-users.php?delete");
    
}else {
     header("location:register-users.php");
}
?>
