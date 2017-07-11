<?php
session_start();
include("dbconnection.php");
header('Content-type: application/json');
if(isset($_REQUEST['game_score']))
{
   $game_score = $_REQUEST['game_score'];
   $user_id = $_SESSION['user_loged_id'];
   $game_id = $_SESSION['game_id'];
   addNewUserGameScore($user_id,$game_id,$game_score);
   $game_results =  getGameById($game_id);
   $game_result  =  mysql_fetch_array($game_results);
   $game_point_ratio=$game_result['game_point_ratio'];
   $total_points=floor($game_score/$game_point_ratio);
   $user_points=  getPointsByUserGame($game_id,$user_id);  
   $game_user_point=  mysql_fetch_array($user_points);
   $game_leader_boards=getGameScoreLeaderBoardByUserId($user_id);
   $game_leaderboard=  mysql_fetch_array($game_leader_boards);
   $points_leaders=getPointsLeaderBoardByUserId($user_id);
   $point_leaderboard=  mysql_fetch_array($points_leaders);
   if($point_leaderboard['point_leader_id']<1)
   {
       $points_leaderboard_score=$total_points;
       addNewPointLeaderBoard($user_id,$points_leaderboard_score);
        
   }else
   {    
       $points_leaderboard_score=$point_leaderboard['total_points']+$total_points;
       updatePointLeaderBoard($user_id,$points_leaderboard_score);
   }
   if($game_leaderboard['leader_board_id']>0)
   {
       $game_leaderboard_score=$game_leaderboard['leader_board_score']+$game_score;
       updateGameScoreLeaderBoard($user_id,$game_leaderboard_score);
   }else
   {
       $game_leaderboard_score=$game_score;
       addNewGameScoreLeaderBoard($user_id,$game_leaderboard_score);
   }
   if($game_user_point['user_point_id']>0)
   {
   $user_total_points=$game_user_point['total_points']+$total_points;
   $user_overall_points=$game_user_point['over_all_points']+$user_total_points;
   updateUserPoints($user_id,$game_id, $user_total_points,$user_overall_points); 
   $createdAt=  date("Y-m-d H:i:s");
   $updatedAt=  date("Y-m-d H:i:s");
   $game_scores=getGameScoreByUser($user_id,$game_id);
   $score_game=  mysql_fetch_array($game_scores);   
   if($score_game['game_score']=="")
   {
   $result= mysql_query("insert into game_scores(game_id,user_id,game_score,createdAt,updateAt,isgarbeg) values($game_id,$user_id,$game_score,'$createdAt','$updatedAt','no')"); 
   if($result)
   {       
       echo json_encode("Score Saved in Leaderboard!");
   }
    else
    {
      echo json_encode("Score Saved in Leaderboard!");
    }
    }else
   {   
    if($game_score>$score_game['game_score'])
    {
     $result= mysql_query("update game_scores set game_score=$game_score where game_id=$game_id and user_id=$user_id"); 
     if($result)
    {       
       echo json_encode("Score Saved in Leaderboard !");
    }
     else
     {      
      echo json_encode("Score Saved in Leaderboard  !");
     }
    }     
  } 
   }
   else {      
   $user_overall_points=$total_points;
   addNewUserPoints($user_id,$game_id,$total_points,$user_overall_points);    
   $createdAt=  date("Y-m-d H:i:s");
   $updatedAt=  date("Y-m-d H:i:s");
   $game_scores=getGameScoreByUser($user_id,$game_id);
   $score_game=  mysql_fetch_array($game_scores);   
   if($score_game['game_score']=="")
   {
   $result= mysql_query("insert into game_scores(game_id,user_id,game_score,createdAt,updateAt,isgarbeg) values($game_id,$user_id,$game_score,'$createdAt','$updatedAt','no')"); 
   
   if($result)
   {       
       echo json_encode("Score Saved in Leaderboard!");
   }
    else
    {
      echo json_encode("Score Saved in Leaderboard!");
    }
    }else
   {   
    if($game_score>$score_game['game_score'])
    {
     $result= mysql_query("update game_scores set game_score=$game_score where game_id=$game_id and user_id=$user_id"); 
     if($result)
    {       
       echo json_encode("Score Saved in Leaderboard !");
    }
     else
     {      
      echo json_encode("Score Saved in Leaderboard  !");
     }
    }     
  } 
}
}
?>