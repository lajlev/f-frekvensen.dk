<?php
/**
 * The widgets containing in the top bar.
 */
?>
	<?php if ( is_active_sidebar( 'widget' ) ) : ?>
		<!-- // WIDGETS // --> 
	    <div id="widgets">
	        <a href"#" id="close-widgets" class="icon">&#10062;</a>

	        <div id="masonry-widgets" class="container">
	        	<?php dynamic_sidebar( 'widget' ); ?>
	        </div><!-- end #masonry-widgets -->
	    </div><!-- end #widgets -->
    <?php endif; ?>