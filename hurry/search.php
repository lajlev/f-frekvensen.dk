<?php
/**
 * The template for displaying Search Results pages.
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
                            <h1 class="post-title"><?php printf( __( 'Søgeresultater for: %s', 'hurry' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
                                    <?php _e( 'Der var ikke noget, der matchede de valgte søgeord.', 'hurry' ); ?>
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