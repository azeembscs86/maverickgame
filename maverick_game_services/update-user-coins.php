<?php
session_start();
header("Content-Type: application/json");
include("../dbconnection.php");
$game_id = $_SESSION['game_id'];
$game_results =  getGameById($game_id);
$game_result  =  mysql_fetch_array($game_results);
if(isset($_SESSION['user_loged_id']))
{
   $user_id       =  mysql_real_escape_string($_SESSION['user_loged_id']);
   $utilize_coins =  $game_result['game_price'];
   $result        =  getUserGameCoins($user_id);
   $user_coins    =  mysql_fetch_array($result);
   $total_coins   =  $user_coins['total_coins']-$utilize_coins;
   $total_utilize = $user_coins['utilize_coins']+$utilize_coins;
   updateUtilizeGameCoins($user_id,$total_utilize,$total_coins);  
    $user_data=array(
        'status'=>'1',
        'success'=>'coins minused'
      );
      echo json_encode($user_data); 
}else
{
    $user_data=array(
        'status'=>'0',
        'err'=>'Error occured.........'
      );
  echo json_encode($user_data); 
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
