<?php
session_start();
include("../dbconnection.php");
$select =getGameWebServiceScore();
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
?>