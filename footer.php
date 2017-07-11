<?php
include("footer-main.php");
?>
<?php
include("scripts.php");
?>
<script type="text/javascript">
$(document).ready(function(e) { 
$(function(){
      // bind change event to select
      $('#game_score').on('change', function () {
          var game_id=document.getElementById('game_score').value;
          var url = "game-leader-board-"+game_id; // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });   
	
    $(".pagination > li").on( "click", function() {
	$(".pagination > li").removeClass("active"); 
	$(this).addClass("active");
	});
	
	$(".prevpage").on( "click", function() {
	$(".pagination li.active").removeClass("active").prev().addClass('active');
	$(".prevpage").hasClass("active").removeClass("active");
	$(".pagination li").addClass("active");
	});
	
	$(".nextpage").on( "click", function() {
	$(".pagination li.active").removeClass("active").next().addClass('active');
	$(".nextpage").hasClass("active").removeClass("active");
	$(".pagination li").addClass("active");
	
});
	
});


</script>
