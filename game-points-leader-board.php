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
<script>
    // Dynamic Change List Of Products
   function score_pagination(nooflist,messagestatus)
   {
       
                        xhr =  new XMLHttpRequest();
			xhr.open('GET','point-pagination.php?noofitemshow='+nooflist+'&message='+messagestatus,true);
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
    <div class="col-md-9 col-sm-9">
    <div class="box-inner">

    <h2 class="hd-main">Leaderboard</h2>
    <div class="tabscore">
    <ul class="nav nav-tabs" role="tablist">
    <li>
     <a href="game-leader-board-1">High Score Leaderboard</a>
    </li>
    <li class="active">
    <a href="game-point-leader-board">Point Leaderboard</a>
    </li>
    </ul>
        <div class="score-tabs">
        <div class="col-md-2"></div>
            <div class="col-md-8"><ul class="gamepoint">
        	<li><a class="active" href="game-point-leader-board">All Time </a></li>
            <li><a href="game-point-weekly-leader-board">This Week</a></li>
            <li><a href="game-point-daily-leader-board">Today </a></li>
          </ul></div>
        <div class="clearfix"></div>
        <div class="highscore">
        <div class="row">
        <div class="col-md-12">
        <h3>All Time Leaderboard</h3>
        </div>
            <?php
            if(isset($_SESSION['user_loged_id']))
            {
                $user_information= getUserById($_SESSION['user_loged_id']);                               
                $u_info= mysql_fetch_array($user_information);
                $current_user=countUserPointByUserId($_SESSION['user_loged_id']);
                if($current_user>0)
                {
                    $user_current_score=  mysql_fetch_array($current_user);
                }       
                 $utilize=countUtilizeUserPointByUserId($_SESSION['user_loged_id']);
                 $utilize_point=  mysql_fetch_array($utilize);
         ?>
            <?php
            if($user_current_score['user_id']>0)
            {
            ?>
        <div>
        <div class="col-md-1 nopad-right">
          <img src="user_images/<?php echo $u_info['photo'];  ?>" width="39" height="39" alt=""> </div>
          <div class="col-md-3 nopad-left">
          <h4 class="hcname"><?php echo $u_info['user_name'];  ?></h4>
          </div>
          <div class="col-md-2">
          <h4 class="hcrank">RANK: <span><?php 
          $user_rank=getPointsUserRank($_SESSION['user_loged_id']);
          echo $user_rank;
          ?></span></h4>
          </div>
          <div class="col-md-3">
          <h4 class="hcscore">POINTS: <span><?php echo round($user_current_score['over_all_points']); ?></span></h4>
          </div>
          <div class="col-md-3 nopad">
          <h4 class="hcscore">REDEEM: <span><?php echo round($utilize_point['utilize_points']); ?></span></h4>
          </div>
          </div>
            <?php
            }
            }
            ?> 
        </div>
        </div>
        
        
        <div id="paginationscore">
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
           $i=0;      
           $active="";
           $sore_games=getAllTimePointsLeaderBoard();
           if($sore_games>0)
            {
            while($score_game= mysql_fetch_array($sore_games))
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
         <td><p><?php echo round($score_game['total_points']); ?></p></td>
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
      <a onclick="score_pagination('','previouspage')" href="javascript:void(0)" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </div>
  <ul class="pagination">
    
    
    <?php
        // Number of Index show
         $score_games = getPointsNoOfIndex();
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
    <li class="indexid"><a onclick="score_pagination(<?php echo $loop_counter; ?>,'numberpagination')" href="javascript:void(0)"><?php echo $loop_counter; ?></a></li>
            <?php $i +=10;  $_SESSION['last_num']=$loop_counter; $loop_counter++;
            
            if ($loop_counter == 10) 
                {
                  break;    
                }
            
            } ?>
    
  </ul>
  <div class="nextpage">
        
      <a onclick="score_pagination('','nextpage')" href="javascript:void(0)" aria-label="Next">
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
     
</body>
</html>

<?php
            $loop_counterr = 1;
            for($i=0;$i<=$index_counter;)
            {
                $i +=10; 
                $_SESSION['last_num']=$loop_counterr;
                $loop_counterr++;
            }
          
        ?>