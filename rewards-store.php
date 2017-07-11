<?php
session_start();
include("dbconnection.php");
function getWords($text, $limit)
{
$array = explode(" ", $text, $limit+1);
if (count($array) > $limit)
{
unset($array[$limit]);
}
return implode(" ", $array);
}
if(isset($_SESSION['user_loged_id']))
{
	$user_points=getPointsLeaderBoardByUserId($_SESSION['user_loged_id']);
	$user_point=mysql_fetch_array($user_points);
	$user_totlal_point=round($user_point['total_points']);
}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Rewards Store | Maverick Game </title>
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
<img src="assets/images/baninner/draon-draft.jpg" width="1366" height="230" class="banpic" alt="">
</div>
	<div class="container">
    <div class="row">
     <div class="col-md-9">
<div class="box-inner">
<h2 class="hd-main">Welcome</h2>
  <p>You can win rewards by playing games and earning points on your score. Once you reach to desired points, click on the reward image from below list and press confirm. Points from your account for selected reward will be deducted and our team will contact you in 48 working hours for shipment details. <br/><br/> 
  <strong class="red">Note:</strong> We are updating our reward list, if you have any suggestions please write to us at <a href="mailto:info@maverickgame.com"><strong>info@maverickgame.com</strong></a> </p>
  <hr>
<img src="assets/images/ban-rewards.png" alt="" width="585" height="222" class="center-block"> 
<hr>       
  <div class="clearfix"></div>
  <h2 class="hd-main">Rewards</h2>
      <hr>
      <div class="accordian-rewads">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Click here to get Rewards worth  1000 Points
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p>
		   <?php                    
                   echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Click here to get Rewards worth 5000 Points
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getFiveThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p>
          <?php 
           
           echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Click here to get Rewards worth 10,000 Points
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getTenThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Click here to get Rewards worth 50,000 Points
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getFiftyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Click here to get Rewards worth 80,000 Points
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> <strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getEightyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 100,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span>
</p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSix">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
          Click here to get Rewards worth 100,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getOneLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 250,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span>
        </p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSeven">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
          Click here to get Rewards worth 120,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getOneLakhTwentyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 500,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingEight">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
          Click here to get Rewards worth 130,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getOneLakhThirtyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 700,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingNine">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
          Click here to get Rewards worth 150,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getOneLakhFiftyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 1,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTen">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
        Click here to get Rewards worth 250,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getTwoLakhFiftyThousandPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 2,500,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingEleven">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
         Click here to get Rewards worth 500,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
         <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getFiveLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 5,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTweleve">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTweleve" aria-expanded="false" aria-controls="collapseTweleve">
         Click here to get Rewards worth 750,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseTweleve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTweleve">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getSevenLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 10,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
          <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThirteen">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
         Click here to get Rewards worth 1,000,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">     
    <div class="panel-body">
    <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getTenLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 25,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>         
          <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFourteen">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
         Click here to get Rewards worth 1,500,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseFourteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFourteen">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        <!-- Large modal -->
        
        <?php
        $rewards=  getFitenLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 50,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
          <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFifteen">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
         Click here to get Rewards worth 2,000,000 Points
          </a>
      </h4>
    </div>
    <div id="collapseFifteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFifteen">
      <div class="panel-body">
      <div class="alert alert-danger" role="alert"><strong>Note:</strong> * Limited offer valid till 30 November 2015</div>
        <ul class="rewards-list">
        
        <!-- Large modal -->
        
        <?php
        $rewards=  getTwentyLakhPointsRewards();
        if($rewards>0)
        {
            while($rewad=  mysql_fetch_array($rewards))
            {
        ?>        
        <li data-toggle="modal" data-target="#demo-modal-3<?php echo $rewad['reward_id']; ?>"><a href="javascript:;"  data-toggle="tooltip" title="<?php echo $rewad['reward_name']; ?>"><span><img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="144" height="144" alt="">
        <p><?php $mycontent = $rewad['reward_name'];
        echo getWords($mycontent, 2).".."; ?><br><del> 100,000,000 Points</del><br><span><?php echo $rewad['reward_points']; ?> Points</span></p>
            </span></a>
        </li>
        <form class="modal multi-step" id="demo-modal-3<?php echo $rewad['reward_id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title step-1" data-step="1"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-2" data-step="2"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-3" data-step="3"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                <h4 class="modal-title step-4" data-step="4"><?php echo $rewad['reward_name']; ?> <img src="rewards_stores/<?php echo $rewad['reward_image']; ?>" width="50" height="50" alt="" style="float:right;margin-top: -12px;"></h4>
                
            </div>
            <div class="modal-body step-1" data-step="1">
                
        <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $rewad['reward_name']; ?></h4>
        <p><?php echo $rewad['reward_points']; ?> Points</p>
            </div>
            
            <div class="modal-body step-3" data-step="3">
                <?php
            if(isset($_SESSION['user_loged_id']))
            {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>       
            <p><?php echo $rewad['reward_points']; ?> Points will be deducted from your avaliable point. </p>
            <?php
            }else
            {
            ?>
           <p><?php echo $user_totlal_point; ?> Insufficient Points play more. </p>
           <?php
          }
          }
        ?>
            </div>            
            <div class="modal-body step-4" data-step="4">
                <p>Thanks You
            <br>
            Your request is submited our Team will contact you in 48 hours
        </p>
            </div>
            
            <div class="modal-footer">
            <span style="float:left;">Point Required:<?php echo $rewad['reward_points']; ?></span>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
				<?php 
        if(isset($_SESSION['user_loged_id']))
        {
       ?>
       <button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 3)">OK</button>
       <?php   
        }else {
            ?>
        <a href="maverick-game-user-login"><button type="button" class="btn btn-primary step step-1" data-step="1" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload())">OK</button></a>
       <?php
        }
        ?>
        <?php
        if(isset($_SESSION['user_loged_id']))
        {
            $user_points=  countUserRedemRewardPoints($_SESSION['user_loged_id']);
            $user_point=  mysql_fetch_array($user_points);
            if($user_totlal_point>$rewad['reward_points'])
            {
            ?>     
                <button type="button" class="btn btn-primary step step-3" data-step="3" onClick="redeemPoints(<?php echo $_SESSION['user_loged_id'] ?>,<?php echo $rewad['reward_id'];  ?>),sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4)">Confirm</button>
            <?php
            }else
            {
           ?>    
            <a href="maverick-game-rewards-store"><button type="button" class="btn btn-primary step step-3" data-step="3" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', window.location.reload()), window.location.reload()">OK</button></a>
          <?php       
            }
        }
            ?>                
                <button type="button" class="btn btn-success step step-4" data-step="4" onClick="sendEvent('#demo-modal-3<?php echo $rewad['reward_id']; ?>', 4), window.location.reload()" data-dismiss="modal">Ok</button>
            
            </div>
        </div>
    </div>
</form>

   
 <?php                
            }            
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
</div>
	</div>
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
<script src="assets/js/multi-step-modal.js"></script>
<script>
sendEvent = function(sel, step) {
    $(sel).trigger('next.m.' + step);
}
</script>
<script>
function redeemPoints(user_id,reward_id)
{
   var user_id = user_id;
   var reward_id  = reward_id;   
   jQuery.ajax({
   	  type: "POST",
    	  url: "redeemuserreward.php",
    	  data: "user_id="+user_id+"&reward_id="+reward_id,  
        });
}
</script>
</body>
</html>