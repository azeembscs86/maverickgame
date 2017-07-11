<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game About Us</title>
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

<div class="featured-area">
	<div class="container">
    <div class="row">
     <div class="col-md-10 col-sm-9">
      <div class="inner-cnt"> 
  <div id="container" align="center">
			<div id="countdown"></div>
			<script type="text/javascript" charset="utf-8">
		var countdown =  $("#countdown").countdown360({
       	 	radius      : 60,
         	seconds     : 30,
         	fontColor   : '#FFFFFF',
         	autostart   : false,
         	onComplete  : function () { console.log(window.location.href='update-user-profile.php') }
		   });
			countdown.start();
			console.log('countdown360 ',countdown);
		 	$(document).on("click","button",function(e){
		 		e.preventDefault();
		 		var type = $(this).attr("data-type");
		 		if(type === "time-remaining")
		 		{
		 			var timeRemaining = countdown.getTimeRemaining();
		 			alert(timeRemaining);
		 		}
		 		else
		 		{
		 			var timeElapsed = countdown.getElapsedTime();
		 			alert(timeElapsed);
		 		}
		 	});
		  </script>
		</div>
<p>
You may choose to become a Super Car Racer tearing down the race track, prefer to play as a suicidal daredevil free falling from a plane towards rocky plains or a cook at at the next top Resturant, you might be a hero slaying demons in the dark, you might be one of those demons itself! Whatever you choose, you are the choosen one and maverick games is youre home now.
 </p>
   
   
</div>
     </div>
      <?php 
      include("rightadds.php");
      ?>
    </div>
    
    
    	<?php 
include("featured-games.php");
?>
    </div>
</div>





</body>
</html>