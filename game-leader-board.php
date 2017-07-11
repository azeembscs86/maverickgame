<?php
session_start();
include("dbconnection.php");
$link="$_SERVER[REQUEST_URI]";
$error="leader-board";
if($link=='/game-leader-board-')
{
    header("location:$error");
}  if($link=='/game-leader-board') {
    header("location:$error");
}
$links=explode("/",$link);
if(count($links)==2)
{
    $seo=$links[1];
}  else {
    $seo=$links[2];
}
$seo=substr($seo, 18);
$game_details=  getGameById($seo);
$game_detail=  mysql_fetch_array($game_details);
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
<script>
    // Dynamic Change List Of Products
   function score_pagination(gameidd,nooflist,messagestatus)
   {
                        xhr =  new XMLHttpRequest();
			xhr.open('GET','board_pagination.php?noofitemshow='+nooflist+'&gameid='+gameidd+'&message='+messagestatus,true);
			xhr.send();
			
			xhr.onreadystatechange=function()
			{
				if(xhr.readyState == 4 && xhr.status == 200)
				{
					document.getElementById("paginationscore").innerHTML = xhr.responseText;
				}
			}
   }
   



</script>
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
<img src="assets/images/baninner/crisis.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
    <div class="row">
    <div class="col-md-9">
    <div class="box-inner">
    <h2 class="hd-main">Leaderboard</h2>
        <div class="tabscore">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active">
     <a href="game-leader-board-1">High Score Leaderboard</a>
    </li>
    <li>
    <a href="game-point-leader-board">Point Leaderboard</a>
    </li>
    </ul>
        <div id="tabs" class="score-tabs">
            <div class="row">
           <div class="col-md-6"><select class="gamesdrop" id="game_score" name="game_score">
    <option value="">Select Game Name</option>      
        <?php 
        $games_tabs=  getAllGames();
        if($games_tabs>0)
        {
            while($game_tab=  mysql_fetch_array($games_tabs))
            {       
        ?>
             <option value="<?php echo $game_tab['game_id']; ?>" <?php if($game_tab['game_id']==$game_detail['game_id']){ ?> selected="selected" <?php }?>><?php echo $game_tab['game_name'];?></option>          
        <?php 
            }
        }
        ?>    
</select></div>
          <div class="col-md-6 nopad-left"><div class="alert alert-info" role="alert"><i class="fa fa-hand-o-left fa-lg"></i> &nbsp;&nbsp; | &nbsp;&nbsp; 
 Select games to view score of each game</div></div>
          </div>
        <div class="highscore">
        <div class="row">
        <div class="col-md-12">
        <h3><?php echo $game_detail['game_name']; ?></h3>
        </div>
            <?php
            if(isset($_SESSION['user_loged_id']))
            {
                $user_information= getUserById($_SESSION['user_loged_id']);                               
                $u_info= mysql_fetch_array($user_information);
                $current_user=countGameScoreByGameIdUserId($_SESSION['user_loged_id'],$game_detail['game_id']);
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
          <h4 class="hcrank">RANK: <span>
          <?php 
          $user_rank=getUserRank($_SESSION['user_loged_id'],$game_detail['game_id']);
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
        </div>
        </div>
        
        <!----- Start -->
        
        <div id="paginationscore">
              
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
     $_SESSION['leader-board-game-id'] = $game_detail['game_id'];
     $sore_games=getGameScoreByScoreId($game_detail['game_id']);
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
         <td><p><?php if($score_game['game_score']<0){ echo "0";}else{ echo $score_game['game_score'];} ?></p></td>
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
 <!-- Pagination --->
  <?php
         if(!isset($_SESSION['pagination_direction_num']))
        {
            $_SESSION['pagination_direction_num'] = 1;
            $_SESSION['last_num'] = 0;
        }else
            {
                $_SESSION['pagination_direction_num'] = 1;
            }
  ?>
      
    <nav class="text-center">
    <div class="prevpage">
      <a onclick="score_pagination(<?php echo $game_detail['game_id']; ?>,'','previouspage')" href="javascript:void(0)" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </div>
  <ul class="pagination">
    <?php
        // Number of Index show
         $score_games = getNoOfIndex($game_detail['game_id']);
         $index_counter = 0;
         while($score_game_result=  mysql_fetch_array($score_games))
        {
             $index_counter++;
        }
       // $total_index = round($index_counter/10);
       
    ?>
    
    <?php
            $loop_counter = 1;
            for($i=0;$i<=$index_counter;){
    ?>
    <li class="indexid"><a onclick="score_pagination(<?php echo $game_detail['game_id']; ?>,<?php echo $loop_counter; ?>,'numberpagination')" href="javascript:void(0)"><?php echo $loop_counter; ?></a></li>
            <?php $i +=10;  $_SESSION['last_num']=$loop_counter; $loop_counter++;
            
            if ($loop_counter == 10) 
                {
                  break;    
                }
            
            }
            
            
            ?>
    
  </ul>
  <div class="nextpage">
        
      <a onclick="score_pagination(<?php echo $game_detail['game_id']; ?>,'','nextpage')" href="javascript:void(0)" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </div>
</nav>
  
   <!-- End Pagination --->
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
<?php
            $loop_counterr = 1;
            for($i=0;$i<=$index_counter;)
            {
                $i +=10; 
                $_SESSION['last_num']=$loop_counterr;
                $loop_counterr++;
            }
          
        ?>
</body>
</html>