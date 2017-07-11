<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
if(isset($_SESSION['game_id']))
{
    $game_id=$_SESSION['game_id'];
    $result=  getGameCoinById($game_id);
    $game_coins=  mysql_fetch_array($result);
    $user_data=array(
        'game_id'=>$game_coins['game_id'],
        'game_price'=>$game_coins['game_price'],
        'status'=>'1'       
      );
  echo json_encode($user_data);
}  else {
    $user_data=array(
        'status'=>'0',
        'err'=>'Error occured.........'
      );
  echo json_encode($user_data); 
}