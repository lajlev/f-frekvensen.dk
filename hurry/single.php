<?php
/**
 * The Template for displaying all single posts.
 */
get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">

                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', get_post_format() ); ?>

                        <?php endwhile; ?>
                    <?php endif; // end have_posts() check ?>

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>