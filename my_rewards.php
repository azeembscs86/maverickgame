<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['user_loged_id']))
{
 $session_id= $_SESSION['user_loged_id'];
 $user_detail=getUserById($_SESSION['user_loged_id']);
 $user=  mysql_fetch_array($user_detail);  
 $user_points=countAwardRedeemPointByUserId($_SESSION['user_loged_id']);
 $user_point=  mysql_fetch_array($user_points);
}else
{
    header("location:maverick-game-user-login");
}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game | Points</title>
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
<div class="leader-area">
  <div class="container">
    <div class="row">
    <div class="col-md-1 col-sm-1"></div>
      <div class="col-md-9 col-sm-9">
      <div class="leader-wrap" style="min-height:450px;">
     <h2 class="">Points</h2>
     <?php
include("points-navigation.php");?>
        <div class="row">
      <div class="col-md-9">
          <h3 class="text-uppercase white">My Points Account Balance </h3>
          <p class="white"> Points add up fast so be sure to check your balance! When you've earned enough, you can redeem them for valuable in-game currency on mavericgame.com.*</p>
          <p class="white">Want to earn even faster? Head to our Earn Points Page to see how! </p>
          
          </div>
          
          <div class="col-md-3">
          <div class="points" style="margin:10px 0 0;">
         <p class="white"> Redeem Points
          <span> <?php echo $user_point['utilize_points']; ?></span></p>
          
          </div>
          <div class="point-date">Updated <?php echo date("d-m-Y",  strtotime($user_point['utilize_points_date'])); ?> </div>
          </div>
          
          <div class="col-md-12">
          <table class="table-points table-striped table-responsive table-bordered table-forum">
          <thead>
			<tr>
                <th><span class="tableformyelo">Date </span></th>
                <th><span class="tableform">Rewards </span></th>
                <th><span class="tableform">Redeem Points</span></th>
              </tr>
			</thead>
            <tbody>
              <?php
             $user_points_ac=getRewardsUserId($session_id);
             if($user_points_ac>0)
             {
                 while($points_user=  mysql_fetch_array($user_points_ac)){
             
             ?>
                <tr>
                    <td><?php echo date("d-m-y",  strtotime($points_user['utilize_points_date'])); ?></td>
                <td>Redeem Award
                <?php
                  echo $points_user['reward_name'];
                ?>
                </td>
                 
                <td><?php
                  echo $points_user['utilize_points'];
                ?></td>
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
<div class="clearfix"></div>

<?php
include("footer-toparea.php");
?>
<?php
include("footer.php");
?>
</body>
</html>