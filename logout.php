<?php
session_start();
include('dbconnection.php');
if(isset($_SESSION['user_loged_id']))
      {    
        $browserout=Logoutwhenbrowserclose($_SESSION['user_loged_id']);
      }
session_unset();
    $_SESSION['FBID'] = NULL;
    $_SESSION['FULLNAME'] = NULL;
    $_SESSION['EMAIL'] =  NULL;
header("Location:index.php"); 
?>