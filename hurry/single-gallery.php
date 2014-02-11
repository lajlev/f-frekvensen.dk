<?php
/*
Template for single gallery
*/
get_header(); ?>
            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">

                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" class="<?php if(rwmb_meta( 'hurry_post_sidebar') == "1"): ?>three_fourth<?php endif; ?> container-column post post-image">

                                <div id="container-header" class="featured-image-on">
                                    <?php
                                        $image_id = get_post_thumbnail_id();
                                        $image_url = wp_get_attachment_image_src($image_id,'full');
                                        $image_url = $image_url[0];
                                    ?>
                                    <div style="background-image: url('<?php echo $image_url; ?>');">

                                    </div><!-- end .container -->
                                </div><!-- end #container-header -->

                                <div class="container-content">
                                    <div class="container-padding">
                                        <h1><?php the_title(); ?></h1>
                                        <?php the_content()?>
                                    </div><!-- end .container-padding -->

                                    <?php if( rwmb_meta('hurry_post_meta') == "1"): ?>
                                        <!-- // POSTMETADATA // -->
                                        <div id="postmetadata">
                                            <div class="breaker"></div>
                                            <ul>
                                                <li><span class="icon">&#128340;</span> <?php the_time('j. F, Y'); ?></li>
                                                <?php if (has_category('',$post->ID)): ?>
                                                    <li><span class="icon">&#59392;</span> <?php _e('Categorized in','hurry'); ?> <?php the_category(', '); ?></li>
                                                <?php endif; ?>
                                                <li><span class="icon">&#128100;</span> <?php _e('By','hurry'); ?> <?php the_author_link(); ?></li>
                                                <?php if( function_exists('zilla_share') ): ?>
                                                    <li><span class="icon">&#59157;</span><?php zilla_share(); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                            <div class="breaker"></div>
                                        </div><!-- end #postmetadata -->
                                    <?php endif; ?>


                                <!-- // NAVIGATION // -->
                                <div id="container-footer">
                                    <nav class="post-navigation" role="navigation">
                                        <?php next_post_link( '%link', '&#59229' ); ?>
                                        <?php previous_post_link( '%link',  '&#59230'); ?>
                                    </nav><!-- end .navigation -->
                                </div><!-- end #container-footer -->

                            </article><!-- end .post -->

                        <?php endwhile; ?>
                    <?php endif; // end have_posts() check ?>

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>