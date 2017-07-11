<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
$select=  getMaverickGamesList();
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
    $status=array('status'=>0,'error'=>'No games exits');          
     echo json_encode($status);
}

?>