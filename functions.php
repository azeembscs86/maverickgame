<?php
require 'dbconfig.php';
function checkuser($fuid,$ffname,$femail){
    	$check = mysql_query("select * from glogin_users where Fuid=$fuid");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO glogin_users (Fuid,name) VALUES ('$fuid','$ffname')";
	mysql_query($query) or die(mysql_error());	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE glogin_users SET name='$ffname' where Fuid='$fuid'";
	mysql_query($query) or die(mysql_error());		
	}
}?>