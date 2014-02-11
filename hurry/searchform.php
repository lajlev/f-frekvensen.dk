<?php
/**
 * The template for displaying search forms in Hurry
 */
?>
<!-- // THE SEARCH FORM // -->
<form class="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" name="s" class="s" onblur="if (this.value == '') {this.value = 'Søg her...';}" onfocus="if (this.value == 'Søg her...') {this.value = '';}" value="Søg her..." />
    <button type="submit" class="button"><span><?php _e("Søg her...","dandy"); ?></span></button>
 </form><!-- end #searchform -->