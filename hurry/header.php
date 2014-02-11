<?php
/**
 * The Header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- Title -->
        <title><?php wp_title( '|', true, 'right' ); ?></title>
	    <!-- Meta Tags -->
	    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- // Search engine optimization  // -->
        <?php $hurry_description = get_option('hurry_description');
        if ($hurry_description != ""): ?>
            <!-- DESCRIPTION -->    
            <meta name="description" content="<?php echo $hurry_description; ?>">
        <?php endif; ?>
        
        <?php $hurry_keywords = get_option('hurry_keywords');
        if ($hurry_keywords != ""): ?>
            <!-- KEYWORDS -->    
            <meta name="keywords" content="<?php echo $hurry_keywords; ?>">
        <?php endif; ?>
        
        <?php $hurry_favicon = get_option('hurry_favicon');
		if ($hurry_favicon != ""): ?>
			<!-- FAVICON -->	
			<link rel="shortcut icon" href="<?php echo $hurry_favicon; ?>" />
        <?php endif; ?>
		
		<?php $hurry_ios_114 = get_option('hurry_ios_114');
			if ($hurry_ios_114 != ""): ?>
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $hurry_ios_114; ?>" />
		<?php endif; ?>
		<?php $hurry_ios_72 = get_option('hurry_ios_72');
			if ($hurry_ios_72 != ""): ?>
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $hurry_ios_72; ?>" />
		<?php endif; ?>
        
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
        <?php wp_head(); ?>
	
    </head>	
    
    <body <?php body_class(); ?>>
        <div id="page">
            <?php $hurry_scroll = get_option('hurry_scroll'); ?>
            <?php if ($hurry_scroll == "true"): ?>
                <a href="#" id="toTop" class="icon animated-css GoIn GoIn-fast">&#59231;</a>
            <?php endif; ?>
            <!-- ///////////////////////////////////////////////////////////////////
            Wrapper top (Header)
            /////////////////////////////////////////////////////////////////////-->
            <section id="header">

                <?php get_sidebar('widgets'); ?>

                <?php $hurry_header_topbar = get_option('hurry_header_topbar'); ?>
                <?php if ($hurry_header_topbar == "true"): ?>
                    <div id="top-bar" class="animated-css GoIn">
                        <div class="container">
                            <!-- // ANNOUNCEMENT // --> 
                            <div class="announcement">
                                <span><?php bloginfo( 'description' ); ?></span>
                            </div><!-- end .announcement -->
                            <?php if ( is_active_sidebar( 'widget' ) ) : ?>
                                <div class="widget-open">
                                    <a href="#" class="icon" title="<?php _e('Open the widgets', 'hurry' ); ?>" data-rel="tooltip" data-placement="bottom">&#59228;</a>
                                </div><!-- end .widget-open -->
                            <?php endif; ?>
                        </div><!-- end .container -->
                    </div><!-- end #top-bar -->
                <?php endif; ?>

                <div id="main-menu">
                    <div class="container">
                        <!-- // LOGO // --> 
                        <div id="logo" class="animated-css GoIn GoIn-slow ">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                <?php $hurry_logo = get_option('hurry_header_logo'); ?>
                                <?php if ($hurry_logo != ""): ?>    
                                    <?php $hurry_logo_width = get_option('hurry_logo_width'); ?>
                                    <?php $hurry_logo_height = get_option('hurry_logo_height'); ?>
                                    <img src="<?php echo $hurry_logo; ?>" alt="logo" style="height:<?php echo $hurry_logo_height; ?>px; width:<?php echo $hurry_logo_width; ?>px">
                                <?php else: ?>
                                    <h1><?php bloginfo( 'name' ); ?></h1>
                                <?php endif; ?>
                            </a>
                        </div>
                        <!-- // MENU // --> 
                        <nav id="menu" class="animated-css GoIn GoIn-slow ">
                            <?php wp_nav_menu( array(
                                'container'       => 'ul', 
                                'items_wrap'      => '<ul id="%1$s" class="sf-menu %2$s">%3$s</ul>',
                                'menu_id'         => 'topnav',
                                'menu_class' => 'nav',
                                'theme_location'  => 'topnav',
                                'sort_column'    => 'menu_order'
                            )); ?>     
                        </nav>
                    </div><!-- end .container -->
                </div><!-- end #main-menu -->

            </section><!-- end #header -->
