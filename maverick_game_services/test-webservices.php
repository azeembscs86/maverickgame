<?php
session_start();
include("../dbconnection.php");
$game_id=2;
$user_id=34;
$game_score=$_REQUEST['game_score'];
$createdAt=  date("Y-m-d H:i:s");
$updatedAt=  date("Y-m-d H:i:s");
$result= mysql_query("insert into game_scores(game_id,user_id,game_score,createdAt,updateAt,isgarbeg) values($game_id,$user_id,$game_score,'$createdAt','$updatedAt','yes')"); 
header('Content-type: application/json');
echo json_encode("Your score added Successfully");  
?>