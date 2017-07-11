<?php
if(isset($_POST['game_score']))
{
session_start();
include("../dbconnection.php");
header('Content-type: application/json');
   $game_score = mysql_real_escape_string($_POST['game_score']);
   $user_id = $_SESSION['user_loged_id'];
   $game_id = $_SESSION['game_id'];   
   $game_results =  getGameById($game_id);
   $game_result  =  mysql_fetch_array($game_results);
   if($game_id=1 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else if($game_id=2 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else if($game_id=3 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else if($game_id=4 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else if($game_id=5 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else if($game_id=6 and $game_score>$game_result['game_score_limit'])
   {
       echo json_encode("Error");
   }
   else
   {     
   addNewUserGameScore($user_id,$game_id,$game_score);
   $game_point_ratio=$game_result['game_point_ratio'];
   $total_points=$game_score/$game_point_ratio;
   $user_points=  getPointsByUserGame($game_id,$user_id);  
   $game_user_point=  mysql_fetch_array($user_points);
   $game_leader_boards=getGameScoreLeaderBoardByUserId($user_id);
   $game_leaderboard=  mysql_fetch_array($game_leader_boards);
   $points_leaders=getPointsLeaderBoardByUserId($user_id);
   $point_leaderboard=  mysql_fetch_array($points_leaders);
   if($point_leaderboard['point_leader_id']<1)
   {
       $points_leaderboard_score=$total_points;
       $current_point=$total_points;
       $week_points=$total_points;
       addNewPointLeaderBoard($user_id,$points_leaderboard_score,$current_point,$week_points);
        
   }else
   {    
       $points_leaderboard_score=$point_leaderboard['total_points']+$total_points;
       $current_point=$point_leaderboard['current_point']+$total_points;
       $week_points=$point_leaderboard['week_points']+$total_points;
       updatePointLeaderBoard($user_id,$points_leaderboard_score,$current_point,$week_points);
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
}else
{
echo json_encode("Error");
}
?>