<?php
/*
Template Name: Standard Blog 
*/
get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">
                    <article id="standard-blog" class="<?php if(rwmb_meta( 'hurry_page_sidebar') == "1"): ?>three_fourth<?php endif; ?> container-column page">
                        <div class="container-content withoutheading">
                            <?php 
                            if ( get_query_var('paged') ) {

                                $paged = get_query_var('paged');

                            } elseif ( get_query_var('page') ) {

                                $paged = get_query_var('page');

                            } else {

                                $paged = 1;

                            }     
                            query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
                            $wp_query->is_home = 0;
                            ?>
                            <?php if ( have_posts() ) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php get_template_part( 'content', get_post_format() ); ?>

                                <?php endwhile; ?>
                            <?php endif; // end have_posts() check ?>
                        </div><!-- end .container-content -->

                        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                            <!-- // NAVIGATION // --> 
                            <div id="container-footer">
                                <nav class="post-navigation" role="navigation">
                                    <?php next_posts_link( '&#59229' ); ?>
                                    <?php previous_posts_link( '&#59230'); ?>
                                </nav><!-- end .navigation -->
                            </div><!-- end #container-footer -->            
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </article>

                    <?php if( rwmb_meta('hurry_page_sidebar') == "1"): ?>
                        <?php get_sidebar(); ?>
                    <?php endif; ?> 

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>