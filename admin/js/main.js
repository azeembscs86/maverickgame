/*
 *  Document   : main.js
 *  Author     : pixelcave
 *  Description: Custom scripts and plugin initializations
 */

var webApp = function() {

    // Cache in variables some often used jquery objects
    var body    = $('body');
    var header  = $('header');

    /* Initialization UI Code */
    var uiInit = function () {

        // Add the correct copyright year at the footer
        var yearCopy = $('#year-copy'),
            d = new Date();

        if (d.getFullYear() === 2013) {
            yearCopy.html('2013');
        } else {
            yearCopy.html('2013-' + d.getFullYear());
        }

        // Set min-height to #page-content, so that footer is visible at the bottom if there is not enough content
        var pageContent = $('#page-content');

        pageContent.css('min-height', $(window).height() -
            (header.outerHeight()
                + $('#pre-page-content').outerHeight()
                + parseInt(pageContent.css('padding-top'))*2
                + $('footer').outerHeight())
                + 'px');

        $(window).resize(function() {
            pageContent.css('min-height', $(window).height() -
                (header.outerHeight()
                    + $('#pre-page-content').outerHeight()
                    + parseInt(pageContent.css('padding-top'))*2
                    + $('footer').outerHeight())
                    + 'px');
        });

        // Initialize Sticky Sidebar and position it correctly
        if ($('#page-sidebar').hasClass('sticky')) { stickySidebar('create'); }

        // Toggle Side content
        $('#toggle-side-content').click(function(){
            body.toggleClass('hide-side-content');
        });

        // Select/Deselect all checkboxes in tables
        $('thead input:checkbox').click(function() {
            var checkedStatus   = $(this).prop('checked');
            var table           = $(this).closest('table');

            $('tbody input:checkbox', table).each(function() {
                $(this).prop('checked', checkedStatus);
            });
        });

        // Initialize tabs
        $('[data-toggle="tabs"] a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Initialize Image Gallery/Popups
        $('[data-toggle="lightbox-gallery"]').magnificPopup({
            delegate: 'a.gallery-link',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                tPrev: 'Previous',
                tNext: 'Next',
                tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
            }
        });

        // Initialize Image Popup
        $('[data-toggle="lightbox-image"]').magnificPopup({ type: 'image' });

        // Initialize Tooltips
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({ container: 'body', animation: false });

        // Initialize Popovers
        $('[data-toggle="popover"]').popover({ container: 'body', animation: false });

        // Initialize Chosen
        $(".select-chosen").chosen();

        // Initialize elastic
        $('textarea.textarea-elastic').elastic();

        // Initialize wysihtml5
        $('textarea.textarea-editor').wysihtml5();

        // Initialize Colorpicker
        $('.input-colorpicker').colorpicker();

        // Initialize TimePicker
        $('.input-timepicker').timepicker();

        // Initialize DatePicker
        $('.input-datepicker').datepicker();

        // Initialize DateRangePicker
        $('.input-daterangepicker').daterangepicker();

        // iCheck (Checkbox & Radio themed)
        $('.input-themed').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey'
        });

        // Form Sliders
        $('.slider').slider();
    };

    /* Demo Code */
    var uiDemo = function () {

        // Demo of how loading messages & notifications could happen
        $('.loading-on').click(function(){

            // Get loading div from header
            var loading = $('#loading');

            // Fade In loading
            $('header .brand').hide();
            loading.fadeIn(250);

            // Hide all badges from links
            $('header li > a > .badge').fadeOut(250);

            // Wait a while (the real updating could happen here)
            setTimeout(function(){
                // Fade Out loading and add a demo badge
                loading.fadeOut(250, function(){
                    $('.brand').fadeIn();
                });
                $('.dropdown-messages > a > .badge').fadeIn(250).html('3');
            }, 1500);
        });

        // Initialize Typeahead - Example with countries
        var data = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Côte d'Ivoire","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands","Colombia","Comoros","Congo","Cook Islands","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Democratic Republic of the Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Faeroe Islands","Falkland Islands","Fiji","Finland","Former Yugoslav Republic of Macedonia","France","French Guiana","French Polynesia","French Southern Territories","Gabon","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Islands","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","North Korea","Northern Marianas","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn Islands","Poland","Portugal","Puerto Rico","Qatar","Réunion","Romania","Russia","Rwanda","São Tomé and Príncipe","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Saudi Arabia","Senegal","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Korea","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","The Bahamas","The Gambia","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","US Virgin Islands","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","United States Minor Outlying Islands","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Wallis and Futuna","Western Sahara","Yemen","Yugoslavia","Zambia","Zimbabwe"];

        $('.example-typeahead').typeahead({ items: 5, source: data });

        // Initialize DateRangePicker Advanced Demo Example
        var exampleAdvancedDateRange = $('#example-advanced-daterangepicker');
        var exampleAdvancedDateRangeSpan = $('#example-advanced-daterangepicker span');

        exampleAdvancedDateRange.daterangepicker({
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({days: -6}), 'today'],
                'Last 30 Days': [Date.today().add({days: -29}), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({months: -1}), Date.today().moveToFirstDayOfMonth().add({days: -1})]
            }
        },
        function(start, end) {
            exampleAdvancedDateRangeSpan.html(start.toString('MMMM d, yy') + ' - ' + end.toString('MMMM d, yy'));
        }
        );

        // Set the default content when page loads
        exampleAdvancedDateRangeSpan.html(Date.today().toString('MMMM d, yy') + ' - ' + Date.today().toString('MMMM d, yy'));
    };

    /* Sticky Sidebar functionality */
    var stickySidebar = function (mode) {
        // Cache some often used jquery objects
        var sideScrollableCon = $('#page-sidebar .slimScrollDiv');
        var sideScrollable    = $('.side-scrollable');

        // Default height for tablets and phones
        var innerHeight       = 380;

        // Modes
        if ((mode == 'create')) {
            // If there is a div with the class .side-scrollable initialize slimscroll
            if (sideScrollable.length) {
                // First, set the height of the sidebar
                innerHeight = stickySidebar('resize');

                // Initialize Slimscroll for the first time
                sideScrollable.slimScroll({ height: innerHeight, color: '#fff', size: '6px' });

                // Resize sidebar height on windows scroll and resize
                $(window).scroll(stickyResize);
                $(window).resize(stickyResize);
            }

            // On window scroll set sidebar position
            $(window).scroll(stickyPosition);
        } else if (mode == 'resize') {
            // Calculate height
            if ($(window).width() > 979) {
                if (body.hasClass('header-fixed-top') || body.hasClass('header-fixed-bottom') || $(this).scrollTop() < 41) {
                    innerHeight = $(window).height() - 41;
                } else {
                    innerHeight = $(window).height();
                }
            }

            // Set height to the sidebar scroll containers
            if (sideScrollableCon)
                sideScrollableCon.css('height', innerHeight);

            sideScrollable.css('height', innerHeight);

            return innerHeight;
        } else if (mode == 'destroy') {
            // Remove Slimscroll by replacing .slimScrollDiv with .side-scrollable
            sideScrollable.parent().replaceWith(sideScrollable);

            // Remove inline styles from the new .side-scrollable div
            $('.side-scrollable').removeAttr('style');

            // Disable functions running on window scroll and resize
            $(window).off('scroll', stickyPosition);
            $(window).off('scroll', stickyResize);
            $(window).off('resize', stickyResize);
        }
    };

    // Helper functions for sticky sidebar functionality
    var stickyResize    = function() { stickySidebar('resize'); };
    var stickyPosition  = function() {
        if (!body.hasClass('header-fixed-bottom') && !body.hasClass('header-fixed-top')) {
            if ($(this).scrollTop() < 41) {
                $('#page-sidebar').css('top', '41px');
            } else if ($(this).scrollTop() > 41) {
                $('#page-sidebar').css('top', '0');
            }
        } else {
            if ($(window).width() > 979) {
                $('#page-sidebar').removeAttr('style');
            }
        }
    };

    /* Primary navigation functionality */
    var primaryNav = function () {

        // Animation Speed, change the values for different results
        var upSpeed         = 150;
        var downSpeed       = 250;

        // Get all primary and sub navigation links
        var menuLinks       = $('.menu-link');
        var submenuLinks    = $('.submenu-link');

        // Initialize number idicators on menu links
        menuLinks.each(function(n, e){
            $(e).append('<span>' + $(e).next('ul').find('a').not('.submenu-link').length + '</span>');
        });

        // Initialize number idicators on submenu links
        submenuLinks.each(function(n, e){
            $(e).append('<span>' + $(e).next('ul').children().length + '</span>');
        });

        // Primary Accordion functionality
        menuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    $('.menu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });

        // Submenu Accordion functionality
        submenuLinks.click(function(){
            var link = $(this);

            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed);
                }
                else {
                    link.closest('ul').find('.submenu-link.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed);
                }
            }

            return false;
        });
    };

    /* Scroll to top link */
    var scrollToTop = function() {
        // Get link
        var link = $('#to-top');

        $(window).scroll(function(){
            // If the user scrolled a bit (150 pixels) show the link
            if ($(this).scrollTop() > 150) {
                link.fadeIn(100);
            } else {
                link.fadeOut(100);
            }
        });

        // On click get to top
        link.click(function(){
            $('html, body').animate({ scrollTop: 0 }, 150);
            return false;
        });
    };

    /* Template Options, change features and colors */
    var templateOptions = function () {

        /*
         * Color Themes
         */
        var colorList = $('.theme-colors');
        var themeLink = $('#theme-link');
        var theme;

        if (themeLink.length) {
            theme = themeLink.attr('href');

            $('li', colorList).removeClass('active');
            $('a[data-theme="' + theme + '"]', colorList).parent('li').addClass('active');
        }

        $('a', colorList).mouseenter(function(e){
            // Get theme name
            theme = $(this).data('theme');

            $('li', colorList).removeClass('active');
            $(this).parent('li').addClass('active');

            if (theme === 'default') {
                if (themeLink.length) {
                    themeLink.remove();
                    themeLink = $('#theme-link');
                }
            } else {
                if (themeLink.length) {
                    themeLink.attr('href', theme);
                } else {
                    $('link[href="css/themes.css"]').before('<link id="theme-link" rel="stylesheet" href="' + theme + '">');
                    themeLink = $('#theme-link');
                }
            }
        });

        /*
         * Sidebar Options
         */
        var pageSidebar = $('#page-sidebar');
        var checkSticky = $('#theme-sidebar-sticky');

        // Check sidebar state and set options
        if (pageSidebar.hasClass('sticky')) {
            checkSticky.iCheck('check');
        }

        // Sticky Sidebar Checkbox Checked
        checkSticky.on('ifChecked', function(e){
            pageSidebar.addClass('sticky');
            stickySidebar('create');
        });

        // Sticky Sidebar Checkbox Unchecked
        checkSticky.on('ifUnchecked', function(e){
            pageSidebar.removeClass('sticky');
            stickySidebar('destroy');
        });

        /*
         * Header Options
         */
        var checkTop    = $('#theme-header-top');
        var checkBottom = $('#theme-header-bottom');

        // Check header state and set options
        if (header.hasClass('navbar-fixed-top')) {
            checkTop.iCheck('check');
            headerOptions('top');
        } else if (header.hasClass('navbar-fixed-bottom')) {
            checkBottom.iCheck('check');
            headerOptions('bottom');
        }

        // Fixed Top Checkbox Checked
        checkTop.on('ifChecked', function(e){
            checkBottom.iCheck('uncheck');
            headerOptions('top');
        });

        // Fixed Top Checkbox Unchecked
        checkTop.on('ifUnchecked', function(e){
            headerOptions('static');
        });

        // Fixed Bottom Checkbox Checked
        checkBottom.on('ifChecked', function(e){
            checkTop.iCheck('uncheck');
            headerOptions('bottom');
        });

        // Fixed Bottom Checkbox Unchecked
        checkBottom.on('ifUnchecked', function(e){
            headerOptions('static');
        });

        /*
         * Full Width
         */
        var pageCon     = $('#page-container');
        var checkfull   = $('#theme-page-full');

        // Check page state and set options
        if (pageCon.hasClass('full-width')) {
            checkfull.iCheck('check');
        }

        // Fixed Bottom Checkbox Checked
        checkfull.on('ifChecked', function(e){
            pageCon.addClass('full-width');
        });

        // Fixed Bottom Checkbox Unchecked
        checkfull.on('ifUnchecked', function(e){
            pageCon.removeClass('full-width');
        });
    };

    /* Header helper function for setting position (top, bottom, static) */
    var headerOptions = function(mode) {

        if (mode === 'top') { // Header Fixed Top
            body.removeClass('header-fixed-bottom').addClass('header-fixed-top');
            header.removeClass('navbar-fixed-bottom').addClass('navbar-fixed-top');
        } else if (mode === 'bottom') { // Header Fixed Bottom
            body.removeClass('header-fixed-top').addClass('header-fixed-bottom');
            header.removeClass('navbar-fixed-top').addClass('navbar-fixed-bottom');
        } else if (mode === 'static') { // Header Static
            body.removeClass('header-fixed-top').removeClass('header-fixed-bottom');
            header.removeClass('navbar-fixed-top').removeClass('navbar-fixed-bottom');
        }
    };

    /* Input placeholder for older browsers */
    var oldiePlaceholder = function() {

        // Check if placeholder feature is supported by browser
        if(!Modernizr.input.placeholder) {

            // If not, add the functionality
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() === input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('ph');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() === '' || input.val() === input.attr('placeholder')) {
                    input.addClass('ph');
                    input.val(input.attr('placeholder'));
                }
            }).blur().parents('form').submit(function() {
                $(this).find('[placeholder]').each(function() {
                    var input = $(this);
                    if (input.val() === input.attr('placeholder')) {
                        input.val('');
                    }
                });
            });
        }
    };

    /* Datatables Bootstrap integration, http://datatables.net/blog/Twitter_Bootstrap_2 */
    var dtIntegration = function() {

        // Set the defaults for DataTables initialization
        $.extend( true, $.fn.dataTable.defaults, {
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span5'i><'span7'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "<div class=\"input-prepend\"><span class=\"add-on\"><i class=\"icon-search\"></i></span>_INPUT_</div>",
                "sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            }
        } );

        // Default class modification
        $.extend( $.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline"
        });

        // API method to get paging information
        $.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
        {
            return {
                "iStart":         oSettings._iDisplayStart,
                "iEnd":           oSettings.fnDisplayEnd(),
                "iLength":        oSettings._iDisplayLength,
                "iTotal":         oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
                "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
            };
        };

        // Bootstrap style pagination control
        $.extend( $.fn.dataTableExt.oPagination, {
            "bootstrap": {
                "fnInit": function( oSettings, nPaging, fnDraw ) {
                    var oLang = oSettings.oLanguage.oPaginate;
                    var fnClickHandler = function ( e ) {
                        e.preventDefault();
                        if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                            fnDraw( oSettings );
                        }
                    };

                    $(nPaging).addClass('pagination').append(
                        '<ul>'+
                            '<li class="prev disabled"><a href="javascript:void(0)"><i class="icon-chevron-left"></i> '+oLang.sPrevious+'</a></li>'+
                            '<li class="next disabled"><a href="javascript:void(0)">'+oLang.sNext+' <i class="icon-chevron-right"></i></a></li>'+
                        '</ul>'
                    );
                    var els = $('a', nPaging);
                    $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
                    $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
                },

                "fnUpdate": function ( oSettings, fnDraw ) {
                    var iListLength = 5;
                    var oPaging = oSettings.oInstance.fnPagingInfo();
                    var an = oSettings.aanFeatures.p;
                    var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

                    if ( oPaging.iTotalPages < iListLength) {
                        iStart = 1;
                        iEnd = oPaging.iTotalPages;
                    }
                    else if ( oPaging.iPage <= iHalf ) {
                        iStart = 1;
                        iEnd = iListLength;
                    } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                        iStart = oPaging.iTotalPages - iListLength + 1;
                        iEnd = oPaging.iTotalPages;
                    } else {
                        iStart = oPaging.iPage - iHalf + 1;
                        iEnd = iStart + iListLength - 1;
                    }

                    for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                        // Remove the middle elements
                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                        // Add the new list items and their event handlers
                        for ( j=iStart ; j<=iEnd ; j++ ) {
                            sClass = (j===oPaging.iPage+1) ? 'class="active"' : '';
                            $('<li '+sClass+'><a href="javascript:void(0)">'+j+'</a></li>')
                                .insertBefore( $('li:last', an[i])[0] )
                                .bind('click', function (e) {
                                    e.preventDefault();
                                    oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                                    fnDraw( oSettings );
                                } );
                        }

                        // Add / remove disabled classes from the static elements
                        if ( oPaging.iPage === 0 ) {
                            $('li:first', an[i]).addClass('disabled');
                        } else {
                            $('li:first', an[i]).removeClass('disabled');
                        }

                        if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                            $('li:last', an[i]).addClass('disabled');
                        } else {
                            $('li:last', an[i]).removeClass('disabled');
                        }
                    }
                }
            }
        });
    };

    return {
        init: function () {
            uiInit(); // Initialize UI Code
            primaryNav(); // Primary Navigation functionality
            scrollToTop(); // Scroll to top functionality
            templateOptions(); // Template Options, change features and colors
            oldiePlaceholder(); // Make input placeholder work in older browsers
            dtIntegration(); // Datatables Bootstrap integration
            uiDemo(); // Initialize Demo Code
        }
    };
}();

/* Initialize WebApp when page loads */
$(function(){
    webApp.init();
});