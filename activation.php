<?php
include("dbconnection.php");
$msg='';
if(!empty($_GET['code']) && isset($_GET['code']))
{
	$code=mysql_real_escape_string($_GET['code']);
        $query="select id,activation from glogin_users WHERE activation='$code'";
        $result=  mysql_query($query) or die(mysql_error());
        $user=  mysql_fetch_array($result);
        if($user['activation']==$code)
        {
           $query="UPDATE glogin_users SET isActive='yes' WHERE activation='$code'";
           mysql_query($query) or die(mysql_error());
           header("location:thank-you.php");
        }  else {
           $query="UPDATE glogin_users SET isActive='no' WHERE activation='$code'";
           mysql_query($query) or die(mysql_error());
            header("location:thank-you.php");
        }        
}else
{
 header("location:maverick-games");
}
?>