<meta name="viewport" content="width=1300">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,100,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
<section class="top-header animated">
	<div class="container">
        	<div class="row">
        	<div class="col-md-6 nopad-right">
            	<ul class="navigation">
				<li>
		<h2><i class="fa fa-question-circle"></i>&nbsp; Know More</h2>
		<p>Welcome to Maverick</p>
        <div class="navinner navlist" style="width:470px;">
       <ul>
         <li><a href="../index.php"><i class="fa fa-angle-double-right"></i> Home</a></li>
         <li><a href="../game-package-payment"><i class="fa fa-angle-double-right"></i> Buy Coins</a></li>
         <li><a href="../leader-board"><i class="fa fa-angle-double-right"></i> Game Score</a></li>
         <li><a href="../maverick-game-rewards-store"><i class="fa fa-angle-double-right"></i> Rewards</a></li>   
        <li><a href="../about-us"><i class="fa fa-angle-double-right"></i> About US</a></li> 
        <li><a href="../maverickgame-blog"><i class="fa fa-angle-double-right"></i> Blog</a></li>
        <li><a href="../maverick-faq"><i class="fa fa-angle-double-right"></i> FAQ's</a></li>
        <li><a href="../contact-us"><i class="fa fa-angle-double-right"></i> Contact US</a></li>             
      </ul>
      
        </div>
	</li>
    			<li>
		<h2><i class="fa fa-gamepad"></i>&nbsp; Games</h2>
		<p>Play and Get Rewards</p>
        <div class="navinner">
        <ul>
        <li><a href="../maverick-game-do-the-dive">
        <div class="row">
        <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/dothedive.png" alt=""></div>
        <div class="col-md-7 nopad-left border-left">
        <h5>Do The Dive</h5>
        <p>Skydiving would be so much...</p></div>
        </div> </a></li>   
          <li><a href="../maverick-game-furious-red">
          <div class="row">
          <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/furiousred.png" alt=""></div>
          <div class="col-md-7 nopad-left border-left"><h5> Furious Red </h5>
        <p>Either diving, racing or...</p></div>
        </div>
        </a></li>     
          <li><a href="../maverick-game-master-cook">
          <div class="row">
          <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/master-cook.png" alt=""></div>
          <div class="col-md-7 nopad-left border-left">
          <h5> Master Cook </h5>
        <p>Girls love cooking as it...</p></div></div>
        </a></li>    
          <li><a href="maverick-game-word-ster">
          <div class="row">
          <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/wordster.png" alt=""></div>
          <div class="col-md-7 nopad-left border-left"><h5> Wordster </h5>
        <p>Wordster is a word builder...</p></div>
        </div>
        </a></li>
        <li><a href="../maverick-game-dragon-draft">
        <div class="row">
        <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/dragondraft.png" alt=""></div>
        <div class="col-md-7 nopad-left border-left"><h5> Dragon Draft </h5>
        <p>Did you know the draft game...</p></div>
        </div>
        </a></li>   
          <li><a href="../maverick-game-crisis">
          <div class="row">
          <div class="col-md-5 nopad-right"><img src="../silverhat_games/game_home_image/crisis.png" alt=""></div>
          <div class="col-md-7 nopad-left border-left"><h5> Crisis </h5>
        <p>You feel the hollows...</p></div>
        </div>
        </a></li>
      </ul>
        </div>
	</li>
				<li>
       <?php if(isset($_SESSION['user_loged_id']))
      {  
       $session_id= $_SESSION['user_loged_id'];
       $user_detail=getUserById($_SESSION['user_loged_id']);
       $user=  mysql_fetch_array($user_detail);  
       $user_points=countUserPointByUserId($_SESSION['user_loged_id']);
       $user_point=  mysql_fetch_array($user_points);                                   
       ?>
		<h2><i class="fa fa-money"></i>&nbsp; Points : <span class="coinstxt"><?php echo round($user_point['over_all_points']); ?></span>
                
                </h2>
		<p>Your Total Points</p>
                <?php
}else{
                ?>
                <h2><i class="fa fa-money"></i>&nbsp; Points 
                
                </h2>
                <p>View points leaderboard</p>
                <?php
                }
                ?>
        <div class="navinner navlist" style="width:240px;">
       <ul>
       <li><a href="../game-point-leader-board"><i class="fa fa-angle-double-right"></i> All Time Points</a></li>
       <li><a href="../game-point-weekly-leader-board"><i class="fa fa-angle-double-right"></i> Weekly Points</a></li>
       <li><a href="../game-point-daily-leader-board"><i class="fa fa-angle-double-right"></i> Today Points</a></li>
       
      </ul>
      
        </div>
	</li>
				</ul>
			</div>                
<div class="col-md-6 nopad">      
            
<div class="top-right-side">
           	
<?php
if(isset($_SESSION['user_loged_id']))
{    
    $user_profile_pics=  getUserById($_SESSION['user_loged_id']);
    $user_profile_pic=  mysql_fetch_array($user_profile_pics);
?>
<div class="col-md-8 nopad-left">
<?php 
$user_coins=getCoinsByUserId($_SESSION['user_loged_id']);
    $user_coin=  mysql_fetch_array($user_coins);
    if($user_coin['total_coins']>0)
    {    
        ?>
        <div class="col-md-7 nopad-left">
        <ul class="navigation">
<li style="width:100%; padding:0 0 0 15px">
		<h2 id='coinsupdate'><i style="font-size:18px" class="fa fa-certificate fa-spin yellow"></i>&nbsp; Coins : <span class="coinstxt"><?php echo $user_coin['total_coins']; ?></span></h2>
		<p>Your Remaining Game Coins</p>
	</li>
    </ul></div>
<?php
    }else
    {
 ?>
<div class="col-md-6 nopad">
            <div class="coins">
            <p>0</p>
              <img src="../assets/images/btn_coins.png" width="97" height="30" alt="" /> </div></div>
<?php
    }
    ?>
<div class="col-md-5 nopad">
<span class="user-login-name">
<?php 
if($_SESSION['loged_user_image']=="")
{
    if($user_profile_pic['gender']=="male")
    {
?>  
    <a href="maverick-user-profile"><img src="../user_images/male.jpg" height="" width=""/></a>   
    <?php
    }
    if($user_profile_pic['gender']=="female")
    {
    ?>
    <a href="maverick-user-profile"><img src="../user_images/female.jpg" height="" width=""/></a>   
    <?php
    }
    ?>
    
    
<?php
}else
{
?>
    <a href="maverick-user-profile"><img src="../user_images/<?php echo $user_profile_pic['photo']; ?>" height="" width=""/></a>
<?php
}
?>
<div class="user-name">
<a href="maverick-user-profile">
<?php
if(isset($_SESSION['loged_user_name']))echo $_SESSION['loged_user_name'];
?>
</a>
</div>
<ul class="user-logout">
<li><a href="../maverick-user-profile">Profile</a></li>
<li><a class="first" href="../logout.php">Log out</a></li>
      </ul>
</span>
    </div>
    </div>
<?php
} 
    else
{
?>
<div class="col-md-8">
       <ul class="top-login-btn">
       	<li class="first" id="popup_window"><a href="../maverick-game-user-login"><i class="fa fa-sign-in"></i>  Login</a></li>
        <li class="last" id="popup_window"><a href="../maverick-game-user-register"><i class="fa fa-user"></i> Sign Up</a></li>
       </ul>
</div>
<?php
}
?>              
<div class="col-md-4">
     <ul class="social-icons">
        <li class="first"><a data-toggle="tooltip"  data-placement="bottom" data-original-title="Facebook" href="https://www.facebook.com/game.maverick" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
        <li><a data-toggle="tooltip"  data-placement="bottom" data-original-title="Google+" href="https://plus.google.com/b/108438942958324909410/108438942958324909410/about" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
        <li><a data-toggle="tooltip"  data-placement="bottom" data-original-title="Twitter" href="https://twitter.com/GameMaverick" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
        <li class="last"><a data-toggle="tooltip"  data-placement="bottom" data-original-title="Pinterest" href="https://www.pinterest.com/maverickgame/" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
      </ul>
   </div>
</div>
</div>
   </div>
</div>
</section>
<div class="newweb" style="display:none;">
<p class="white text-center"><strong>Upon Joining for first time, you will be given free 5 coins, to play a game you require 1 coin. Please click on <strong>Game Score</strong> to see your points and <stron>Buy Coins</stron> to purchase more coins</strong></p>
</div>

    