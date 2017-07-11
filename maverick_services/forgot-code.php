<?php
header("Content-Type: application/json");
include("../dbconnection.php");
$email             = mysql_real_escape_string($_POST['email']);
$password          = mysql_real_escape_string(md5($_POST['pass']));
$verificationcode  = mysql_real_escape_string($_POST['code']);
$verificationcode=generateCode(1);
updateAppUserPassword($email,$password,$verificationcode);
$status=array('status'=>0,'success'=>'Password Change Successfully');          
echo json_encode($status);
?>