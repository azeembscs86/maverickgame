<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
  <head>
  
  <title>Leader Board - Check your Game Score | Maverick Game</title>
    <meta  content="leader board, maverick game, game score" name="keywords" />
  <meta content="Check you game score by entering our LeaderBoard at Maverick Game"  name="description" />
  <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
  </head>

  <body>
<?php
            include("user-login-menus.php");
            ?>
<?php
include("sidebarlinks.php");
?>
<div class="baninner">
<?php
	include("navigation.php");
?>
<div class="bgshadow"></div>
<img src="assets/images/baninner/dothedive.jpg" width="1366" height="230" class="banpic" alt="">
</div>

<div class="container">
    <div class="row">
    <div class="col-md-9">    
    <div class="box-inner">  
        <h2 class="hd-main">leaderboard</h2>
        <p>Only your highest score in the game are shown here, click on Points Leader to see your accumulated points. Your individual game score and points are shown in your account</p>
        
    <div class="tabscore">
    <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="active">
     <a href="game-leader-board-1">High Score Leaderboard</a>
    </li>
    <li>
    <a href="game-point-leader-board">Point Leaderboard</a>
    </li>
    </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="score-tabs">
    
           <div class="row">
           <div class="col-md-6"><select class="gamesdrop">
        <?php 
        $games_tabs=  getAllGames();
        if($games_tabs>0)
        {
            while($game_tab=  mysql_fetch_array($games_tabs))
            {
       
        ?>
          <option><a href="game-leader-board-<?php echo $game_tab['game_id']; ?>"><?php echo $game_tab['game_name'];?></a></option>          
        <?php 
            }
        }
        ?>    
          </select></div>
          <div class="col-md-6 nopad-left"><div class="alert alert-info" role="alert"><i class="fa fa-hand-o-left fa-lg"></i> &nbsp;&nbsp; | &nbsp;&nbsp; 
 Select games to view score of each game</div></div>
          </div>
        <div class="highscore">
        <div class="row text-center">        
            <?php
            if(isset($_SESSION['user_loged_id']))
            {
                $game_id=1;
                $user_information = getUserById($_SESSION['user_loged_id']);                               
                $u_info = mysql_fetch_array($user_information);
                $current_user=countGameScoreByGameIdUserId($_SESSION['user_loged_id'],$game_id);
                if($current_user>0)
                {
                    $user_current_score=  mysql_fetch_array($current_user);
                }                
         ?>
            <?php
            if($user_current_score['user_id']>0)
            {
            ?>

        <div class="col-md-1 nopad-right">
          <img src="user_images/<?php echo $u_info['photo'];  ?>" width="39" height="39" alt=""> </div>
          <div class="col-md-3 nopad-left">
          <h4 class="hcname"><?php echo $u_info['user_name'];  ?></h4>
          </div>
          <div class="col-md-3">
          <h4 class="hcrank">RANK:&nbsp; <span> <?php 
          $user_rank=getUserRank($_SESSION['user_loged_id'],$game_id);
          echo $user_rank;
          ?></span></h4>
          </div>
          <div class="col-md-5">
          <h4 class="hcscore">SCORE:&nbsp; <span><?php echo $user_current_score['game_score']; ?></span></h4>
          </div>
   
             <?php
            }
            }
            ?> 
        </div>
        </div>
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
     $i=0;
     $active="";
     $game_id=1;
     $sore_games=getGameScoreByScoreId($game_id);
     if($sore_games>0)
     {
        while($score_game=  mysql_fetch_array($sore_games))
        {
            $i++;
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
            echo $i; ?></p></td>
         <td><img width="34" height="34" alt="" src="user_images/<?php echo $game_score_user['photo'];?>"> <p class="left"><?php 
   if($game_score_user['user_name']!=""){ 
       echo $game_score_user['user_name'];
   }  else {
       echo $game_score_user['name'];
   }
    ?></p></td>
         <td><p><?php echo $score_game['game_score']; ?></p></td>
         </tr>
         
         
          <?php
    }
  }
   
    ?>
      </tbody>
      </table>
      </div>
      </div>

    
  </div>
      <?php
include("includes/pagination-score.php");
?>
    
    </div>
        
      </div>
      </div>
      <div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarpoints.php");
	  ?>
      <?php
		include("includes/sidebarscore.php");
	  ?>
      </div>
      </div>
  </div>
  </div>

  <?php
include("footer-toparea.php");
?>
<?php
include("footer.php");
?>
</body>
</html>