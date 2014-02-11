<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">

                    <article id="post-<?php the_ID(); ?>" class="container-column page">
                    
                        <div id="container-header">
                            <div class="container-padding" style="background: #FFF;">
                                <h1><?php _e( '404 error: Not found...', 'hurry' ); ?></h1>
                            </div><!-- end .container-padding -->
                        </div><!-- end #container-header -->

                        <div class="container-content">

                            <div class="container-padding">
                                <div class="center m1">
                                     <span class="icon large">&#128165;</span>
                                </div><!-- end .center -->
                                <div class="center m1">
                                    <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'hurry' ); ?>
                                </div><!-- end .center -->
                                <div class="center m2 not-found-form" >
                                    <?php get_search_form(); ?> 
                                </div>
                            </div><!-- end .container-padding -->    
                        </div><!-- end .container-content -->  

                    </article><!-- end .page -->

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>