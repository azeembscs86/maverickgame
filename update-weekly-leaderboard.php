<?php
session_start();
include("dbconnection.php");
$today = date('Y-m-d', strtotime('-7 days'));
$createdAt="";
$updatedAt="";
$updated_date="";
$current_leader=getUpdateWeekPointsLeaderBoard($today);
if($current_leader>0)
{
    while($leader=  mysql_fetch_array($current_leader))
    {    
      $createdAt = date("Y-m-d",  strtotime($leader['createdAt'])); 
      $updatedAt = date("Y-m-d",  strtotime($leader['updatedAt'])); 
}
if($createdAt>$updatedAt)
{
    $updated_date=$createdAt;
}else
{
    $updated_date=$updatedAt;
}
if($today > $updated_date) { 
    echo "Greater" ;
}  else {
   updateWeekLeaderBoard($today);
}
}
?>
