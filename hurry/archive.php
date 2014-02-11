<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container">

                <div id="container-main" class="container">
                    <div id="container-header">
                        <div class="container-padding" style="background: #FFF;">
                            <h1>
                                <?php if ( is_day() ) : ?>
                                    <?php printf( __( 'Arkiv efter dag: %s', 'hurry' ), '<span>' . get_the_date() . '</span>' ); ?>
                                <?php elseif ( is_month() ) : ?>
                                        <?php printf( __( 'Arkiv efter måned: %s', 'hurry' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
                                <?php elseif ( is_year() ) : ?>
                                        <?php printf( __( 'Arkiv efter år: %s', 'hurry' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
                                <?php elseif ( is_category() ) : ?>
                                        <?php printf( __( 'Arkiv efter kategori: %s', 'hurry' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
                                <?php else : ?>
                                        <?php _e( 'Blog Archives', 'hurry' ); ?>
                                <?php endif; ?>
                            </h1>
                        </div><!-- end .container-padding -->
                    </div><!-- end #container-header -->

                    <?php if ( have_posts() ) : ?>
                        <div id="masonry" class="one">
                            <div class="container-content withoutheading">
                                <div id="masonry-container">

                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php get_template_part( 'content', get_post_format() ); ?>

                                    <?php endwhile; ?> 
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
                    <?php else: ?>     
                        <div class="container-content">
                            <div class="container-padding">
                                <div class="center m1">
                                     <span class="icon large">&#128165;</span>
                                </div><!-- end .center -->
                                <p class="center m2">
                                    <?php _e( 'Apologies, but no results were found for the requested archive.', 'hurry' ); ?>
                                </p>
                                <div class="center m2 not-found-form" >
                                    <?php get_search_form(); ?> 
                                </div>
                            </div><!-- end .container-padding -->
                        </div><!-- end .container-content -->
                    <?php endif; // end have_posts() check ?>   

                </div><!-- end #container-main -->


            </section><!-- end #wrapper-container -->

<?php get_footer(); ?>