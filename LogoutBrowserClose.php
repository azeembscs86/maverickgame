<?php
session_start();
include('dbconnection.php');
    if(isset($_SESSION['user_loged_id']))
      {    
        $browserout=Logoutwhenbrowserclose($_SESSION['user_loged_id']);
      }
    
?>