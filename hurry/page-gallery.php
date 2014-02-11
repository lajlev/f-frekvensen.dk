<?php
/*
Template Name: Gallery
*/
get_header(); ?>
            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">
                    <?php $hurry_gallery_filters = get_option('hurry_gallery_filters');
                    if ($hurry_gallery_filters == "true"): ?>
                        <div id="container-header">
                            <div class="container-padding filters" style="background: #FFF;">
                                <a href="#" class="button" style="margin-right: 12px;"  data-filter="*"><?php _e('All', 'hurry'); ?></a>
                                <?php $terms = get_terms("gallery_category");
                                $count = count($terms);
                                if ( $count > 0 ){
                                    foreach ( $terms as $term ) {
                                        echo '<a href="#" class="button" style="margin-right: 12px;" data-filter=".Gallery-' . $term->name . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
                                    }
                                } ?>
                            </div><!-- end .container-padding -->
                        </div><!-- end #container-header -->
                    <?php endif; ?>

                    <div id="masonry" class="one gallery">
                        <div class="container-content withoutheading">
                        <div id="masonry-container">
                            <?php $hurry_gallery_per_pages = get_option('hurry_gallery_per_pages'); ?>
                            <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                            <?php $wp_query = new WP_Query('post_type=gallery&post_status=publish&paged='.$paged.'&showposts='.$hurry_gallery_per_pages);?>
                            <?php if (have_posts()) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <!-- // A POST // --> 
                                    <?php 
                                    $terms2 = get_the_terms($post->ID,'gallery_category');
                                    $count2 = count($terms2);
                                    ?>
                                    <div class="post post-image masonry-item view <?php if(is_sticky()): ?>post-big<?php endif;?> <?php if ( $count2 > 0 ){ foreach ( $terms2 as $term2 ) { echo 'Gallery-' . $term2->name . ' '; }} ?>">
                                        <div class="post-absolute-container">
                                            <a href="<?php echo get_permalink( $id ); ?>"><?php the_post_thumbnail(); ?></a>
                                            <div class="post-hidden">
                                                <?php
                                                    $image_id = get_post_thumbnail_id();  
                                                    $image_url = wp_get_attachment_image_src($image_id,'full');  
                                                    $image_url = $image_url[0];
                                                ?>
                                                <a href="<?php echo $image_url; ?>" data-rel="prettyPhoto" class="post-icon-link"><span class="post-icon icon large">&#128247;</span></a>
                                                <a href="<?php echo $image_url; ?>" data-rel="prettyPhoto"><h4><?php the_title(); ?></h4></a>
                                                <div class="post-hover-matadata">
                                                    <ul>
                                                        <li><span class="icon">&#128340;</span> <a href="<?php echo get_permalink( $id ); ?>"> <?php the_time('F j, Y'); ?> </a></li>
                                                    </ul>
                                                </div><!-- end .post-hover-matadata -->
                                            </div><!-- end .post-hidden -->
                                        </div><!-- end .post-absolute-container -->
                                    </div><!-- end .post -->

                                <?php endwhile; ?>
                            <?php endif; // end have_posts() check ?>

                        </div><!-- end #masonry-container -->

                        <div class="clearboth"></div>
                            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                                <!-- // NAVIGATION // --> 
                                <div id="container-footer">
                                    <nav class="post-navigation infinite-nav" role="navigation">
                                        <?php next_posts_link('<span class="infinite-textbtn load">'. __( 'Load more images', 'hurry' ) .'</span>' ); ?>
                                        <span class="infinite-loader"></span>
                                    </nav>
                                </div><!-- end #container-footer -->              
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                        </div><!-- end .container-content -->
                    </div><!-- end .one -->
                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->
                
<?php get_footer(); ?>
