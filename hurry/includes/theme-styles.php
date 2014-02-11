<?php
function hurry_styles() {
	if (!is_admin()) {
		
		wp_register_style('general-css', get_template_directory_uri().'/style.css', '', '', 'screen, all');
		wp_enqueue_style('general-css');

		$hurry_retina = get_option('hurry_retina'); 
		if($hurry_retina =="true"):
			wp_register_style('retina-css', get_template_directory_uri().'/css/retina.css', '', '', 'screen, all');
			wp_enqueue_style('retina-css');
		endif;
		
		$hurry_responsive = get_option('hurry_responsive'); 
		if($hurry_responsive =="true"):
			wp_register_style('responsive-css', get_template_directory_uri().'/css/responsive.css', '', '', 'screen, all');
			wp_enqueue_style('responsive-css');
		endif;
		
	}
}
add_action('init', 'hurry_styles');


$hurry_font1_on = get_option('hurry_font1_on'); 
if ($hurry_font1_on == "true"): 
	/**
	 * Enqueue the font.
	 */
	function mytheme_fonts() {
	    $hurry_font1 = get_option('hurry_font1'); 
	    $hurry_font1_f = str_replace(' ','+', $hurry_font1);
	    $protocol = is_ssl() ? 'https' : 'http';
	    wp_enqueue_style( 'mytheme-font', "$protocol://fonts.googleapis.com/css?family=". $hurry_font1_f."" );}
	add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );
endif;

function hurry_custom_styles() {
	if (!is_admin()) { ?>
		
		<style type="text/css">
			/******************************************************
			STYLES FROM THE THEME OPTIONS
			******************************************************/
			/*BACKGROUND*/
			<?php $hurry_background_image = get_option('hurry_background_image'); ?>
			<?php if ($hurry_background_image != ""): ?>
		    		body{
		            	background: url("<?php echo $hurry_background_image; ?>") repeat;
		            }
		             #wrapper-container{
		            	border-color:  transparent;
		            }
		    <?php else: ?> 
		    	<?php $hurry_background = get_option('hurry_background'); ?>
	            body{
	            	background-color: <?php echo $hurry_background; ?>;
	            }
	            #wrapper-container{
	            	border-color:  <?php echo $hurry_background; ?>;
	            }
		    <?php endif; ?>

			/*FONTS*/
			<?php $hurry_font1_on = get_option('hurry_font1_on'); ?>
			    <?php if ($hurry_font1_on == "true"): ?>
				<?php $hurry_font1 = get_option('hurry_font1'); ?>
	                .searchform input[type="text"],.jp-audio, body, h1, h2, h4,h4 p, #main-menu #logo h1, .searchform input[type="text"],
	                .post-navigation a .load, #infscr-loading
	                {
	                	font-family: '<?php echo $hurry_font1; ?>',  Helvetica, sans-serif;
	                }
	            <?php else: ?>
	            	.searchform input[type="text"],.jp-audio, body, h1, h2, h4,h4 p, #main-menu #logo h1, .searchform input[type="text"],
	            	.post-navigation a .load, #infscr-loading
	                {
	                	font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
	                }
            <?php endif; ?>
			/*COLOR*/
			<?php $hurry_color = get_option('hurry_color'); ?>
                .jp-audio, .jp-play .icon, .jp-pause .icon, a:hover, p a , p a:hover , h6, 
				#widgets .widget ul.tags li a, #widgets .widget nav.social-icons ul li a, #widgets .widget .last-posts-widget li,
				#widgets .widget .last-posts-widget a, #main-menu #menu ul li a:hover, #main-menu #menu ul li.active a,
				.button.colored:hover, #container-comments header a:hover h2, #container-comments .comment-meta a:hover.comment-time,
				.widget a, #footer-menu nav ul li a:hover, #container-comments input#submit:hover, .wpcf7-submit:hover,
				#wrapper-container #masonry-container .post-link .post-home-content h3
                {
                	color: <?php echo $hurry_color; ?>;
                }
                #top-bar, #widgets, #widgets .widget ul.tags li a:hover, #wrapper-container #masonry-container .post-audio .post-home-conten,
                #masonry-container .post-hidden, .button.colored, #container-comments input#submit,  span.dropcap, #container-comments .reply a, .wpcf7-submit
                {
                	background-color: <?php echo $hurry_color; ?>;
                }
                .sf-menu ul a:hover, #container-comments .reply a:hover
                {
                	color: <?php echo $hurry_color; ?> !important;
                }
                #wrapper-container #masonry-container .post-home-content.bordered, .jp-controls li a
                {
                	border-color: <?php echo $hurry_color; ?>;
                }
            <?php $hurry_color2 = get_option('hurry_color2'); ?>
            	h1, #footer-menu nav ul li:before, #footer-menu nav ul li:before, #footer-menu nav ul, #footer-copyright p,
            	a, h4,h4 p, #main-menu #menu ul li:before, #wrapper-container #container-main #container-header h1,
            	#wrapper-container .container blockquote, #wrapper-container #masonry-container .post-home-content blockquote small,
            	#container-main #postmetadata ul li, input[type="text"], input[type="text"], textarea, #container-comments .comment-list > li:before, 
            	#container-comments .comment-meta a.comment-time, .widget h3, .searchform input[type="text"] , .post-quote blockquote small,
            	#wrapper-container .container h2 p
                {
                	color: <?php echo $hurry_color2; ?>;
                }
            <?php $hurry_color3 = get_option('hurry_color3'); ?>
            	.widget ul.tags li a:hover, #footer-social nav ul li a, .jp-audio a , .jp-audio a:hover, body,
            	a[rel=tooltip], a:hover[rel=tooltip], .post-navigation a:hover, #container-main #postmetadata a:hover,
            	#postmetadata ul li span.icon:hover, .button:hover, #container-comments header a:hover h2,
            	#container-comments .comment-text, .widget, .container .post-quote blockquote p,
            	#wrapper-container #masonry-container .post-home-content blockquote p
				{
                	color: <?php echo $hurry_color3; ?>;
                }
                .widget .last-posts-widget li, .widget nav.social-icons ul li a, .widget ul.tags li a, .post-navigation a,
                .button, #container-author, #container-comments header a h2, #infscr-loading, #toTop
                {
                	background-color: <?php echo $hurry_color3; ?>;
                }
                .box, input[type="text"], input[type="text"], textarea
                {
                	border-color: <?php echo $hurry_color3; ?>;
                }
                .sf-menu ul a {
                	color: <?php echo $hurry_color3; ?> !important;
                }
			/*CUSTOM CSS*/
			<?php $hurry_custom_css = get_option('hurry_custom_css'); ?>
			<?php if ($hurry_custom_css != ""): ?>
                <?php echo $hurry_custom_css; ?>
            <?php endif; ?>
		</style>
	<?php
	}
}
add_action('wp_head', 'hurry_custom_styles');
?>