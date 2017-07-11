<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
if(isset($_REQUEST['game_id']))
{
$game_id=  mysql_real_escape_string($_REQUEST['game_id']);
$select=  getGameWebScoreByScoreId($game_id);
if($select>0)
{
    $result = array();
    while($data = mysql_fetch_assoc($select)) {
     $result[] = $data;
    }
    $data = array("data" => $result,'status'=>1);
    echo json_encode($data);
}else
{
     $status=array('status'=>0,'error'=>'score not exit');          
     echo json_encode($status);
}
}else
{
    $status=array('status'=>0,'error'=>'score not exit');          
     echo json_encode($status);
}
?>