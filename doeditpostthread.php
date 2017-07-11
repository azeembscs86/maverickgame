<?php
session_start();
include("dbconnection.php");
$thread_id=  mysql_real_escape_string($_REQUEST['thread_id']);
$thread_message=mysql_real_escape_string($_REQUEST['thread_message']);
$thread_name =mysql_real_escape_string($_REQUEST['thread_name']);
$thread_seo=  str_replace(" ","-", strtolower($thread_name));
$threadseo=  getThreadBySeo($thread_seo);
$seothread=  mysql_fetch_array($threadseo);
if($seothread['thread_seo']==$thread_seo)
{
  $thread_seo=$thread_seo."-".time();
  $thread_seo=rtrim($thread_seo,"-");
}else
{    
    $thread_seo=rtrim($thread_seo,"-");
}
        
if(isset($_SESSION['user_loged_id']))
{
$user_id=$_SESSION['user_loged_id'];
updateThreads($thread_id,$thread_name,$thread_message,$thread_seo);
header("location:maverick-game-dicussion-forum");
} else if(isset($_SESSION['FBID']))
{    
$user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
if($user_facebook_id){
$face_book_user=  mysql_fetch_array($user_facebook_id);
$user_id=$face_book_user['id'];
}
updateThreads($thread_id,$thread_name,$thread_message,$thread_seo);
header("location:maverick-game-dicussion-forum");
}
else {
    header("location:maverick-game-user-login");
}
?>