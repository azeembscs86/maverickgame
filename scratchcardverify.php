<?php
session_start();
include("dbconnection.php");
$createdAt=date('Y-m-d h:i:s');  
if(isset($_SESSION['user_loged_id']))
{  
  $scratch_card_number = mysql_real_escape_string($_REQUEST['scratch_card_number']);
  $scratch_cards=getScratchCardByNumber($scratch_card_number);
  $scratch_card=  mysql_fetch_array($scratch_cards);
  if($scratch_card['card_id']>0)
  {
      if($scratch_card['isused']=='yes')
      {
          header("location:scratch-card-payment?used");
      }else{
      $card_id=$scratch_card['card_id'];
      $scratch_card_coins = $scratch_card['number_of_coins'];    
      $session_id=$_SESSION['user_loged_id'];
      $result        =  getUserGameCoins($session_id);
      $user_coins    =  mysql_fetch_array($result);   
      addUserScratchCard($card_id,$session_id);
      if($user_coins['game_coins_id']>0)
      {
          $total_coins   = $user_coins['total_coins']+$scratch_card['number_of_coins'];
          $query="update user_game_coins set total_coins=$total_coins,cardactivatedAt='$createdAt' where user_id=$session_id";
          mysql_query($query) or die(mysql_error());
          $queryq="update maverick_game_card set isused='yes',cardactivatedAt='$createdAt' where card_id=$card_id";
          mysql_query($queryq) or die(mysql_error());
          $_SESSION['coins']=$scratch_card_coins;
          header("location:thanks-scratchcard-payment");                 
      }else
      {
          $total_coins   = $user_coins['total_coins']+$scratch_card['number_of_coins'];
          $query="insert into user_game_coins(user_id,total_coins) values ($session_id,$total_coins)";
          mysql_query($query) or die(mysql_error());
         
          $queryq="update maverick_game_card set isused='yes' ,cardactivatedAt='$createdAt' where card_id=$card_id";
          mysql_query($queryq) or die(mysql_error());
          $_SESSION['coins']=$scratch_card_coins;
          header("location:thanks-scratchcard-payment");  
      }           
      }
  }else
  {
      header("location:scratch-card-payment?err");
  }
  
  
}else
{
    header("location:maverick-game-user-login");
}