<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<?php 
if ( is_single() ) {
?>

    <?php if(rwmb_meta( 'hurry_post_sidebar') == "1"): $classes = array('three_fourth','container-column','post-quote'); else: $classes = array('container-column','post-quote'); endif; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

        <?php if ( has_post_thumbnail() ): ?>
            <div id="container-header" class="featured-image-on">
                <?php
                    $image_id = get_post_thumbnail_id();  
                    $image_url = wp_get_attachment_image_src($image_id,'full');  
                    $image_url = $image_url[0];
                ?>
                <div style="background-image: url('<?php echo $image_url; ?>');">
                    <div class="container-padding">
                        <div class="center post-icon">
                            <span class="icon large">&#10078;</span>
                        </div>
                        <blockquote><p><?php the_content()?></p><small><?php echo rwmb_meta('hurry_post_quote_author'); ?></small></blockquote>
                    </div><!-- end .container-padding -->
                </div><!-- end .container -->
            </div><!-- end #container-header -->
        <?php else: ?>
            <div id="container-header">
                <div class="container-padding" style="background: #FFF;">
                    <div class="center post-icon">
                        <span class="icon large">&#10078;</span>
                    </div>
                    <blockquote><?php the_content()?><small><?php echo rwmb_meta('hurry_post_quote_author'); ?></small></blockquote>
                </div><!-- end .container-padding -->
            </div><!-- end #container-header -->
        <?php endif; ?>

        <div class="container-content">
            <div class="container-padding" style="padding: 10px;">

            </div><!-- end .container-padding -->

            <?php if( rwmb_meta('hurry_post_meta') == "1"): ?>
                <!-- // POSTMETADATA // --> 
                <div id="postmetadata">
                    <div class="breaker"></div>
                    <ul>
                        <li><span class="icon">&#128340;</span> <?php the_time('F j, Y'); ?></li>
                        <li><span class="icon">&#59160;</span> <?php comments_popup_link('0 Comment', '1 Comment', '% Comments', 'comments-link', '<div class="commentoff">No comments on this post</div>'); ?></li>
                        <?php echo getPostLikeLink(get_the_ID());?> 
                        <?php if (has_category('',$post->ID)): ?>
                            <li><span class="icon">&#59392;</span> <?php _e('Categorized in','hurry'); ?> <?php the_category(', '); ?></li>
                        <?php endif; ?>    
                        <?php if (has_tag('',$post->ID)): ?>                       
                            <li><span class="icon">&#128278;</span> <?php _e('Tagged in','hurry'); ?> <?php the_tags(', '); ?></li>
                        <?php endif; ?>
                        <li><span class="icon">&#128100;</span> <?php _e('By','hurry'); ?> <?php the_author_link(); ?></li>
                        <?php if( function_exists('zilla_share') ): ?>
                            <li><span class="icon">&#59157;</span><?php zilla_share(); ?></li>
                        <?php endif; ?>
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
        <div id="container-footer">
            <nav class="post-navigation" role="navigation">
                <?php next_post_link( '%link', '&#59229' ); ?>
                <?php previous_post_link( '%link',  '&#59230'); ?>
            </nav><!-- end .navigation -->
        </div><!-- end #container-footer -->

    </article><!-- end .post -->

    <?php if( rwmb_meta('hurry_post_sidebar') == "1"): ?>
        <?php get_sidebar(); ?>
    <?php endif; ?> 

<?php 
/*
* OTHERWISE IF IT'S ARCHIVE/SEARCH/CATEGORY/HOME.
*/
} elseif( is_home() OR is_search() OR is_archive() ) {
?>
    <!-- // A POST // --> 
    <div class="post post-quote masonry-item view <?php if(is_sticky()): ?>sticky<?php endif;?>">
        <div class="post-absolute-container">
            <?php if ( has_post_thumbnail() ): ?>
               <a href="<?php echo get_permalink( $id ); ?>"><?php the_post_thumbnail(); ?></a>
            <?php else: ?>
                <div class="post-home-content <?php if( rwmb_meta('hurry_post_border') == "1"): ?>bordered<?php endif; ?>">
                    <blockquote>
                        <p><?php the_content()?></p><small><?php echo rwmb_meta('hurry_post_quote_author'); ?></small>
                    </blockquote>
                </div>
            <?php endif; ?>
            <?php if( rwmb_meta('hurry_post_hover') == "1"): ?>
                <div class="post-hidden">
                    <a href="<?php echo get_permalink( $id ); ?>" class="post-icon-link"><span class="post-icon icon large">&#10078;</span></a>
                    <div class="post-hover-matadata">
                        <ul>
                            <li><span class="icon">&#128340;</span> <a href="<?php echo get_permalink( $id ); ?>"> <?php the_time('F j, Y'); ?> </a></li>
                            <li><span class="icon">&#59160;</span> <?php comments_popup_link('0', '1', '%', 'comments-link', '<div class="commentoff"></div>'); ?></li>
                            <?php echo getPostLikeLink(get_the_ID());?> 
                        </ul>
                    </div><!-- end .post-hover-matadata -->
                </div><!-- end .post-hidden -->
            <?php endif; ?> 
        </div><!-- end .post-absolute-container -->
    </div><!-- end .post -->

<?php 
/*
* FOR STANDARD BLOG PAGE
*/
} else {
?>
    <!-- // A POST // --> 
    <div class="post post-quote">
        <?php if ( has_post_thumbnail() ): ?>
            <div id="container-header" class="featured-image-on">
                <?php
                    $image_id = get_post_thumbnail_id();  
                    $image_url = wp_get_attachment_image_src($image_id,'full');  
                    $image_url = $image_url[0];
                ?>
                <div style="background-image: url('<?php echo $image_url; ?>');">
                    <div class="container-padding">
                        <div class="center post-icon">
                            <span class="icon large">&#10078;</span>
                        </div>
                        <blockquote><p><?php the_content()?></p><small><?php echo rwmb_meta('hurry_post_quote_author'); ?></small></blockquote>
                    </div><!-- end .container-padding -->
                </div><!-- end .container -->
            </div><!-- end #container-header -->
        <?php else: ?>
            <div id="container-header">
                <div class="container-padding" style="background: #FFF;">
                    <div class="center post-icon">
                        <span class="icon large">&#10078;</span>
                    </div>
                    <blockquote><?php the_content()?><small><?php echo rwmb_meta('hurry_post_quote_author'); ?></small></blockquote>
                </div><!-- end .container-padding -->
            </div><!-- end #container-header -->
        <?php endif; ?>

        <div class="container-content">
            <div class="container-padding" style="padding: 10px;">

            </div><!-- end .container-padding -->
            <?php if( rwmb_meta('hurry_post_meta') == "1"): ?>
                <div class="breaker"></div>
                <!-- // POSTMETADATA // --> 
                <div id="postmetadata">
                    <ul>
                        <li><span class="icon">&#128340;</span> <?php the_time('F j, Y'); ?></li>
                        <li><span class="icon">&#59160;</span> <?php comments_popup_link('0 Comment', '1 Comment', '% Comments', 'comments-link', '<div class="commentoff">No comments on this post</div>'); ?></li>
                        <?php echo getPostLikeLink(get_the_ID());?> 
                        <?php if (has_category('',$post->ID)): ?>
                            <li><span class="icon">&#59392;</span> <?php _e('Categorized in','hurry'); ?> <?php the_category(', '); ?></li>
                        <?php endif; ?>    
                        <?php if (has_tag('',$post->ID)): ?>                       
                            <li><span class="icon">&#128278;</span> <?php _e('Tagged in','hurry'); ?> <?php the_tags(', '); ?></li>
                        <?php endif; ?>
                        <li><span class="icon">&#128100;</span> <?php _e('By','hurry'); ?> <?php the_author_link(); ?></li>
                        <?php if( function_exists('zilla_share') ): ?>
                            <li><span class="icon">&#59157;</span><?php zilla_share(); ?></li>
                        <?php endif; ?>
                    </ul>
                    <a href="<?php echo get_permalink( $id ); ?>" class="button"><?php _e('Read More','hurry'); ?>   <span class="icon">&oplus;</span></a>
                    <div class="clearboth"></div>
                </div><!-- end #postmetadata -->
            <?php endif; ?>
        </div><!-- end .container-content -->
    </div><!-- end .post -->

<?php 
} 
?>