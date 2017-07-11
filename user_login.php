<?php
session_start();
    include("dbconnection.php");
    $email=  clean($_REQUEST['user_email']);
    $password=  clean(md5($_REQUEST['user_password']));
    if($email=='utmalik.2@gmail.com' or $email='UmarTariq')
    {
       header("location:error.php?msg");
    }
    if(isset($_SESSION['current_url']))
    {
    $url=$_SESSION['current_url'];
    }else
    {
    $url="login-message";
    }
    $result=  Userlogin($email,$password);  
    $row=mysql_fetch_array($result);        
            $loginuser = $row['email'];
            $loginpassword = $row['password'];
            $fullname = $row['name']; 
            $userId = $row['id'];
            $user_image = $row['photo'];  
            $login_user_name=$row['user_name'];
            $isactive=$row['isActive'];
       if($isactive=='no')
       {
              header("location:error.php?active");
       }else{
       if(($loginuser==$email and $loginpassword==$password))
       {
	    $_SESSION['loged_name']=$fullname;       
            $_SESSION['loged_email']=$loginuser;
            $_SESSION['loged_password']=$loginpassword;
            $_SESSION['loged_fullname']=$fullname;
            $_SESSION['user_loged_id']=$userId;
            $_SESSION['loged_user_image']=$user_image;
            $_SESSION['loged_user_name']=$login_user_name;    
             setUserLogin($email);                     
            header("location:$url");       
       }
       else if(($login_user_name==$email and $loginpassword==$password)) 
       {
            $_SESSION['loged_name']=$fullname;
            $_SESSION['loged_email']=$loginuser;            
            $_SESSION['loged_fullname']=$fullname;
            $_SESSION['user_loged_id']=$userId;
            $_SESSION['loged_user_image']=$user_image;
            $_SESSION['loged_user_name']=$login_user_name;
             setUserLogin($email);            
            header("location:$url");           
          }          
         else
          {
            header("location:error.php?msg");
          } 
       }      


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

