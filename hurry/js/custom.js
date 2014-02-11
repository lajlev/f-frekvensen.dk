/*
 * Hurry - Minimalist Blogging Theme
 *
 * Copyright (c) 2013 F²
 * 
 * Main Javascript
 */
/******************************************************
BOOTSTRAP PLUGINS
*******************************************************/
(function($) {
        $('[data-rel=tooltip]').tooltip();
        $('.collapse').collapse();
}(jQuery));
/******************************************************
WIDGETS
*******************************************************/
(function($) {
    $(window).load(function(){
        $('div.widget-open a, #close-widgets').click(function(){
            $('#widgets').slideToggle();
            $('#masonry-widgets').masonry({
                itemSelector : '.widget',
                isResizable: true,
                isAnimated: true
            });
        });
    });
}(jQuery));
/******************************************************
DROPDOWN MENU
*******************************************************/
(function($) { 
        $("ul.sf-menu").superfish({ 
            delay: 500, // 0.5 second delay on mouseout 
            speed: 'normal',            
            cssArrows: false
        }); 
        $('ul.sf-menu > li > a.sf-with-ul').parent('li').addClass('sf-ul');
}(jQuery)); 
/******************************************************
FIVFIDS (height and with for the videos)
*******************************************************/
(function($) {
        $(".video-wrapper").fitVids({ customSelector: "iframe[src^='http://www.dailymotion.com']"});
}(jQuery));
/******************************************************
MENU FOR MOBILES 
*******************************************************/
(function($) {
          var navigation = responsiveNav("#menu", { // Selector: The ID of the wrapper
              animate: true, // Boolean: Use CSS3 transitions, true or false
              transition: 400, // Integer: Speed of the transition, in milliseconds
              label: '<span class="icon">&#9776;</span>', // String: Label for the navigation toggle,  
              insert: "after", 
              open: function(){ $('#menu ul').removeClass('sf-menu sf-js-enabled sf-shadow'); }, // Function: Open callback
              close: function(){ $('#menu ul').addClass('sf-menu sf-js-enabled sf-shadow'); } // Function: Close callback
            });
}(jQuery));
/******************************************************
COMMENTS
*******************************************************/
(function($) {
        $('.comment-container').hide;
        $(".comments-open").click(function () {
        
            $(".comment-container").fadeToggle();
            
            $('html, body').animate({
                scrollTop: $(".comments-open").offset().top
            }, 500);

            return false;
        });
}(jQuery));
/******************************************************
ISOTOPE FILTERING
*******************************************************/
jQuery.noConflict()(function($){
    $(window).load(function(){
        // cache container
        var $container = $('.gallery #masonry-container');
        // initialize isotope
        // filter items when filter link is clicked
        $('.filters a').click(function(){
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector });
            return false;
        });
    });    
}); 
/******************************************************
MASONRY
*******************************************************/
jQuery.noConflict()(function($){
    $(window).load(function(){
        /*$('.chrome div.view div.post-absolute-container').each( function() { 
            $(this).hoverdir({speed: 400}); 
        } );*/

        var $container = $('#masonry-container');
            $container.masonry({
                itemSelector : '.masonry-item',
                isResizable: true,
                columnWidth : 240,
                isAnimated: true
            });
        var $container = $('#masonry-container');
        $container.infinitescroll({
            navSelector: '#masonry .post-navigation',
            nextSelector: '#masonry .post-navigation a',
            itemSelector: '.masonry-item',
            behavior: 'twitter',
            loading: {
                finished: null,
                finishedMsg: '<p>All posts are loaded</p>',
                img: '', 
                msg: '',
                msgText: '',
                selector: '#masonry .post-navigation a',
                speed: 'fast'
            }
        }, function(newElements) {
            var $newElems = $(newElements).css({
                opacity: 0
            });
            $newElems.imagesLoaded(function() {
                $newElems.animate({
                    opacity: 1
                });
                $container.masonry('appended', $newElems, true);

                $("a[data-rel^='prettyPhoto']").prettyPhoto({
                    animation_speed: 'normal',
                    /* fast/slow/normal */
                    slideshow: false,
                    /* false OR interval time in ms */
                    autoplay_slideshow: false,
                    /* true/false */
                    opacity: 0.4,
                    /* Value between 0 and 1 */
                    show_title: false,
                    /* true/false */
                    allow_resize: true,
                    /* Resize the photos bigger than viewport. true/false */
                    default_width: 300,
                    default_height: 144,
                    counter_separator_label: '/',
                    /* The separator for the gallery counter 1 "of" 2 */
                    theme: 'pp_default',
                    /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                    hideflash: false,
                    /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
                    wmode: 'opaque',
                    /* Set the flash wmode attribute */
                    autoplay: true,
                    /* Automatically start videos: True/False */
                    modal: false,
                    /* If set to true, only the close button will close the window */
                    overlay_gallery: false,
                    /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                    keyboard_shortcuts: true,
                    /* Set to false if you open forms inside prettyPhoto */
                    changepicturecallback: function() {},
                    /* Called everytime an item is shown/changed */
                    callback: function() {} /* Called when prettyPhoto is closed */
                });
                $(".video-wrapper").fitVids({ customSelector: "iframe[src^='http://www.dailymotion.com']"});
                $(".royalSlider").royalSlider({
                    keyboardNavEnabled: true,
                    imageScaleMode: 'fill',
                    autoScaleSlider: true, 
                    sliderDrag: false,
                    autoPlay: true,
                    slidesSpacing: 0,
                    transitionType:'move'
                });  
                /*$('.chrome div.view div.post-absolute-container').each( function() { 
                    $(this).hoverdir({speed: 400}); 
                } );*/
                $('[data-rel=tooltip]').tooltip();
                $(".post-like a").click(function() {

                    heart = $(this);
                    post_id = heart.data("post_id");

                    $.ajax({
                            type: "post",
                            url: ajax_var.url,
                            data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
                            success: function(count){
                                if(count != "already") {
                                    heart.addClass("voted");
                                    heart.siblings(".count").text(count);
                                }
                            }
                    });
                    return false;
                }) // end post like system
            });
        });

        $(window).unbind('.infscr');
        $('#masonry .post-navigation a').click(function(){
            $('#masonry-container').infinitescroll('retrieve');
            return false;
        });

        $('#masonry .post-navigation a').click(function(){   
            $('#masonry .post-navigation a').fadeOut(100).delay(2000).fadeIn(100);
        });
    });    
}); 
/******************************************************
PRETTYPHOTO
*******************************************************/
(function($) {
        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            /* fast/slow/normal */
            slideshow: false,
            /* false OR interval time in ms */
            autoplay_slideshow: false,
            /* true/false */
            opacity: 0.4,
            /* Value between 0 and 1 */
            show_title: false,
            /* true/false */
            allow_resize: true,
            /* Resize the photos bigger than viewport. true/false */
            default_width: 300,
            default_height: 144,
            counter_separator_label: '/',
            /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default',
            /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false,
            /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque',
            /* Set the flash wmode attribute */
            autoplay: true,
            /* Automatically start videos: True/False */
            modal: false,
            /* If set to true, only the close button will close the window */
            overlay_gallery: false,
            /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true,
            /* Set to false if you open forms inside prettyPhoto */
            changepicturecallback: function() {},
            /* Called everytime an item is shown/changed */
            callback: function() {} /* Called when prettyPhoto is closed */
        });
}(jQuery));
/******************************************************
SLIDERS
*******************************************************/
(function($) {
        $(".royalSlider").royalSlider({
            keyboardNavEnabled: true,
            imageScaleMode: 'fill',
            autoScaleSlider: true, 
            sliderDrag: false,
            autoPlay: true,
            slidesSpacing: 0,
            transitionType:'move'
        });  
}(jQuery));
/******************************************************
SLIDERS
*******************************************************/
(function($) {
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        }); 
 
        $('#toTop').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        }); 
}(jQuery));
