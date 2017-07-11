<?php
session_start();
  include("dbconnection.php");
  $sender = $_GET['sender'];//phone num.
  $amount = $_GET['amount'];//credit
  $cuid = $_GET['cuid'];//resource i.e. user
  if(preg_match("/completed/i", $_GET['status'])) {
  $result        =  getUserGameCoins($cuid);
  $user_coins    =  mysql_fetch_array($result);
  if($user_coins['game_coins_id']>0){
  $total_coins   =  $user_coins['total_coins']+$amount;
  $updatedAt= date("Y-m-d");
  $query="update user_game_coins set total_coins=$total_coins,fortomo_coins=$amount where user_id=$cuid";
  mysql_query($query) or die(mysql_error());
  }else
  {
  $createdAt= date("Y-m-d"); 
  $query="insert into  user_game_coins (user_id,createdAt,total_coins,fortomo_coins) vaues($cuid,'$createdAt',$amount,$amount)";
  mysql_query($query) or die(mysql_error());
  }
  } 
  
?>