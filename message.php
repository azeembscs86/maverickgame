<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game Logged Message</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css' /
<link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body>
	<div class="container">
    <div class="row">
     <div class="col-md-12">
     <div class="clearfix"></div><br>
<div class="alert alert-success text-center" role="alert">
 	<div id="container">
		<div id="countdown"></div>
	</div>
<strong>Thank you for Logging in, Don't forget to check your points in game score,</strong>
<br><br>go to reward store to buy rewards through your points.<br>
<a href="maverick-user-profile" class="btnread"><strong>click here to proceed your profile</strong></a>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/jquery.countdown360.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
		var countdown =  $("#countdown").countdown360({
       	 	radius      : 60,
         	seconds     : 10,
         	fontColor   : '#FFFFFF',
         	autostart   : false,
         	onComplete  : function () { console.log(window.location.href='maverick-games') }
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
</body>
</html>