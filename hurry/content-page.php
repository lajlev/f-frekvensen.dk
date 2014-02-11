<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
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

                <p><?php the_content()?></p>

            </div><!-- end .container-padding -->

            <?php if( rwmb_meta('hurry_post_meta') == "1"): ?>
                <!-- // POSTMETADATA // --> 
                <div id="postmetadata">
                    <div class="breaker"></div>
                    <ul>
                        <li><span class="icon">&#128340;</span> <?php the_time('F j, Y'); ?></li>
                        <li><span class="icon">&#59160;</span> <?php comments_popup_link('0 Comment', '1 Comment', '% Comments', 'comments-link', '<div class="commentoff">No comments on this post</div>'); ?></li>
                        <li><span class="icon">&#128100;</span> <?php _e('By','hurry'); ?> <?php the_author_link(); ?></li>
                    </ul>
                    <div class="breaker"></div>
                </div><!-- end #postmetadata -->
            <?php endif; ?> 

            <?php if( rwmb_meta('hurry_post_author') == "1"): ?>
                <!-- // AUTHOR // --> 
                <div id="container-author">
                    <div class="container-padding">
                        <?php echo get_avatar( get_the_author_meta('ID'), 80); ?>
                        <h4><?php the_author_link(); ?></h4>
                        <p><?php the_author_meta('description'); ?></p>
                    </div><!-- end .container-padding -->
                </div><!-- end #container-author -->
            <?php endif; ?> 

            <?php if( rwmb_meta('hurry_post_comments') == "1"): ?>
                <!-- // COMMENTS // --> 
                <?php comments_template( '', true ); ?>
            <?php endif; ?> 

        </div><!-- end .container-content -->
        <!-- // NAVIGATION // --> 
        <div id="container-footer" style="display: none;">
            <nav class="post-navigation" role="navigation">
                <?php $args = array(
                    'before'           => '',
                    'after'            => '',
                    'link_before'      => '',
                    'link_after'       => '',
                    'next_or_number'   => 'number',
                    'nextpagelink'     => '&#59229',
                    'previouspagelink' => '&#59230',
                    'pagelink'         => '%',
                    'echo'             => 1
                ); ?>
                <?php wp_link_pages( $args ); ?> 
            </nav><!-- end .navigation -->
        </div><!-- end #container-footer -->  

    </article><!-- end .page -->
    
    <?php if( rwmb_meta('hurry_page_sidebar') == "1"): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?> 

