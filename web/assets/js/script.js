$(document).ready(function () {


    $('input[type="radio"]').on('click', function () {
        var form = $(this).closest('form').attr('id');
        $('#'+form).find('input:checked').each(function () {
            $(this).prop('checked', false);
        });
        $(this).prop('checked', true);
    });
/*
    $('input[type="radio"]').on('click', function () {
        var form = $(this).closest('form').attr('id');
        $('input[type="radio"]').each(function () {
            $(this).prop('checked', false);
        });
        $(this).prop('checked', true);
    });
*/

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

    });

    $(window).resize(function () {
        matchColsHeight();
        centerObject();
        matchHeight();
    });


    /* ------------------------------------------------------------------- */

    /* displays image size and image link */


    $('.img-container-title').each(function () {

        var image = new Image();

        if(!$(this).find('.img-main').attr("src")) {
            return;
        }
        image.src = $(this).find('.img-main').attr("src");

        var width = $(this).find('.img-main').width();

        var height = $(this).find('.img-main').height();

        var naturalWidth = image.naturalWidth;

        var naturalHeight = image.naturalHeight;

        $(this).parent().find('.img-size-displayed').text('Displayed dimensions ' + width + 'x' + height);

        $(this).parent().find('.img-size-orginal').text('Image dimensions ' + naturalWidth + 'x' + naturalHeight);

        $(this).parent().find('.img-url').attr('href', image.src);

    });


    /* ------------------------------------------------------------------- */

    /* add data-target and data-toggle to img when mouse over the img area*/


    $(document).on('mouseenter', '.img-main', function () {

        var image = new Image();

        image.src = $(this).attr("src");

        var src = $(this).attr("src");

        var modalID = $('.modal').attr("id");

        if ($(this).parent().parent().find('.caption-text').text().length != 0) {
            var caption = $(this).parent().parent().find('.caption-text').text();

            $('.caption-text-modal').html('<i class="fa fa-files-o"></i>' + caption);
        } else {
            $('.caption-text-modal').html('');
        }

        if ($(this).parent().parent().find('.pic-title').text().length != 0) {
            var pic_title = $(this).parent().parent().find('.pic-title').text();

            $('.pic-title-modal').html('<i class="fa fa-files-o"></i>' + pic_title);
        } else {
            $('.pic-title-modal').html('');
        }

        if ($(this).parent().parent().find('.contributor').text().length != 0) {
            var contributor = $(this).parent().parent().find('.contributor').text();

            $('.contributor-modal').html('<i class="fa fa-files-o"></i>' + contributor);
        } else {
            $('.contributor-modal').html('');
        }

        $('.img-main-modal').attr('src', image.src);

        $('.img-url-modal').html('<p>' + image.src + '</p>');

        $('.img-url-modal').attr('href', image.src);

        $(this).attr('data-toggle', 'modal').attr('data-target', '#' + modalID);
    });


    /* ------------------------------------------------------------------- */

    /* remove data-target and data-toggle from img when mouse leave the img area*/


    $('.img-main').mouseleave(function () {

        var src = $(this).attr("src");

        var modalID = $('.modal').attr("id");

        $(this).removeAttr('data-toggle', 'modal').removeAttr('data-target', '#' + modalID);
    });


    /* ------------------------------------------------------------------- */

    /* copy text to clipboard */


    $(document).on('mouseover', '.fa-files-o, .x-text-editor-clipboard', function () {
        if ($(this).parent().find('.zclip').length == 0) {

            $(this).zclip({
                path: '/assets/vendor/zclip/ZeroClipboard.swf',

                copy: function () {
                    if ($(this).hasClass('text-editor-clipboard') == true) {
                        if ($('.note-editable')[0]) {
                            return $.trim($(this).parent().find('.note-editable').text());
                        } else {
                            return $.trim($(this).parent().find('.click2edit').text());
                        }
                    } else if ($(this).data('target')) {
                        var $target = $($(this).data('target'));
                        var val;
                        if (!(val = $target.text())) {
                            val = $target.val();
                        }
                        return $.trim(val);
                    }
                    else if ($(this).parent().find('a')[0]) {
                        return $.trim($(this).parent().find('.x-copy-target').text());
                    } else if ($(this).parent().find('.x-copy-target').length) {
                        return $.trim($(this).parent().find('.x-copy-target').text());
                    } else {
                        return $.trim($(this).parent().text());
                    }
                }
            });

            $('.modal').each(function () {
                $(this).parent().find('[id^="ZeroClipboardMovie_"]').css('position', 'absolute').css('right', '0px').css('cursor', 'pointer');
            });

            $('[id^="ZeroClipboardMovie_"]').each(function () {
                $(this).css('position', 'absolute').css('cursor', 'pointer');
            });
        }
    });

    // product link code generator
    {
        function updateCode($generator) {
            var position = $generator.find('#position').val();
            var width = $generator.find('#width').val();
            var height = $generator.find('#height').val();
            var id = $generator.find('#id').val();
            var code = '<button class="x-cp-product" data-width="{width}" data-height="{height}" data-position="{position}" data-id="{id}">Buy</button>';
            code = code.replace('{width}', width);
            code = code.replace('{height}', height);
            code = code.replace('{position}', position);
            code = code.replace('{id}', id);

            var button = $('<button>').text('BUy').attr('class', '');
            $generator.find('#code').val(code);
        }

        var $generators = $('.x-product-code-generator');
        $generators.each(function () {
            updateCode($(this));
        });
        $generators.on('change keyup', 'input, select', function (e) {
            updateCode($(e.delegateTarget));
        });
        $generators.find('#code').on('click', function () {
            this.focus();
            this.select();
        });
    }
    // links init script code generator
    {

        function updateCustomerCode($generator) {
            var customer = $generator.find('#customer').val();
            var container = $generator.find('#container').val();
            var script = $generator.find('#customer').data('init-script');
            var code = '<script type="text/javascript" src="{script_url}" data-customer-id="{customer}" data-container-id="{container}" id="contentful_init_script"></script>';
            code = code.replace('{customer}', customer);
            code = code.replace('{container}', container);
            code = code.replace('{script_url}', script);
            $generator.find('#code').val(code);
        }

        var $customerCodeGenerators = $('.x-customer-code-generator');

        $customerCodeGenerators.on('change keyup', 'input, select', function (e) {
            updateCustomerCode($(e.delegateTarget));
        });

        $customerCodeGenerators.find('#code').on('click', function () {
            this.focus();
            this.select();
        });
        $customerCodeGenerators.each(function () {
            updateCustomerCode($(this));
        });
    }

});
