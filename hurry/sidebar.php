<?php
/**
 * The main sidebar.
 *
 */
?>
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
		<div id="container-sidebar" class="container-column one_fourth last">
	        <?php dynamic_sidebar( 'sidebar' ); ?>
		</div><div class="clearboth"></div>
	<?php endif; ?>