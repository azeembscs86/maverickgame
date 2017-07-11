<?php
function getWords($text, $limit)
{
$array = explode(" ", $text, $limit+1);
if (count($array) > $limit)
{
unset($array[$limit]);
}
return implode(" ", $array);
}
?>

<section class="slider">
<?php
	include("navigation.php");
?>
                
 <div id="slideshow-1">
        <a href="#" class="cycle-prev"><i class="fa fa-angle-double-left"></i> <span>prev</span>
</a>
        <a href="#" class="cycle-next"><span>next</span> <i class="fa fa-angle-double-right"></i>
</a>
        <!--<span class="custom-caption"></span>-->
    <div id="cycle-1" class="cycle-slideshow"
        data-cycle-slides="> div"
        data-cycle-timeout="0"
        data-cycle-prev="#slideshow-1 .cycle-prev"
        data-cycle-next="#slideshow-1 .cycle-next"
        data-cycle-caption="#slideshow-1 .custom-caption"
        data-cycle-caption-template="{{slideNum}} / {{slideCount}}"
        data-cycle-fx="tileSlide"
        data-cycle-pager=".pagerslider"
        >
        <div><img src="silverhat_games/game_background_image/dothedive.jpg" width="100%" alt="" />
        <a href="/DoTheDive/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a>
        </div>
        <div><img src="silverhat_games/game_background_image/draon-draft.jpg" width="100%" alt="" />
        <a href="/DragonDraft/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a></div>
        <div><img src="silverhat_games/game_background_image/furiousred.jpg" width="100%" alt="" />
        <a href="/FuriousRed/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a></div>
        <div><img src="silverhat_games/game_background_image/master-cook.jpg" width="100%" alt="" />
        <a href="/MasterCook/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a></div>
        <div><img src="silverhat_games/game_background_image/wordster.jpg" width="100%" alt="" />
        <a href="/Wordster/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a></div>
        <div><img src="silverhat_games/game_background_image/crisis.jpg" width="100%" alt="" />
        <a href="/Crisis/" class="box-btn"><img src="assets/images/btn_playnow.png" width="300" height="50" alt="" /></a></div>
        <div><img src="silverhat_games/game_background_image/mage.jpg" width="100%" alt="" />
        </div>
        <div><img src="silverhat_games/game_background_image/metal.jpg" width="100%" alt="" />
        </div>
    </div>
</div>
<div class="pagerslider"></div>

<!--<div id="slideshow-2">
    <div id="cycle-2" class="cycle-slideshow"
        data-cycle-slides="> div"
        data-cycle-timeout="0"
        data-cycle-prev="#slideshow-2 .cycle-prev"
        data-cycle-next="#slideshow-2 .cycle-next"
        data-cycle-caption="#slideshow-2 .custom-caption"
        data-cycle-caption-template="{{slideNum}} / {{slideCount}}"
        data-cycle-fx="carousel"
        data-cycle-carousel-visible="5"
        data-cycle-carousel-fluid=true
        data-allow-wrap="false"
        >
        <div><img src="silverhat_games/game_home_image/dothedive.png" width="60" height="60" alt="" /></div>
        <div><img src="silverhat_games/game_home_image/dragondraft.png" width="60" height="60" alt="" /></div>
        <div><img src="silverhat_games/game_home_image/furiousred.png" width="60" height="60" alt="" /></div>
        <div><img src="silverhat_games/game_home_image/master-cook.png" width="60" height="60" alt="" /></div>
        <div><img src="silverhat_games/game_home_image/wordster.png" width="60" height="60" alt="" /></div>
        <div><img src="silverhat_games/game_home_image/crisis.png" width="60" height="60" alt="" /></div>
    </div>
</div>-->
</section>