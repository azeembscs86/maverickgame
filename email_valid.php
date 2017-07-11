<?php
include('dbconnection.php');
if(isset($_POST['name']))
{
	$email_address = mysql_real_escape_string(trim($_POST['name']));
	$sql = "SELECT email FROM glogin_users WHERE email = '$email_address'";
	$myquery = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($myquery) !=0)
	{
		$row = mysql_fetch_array($myquery);
		echo 'exist';
	}
	else
	{
		echo 'not exist';
	}
}
?>