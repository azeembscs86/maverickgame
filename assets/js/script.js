// JavaScript Document
$(window).load(function(){
	
jQuery(document).ready(function($){
	
	
   $(".top-left-btn a").on("click", function(){
	 
	$(".top-left-btn a").toggleClass("active");
	 $(".hide-dropdown").slideToggle();
	 
	});
	
	$('[data-toggle="tooltip"]').tooltip();

    $('[data-popup-target]').click(function () {
        $('html').addClass('overlay');
        var activePopup = $(this).attr('data-popup-target');
        $(activePopup).addClass('visible');

    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27 && $('html').hasClass('overlay')) {
            clearPopup();
        }
    });

    $('.popup-exit').click(function () {
        clearPopup();

    });

    $('.popup-overlay').click(function () {
        clearPopup();
    });

    function clearPopup() {
        $('.popup.visible').addClass('transitioning').removeClass('visible');
        $('html').removeClass('overlay');

        setTimeout(function () {
            $('.popup').removeClass('transitioning');
        }, 200);
    }

});

});//]]> 

/*********fuction for game button*********/



