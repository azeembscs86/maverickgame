<?php
$max_scores=  getGameHightestScore();
$max_score = mysql_fetch_array($max_scores);
$game_users=getUserByMaxScore($max_score['game_score']);
$game_user=  mysql_fetch_array($game_users);
$user_id = $game_user['user_id'];
$current_date=date("Y-m-d");
$updateAt=strtotime($game_user['updateAt']);
$updatedAt=date("Y-m-d",$updateAt );
$d1 = new DateTime($current_date);
$d2 = new DateTime($updatedAt);
$interval = $d2->diff($d1);
$difference= $interval->format('%d');
if($interval->format('%d')>1)
{
    $game_point=getUserGameCoins($user_id);
    $user_points=  mysql_fetch_array($game_point);
   if($user_points['total_coins']>0)
   {
      if($user_points['heightest_score_coins']<1)
      {
       $heightest_score_point=10;          
      $total_points=$user_points['total_coins']+$heightest_score_point;
      updateUserCoins($user_id,$heightest_score_point,$total_points);
      }else {
      $heightest_score_point=10;        
      $total_points=$heightest_score_point;
      updateUserCoins($user_id,$heightest_score_point,$total_points);
      }
   }  else {      
      $heightest_score_point=10;
      $total_points=$heightest_score_point;  
      createUserHightScoreCoins($user_id,$heightest_score_point,$total_points);
   }
}
?>