<?php
session_start();
include("dbconnection.php");
$link="$_SERVER[REQUEST_URI]";
if($link=='/view-maverick-game.php?id=do-the-dive')
{
    header("location: https://www.maverickgame.com/maverick-game-do-the-dive");
}
if($link=='/view-maverick-game.php?id=furious-red'){
 header("location: https://www.maverickgame.com/maverick-game-furious-red");
}
if($link=='/view-maverick-game.php?id=master-cook')
{
 header("location: https://www.maverickgame.com/maverick-game-master-cook");
}
if($link=='/view-maverick-game.php?id=word-ster')
{
 header("location: https://www.maverickgame.com/maverick-game-word-ster");
}
if($link=='/view-maverick-game.php?id=dragon-draft')
{
 header("location: https://www.maverickgame.com/maverick-game-dragon-draft");
}
if($link=='/view-maverick-game.php?id=crisis')
{
 header("location: https://www.maverickgame.com/maverick-game-crisis");
}
$links=explode("/",$link);
if(count($links)==2)
{
    $seo=$links[1];
}  else {
    $seo=$links[2];
}
$seo=substr($seo, 14);
$game_details=getGameBySeo($seo);
$game_detail=  mysql_fetch_array($game_details);
?>
<!DOCTYPE HTML>
<html>
<head>

<title><?php echo $game_detail['game_seo_title']; ?></title>
<meta content="<?php echo $game_detail['meta_tag_keywords']; ?>"  name="keywords" />
<meta content="<?php echo $game_detail['meta_tag_description']; ?>" name="description"  />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body class="game">
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
<img src="assets/images/baninner/draon-draft.jpg" width="1366" height="230" class="banpic" alt="">
</div>

	<div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
     <div class="box-inner">
     <div class="alert alert-danger" role="alert"><strong>Note: </strong>For best gaming experience our games have been developed on Unity WebGl, recommeded devices  are desktops/laptops and loading may take 3-5 mins .Thanks for your support.</div>
<?php
if($seo=='maverick-game-do-the-dive')
{
?>
<div class="alert alert-info" role="alert" style="display:none">
<h4>For Those Who Dare to Win!</h4>
<hr>
Buy Coins and Play <strong>"Do The Dive"</strong> game. Reach score of <strong>100,000</strong> to Win a brand new <strong>Samsung Galaxy TAB 4</strong> Tablet Instantly. Achieve this score by <strong>6th November 2015 - 6:00pm.</strong><br>
<br>
All the very best Maverick Gamers. <br>
<strong>Happy Winnings!</strong>
</div>
<?php
}
?>
<img src="silverhat_games/game_image/<?php echo $game_detail['game_image'];?>" alt="gaming" class="img-responsive">
<hr>
  <h2 class="hd-main"> <?php echo $game_detail['game_name']; ?></h2>
  <hr>
<p><?php echo $game_detail['game_description']; ?></p>       
                    
  <?php
  if(isset($_SESSION['user_loged_id']))
  {
  ?>
  <a class="btnread" href="<?php echo $game_detail['game_file'];?>" onClick="ga('send', 'event', '<?php echo $game_detail["game_name"];  ?>', 'Play <?php echo $game_detail["game_name"];  ?>');">PLAY NOW</a>
 <?php
  }else
 {
  ?> 
  <a class="btnread" href="maverick-game-user-login"> LOGIN</a> 
  <a class="btnread" href="maverick-game-user-register"> SIGN UP</a>
<?php
 }
 ?>
		</div>
     </div>
     <div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarscore.php");
	  ?>
      <?php
		include("includes/sidebarpoints.php");
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