<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id'];
 $seo=1;
$game_details=  getGameById($seo);
$game_detail=  mysql_fetch_array($game_details);
}else
{
    header("location:maverick-game-user-login");
}

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
<img src="assets/images/baninner/master-cook.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
    <div class="row">
    <div class="col-md-9">   
    <div class="box-inner">
    <h2 class="hd-main">ACCOUNT SETTINGS</h2>
    <div class="score-tabs">
  <ul>
   <li><a href="maverick-user-profile">Personal Information</a></li>
    <li><a href="update-password">Update Password</a></li>
    <li><a href="user-games-point">User Points</a></li>
    <li><a class="active" href="user-game-score">User Score</a></li> 
    <!--<li><a href="user-rewards">User Rewards</a></li>-->
    <li><a href="user-profile-picture.php">Upload Image</a></li>
  </ul>
  <div class="clearfix"></div><br>
  <p>Click on the tabs provided below to view your each game score earned. To check your Highest Score go to The Leaderboard. and Click on Points Leader to see your accumulated points to gain rewards.</p>
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
                <li ><a onclick="return getUserGameScore(<?php echo $session_id; ?>,<?php echo $game_tab['game_id']; ?>)"><?php echo $game_tab['game_name'];?></a></li>          
        <?php 
            }
        }
        ?>    
          </ul>
            
            
        <div id="game_leader_board">
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
    $sore_games=getGameScoreByUserId($session_id,$game_detail['game_id']);
    if($sore_games>0)
    {
        while($score_game=  mysql_fetch_array($sore_games))
        {      
    ?>             
         <tr>
             <td><p>
             <?php
             echo date("d-m-Y",  strtotime($score_game['createdAt']));
             ?>
                 </p></td>
         <td><p><?php echo $score_game['user_game_score']; ?></p></td>
         </tr>
         
         
          <?php
    }
  }
   
    ?>
         </tbody>
         </table> 
         
            
</div>
        </div>
            <div id="game_score" style="display:none;"></div>   
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
<script>
 function getUserGameScore(user_id,game_id)
      {
         
          var game_id=game_id
          var user_id=user_id;
 	  jQuery.ajax({
   	  type: "GET",
    	  url: "getusergamescore.php",
    	  data: "user_id="+user_id+"&game_id="+game_id,
    	  success: function(response){
	  jQuery("#game_score").html(response);
  	   if(!game_id)
  	   {
		jQuery("#game_score").hide(); 
                jQuery("#game_leader_board").show();                 
   	  }else
  	  {
		jQuery("#game_score").show();  
                jQuery("#game_leader_board").hide();  
          }
	}
        });	
      }
</script>
</body>
</html>