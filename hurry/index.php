<?php
/**
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container">

                <div id="container-main" class="container">
                    <div id="masonry" class="one">
                        <div class="container-content withoutheading">
                            <div id="masonry-container">

                                <?php if ( have_posts() ) : ?>
                                <ul>
                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <li><?php get_template_part( 'content', get_post_format() ); ?></li>

                                    <?php endwhile; ?>
                                </ul>
                                <?php endif; // end have_posts() check ?>   

                            </div><!-- end #masonry-container -->

                            <div class="clearboth"></div>

                            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                                <!-- // NAVIGATION // --> 
                                <div id="container-footer">
                                    <nav class="post-navigation infinite-nav" role="navigation">
                                        <?php next_posts_link('<span class="infinite-textbtn load">'. __( 'Load more posts', 'hurry' ) .'</span>' ); ?>
                                        <span class="infinite-loader"></span>
                                    </nav>
                                </div><!-- end #container-footer -->              
                            <?php endif; ?>
                        </div><!-- end .container-content -->
                    </div><!-- end .one -->
                </div><!-- end #container-main -->


            </section><!-- end #wrapper-container -->
<?php get_footer(); ?>