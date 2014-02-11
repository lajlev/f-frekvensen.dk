<?php
/*
Template Name: Sitemap
*/
get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">

                    <article id="post-<?php the_ID(); ?>" class="<?php if(rwmb_meta( 'hurry_page_sidebar') == "1"): ?>three_fourth<?php endif; ?> container-column page">

                        <?php if ( has_post_thumbnail() ): ?>
                            <div id="container-header" class="featured-image-on">
                                <?php
                                    $image_id = get_post_thumbnail_id();  
                                    $image_url = wp_get_attachment_image_src($image_id,'full');  
                                    $image_url = $image_url[0];
                                ?>
                                <div style="background-image: url('<?php echo $image_url; ?>');">
                                    <div class="container-padding">
                                        <h1><?php the_title(); ?></h1>
                                    </div><!-- end .container-padding -->
                                </div><!-- end .container -->
                            </div><!-- end #container-header -->
                        <?php else: ?>
                            <div id="container-header">
                                <div class="container-padding" style="background: #FFF;">
                                    <h1><?php the_title(); ?></h1>
                                </div><!-- end .container-padding -->
                            </div><!-- end #container-header -->
                        <?php endif; ?>

                        <div class="container-content">

                            <div class="container-padding">
                                <?php if ( have_posts() ) : ?>
                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php the_content() ?>

                                    <?php endwhile; ?>
                                <?php endif; // end have_posts() check ?>   

                                <div class="breaker"></div>
                                <div class="center m2">
                                     <span class="icon large">&#59392;</span>
                                </div><!-- end .center -->
                                <div class="m1">
                                    <div class="one_third">
                                        <h2 class="center">    
                                             <?php _e( 'Archives', 'hurry' ); ?>
                                        </h2>
                                        <ul class="archives-list m1"><?php wp_get_archives('type=monthly'); ?></ul>
                                    </div>
                                    <div class="one_third">
                                        <h2 class="center">
                                             <?php _e( 'Categories', 'hurry' ); ?>
                                        </h2>
                                        <ul class="archives-list m1"><?php wp_list_categories('title_li='); ?></ul>
                                    </div>
                                    <div class="one_third last">
                                        <h2 class="center">   
                                             <?php _e( 'Pages', 'hurry' ); ?>
                                        </h2>
                                        <ul class="archives-list m1"><?php wp_list_pages('title_li='); ?></ul>
                                    </div>
                                    <div class="clearboth"></div>
                                </div>
                            </div><!-- end .container-padding -->    
                        </div><!-- end .container-content -->                
                    </article><!-- end .page -->
    
                    <?php if( rwmb_meta('hurry_page_sidebar') == "1"): ?>
                        <?php get_sidebar(); ?>
                    <?php endif; ?> 

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>