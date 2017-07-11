<?php
if(isset($_COOKIE['loged_email']))
{
   $email=$_COOKIE['loged_email'];
   $email=$_COOKIE['user_name'];
   $query="update glogin_users set islogin='no' where email='$email' or user_name='$email'";
   mysql_query($query)or die(mysql_error());
}
else if(isset($_COOKIE['user_name']))
{
   $email=$_COOKIE['loged_email'];
   $email=$_COOKIE['user_name'];
   $query="update glogin_users set islogin='no' where email='$email' or user_name='$email'";
   mysql_query($query)or die(mysql_error());
}
?>