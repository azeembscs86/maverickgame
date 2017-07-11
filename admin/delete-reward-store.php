<?php
session_start();
include("dbconnection.php");
if(isset($_REQUEST['id']))
{
    $reward_id =  mysql_real_escape_string($_REQUEST['id']);
    deleteRewards($reward_id);
    header("location:maverick-rewards.php?delete");
    
}else {
     header("location:maverick-rewards.php");
}
?>
