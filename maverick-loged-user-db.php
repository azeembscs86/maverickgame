<?php
session_start();
include("dbconnection.php");
   $game_score=$_GET['game_score'];
   $user_id = $_SESSION['user_loged_id'];
   $game_id = $_SESSION['game_id'];
   $createdAt=  date("Y-m-d H:i:s");
   $updatedAt=  date("Y-m-d H:i:s");
   $result=getGameScoreByUser($user_id,$game_id);
   if($result>0)
   {
	   $user_score=mysql_fetch_array($result);
		$game_score_id=$user_score['score_id']; 
	   $result= mysql_query("update game_scores set game_score=$game_score where score_id=$game_score_id"); 
       if($result)
   {
       header('Content-type: application/json');
       echo json_encode("Score Saved in Leaderboard !");
    }else{
		header('Content-type: application/json');
       echo json_encode("Score not saved");
	}
	   }else{
		
		$result= mysql_query("insert into game_scores(game_id,user_id,game_score,createdAt,updateAt) values($game_id,$user_id,$game_score,'$createdAt','$updatedAt')"); 
   if($result)
   {
       header('Content-type: application/json');
       echo json_encode("Score Saved in Leaderboard !");
    }else{
		header('Content-type: application/json');
       echo json_encode("Score not saved");
	}
}	


 