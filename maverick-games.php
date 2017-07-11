<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Games | Maverick Game</title>
<meta content="maverick game, about us, about maaverick games" name="keywords" />
<meta content="About Maverick Games- Home to online action, adventure, educational and role playing games!"  name="description" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>

<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/fdw-demo.css" media="all" />
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
<style type="text/css">
/* Portolio Hover */
.da-thumbs li ,
.da-thumbs li  img {
	display: block;
	position: relative;
}
.da-thumbs li  img { 
border:5px solid #900;
}
.da-thumbs li  {
	overflow: hidden;
}
.da-thumbs li  article {
	position: absolute;
	background-image:url(assets/images/image_hover.png);
	background-repeat:repeat;
	width: 100%;
	height: 100%;
}
.da-thumbs li  article.da-animate {
	-webkit-transition: all 0.2s ease;
	-moz-transition: all 0.2s ease-in-out;
	-o-transition: all 0.2s ease-in-out;
	-ms-transition: all 0.2s ease-in-out;
	transition: all 0.2s ease-in-out;
}
/* Initial state classes: */
.da-slideFromTop {
	left: 0px;
	top: -100%;
}
.da-slideFromBottom {
	left: 0px;
	top: 100%;
}
.da-slideFromLeft {
	top: 0px; 
	left: -100%;
}
.da-slideFromRight {
	top: 0px;
	left: 100%;
}
/* Final state classes: */
.da-slideTop {
	top: 0px;
}
.da-slideLeft {
	left: 0px;
}
.da-thumbs li  article a {
	color:#fff;
	padding:20px;
	display:block;
}

.da-thumbs {
text-align:center;
margin:0 0 0 50px;
}

.da-thumbs li  article h3{
color:#fff;
padding-top:25px;
font-style:oblique;
}

.da-thumbs li  article em{
margin-bottom:10px;
color:#fff;
display:block;
}

.da-thumbs li  article span{
display:inline-block;
}

span.link_post{
display:block;
width:35px;
height:35px;
background-color:#A40101;
border-radius:50px;
cursor:pointer;
background-image:url(assets/images/link_post_icon.png);
background-repeat:no-repeat;
background-position:center;
margin-right:10px;
}

span.zoom{
overflow:hidden;
display:block;
width:35px;
height:35px;
background-color:#A40101;
border-radius:50px;
cursor:pointer;
background-image:url(assets/images/zoom_icon.png);
background-repeat:no-repeat;
background-position:center;
margin-left:10px;
}

.portfolio_2col article h3{
padding-top:70px !important;
}

/* Image Grid */
.image_grid {
	float:left;
	overflow:hidden;
	position:relative;

}

.image_grid li{
	float: left;
	line-height: 17px;
	color: #686f74;
	list-style:none;
	overflow:hidden;
	margin-bottom:23px;
	margin-right:50px;
	text-align:center;
}

</style>

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
  <h2 class="hd-main">Maverick Games</h2>
  <div class="freshdesignweb">     
<!-- Portfolio 4 Column start -->
    <div class="image_grid portfolio_4col">
    <ul id="list" class="portfolio_list da-thumbs">
    <?php
      $maverickgames=  getAllMaverickGames();
      if($maverickgames>0)
      {
          while($maverickgame=  mysql_fetch_array($maverickgames)){
     ?>
        
        
        <li style="min-height:140px">
            <img width="200" src="silverhat_games/game_image/<?php echo $maverickgame['thumb_game_image']; ?>" class="img-responsive" alt="">
            <article class="da-animate da-slideFromRight" style="display: block;">
                <h3><?php echo $maverickgame['game_name']; ?></h3>
                <em></em>
                <span class="link_post"><a href="maverick-game-<?php echo $maverickgame['game_seo']; ?>"></a></span>
                <?php
                if(isset($_SESSION['user_loged_id']))
                {
                ?>
                <span class="zoom"><a href="<?php echo $maverickgame['game_file']; ?>"></a></span>
             <?php
                }else
                {
                ?>
                <span class="zoom"><a href="maverick-game-user-login"></a></span>
                <?php
                }
                ?>
            </article>
            <div class="clearfix"></div>
            <h3><?php echo $maverickgame['game_name']; ?></h3>
        </li>
        
    <?php    
          }
      }
    ?>

    </ul>
    </div>
    <!-- Portfolio 4 Column End -->
</div>
<div class="clearfix"></div>
	</div>
     </div>
     <div class="col-md-3">
      <div class="sidebar">
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
<script type="text/javascript">
//Image Hover
jQuery(document).ready(function(){
jQuery(function() {
	jQuery('ul.da-thumbs > li').hoverdir();
});
});
</script>
</body>
</html>