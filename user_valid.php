<?php
include('dbconnection.php');
if(isset($_POST['name']))
{
	$username = mysql_real_escape_string(trim($_POST['name']));
	$sql = "SELECT user_name FROM glogin_users WHERE user_name = '$username'";
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