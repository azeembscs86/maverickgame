<?php
session_start();
include("dbconnection.php");
$userId   = $_REQUEST['userId'];
$email    = $_REQUEST['email'];
$password = md5($_REQUEST['password']);
$appaskey=$_REQUEST['passkey'];
$verificationcode=generateCode(1);
$result=getUserByEmail($email);
$user=mysql_fetch_array($result);
if($appaskey==$user['verificationcode'])
{
resetPassword($userId,$email,$password,$verificationcode);
header("location:maverick-game-user-login?reset");
}else
{
	header("location:maverick-forgotpassword?verfify");
}
?>