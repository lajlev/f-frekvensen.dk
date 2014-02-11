<?php
function hurry_script() {
	if (!is_admin()) {

		wp_enqueue_script('jquery');

	    wp_register_script('jplugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '1', true);
	    wp_enqueue_script('jplugins');
		
		wp_register_script('jmain', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jmain');

		wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );  
		wp_localize_script('like_post', 'ajax_var', array(  
		    'url' => admin_url('admin-ajax.php'),  
		    'nonce' => wp_create_nonce('ajax-nonce')  
		)); 

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('init', 'hurry_script');

function traking_code_js() {
	$hurry_tracking = get_option('hurry_tracking');
    if (!is_admin()) {
	    if ($hurry_tracking != ""): ?>
	        <script type="text/javascript">
	            <?php echo $hurry_tracking; ?>
	        </script>
		 <?php 
		 endif;
    }
}
add_action( 'wp_footer', 'traking_code_js',100 );

function custom_js() {
    $hurry_custom_js = get_option('hurry_custom_js');
    if (!is_admin()) {
    	if ($hurry_custom_js != ""): ?>
	        <script type="text/javascript">
	            <?php echo $hurry_custom_js; ?>
	        </script>
		 <?php 
		 endif;
    }
}
add_action( 'wp_footer', 'custom_js',100 );

function dribbble_js() {
	$hurry_social_dribbble_user = get_option('hurry_social_dribbble_user'); 
	if($hurry_social_dribbble_user != ""): ?>
	    <script type="text/javascript">
		    (function($) {
	        $.jribbble.getShotsByPlayerId('<?php echo $hurry_social_dribbble_user; ?>', function (playerShots) {
	            var html = [];

	            $.each(playerShots.shots, function (i, shot) {
	                html.push('<li><a href="' + shot.url + '" title="' + shot.title + '">');
	                html.push('<img src="' + shot.image_teaser_url + '" ');
	                html.push('alt="' + shot.title + '"></a></li>');
	            });

	            $('.shotsByPlayerId').html(html.join(''));
	        }, {page: 1, per_page: 6});
			}(jQuery));
	    </script>
<?php endif;
}
add_action( 'wp_footer', 'dribbble_js',100 );


function flickr_js() {
	$hurry_social_flickr_user = get_option('hurry_social_flickr_user'); 
	if($hurry_social_flickr_user != ""): ?>
	    <script type="text/javascript">
		    (function($) {
				$('.flickr-feed').flickrfeed('<?php echo $hurry_social_flickr_user; ?>', '', {
			    	limit: 3,
			    	date: false,
			    	header: false,
			    	title: false
			  	});
			}(jQuery));
	    </script>
<?php endif;
}
add_action( 'wp_footer', 'flickr_js',100 );


?>