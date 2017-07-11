<div class="newgames">
<div class="container">
<div class="col-md-12 nopad">           
                <h2 class="hd-main">New Games</h2>
                <div class="clearfix"></div>
                
<div class="jcarousel-wrapper">
                
                <div class="jcarousel">
                    <ul>
                        <?php
                        $newgames =  getAllSliderGames();
                        if($newgames>0)
                        {
                            while($newgame =  mysql_fetch_array($newgames))
                            {
                        ?>
                        
                        <li>
                        <div class="slidebox">
                        <div class="ribbon-wrapper-green"><div class="ribbon-green">NEW</div></div>
                        <a href="maverick-game-<?php echo $newgame['game_seo'];  ?>">
                        <img src="silverhat_games/game_slider/<?php echo $newgame['game_slider']; ?>" alt="" width="161" height="160">
                        <h4><?php echo $newgame['game_name'];   ?></h4>
                        <p><?php $mycontents = $newgame['game_description'];
        echo getWords($mycontents, 10)."..."; ?></p>
         </a>
                        </div>
                        </li>  
                       
                        <?php
                            }
                        }
                        ?>
                        
                        
                    </ul>
                </div>
<a href="#" class="jcarousel-control-prev"><i class="fa fa-angle-double-left"></i></a>
 <a href="#" class="jcarousel-control-next"> <i class="fa fa-angle-double-right"></i></a>
 </div>
 <div class="clearfix"></div>
 </div>
</div>

            </div>
            