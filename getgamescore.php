<?php 
include("dbconnection.php");
$game_id=  mysql_real_escape_string($_REQUEST['game_id']);
$game_leaders=  getGameById($game_id);
$game_leader=  mysql_fetch_array($game_leaders);
?>
<div id="tabs-<?php echo $game_id; ?>"> <img src="silverhat_games/game_leaderboards/<?php echo $game_leader['game_leaderboard_image']; ?>" alt="" class="score-banner">
            <div class="titles">
            <div class="row">
                <div class="col-lg-2 bor-right text-center">
                <h2>Rank</h2>
              </div>
                <div class="col-lg-6 bor-right">
                <h2>Player</h2>
              </div>
                <div class="col-lg-4 text-center">
                <h2>Score</h2>
              </div>
              </div>
          </div>
    <?php 
    $i=0;
    $sore_games=getGameScoreByScoreId($game_id);
    if($sore_games>0)
    {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i++;
            $games_scores_user=  getUserById($score_game['user_id']);
            $game_score_user=  mysql_fetch_array($games_scores_user);
            
    ?>
    <div class="score-row">
    <div class="row">
    <div class="col-lg-2 bor-right-red text-center">
    <h2><?php 
            echo $i; ?></h2>
    </div>
    <div class="col-lg-6 bor-right-red">
        <?php
            if($game_score_user['photo']!=""){
            ?>
            <img src="user_images/<?php echo $game_score_user['photo'];?>" alt="" width="34" height="34">
            <?php
            }else{
            ?>
          <?php
          if($game_score_user['gender']=='male')
          {
          ?>
            <img src="user_images/male.jpg" alt="" width="34" height="34">
            <?php
          }else if($game_score_user['gender']=='female')
          {
          ?>
            <img src="user_images/female.jpg" alt="" width="34" height="34">
            <?php
          }else
          {
          ?>
            <img src="user_images/pro_03.png" alt="" width="34" height="34">
         <?php
          }
        }
          ?>
            
    <h2>
   <?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?>
    </h2>
    </div>
    <div class="col-lg-4 text-center">
    <h2><?php echo $score_game['game_score']; ?></h2>
    </div>
    </div>
    </div>
    <?php
    }
  }
   
    ?>
</div>