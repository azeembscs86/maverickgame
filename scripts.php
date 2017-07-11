<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-hover-effect.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>
<script type="text/javascript" src="assets/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="assets/js/jcarousel.responsive.js"></script>
<script type="text/javascript" src="assets/js/jquery.easing.js"></script>
<script type="text/javascript" src="assets/js/lofslidernews.mt11.js"></script>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
     <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<!--[if IE 8]>
<script type="text/javascript" src="/assets/js/html5.js"></script>
<html lang="en" class="ie ie8">
<![endif]-->
<script type="text/javascript">
    //$( window ).load(function() {
//			$('.popup-overlay').addClass('overlay');
//			$(".Center-Container").delay(1000).fadeIn(500);
//	$('.btnclose').click(function() {
//			 $(".Center-Container").hide();
//			 $('.popup-overlay').removeClass('overlay');
//		 });
//    });

</script>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58113944-9', 'auto');
  ga('send', 'pageview');

</script>
<div id="fb-root"></div>
<script type="text/javascript">
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=481352955356475";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
</script>
<script>
window.onbeforeunload = function() {
    $.ajax({
        url: 'LogoutBrowserClose.php',
        type: 'GET',
        async: false,
        timeout: 2000
    });
};
</script>