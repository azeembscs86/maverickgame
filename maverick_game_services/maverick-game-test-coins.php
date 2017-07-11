<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
$_SESSION['game_id']=1;

    $game_id = $_SESSION['game_id'];
    $result =  getGameCoinById($game_id);
    $game_coins =  mysql_fetch_array($result);
    $user_data=array(
        'game_id'=>$game_coins['game_id'],
        'game_price'=>$game_coins['game_price'],
        'status'=>'1'       
      );
  echo json_encode($user_data);
