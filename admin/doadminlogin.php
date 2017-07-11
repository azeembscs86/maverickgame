<?php
session_start();
include("dbconnection.php");
$email  = clean($_REQUEST['email']);
$password = clean(md5($_REQUEST['password']));
$result = adminLogin($email,$password);
$row=  mysql_fetch_array($result);
            $loginuser = $row['email'];
            $loginpassword = $row['password'];
            $adminfullname = $row['fullname']; 
            $userId = $row['user_id'];
        if(($loginuser==$email and $loginpassword==$password))
          {
	    $_SESSION['admin_email']=$loginuser;
            $_SESSION['admin_password']=$loginpassword;
            $_SESSION['admin_fullname']=$adminfullname;
            $_SESSION['admin_user_id']=$userId;
            if($_SESSION['admin_fullname']=='Administrator')
            {
              header("location:dashboard.php");
            }
            if(isset($_REQUEST['rememberme']))
	     {
	       header("location:dashboard.php");
               setcookie("email", $_SESSION['admin_email'], time()+60*60*24*100, "/");
               setcookie("password", $_REQUEST['admin_password'], time()+60*60*24*100, "/");   
               setcookie($_COOKIE['email'],  $_COOKIE['password'], $expire); 			
             }
          }else
          {
            header("location:index.php?msg");
          }

?>

