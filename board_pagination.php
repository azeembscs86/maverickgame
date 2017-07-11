<?php
session_start();
include("dbconnection.php");
if($_GET['message'] == 'numberpagination'){
$nooflist = $_GET['noofitemshow'];
$_SESSION['pagination_direction_num'] = $nooflist;
$ending = $nooflist*10;
$starting = ($ending-10)+1;
?>
<div id="game_leader_board"> 
         <table class="highscore_table table-nonfluid table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Score</th>
         </tr>
         </thead>
         <?php 
     $i=$starting;
     $active="";
     $game_id=$_REQUEST['gameid'];
     $sore_games=getAllGameScorePagination($starting,$ending,$game_id);
     if($sore_games>0)
     {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i;
            $games_scores_user=  getUserById($score_game['user_id']);
            $game_score_user=  mysql_fetch_array($games_scores_user);
            
    ?>
             <?php
         if(isset($_SESSION['user_loged_id']))
         {
             $user_id=$_SESSION['user_loged_id'];
             if($score_game['user_id']==$user_id)
             {
                $active="activeplayer";
             }  else {
                 $active="";
             }
         }
         ?>
         <tr class="<?php echo $active; ?>">
         <td><p><?php 
            echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $game_score_user['photo'];?>"> <p class="left"><?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?></p></td>
         <td><p><?php if($score_game['game_score']<0){ echo "0";}else{ echo $score_game['game_score'];} ?></p></td>
         </tr>
         
         
          <?php
    }
  }
   
    ?>
      </tbody>
      </table>
       </div>

<?php }else if($_GET['message'] == 'nextpage')
    {
        //$_SESSION['pagination_direction_num'] = $_GET['noofitemshow'];
    if($_SESSION['pagination_direction_num'] == $_SESSION['last_num'])
        {
            $_SESSION['pagination_direction_num'] = $_SESSION['last_num'];
        }else{
        $_SESSION['pagination_direction_num']++;
        }
$ending = $_SESSION['pagination_direction_num']*10;
$starting = ($ending-10)+1;

?>
<div id="game_leader_board"> 
         <table class="highscore_table table-nonfluid table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Score</th>
         </tr>
         </thead>
         <?php 
     $i=$starting;
     $active="";
     $game_id=$_REQUEST['gameid'];
     $sore_games=getAllGameScorePagination($starting,$ending,$game_id);
     if($sore_games>0)
     {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i;
            $games_scores_user=  getUserById($score_game['user_id']);
            $game_score_user=  mysql_fetch_array($games_scores_user);
            
    ?>
             <?php
         if(isset($_SESSION['user_loged_id']))
         {
             $user_id=$_SESSION['user_loged_id'];
             if($score_game['user_id']==$user_id)
             {
                $active="activeplayer";
             }  else {
                 $active="";
             }
         }
         ?>
         <tr class="<?php echo $active; ?>">
         <td><p><?php 
            echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $game_score_user['photo'];?>"> <p class="left"><?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?></p></td>
         <td><p><?php if($score_game['game_score']<0){ echo "0";}else{ echo $score_game['game_score'];} ?></p></td>
         </tr>
         
         
          <?php
    }
  }
   
    ?>
      </tbody>
      </table>
       </div>
 <?php   }else if($_GET['message'] == 'previouspage')
    {
      //  $_SESSION['pagination_direction_num'] = $_GET['noofitemshow'];
     
     if($_SESSION['pagination_direction_num'] == 1)
    {
        $_SESSION['pagination_direction_num'] = 1;
    }else
        {
        $_SESSION['pagination_direction_num']--;
        }

$ending = $_SESSION['pagination_direction_num']*10;
$starting = ($ending-10)+1;


?>
<div id="game_leader_board"> 
         <table class="highscore_table table-nonfluid table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Score</th>
         </tr>
         </thead>
         <?php 
     $i=$starting;
     $active="";
     $game_id=$_REQUEST['gameid'];
     $sore_games=getAllGameScorePagination($starting,$ending,$game_id);
     if($sore_games>0)
     {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i;
            $games_scores_user=  getUserById($score_game['user_id']);
            $game_score_user=  mysql_fetch_array($games_scores_user);
            
    ?>
             <?php
         if(isset($_SESSION['user_loged_id']))
         {
             $user_id=$_SESSION['user_loged_id'];
             if($score_game['user_id']==$user_id)
             {
                $active="activeplayer";
             }  else {
                 $active="";
             }
         }
         ?>
         <tr class="<?php echo $active; ?>">
         <td><p><?php 
            echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $game_score_user['photo'];?>"> <p class="left"><?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?></p></td>
         <td><p><?php if($score_game['game_score']<0){ echo "0";}else{ echo $score_game['game_score'];} ?></p></td>
         </tr>
         
         
          <?php
    }
  }
   
    ?>
      </tbody>
      </table>
       </div>
 <?php   } ?>
