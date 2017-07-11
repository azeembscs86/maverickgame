<?php 
$link="$_SERVER[REQUEST_URI]";
$links=explode("/",$link);
if(count($links)==2)
{
    $seo=$links[1];
}  else {
    $seo=$links[2];
}
?>
<section class="header">
	<div class="container">
    	<div class="row">
       	<div class="col-md-2">
                    <a href="index.php"><img style="margin:10px 0 0;" class="img-responsive" src="assets/images/maverick-logo.png" alt="Logo" height="116" width="196"></a>
            </div>
            <div class="col-md-8 nopad">
            <div class="head-banner text-center">
              <a href="https://www.maverickgame.com/maverick-game-do-the-dive"> <img width="693" height="102" alt="Header Banner" src="assets/images/digital-training.jpg"></a>
                </div>           
            </div>
            <div class="col-md-2">
            <a href="maverick-game-rewards-store"><img src="assets/images/reward-points.jpg" width="180" height="102" alt="" style="margin:7px 0 0;" /></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
