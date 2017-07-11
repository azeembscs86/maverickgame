<?php
$current_leader=getCurrentPointsLeaderBoard();
$today = date("Y-m-d");
if($current_leader>0)
{
    while($leader=mysql_fetch_array($current_leader))
    {
    
    $createdAt = date("Y-m-d",  strtotime($leader['createdAt'])); 
    $updatedAt = date("Y-m-d",  strtotime($leader['updatedAt'])); 
    }
if($today > $createdAt and $today > $updatedAt) { 
    updateCurrentLeaderBoard();
}
}
?>
