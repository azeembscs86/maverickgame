<?php
session_start();
include("dbconnection.php");
$thread_id=  mysql_real_escape_string($_REQUEST['thread_id']);
$thread_message=mysql_real_escape_string($_REQUEST['thread_message']);
$mom_sub_forum_id=  mysql_real_escape_string($_REQUEST['discussion_forum_id']);
$thread_name =mysql_real_escape_string($_REQUEST['thread_name']);
$thread_name_seo=mysql_real_escape_string($_REQUEST['thread_seo']);
if(isset($_SESSION['user_loged_id']))
{
$user_id=$_SESSION['user_loged_id'];
addNewQuickThreadReplys($thread_id,$user_id,$thread_name,$thread_message,$mom_sub_forum_id);    
header("location:game-forum-post-$thread_name_seo");
}else if(isset($_SESSION['FBID']))
{
    $user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
if($user_facebook_id){
$face_book_user=  mysql_fetch_array($user_facebook_id);
$user_id=$face_book_user['user_id'];
} 
addNewQuickThreadReplys($thread_id,$user_id,$thread_name,$thread_message,$mom_sub_forum_id);    
header("location:game-forum-post-$thread_name_seo");   
}
else {
    header("location:maverick-game-user-login");
}

?>