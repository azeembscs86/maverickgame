<footer class="footer">
	<div class="container">
    	<div class="row">
            <div class="col-md-6 col-sm-6 bdr-rgt">
                <div class="f-box wow lightSpeedIn">
                     <ul class="ft-nav">
                        <li class="nopad-left"><a href="../index.php">Home</a></li>
                         <li><a href="../game-package-payment">Buy Coins</a></li>
                         <li><a href="../leader-board">Game Score</a></li>
                         <li><a href=../"maverick-game-rewards-store">Rewards</a></li> 
                        <li><a href="../about-us">About US</a></li> 
                        <li class="nobdr"><a href="../contact-us">Contact US</a></li>  
                    </ul>
              </div>
              <div class="f-bottom">
            	<div class="col-md-4 col-sm-4 nopad-left">
                	<div class="logo wow zoomInDown">
                            <a href="index.php"><img src="../assets/images/ft-logo.png" alt="Footer Logo" width="142" height="66"></a>
                </div>
                </div>
                <div class="col-md-8 col-sm-7 nopad-left">
                <ul class="social-icons	">
                            <li class="first"><a data-toggle="tooltip"  data-placement="top" data-original-title="Facebook" href="https://www.facebook.com/game.maverick" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                   <li><a data-toggle="tooltip"  data-placement="top" data-original-title="Google+" href="https://plus.google.com/b/108438942958324909410/108438942958324909410/about" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                   <li><a data-toggle="tooltip"  data-placement="top" data-original-title="Twitter" href="https://twitter.com/GameMaverick" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                   <li class="last"><a data-toggle="tooltip"  data-placement="top" data-original-title="Pinterest" href="https://www.pinterest.com/maverickgame/" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
                </ul>
                	<p class="f-p">&copy; 2015 MAVERICK GAME. ALL RIGHTS RESERVED.
                    </p>
                </div>
                
            </div>
           </div>
            <div class="col-md-6">
            <div class="col-md-5">
                <div class="f-box bdr-rgt">
                    <h4>Maverick Links</h4>
                     <ul class="ft-nav2">
                      <li><a href="../maverickgame-blog"><i class="fa fa-angle-double-right"></i> Blog</a></li>
                      <li><a href="../maverick-faq"><i class="fa fa-angle-double-right"></i> FAQ's</a></li>
                      <li><a href="../game-dicussion-forums"><i class="fa fa-angle-double-right"></i> Game Forum</a></li> 
                      <li><a href="../terms-conditions"><i class="fa fa-angle-double-right"></i> Terms &amp; Condition </a></li>   
                    </ul>
              </div>
           </div>
                <div class="col-md-7"><div class="f-box">
                    <h4>Maverick Games </h4>
                     <ul class="ft-nav2 gamelsit">
                         <?php                         
      $footergames=  getAllFooterGames();
      if($footergames>0)
      {
          while ($footergame=  mysql_fetch_array($footergames))
          {              
      ?>               
          <li><a href="../maverick-game-<?php echo $footergame['game_seo'];  ?>"><i class="fa fa-angle-double-right"></i> <?php echo $footergame['game_name'];  ?></a></li>
     <?php
          }
      }
      ?>
                    </ul>
              </div></div>
              
              
           </div>
           <div class="clearfix"></div><br />
    </div>
    	
</div>
<?php /*?><?php if($seo==""){ ?> <a class="iconhome" href="index.php" style="display:none;"></a><?php } else {
	
	?> <a class="iconhome" href="index.php"></a> <?php  } ?><?php */?>

</footer>