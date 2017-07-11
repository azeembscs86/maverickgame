<div class="topfive">
      <h3>Top 5 in Leader Board</h3>
      <ul>
     <?php 
     $i=0;
     $active="";
     $game_id=1;
     $sore_games=getTopFiveGameScoreByScoreId($game_id);
     if($sore_games>0)
     {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i++;
            $games_scores_user=  getUserById($score_game['user_id']);
            $game_score_user=  mysql_fetch_array($games_scores_user);
            
    ?>           
     <li>
     <p><?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?></p>
      <div class="picbox">
      <img width="34" height="34" src="user_images/<?php echo $game_score_user['photo'];?>" alt=""><br>
      </div>
      <div class="scorebox">
      <strong>Score :</strong> <span><?php echo $score_game['game_score']; ?></span><br>
      <strong>Rank :</strong> <span><?php 
            echo $i; ?></span>
      </div>
      </li>
      
  <?php
    }
  }
   
    ?>    
      
      
      </ul>
      </div>