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
         <table class="highscore_table table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Points</th>
         </tr>
         </thead>
         <tbody>
             <?php
           $i=$starting;      
           $active="";
           $current_date=date("Y-m-d");
           $sore_games=getDailyPointsPagination($starting,$ending);
           if($sore_games>0)
            {
            while($score_game=  mysql_fetch_array($sore_games))
            { 
              $i;    
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
         <td><p><?php echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $score_game['user_image'];?>"> <p class="left"><?php 
          echo $score_game['user_name'];
          ?></p></td>
         <td><p><?php echo round($score_game['total_points']); ?></p></td>
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
         <table class="highscore_table table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Points</th>
         </tr>
         </thead>
         <tbody>
             <?php
           $i=$starting;      
           $active="";
           $current_date=date("Y-m-d");
           $sore_games=getDailyPointsPagination($starting,$ending);
           if($sore_games>0)
            {
            while($score_game=  mysql_fetch_array($sore_games))
            { 
              $i;    
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
         <td><p><?php echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $score_game['user_image'];?>"> <p class="left"><?php 
          echo $score_game['user_name'];
          ?></p></td>
         <td><p><?php echo round($score_game['total_points']); ?></p></td>
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
         <table class="highscore_table table table-striped">
         <thead>
         <tr>
         <th>Rank</th>
         <th>Player</th>
         <th>Points</th>
         </tr>
         </thead>
         <tbody>
             <?php
           $i=$starting;      
           $active="";
           $current_date=date("Y-m-d");
           $sore_games=getDailyPointsPagination($starting,$ending);
           if($sore_games>0)
            {
            while($score_game=  mysql_fetch_array($sore_games))
            { 
              $i;    
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
         <td><p><?php echo $i++; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $score_game['user_image'];?>"> <p class="left"><?php 
          echo $score_game['user_name'];
          ?></p></td>
         <td><p><?php echo round($score_game['total_points']); ?></p></td>
         </tr>         
         <?php
          }
        }
       ?>
         </tbody>
         </table>       
    </div>
 <?php   } ?>
