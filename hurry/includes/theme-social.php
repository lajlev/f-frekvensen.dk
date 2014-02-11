<?php
/**
 * Social Icons Managed from the Theme Options 
 */
?>
<ul>
    <?php $hurry_social_facebook = get_option('hurry_social_facebook'); ?>
    <?php if($hurry_social_facebook != ""): ?>
        <li class="icon-facebook"><a href="<?php echo $hurry_social_facebook; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Facebook', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_twitter = get_option('hurry_social_twitter'); ?>
    <?php if($hurry_social_twitter != ""): ?>
        <li class="icon-twitter"><a href="<?php echo $hurry_social_twitter; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Twitter', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_vimeo = get_option('hurry_social_vimeo'); ?>
    <?php if($hurry_social_vimeo != ""): ?>
        <li class="icon-vimeo"><a href="<?php echo $hurry_social_vimeo; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Vimeo', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_flickr = get_option('hurry_social_flickr'); ?>
    <?php if($hurry_social_flickr != ""): ?>
        <li class="icon-flickr"><a href="<?php echo $hurry_social_flickr; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Flickr', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_google = get_option('hurry_social_google'); ?>
    <?php if($hurry_social_google != ""): ?>
        <li class="icon-google"><a href="<?php echo $hurry_social_google; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Google Plus', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_pinterest = get_option('hurry_social_pinterest'); ?>
    <?php if($hurry_social_pinterest != ""): ?>
        <li class="icon-pinterest"><a href="<?php echo $hurry_social_pinterest; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Pinterest', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_tumblr = get_option('hurry_social_tumblr'); ?>
    <?php if($hurry_social_tumblr != ""): ?>
        <li class="icon-tumblr"><a href="<?php echo $hurry_social_tumblr; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Tumblr', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_github = get_option('hurry_social_github'); ?>
    <?php if($hurry_social_github != ""): ?>
        <li class="icon-github"><a href="<?php echo $hurry_social_github; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Github', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_instagram = get_option('hurry_social_instagram'); ?>
    <?php if($hurry_social_instagram != ""): ?>
        <li class="icon-instagram"><a href="<?php echo $hurry_social_instagram; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Instagram', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_linkedin = get_option('hurry_social_linkedin'); ?>
    <?php if($hurry_social_linkedin != ""): ?>
        <li class="icon-linkedin"><a href="<?php echo $hurry_social_linkedin; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Linkedin', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_dribbble = get_option('hurry_social_dribbble'); ?>
    <?php if($hurry_social_dribbble != ""): ?>
        <li class="icon-dribbble"><a href="<?php echo $hurry_social_dribbble; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Dribbble', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_stumbleupon = get_option('hurry_social_stumbleupon'); ?>
    <?php if($hurry_social_stumbleupon != ""): ?>
        <li class="icon-stumbleupon"><a href="<?php echo $hurry_social_stumbleupon; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Stumbleupon', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_lastfm = get_option('hurry_social_lastfm'); ?>
    <?php if($hurry_social_lastfm != ""): ?>
        <li class="icon-lastfm"><a href="<?php echo $hurry_social_lastfm; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Lastfm', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_spotify = get_option('hurry_social_spotify'); ?>
    <?php if($hurry_social_spotify != ""): ?>
        <li class="icon-spotify"><a href="<?php echo $hurry_social_spotify; ?>" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Join us on Spotify', 'hurry' ); ?>"></a></li>
    <?php endif; ?>
    <?php $hurry_social_rss = get_option('hurry_social_rss'); ?>
    <?php if($hurry_social_rss == "true"): ?>
	    <li class="icon-rss"><a href="<?php bloginfo('rss2_url'); ?>" class="rss-icon" data-rel="tooltip" data-tip="top" data-original-title="<?php _e( 'Subscribe to our RSS feed', 'hurry' ); ?>"></a></li>
	 <?php endif; ?>
</ul>

<?php ?>