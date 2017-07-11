<?php 
session_start(); 
include("dbconnection.php"); 
include("closelogindetails.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Maverick Game - Play the Most Addicting Games Online!</title>
    <meta content="play games online, best online games, addicting games, arcade games, mmorpg, adventure games, action games, car racing gamees, arcade games, multiplayer games" name="keywords" />
    <meta content="The most addicting games lie within Maverick Game! Play racing, stunt, cooking, strategy and all types of arcade games here!" name="description" />

    <link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/jcarousel.responsive.css">
    <meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body class="home">
    <!-- End signUp form -->
    <div class="popup-overlay"></div>
    <!-- End popup-->
    <?php 
		include("user-login-menus.php"); 
	?>


    <?php 
		include("sidebarlinks.php"); 
	?>

    <?php 
		include("homeslider.php"); 
	?>
    
    <div class="featured-area">
        <div class="container">
            <div class="row">
                <?php 
		   include("featured-games.php");
		?>
                
            </div>
        </div>
    </div>

    <?php 
		include("ban-area.php"); 
	?>
    <?php 
		include("new-games-slider.php"); 
	?>

    
    <?php 
		include("footer.php"); 
	?>
<script src="assets/js/jquery.cycle2.js"></script>
<script src="assets/js/jquery.cycle2.carousel.js"></script>
<script src="assets/js/jquery.cycle2.tile.js"></script>
<script>
jQuery(document).ready(function($){

var slideshows = $('.cycle-slideshow').on('cycle-next cycle-prev', function(e, opts) {
    // advance the other slideshow
    slideshows.not(this).cycle('goto', opts.currSlide);
});

$('#cycle-2 .cycle-slide').click(function(){
    var index = $('#cycle-2').data('cycle.API').getSlideIndex(this);
    slideshows.cycle('goto', index);
});

});
</script>
</body>

</html>