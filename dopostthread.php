<?php
session_start();
include("dbconnection.php");
$sub_forum_id=  mysql_real_escape_string($_REQUEST['sub_forum_id']);
$thread_message=mysql_real_escape_string($_REQUEST['thread_message']);
$thread_name =mysql_real_escape_string($_REQUEST['thread_name']);
$sub_form_title=  mysql_real_escape_string($_REQUEST['sub_form_title']);
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
addnewThreads($sub_forum_id,$user_id,$thread_name,$thread_message,$thread_seo);
header("location:game-forum-thread-$sub_form_title");
}else if(isset($_SESSION['FBID']))
{    
$user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
if($user_facebook_id){
$face_book_user=  mysql_fetch_array($user_facebook_id);
$user_id=$face_book_user['id'];
}
addnewThreads($sub_forum_id,$user_id,$thread_name,$thread_message,$thread_seo);
header("location:game-forum-thread-$sub_form_title");
}
else {
    header("location:maverick-game-user-login");
}
?>