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
<div class="leader-area">
<div class="container">
<div class="row">
<div class="col-md-1 col-sm-1"></div>
<div class="col-md-9 col-sm-9">    
<div class="leader-wrap">
<div class="col-md-12"> 
<h2>leaderboard</h2>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="col-md-4"><a href="maverick-leader-board" class="tophd">All Games<br> Leaderboard</a></div>
<div class="col-md-4">
<a href="highest-leader-board" class="tophd">HIGH SCORE <br>leaderboard</a>
</div>
<div class="col-md-4">
<a href="game-point-leader-board" class="tophd">Point<br>leaderboard</a>
</div>
</div>
</div>
<div id="tabs" class="score-tabs">
    <ul>
<?php 
$games_tabs=  getAllGames();
if($games_tabs>0)
{
    while($game_tab=  mysql_fetch_array($games_tabs))
    {       
?>
  <li ><a href="game-leader-board-<?php echo $game_tab['game_id']; ?>"><?php echo $game_tab['game_name'];?></a></li>          
<?php 
    }
}
?>    
  </ul>
<div class="clearfix"></div>
<div class="highscore">
<div class="row"> 
<div class="col-md-12">
<h3>High Score Leaderboard</h3>
</div>       
    <?php
    if(isset($_SESSION['user_loged_id']))
    {
        $user_information = getUserById($_SESSION['user_loged_id']);                               
        $u_info = mysql_fetch_array($user_information);
        $current_user = countHightestGameScoreByUserId($_SESSION['user_loged_id']);
        if($current_user>0)
        {
            $user_current_score=  mysql_fetch_array($current_user);
        }                
 ?>
    <?php
    if($user_current_score['user_id']>0)
    {
    ?>
<div class="bdr-bot-red">
<div class="col-md-1 nopad-right">
  <img src="user_images/<?php echo $u_info['photo'];  ?>" width="39" height="39" alt=""> </div>
  <div class="col-md-3 nopad-left">
  <h4 class="hcname"><?php echo $u_info['user_name'];  ?></h4>
  </div>
  <div class="col-md-4">
  <h4 class="hcrank">RANK: <span><?php 
  $user_rank=getHigehestScoreUserRank($_SESSION['user_loged_id']);
  echo $user_rank;
  ?></span></h4>
  </div>
  <div class="col-md-4">
  <h4 class="hcscore">SCORE: <span><?php echo $user_current_score['game_score']; ?></span></h4>
  </div>
  </div>
     <?php
    }
    }
    ?> 
<div class="bdr-bot-red" style="margin:0 0 5px;"></div>
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
   $sore_games=getHightestGameScoreLeaderBoard();
   if($sore_games>0)
    {
    while($score_game=  mysql_fetch_array($sore_games))
    { 
        $i++;    
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
 <td><p><?php echo $i; ?></p></td>
 <td><img width="34" height="34" alt="" src="user_images/<?php echo $score_game['user_image'];?>"> <p class="left"><?php 
  echo $score_game['user_name'];
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
</div>
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