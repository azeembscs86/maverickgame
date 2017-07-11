<div class="topfive">
      <h3>Top 5 in Points Board</h3>
      <ul>
      <?php
           $i=0;      
           $active="";
           $sore_games=getTopFiveAllTimePointsLeaderBoard();
           if($sore_games>0)
            {
            while($score_game= mysql_fetch_array($sore_games))
            { 
              $i++;    
            ?>           
     <li>
     <p><?php 
          echo $score_game['user_name'];
          ?></p>
          
      <div class="picbox">
      <img width="34" height="34" src="user_images/<?php echo $score_game['user_image'];?>" alt=""><br>
      </div>
      <div class="scorebox">
      <strong>Points :</strong> <span><?php echo round($score_game['total_points']); ?></span><br>
      <strong>Rank :</strong> <span><?php echo $i; ?></span>
      </div>
      </li>
      
      <?php
          }
        }
       ?>
      
      </ul>
      </div>