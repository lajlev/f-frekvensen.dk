<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
get_header(); ?>

            <!-- ///////////////////////////////////////////////////////////////////
            MAIN CONTENT
            /////////////////////////////////////////////////////////////////////-->
            <section id="wrapper-container" >
                <div id="container-main" class="container">

                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', 'page' ); ?>

                        <?php endwhile; ?>
                    <?php endif; // end have_posts() check ?>

                </div><!-- end #container-main -->
            </section><!-- #wrapper-main -->

<?php get_footer(); ?>