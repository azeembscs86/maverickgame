<?php
session_start();
include("dbconnection.php");
$user_id=$_REQUEST['user_id'];
$game_id=$_REQUEST['game_id'];
$game_details=  getGameById($game_id);
$game_detail=  mysql_fetch_array($game_details);
?>
<div>
        <div class="clearfix"></div>
        <div class="highscore">
        <div class="row">
        <div class="col-md-12">
        <h3><?php echo $game_detail['game_name']; ?></h3>
        </div>           
        </div>
        </div>
         <div id="game_leader_board">
         <table class="highscore_table table-nonfluid table table-striped">
         <thead>
         <tr>
         <th>Date</th>
         <th>Score</th>
         </tr>
         </thead>
         <tbody>             
    <?php
    $sore_games=getGameScoreByUserId($user_id,$game_id);
    if($sore_games>0)
    {
        while($score_game=  mysql_fetch_array($sore_games))
        {  
            if($score_game['user_game_score_id']>0)
            {
    ?>            
         <tr>
         <td><p><?php
             echo date("d-m-Y",  strtotime($score_game['createdAt']));
             ?></p></td>
         <td><p><?php echo $score_game['user_game_score']; ?></p></td>
         </tr>
         
         
          <?php
    }  else {
    ?>
         <tr>
         <td><p><?php
             echo date("d-m-Y");
             ?></p></td>
         <td><p>00</p></td>
         </tr>
   <?php      
    }
   }
  }else
  {
      ?>
       <tr>
         <td><p><?php
             echo date("d-m-Y");
             ?></p></td>
         <td><p>00</p></td>
         </tr>  
 <?php        
  }
   
    ?>
         </tbody>
         </table> 
         
            
</div>
        </div>