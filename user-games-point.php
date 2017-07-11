<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id'];
 $user_detail=getUserById($_SESSION['user_loged_id']);
 $user=  mysql_fetch_array($user_detail);  
 $user_points=countUserPointByUserId($_SESSION['user_loged_id']);
 $user_point=  mysql_fetch_array($user_points);
}else
{
    header("location:maverick-game-user-login");
}
?>    
<!DOCTYPE HTML>
<html>
<head>

<title><?php echo $_SESSION['loged_fullname']; ?>'s Profile</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

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
<img src="assets/images/baninner/wordster.jpg" width="1366" height="230" class="banpic" alt="">
</div>
	<div class="container">
    <div class="row">
     <div class="col-md-9">
     <div class="box-inner">
     
     <h2 class="hd-main">User Game Points</h2>

   
<div class="score-tabs">
  <ul>
   <li><a href="maverick-user-profile">Personal Information</a></li>
    <li><a href="update-password">Update Password</a></li>
    <li><a class="active" href="user-games-point">User Points</a></li>
    <li><a href="user-game-score">User Score</a></li> 
    <!--<li><a href="user-rewards">User Rewards</a></li>-->
    <li><a href="user-profile-picture.php">Upload Image</a></li>
  </ul>  
    <div id="tabs-3">
  
  <div class="con-div">
   <div class="row">
      <div class="col-md-9">
          <h3 class="text-uppercase">My Points Account Balance </h3>
          <p> Points add up fast so be sure to check your balance when you have played the game. You can redeem them for real rewards by going to rewards section</p>
          <p>Go to reward store and see how much more points do you need to reach to desired reward. </p>
          <p>If any queries please write to us at info@maverickgame.com </p>
          </div>
          
          <div class="col-md-3">
          <div class="points">
         <p> Points
          <span>
              
             <?php echo round($user_point['over_all_points']); ?></span></p>
          
          </div>
              <div class="point-date">Updated <?php echo date("d-m-Y"); ?></div>
          </div>
          
          <div class="col-md-12">
          <table class="table-points table-striped table-responsive table-bordered table-forum">
          <thead>
			<tr>
                <th><span class="tableformyelo">Date </span></th>
                <th><span class="tableform">Activity </span></th>
                <th><span class="tableform">Points Earned </span></th>
                <th><span class="tableform">Redeem Points</span></th>
              </tr>
			</thead>
            
              <tbody>
             <?php
             $user_points_ac=getUserGamePointsByUserId($session_id);
             if($user_points_ac>0)
             {
                 while($points_user=  mysql_fetch_array($user_points_ac)){
             
             ?>
                <tr>
                    <td><?php echo date("d-m-y",  strtotime($points_user['updatedAt'])); ?></td>
                <td>Played game 
                <?php                 
                 echo $points_user['game_name'];
                ?>
                </td>
                 <td><?php echo round($points_user['total_points']); ?></td>
                <td>0</td>
              </tr>  
            <?php      
                 }
                 
                 
             }
             ?>
                  
             
              <?php
              $user_redeem_points=getUserRedeemPointByUserId($session_id);
              if($user_redeem_points>0)
              {
                  while($user_redeem_point=  mysql_fetch_array($user_redeem_points))
                  {
             ?>         
           <tr>
             <td><?php echo date("d-m-y",  strtotime($user_redeem_point['utilize_points_date'])); ?></td>
                <td>Redeem Award
                <?php
                 echo $user_redeem_point['reward_name'];
                ?>
                </td>
                 <td>0</td>
                <td><?php echo $user_redeem_point['utilize_points']; ?></td>
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
  
  <div class="clearfix"></div>
  <br/>
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