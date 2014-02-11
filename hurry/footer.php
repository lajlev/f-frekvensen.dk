<?php
/**
 * The template for displaying the footer.
 */
?>
			<!-- ///////////////////////////////////////////////////////////////////
            FOOTER
            /////////////////////////////////////////////////////////////////////-->
            <section id="footer">
            	<?php $hurry_footer_menu = get_option('hurry_footer_menu'); ?>
                <?php if ($hurry_footer_menu == "true"): ?>
	                <!-- // FOOTER MENU // --> 
	                <div id="footer-menu" class="container">
	                    <nav>
	                        <?php wp_nav_menu( array(
                                'container'       => 'ul', 
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'menu_id'         => 'footernav',
                                'menu_class' => 'nav',
                                'theme_location'  => 'footernav',
                                'sort_column'    => 'menu_order'
                            )); ?> 
	                    </nav>
	                </div><!-- end #footer-menu -->
	            <?php endif; ?>

                <!-- // FOOTER COPYRIGHT // --> 
                <div id="footer-copyright">
                    <div class="container">
                    	<?php $hurry_footer_text = get_option('hurry_footer_text'); ?>
                        <p><?php echo $hurry_footer_text; ?></p>
                    </div>
                </div><!-- end #footer-copyright -->

                <?php $hurry_footer_social = get_option('hurry_footer_social'); ?>
                <?php if ($hurry_footer_social == "true"): ?>
	                <!-- // SOCIALICONS // --> 
	                <div id="footer-social">
	                    <nav class="social-icons container">
                			<?php include(TEMPLATEPATH . '/includes/theme-social.php'); ?> 
	                    </nav>
	                </div><!-- end #footer-social -->
	            <?php endif; ?>
            </section><!-- end #footer -->

        </div><!-- end #page -->
        
        <!-- ///////////////////////////////////////////////////////////////////
        Javascript files
        /////////////////////////////////////////////////////////////////////-->
        <?php wp_footer(); ?>
    </body>
</html>