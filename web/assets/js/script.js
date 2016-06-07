//$(document).on('click', '.list-group-item', function(){
//   $(this).siblings().removeClass('active');
//   $(this).addClass('active');
//});

$(document).ready(function () {
    
    $('.list-group-item').on('click', '.text-input', function(event) {
        event.preventDefault();
    });
    
    $('.list-group-item').on('click', '.only-text', function(event) {
        event.preventDefault();
    });
    
    $(function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });

    
    //slide-swipe from vendors main.js
    	$('.list-group-item span.slide-swipe').on('click', function(event) {
		event.preventDefault();
		$(this).parent('a.list-group-item').toggleClass('open');
	});
	
	$('.data-switch span.slide-swipe').on('click', function(event) {
		event.preventDefault();
		$(this).parent('.data-switch').toggleClass('open');
	});
    //end slide-swipe
    

    $('input[type="radio"]').on('click', function () {
        var form = $(this).closest('form').attr('id');
        
        if($('#'+form).find('.prices').length === 0) {
            $('#'+form).find('input:checked').each(function () {
                if(!$(this).is('.onoffswitch-checkbox')) {
                    $(this).prop('checked', false);
                }
            });

            $(this).prop('checked', true);
            
        } else {
            
            $('#'+form).find('input:checked').each(function () {
                $(this).prop('checked', false);
            });

            var id = $(this).attr('id').match(/[0-9]+/);

            $('.prices').find('input[type="radio"]').each(function () {

                if( $(this).attr('id').indexOf(id) > -1 ){
                   $(this).prop('checked', true);
                }
            });
        }
    });
    


    function centerObject() {
        var windowHeight = $(window).height();
        var elementHeight = $('.screen-center').height();
        
        var windowWidth = $(window).width();
        var elementWidth = $('.screen-center').width();
        
        var differenceHorizontal = (windowWidth-elementWidth)/2;
        var differenceVertical = ((windowHeight-elementHeight)/2)-(windowHeight/25);
        
        if( windowHeight > elementHeight+(windowHeight/5) ) {
            $('.screen-center').css({ 'position': 'absolute', 'top': differenceVertical+'px'});
            
            if(windowWidth >= '768'){
                $('.screen-center').css({ 'position': 'absolute', 'left': differenceHorizontal+'px'});
            } else {
                $('.screen-center').css({ 'position': 'absolute', 'left': (differenceHorizontal-15)+'px'});
            }
        }
    }
    
    function matchHeight() {
        var windowWidth = $(window).width();
        var sideNavHeight;
        var contentHeight;
        
        if (windowWidth >= '768'){
            sideNavHeight = $('.side-nav').height();
            contentHeight = $('.content').height();
            
            if(sideNavHeight > contentHeight) {
                $('.content').css({ 'height': sideNavHeight+22});
            } else if (sideNavHeight < contentHeight) {
                $('.side-nav').css({ 'height': contentHeight+22});
            }
        } else if (windowWidth < '768'){
            sideNavHeight = $('.side-nav').height();
            contentHeight = $('.content').height();
            
            $('.content').css({ 'height': 'auto'});
            $('.side-nav').css({ 'height': 'auto'});
        }
    }
    

    /* ------------------------------------------------------------------- */

    /* Match cols height */


    function matchColsHeight() {
        $('.row-match-height').each(function () {
            var maxHeight = 0;

            var cols = $(this).find('> div');

            cols.each(function () {
                var currentHeight = $(this).height();

                if (currentHeight > maxHeight) {
                    maxHeight = currentHeight;
                }
            });

            cols.each(function () {
                if (!$(this).hasClass('clearfix')) {
                    $(this).css('min-height', maxHeight);
                }
            });

            $('.slides').each(function () {
                $(this).css('height', maxHeight);
            });
        });
    }

    /**
     * Window load.
     *
     */
    $(window).load(function () {

        matchColsHeight();
        centerObject();
        matchHeight();
        
        if($('.prices').length !== 0) {
            var checkedid = $('.prices').find('input:checked').attr('id').match(/[0-9]+/);

            $('.prices').find('input[type="radio"]').each(function () {

                if( $(this).attr('id').indexOf(checkedid) > -1 ){
                   $(this).prop('checked', true);
                }
            });
        }

    });

    $(window).resize(function () {
        matchColsHeight();
        centerObject();
        matchHeight();
    });
});
